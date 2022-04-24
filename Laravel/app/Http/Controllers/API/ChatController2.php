<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\ChatResource;
use App\Models\chat;
use App\Models\Req;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController2 extends BaseController
{

    public function conversation($reciver_id)
    {
        $senderId = Auth::id();
        $receiverId = $reciver_id;
        $conversation = chat::select()->where([['sender_id',$receiverId],['receiver_id',$senderId]])
                        ->orWhere([['receiver_id',$receiverId],['sender_id',$senderId]])->orderBy('created_at','DESC')->get();

        if(is_null($conversation)){
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
        if ($message->sender_id != Auth::id() || $message->reciver_id != Auth::id()) {
            return $this->SendError("You Are Not Allowed to delete this message");
        }else{
            $message = $message->delete();
            return $this->SendResponse($message, 'message Deleted Successfully');
        }

    }

    public function delete_conversation($user_id)
    {
        $senderId = Auth::id();
        $receiverId = $user_id;
        $conversation = chat::select()->where([['sender_id',$receiverId],['receiver_id',$senderId]])
                        ->orWhere([['receiver_id',$receiverId],['sender_id',$senderId]])->delete();

        return $this->SendResponse(null, 'conversation Deleted Successfully');
    }


    public function my_chats()
    {
        $user = Auth::id();
        $chats1 = Chat::where('sender_id',$user)
        ->orderBy('updated_at', 'desc')->get()
        ->groupBy('receiver_id');


        // $chats = Chat::select(DB::raw('*, max(updated_at) as updatedAt'))
        // ->where('sender_id',$user)
        // ->orderBy('updatedAt', 'desc')
        // ->groupBy('receiver_id')
        // ->get();
        // $chats2 = Chat::where('receiver_id',$user)
        // ->orderBy('updated_at', 'desc')->get()
        // ->unique('sender_id');
        // $js_chats1 = new ChatCollection($chats1);
        // $js_chats2 = new ChatCollection($chats2);
        // $data =[];
        // array_push($data , [$js_chats1  , $js_chats2 ]);
        return $this->SendResponse($chats1, 'chats sent Successfully');

    }


}
