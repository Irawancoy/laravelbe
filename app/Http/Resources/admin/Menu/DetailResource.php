<?php

namespace App\Http\Resources\Admin\Menu;

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
            'id' => $this->resource->id_menu,
            'nama' => $this->resource->nama,
            'harga' => $this->resource->harga,
            'deskripsi' => $this->resource->deskripsi,
            'gambar' => $this->resource->fotoUrl(),
          
            'status' => $this->resource->status,
            // 'kategoriMenu' => [
            //     'id' => $this->kategoriMenu->id,
            //     'nama' => $this->kategoriMenu->nama,
            // ],
            'kategori' => $this->resource->kategori,
            
          
        ];
    }
}
