<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ChatResource;
use App\Models\chat;
use App\Models\message;
use App\Models\Req;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends BaseController
{

    // user1 is auth user

    public function conversation($user2)
    {
        $user1 = Auth::id();

        $chat = chat::select()->where([['user1_id',$user1],['user2_id',$user2]])->orWhere([['user1_id',$user2],['user2_id',$user1]])->first();

        if(is_null($chat)){
            return $this->SendError('there in no conversation with this user');
        }
        if( $chat->user1_id == Auth::id()){
            $messages = message::select()->where([ ['chat_id',$chat->id] , ['v_user1',1] ])->get();
        }else{
            $messages = message::select()->where([ ['chat_id',$chat->id] , ['v_user2',1] ])->get();
        }

        if(is_null($messages->first())){
            return $this->SendError('there in no conversation with this user');
        }

        foreach($messages as $message){
             message::where('sender_id', $user2)->update(['seen' => 1]);
        }

        $js_conv = ChatResource::collection($messages);
        return $this->SendResponse($js_conv, "conversation send");
    }



    public function send_message(Request $request , $user2){
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

            $user1 = Auth::id();
            $input['sender_id'] =$user1;
            $input['seen'] = 0;

            $chat = chat::select()->where([['user1_id',$user1],['user2_id',$user2]])->orWhere([['user1_id',$user2],['user2_id',$user1]])->first();
            if(is_null($chat)){
                $request = Req::select()->where([['post_owner_id',$user1 ],['requester_id',$user2,['status','accept'] ]])
                ->orWhere([['post_owner_id',$user2 ],['requester_id',$user1,['status','accept'] ]])->first();

                if($request == null){
                    return $this->SendError( "you can't send message to this user");
                }else{
                    $chat = chat::create([
                        'user1_id'=>$user1,
                        'user2_id'=>$user2,
                    ]);
                    $input['chat_id'] =$chat->id;
                }
            }else{
                $input['chat_id'] =$chat->id;
            }
            $message = message::create($input);
            $js_message = ChatResource::make($message);
            return $this->SendResponse($js_message, "message send");
        }
    }


    public function delete_message($id)
    {
        $message = message::find($id);
        if($message->sender_id == Auth::id() ){
            message::where('id', $id)->update(['v_user1' => '0']);
        }
        else{
            message::where('id', $id)->update(['v_user2' => '0']);
        }

        return $this->SendResponse(null, 'message Deleted Successfully');


    }

    // id of conversation
    public function delete_conversation($id)
    {
        $conversation = message::select()->where('chat_id',$id)->get();
        foreach($conversation as $message){
            if($message->sender_id == Auth::id() ){
                message::where('id', $message->id)->update(['v_user1' => '0']);
            }
            else{
                message::where('id', $message->id)->update(['v_user2' => '0']);
            }
        }

        return $this->SendResponse(null, 'conversation Deleted Successfully');
    }


    public function my_chats()
    {
        $data=[];
        $user1 = Auth::id();

        $Chats = chat::select()->where('user1_id',$user1)->orWhere('user2_id',$user1)->orderBy('created_at','DESC')->get();

        foreach ($Chats as $Chat){
            if($Chat->user1_id == $user1 ){
                $last_mess = message::select()->where([ ['chat_id',$Chat->id] , ['v_user1',1] ])->latest()->first();
                if(!is_null($last_mess)){
                    $receiver = $Chat->user2()->first();
                    $receiver_id = $receiver->id;
                    $receiver_name =  $receiver->name;
                    $receiver = User::find($receiver_id);
                    $avatar = $receiver->profile()->first()->image;
                    $avatar = "uploads/Users/".$avatar;
                    array_push($data,["user_id" => $receiver_id,"user_name"=>$receiver_name,"image"=> $avatar,"last_message" => $last_mess->body,"date"=>$last_mess->created_at->diffForhumans()]);}
            }else{
                $last_mess = message::select('body','created_at')->where([ ['chat_id',$Chat->id] , ['v_user2',1] ])->latest()->first();
                if(!is_null($last_mess)){
                    $receiver = $Chat->user1()->first();
                    $receiver_id = $receiver->id;
                    $receiver_name =  $receiver->name;
                    $receiver = User::find($receiver_id);
                    $avatar = $receiver->profile()->first()->image;
                    $avatar = "uploads/Users/".$avatar;
                    array_push($data,["user_id" => $receiver_id,"user_name"=>$receiver_name,"image"=> $avatar,"last_message" => $last_mess->body,"date"=>$last_mess->created_at->diffForhumans()]);}
            }
        }

        return $this->SendResponse($data, 'chats sent Successfully');

    }


}
