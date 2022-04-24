<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{

    public function toArray($request)
    {

        $chat = $this->chat()->select()->first();
        $sender = $this->sender()->select('id' , 'name')->first();

        if($chat->user1_id == $sender->id){
            $reciver = $chat->user2()->select('id' , 'name')->get();
        }else{
            $reciver = $chat->user1()->select('id' , 'name')->get();
        }

        return [
            'id' => $this->id,
            'Sender ' => $sender,
            'reciver'=>$reciver,
            'body' => $this->body,
            'attachment ' => $this->attachment,
            'seen' => $this->seen,
            'created_at' =>$this->created_at->format('d/m/Y'),
            'updated_at' =>$this->updated_at->format('d/m/Y')
        ];
    }
}
