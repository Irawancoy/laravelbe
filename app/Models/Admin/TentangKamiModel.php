<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TentangKamiModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 't_tentang_kami';

    public $timestamps = true;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
     
    ];

    public function fotoUrl() {
        if(empty($this->gambar)) {
            return asset('assets/img/kosong.jpg');
        }

        // return $this->gambar;
        return asset('storage/'.$this->gambar);

    }

    public function getAll(): object
    {
        return $this->get();
    }

    public function getById(int $id): object
    {
        return $this->find($id);
    }

    
    public function store(array $payload)
    {
        // dd($payload);
        return $this->create($payload);
    }

    public function edit(array $payload, int $id)
    {
        return $this->find($id)->update($payload);
    }

    public function drop(int $id)
    {
        // dd($id);
        return $this->find($id)->delete();
    }

}
