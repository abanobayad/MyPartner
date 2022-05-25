<?php

namespace App\Http\Resources;

use App\Models\CanceledRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request)
    {

        // return parent::toArray($request);

        // dd(CanceledRequest::where('requester_id' , $this->user_id )->first()->req_count);
   return
        [
            'user_id' => $this->user_id ,
            'name' => $this->user()->first()->name,
            // 'canceled_Requests' => $this->user()->cancelRequests()->first()->req_count,
            // 'canceled_Requests' => CanceledRequest::where('requester_id' , $this->user_id )->first()->req_count,

            'image' => 'uploads/Users/'.$this->image ,
            'address' =>$this->address ,
            'bio' =>$this->bio ,
            'phone' =>$this->phone ,
            'gender' =>$this->gender ,
            'updated_at' =>$this->updated_at->diffForhumans()

        ];
    }
}
