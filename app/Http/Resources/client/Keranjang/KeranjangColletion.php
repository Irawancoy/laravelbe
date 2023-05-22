<?php

namespace App\Http\Resources\client\Keranjang;;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KeranjangCollection extends ResourceCollection
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
            'list' => $this->collection, // otomatis mengikuti format UserResource
  
        ];
    }
}
