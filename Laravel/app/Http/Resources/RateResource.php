<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'Sender ' => $this->receiver()->select('id' , 'name')->get(),
            'receiver ' => $this->sender()->select('id' , 'name')->get(),
            'rate_value' => $this->rate_value,
            'feedback' => $this->feedback,
            'updated_at' =>$this->updated_at->diffForhumans()
        ];
    }


}

