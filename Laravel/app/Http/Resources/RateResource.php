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
            'rate value' => $this->rate_value,
            'created_at' =>$this->created_at->format('d/m/Y'),
            'updated_at' =>$this->updated_at->format('d/m/Y')
        ];
    }


}

