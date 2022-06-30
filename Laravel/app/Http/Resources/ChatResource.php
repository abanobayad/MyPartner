<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{

    public function toArray($request)
    {

        $chat = $this->chat()->select()->first();
        $sender = $this->sender()->select('id' , 'name')->first();
        $user = [];
        array_push($user,["id" => $sender->id,"name"=>$sender->id]);


        if($chat->user1_id == $sender->id){
            $reciver = $chat->user2()->select('id' , 'name')->get();
        }else{
            $reciver = $chat->user1()->select('id' , 'name')->get();
        }

        return [
            'id' => $this->id,
            'Sender ' => $user,
            'reciver'=>$reciver,
            'body' => $this->body,
            'attachment ' => $this->attachment,
            'seen' => $this->seen,
            'created_at' =>$this->created_at->diffForhumans()
        ];
    }
}
