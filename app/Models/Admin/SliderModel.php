<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='t_slider';

    public $timestamps = true;

    protected $fillable = [
        'gambar',
    ];
    public function fotoUrl(){
        if(empty($this->gambar)){
            return asset('assets/img/kosong.jpg');
        }
        return asset('storage/'.$this->gambar);
    }
    public function getAll(): object
    {
        return $this->all();
    }
    public function getById($id): object
    {
        return $this->find($id);
    }

    public function store(array $data)
    {
        return $this->create($data);
    }
    public function edit(array $payload, int $id)
    {
        return $this->find($id)->update($payload);
    }
    public function drop(int $id)
    {
        return $this->find($id)->delete();
    }

    
}
