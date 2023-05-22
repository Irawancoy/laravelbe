<?php

namespace App\Http\Resources\client\Keranjang;

use Illuminate\Http\Resources\Json\JsonResource;

class KeranjangResource extends JsonResource
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
            'user_id' => $this->user_id,
            'ruangan_id' => $this->ruangan_id,
            'menu_id' => $this->menu_id,
            'duration' => $this->duration,
          //   'created_at' => $this->created_at,
          //   'updated_at' => $this->updated_at,
        ];
    }
}
