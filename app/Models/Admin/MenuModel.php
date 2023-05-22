<?php

namespace App\Models\Admin;

use App\Http\Traits\RecordSignature;
use App\Models\Client\KeranjangModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repository\ModelInterface;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class MenuModel extends Model 
{
    use HasFactory,SoftDeletes,RecordSignature,HasRelationships;
       /**
    * Menentukan nama tabel yang terhubung dengan Class ini
    *
    * @var string
    */
    protected $table = 't_menu';

    /**
     * Menentukan primary key, jika nama kolom primary key adalah "id",
     * langkah deklarasi ini bisa dilewati
     *
     * @var string
     */
    protected $primaryKey = 'id_menu';

    /**
     * Akan mengisi kolom "created_at" dan "updated_at" secara otomatis,
     *
     * @var bool
     */
    public $timestamps = true;

    protected $attributes = [

    ];

    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'gambar',
        'status',
        'kategori'
    ];
    public function carts()
    {
        return $this->hasMany(KeranjangModel::class, 'id_menu', 'id_menu');
    }
    public function fotoUrl() {
        if(empty($this->gambar)) {
            return asset('assets/img/kosong.jpg');
        }

        // return $this->gambar;
        return asset('storage/'.$this->gambar);

    }

    public function getAll(): object
    {
        return $this->query()->get();
    }
    // public function kategoriMenu()
    // {
    //     return $this->hasOne(KategoriMenuModel::class, 'id', 'id_kategori_menu');
    // }

  
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
    public function getByIds(array $ids): object
    {
        return $this->whereIn('id_menu', $ids)->get();
    }

}
