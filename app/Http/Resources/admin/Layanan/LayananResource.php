<?php

namespace App\Http\Resources\Admin\Layanan;

use Illuminate\Http\Resources\Json\JsonResource;

class LayananResource extends JsonResource
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
            'id' => $this->id_ruangan,
            'nama' => $this->nama,
            'harga1jam' => $this->harga1jam,
            'harga3jam' => $this->harga3jam,
            'deskripsi' => $this->deskripsi,
            'gambar' => $this->fotoUrl(),
            'status' => $this->status
        ];

    }
}
