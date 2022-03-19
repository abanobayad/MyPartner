<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request)
    {

        return parent::toArray($request);

//    return
//         [
//             'id'=>$this->id,
//             'user_id' => $this->user_id ,
//             'image' => public_path('uploads/Users/').$this->image ,
//             'address' =>$this->address ,
//             'bio' =>$this->bio ,
//             'phone' =>$this->phone ,
//             'gender' =>$this->gender ,
//             'created_at' =>$this->created_at->format('d/m/Y'),
//             'updated_at' =>$this->updated_at->format('d/m/Y')

//         ];
    }
}
