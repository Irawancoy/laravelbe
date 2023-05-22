<?php

namespace App\Http\Resources\admin\User;

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
            'nama' => $this->resource->nama,
            'email' => $this->resource->email,
            'foto' => $this->resource->fotoUrl(),
            'updated_security' => $this->resource->updated_security,
        ];
    }
}
