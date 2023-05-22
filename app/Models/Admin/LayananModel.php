<?php

namespace App\Models\Admin;

use App\Http\Traits\RecordSignature;
use App\Models\Client\KeranjangModel;
use App\Repository\ModelInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LayananModel extends Model 
{
    use HasFactory,SoftDeletes,RecordSignature;

    /**
    * Menentukan nama tabel yang terhubung dengan Class ini
    *
    * @var string
    */
    protected $table = 't_ruangan';

    /**
     * Menentukan primary key, jika nama kolom primary key adalah "id",
     * langkah deklarasi ini bisa dilewati
     *
     * @var string
     */
    protected $primaryKey = 'id_ruangan';

    /**
     * Akan mengisi kolom "created_at" dan "updated_at" secara otomatis,
     *
     * @var bool
     */
    public $timestamps = true;

  

    protected $fillable = [
        'nama',
        'harga1jam',
        'harga3jam',
        'deskripsi',
        'gambar',
        'prosedur',
        'status',
    ];
    public function carts()
    {
        return $this->hasMany(KeranjangModel::class, 'id_ruangan', 'id_ruangan');
    }
    
    public function fotoUrl() {
        if(empty($this->gambar)) {
            return asset('assets/img/kosong.jpg');
        }

        // return $this->foto;
        return asset('storage/'.$this->gambar);

    }

    
    public function getAll(): object
    {
        return $this->query()->get();
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
        // dd($payload);
        return $this->find($id)->update($payload);
    }

    public function drop(int $id)
    {
        // dd($id);
        return $this->find($id)->delete();
    }



}
