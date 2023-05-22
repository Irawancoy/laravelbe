<?php

namespace App\Http\Resources\Admin\KategoriMenu;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
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
            'id'=>$this->resource->id,
            'nama'=>$this->resource->nama,
            'deskripsi'=>$this->resource->deskripsi,
            'status'=>$this->resource->status
            
        ];
    }
}
