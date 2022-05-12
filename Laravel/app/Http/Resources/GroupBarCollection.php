<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupBarCollection extends ResourceCollection
{
    public  $tags = [];
    public function toArray($request)
    {
        // dd($this->collection->map->tags->first());
        foreach ($this->collection->map->tags->first() as $tag ){
            array_push($this->tags ,['id' =>$tag->id,'name'=>$tag->name]);}
        // dd($this->tags);
        return [
                $this->collection->map(function($data) {
                    return [
                        'id'                => $data->id,
                        'name'              =>$data->name,
                        'description'       =>$data->description,
                        'image'             => 'uploads/Groups/'.$data->image,
                        'created_at'        =>$data->created_at->format('d/m/Y'),
                        'updated_at'        =>$data->updated_at->format('d/m/Y'),
                        'Category'          =>[
                                            'id'=>$data->category->id,
                                            'name'=>$data->category->name,
                                            'created_at'=>$data->category->created_at->format('d/m/Y')
                                                ],
                        'Tags'              => $this->tags
                    ];
                })
        ];

    }
}
