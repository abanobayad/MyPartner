<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'Sender ' => $data->receiver()->select('id', 'name')->get(),
                    'receiver ' => $data->sender()->select('id', 'name')->get(),
                    'rate_value' => $data->rate_value,
                    'feedback' => $data->feedback,
                    'updated_at' => $data->updated_at->diffForhumans()
                ];
            })
        ];
    }
}
