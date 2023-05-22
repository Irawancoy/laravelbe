<?php

namespace App\Models\Admin;

use App\Http\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProsedurModel extends Model
{
    use HasFactory,SoftDeletes,RecordSignature;

    protected $table = 't_prosedur';

    protected $primaryKey = 'id_prosedur';

    public $timestamps = true;  

    protected $fillable = [
        'id_prosedur',
        'deskripsi',
        'nomer'
    
    ];

    public function getAll(): object
    {
        return $this->all();
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
