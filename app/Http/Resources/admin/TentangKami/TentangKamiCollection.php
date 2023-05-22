<?php

namespace App\Http\Resources\Admin\TentangKami;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TentangKamiCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'list' => $this->collection, // this is the collection of items
        ];
    }
}
