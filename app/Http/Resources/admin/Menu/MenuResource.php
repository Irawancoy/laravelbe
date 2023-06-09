<?php

namespace App\Http\Resources\Admin\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id' => $this->id_menu,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'gambar' =>$this->fotoUrl(),
            'status' => $this->status,
           
            'kategori' => $this->kategori,
         
        ];

    }
}
