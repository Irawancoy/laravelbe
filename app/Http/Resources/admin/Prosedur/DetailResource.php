<?php

namespace App\Http\Resources\Admin\Prosedur;

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
            'id' => $this->resource->id_prosedur,
            'nomer'=>$this->resource->nomer,
            'deskripsi' => $this->resource->deskripsi,
          
        ];
    }
}
