<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ChatResource;
use App\Models\chat;
use App\Models\Req;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends BaseController
{

    public function conversation($reciver_id)
    {
        $user1 = Auth::id();
        $user2 = $reciver_id;
        $conversation = chat::select()->where([['sender_id',$user2],['receiver_id',$user1],['v_r',1]])
                        ->orWhere([['receiver_id',$user2],['sender_id',$user1],['v_s',1]])->orderBy('created_at','DESC')->get();

        if(is_null($conversation->first())){
            return $this->SendError('there in no conversation with this user');
        }

        foreach($conversation as $message){
            if($message->receiver_id == Auth::id() ){
                chat::where('sender_id', $reciver_id)->where('receiver_id', Auth::id())->update(['seen' => 1]);
            }
        }
        $js_conv = ChatResource::collection($conversation);
        return $this->SendResponse($js_conv, "conversation send");
    }



    public function send_message(Request $request , $receiver_id){
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'body' => 'required',
                'attach' => 'nullable|string',
            ]
            );
        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        }else{

            $input['sender_id'] = Auth::id();
            $input['receiver_id'] = $receiver_id;
            $input['seen'] = 0;


            $request = Req::select()->where([['post_owner_id',$input['sender_id']],['requester_id',$input['receiver_id'],['status','accept'] ]])
            ->orWhere([['post_owner_id',$input['receiver_id'] ],['requester_id',$input['sender_id'],['status','accept'] ]])->first();

            if($request == null){
                return $this->SendError( "you can't send message to this user");
            }

            $message = chat::create($input);
            $js_message = ChatResource::make($message);
            return $this->SendResponse($js_message, "message send");
        }
    }


    public function delete_message($id)
    {
        $message = chat::find($id);
        if($message->sender_id == Auth::id() ){
            chat::where('id', $id)->update(['v_s' => '0']);
        }
        elseif($message->receiver_id == Auth::id()){
            chat::where('id', $id)->update(['v_r' => '0']);
        }

        return $this->SendResponse(null, 'message Deleted Successfully');


    }

    public function delete_conversation($user_id)
    {
        $senderId = Auth::id();
        $receiverId = $user_id;
        $conversation = chat::select()->where([['sender_id',$receiverId],['receiver_id',$senderId]])
                        ->orWhere([['receiver_id',$receiverId],['sender_id',$senderId]])->get();

        foreach($conversation as $message){
            if($message->sender_id == Auth::id() ){
                chat::where('id', $message->id)->update(['v_s' => '0']);
            }
            elseif($message->receiver_id == Auth::id()){
                chat::where('id', $message->id)->update(['v_r' => '0']);
            }
        }

        return $this->SendResponse(null, 'conversation Deleted Successfully');
    }


    public function my_chats()
    {
        $data=[];

        $user = Auth::id();
        $Chats = chat::select()->where('sender_id',$user)->orWhere('receiver_id',$user)->orderBy('created_at','DESC')->get();

        foreach ($Chats as $Chat){
            if($Chat->sender_id == $user ){
                $last_mess = $Chat->latest()->first();
                array_push($data,["user_id" => $Chat->receiver_id],["last_message" => $last_mess]);
            }else{
                $last_mess = $Chat->latest()->first();
                array_push($data,["user_id" => $Chat->sender_id],["last_message" => $last_mess]);
            }
        }

        return $this->SendResponse($data, 'chats sent Successfully');

    }


}
