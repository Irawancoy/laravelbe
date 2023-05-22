<?php

namespace App\Http\Resources\Admin\Layanan;

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
            'id' => $this->resource->id_ruangan,
            'nama' => $this->resource->nama,
            'harga1jam' => $this->resource->harga1jam,
            'harga3jam' => $this->resource->harga3jam,
            'deskripsi' => $this->resource->deskripsi,
            'gambar' => $this->resource->fotoUrl(),
            'status' => $this->resource->status
            
        ];
    }
}
