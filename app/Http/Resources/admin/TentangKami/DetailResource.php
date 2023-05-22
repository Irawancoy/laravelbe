<?php

namespace App\Http\Resources\Admin\TentangKami;

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
            'id' => $this->resource->id,
            'judul' => $this->resource->judul,
            'deskripsi' => $this->resource->deskripsi,
            'gambar' => $this->resource->fotoUrl()

          
        ];
    }
}
