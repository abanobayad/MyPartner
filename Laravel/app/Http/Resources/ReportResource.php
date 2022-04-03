<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{

    public function toArray($request)
    {


        return
        [
            'id' => $this->id,

            'user ' => $this->user()->select('id' , 'name')->get(),
            'post ' => $this->post()->select('id' , 'title')->get(),

            'reason ' => $this->reason,
            'feedback ' => $this->feedback,
            'created_at' =>$this->created_at->format('d/m/Y'),
            'updated_at' =>$this->updated_at->format('d/m/Y')

        ];
    }
}
