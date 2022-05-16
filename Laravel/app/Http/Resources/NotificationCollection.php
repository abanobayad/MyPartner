<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // // return parent::toArray($request);



        // foreach ($this->collection->map->tags->first() as $tag ){
        //     array_push($this->tags ,['id' =>$tag->id,'name'=>$tag->name]);
        // }
        // // dd($this->tags);
        return [
                'Notifiactions' => $this->collection->map(function($data) {
                    return [
                        'id'                => $data->id,
                        'type'                => $data->type,
                        'details'              => $data->data,
                        'created_at'        => $data->created_at->diffForhumans()
                    ];})];


    }
}
