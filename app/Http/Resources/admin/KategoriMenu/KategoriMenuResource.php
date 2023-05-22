<?php

namespace App\Http\Resources\Admin\KategoriMenu;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriMenuResource extends JsonResource
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
            'id' => $this->id,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status
         
        ];

    }
}
