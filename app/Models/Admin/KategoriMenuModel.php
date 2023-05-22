<?php

namespace App\Models\Admin;

use App\Http\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repository\ModelInterface;

class KategoriMenuModel extends Model implements ModelInterface
{
    use HasFactory,SoftDeletes,RecordSignature;
      /**
    * Menentukan nama tabel yang terhubung dengan Class ini
    *
    * @var string
    */
    protected $table = 't_kategori_menu';

    /**
     * Menentukan primary key, jika nama kolom primary key adalah "id",
     * langkah deklarasi ini bisa dilewati
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
        'deskripsi',
        'status',
    ];

    public function getAll(array $filter, int $itemPerPage = 0, string $sort = ''): object
    {
        $dataItem = $this->query();

        if (!empty($filter['nama'])) {
            $dataItem->where('nama', 'LIKE', '%'.$filter['nama'].'%');
        }


        $sort = $sort ?: 'id DESC';
        $dataItem->orderByRaw($sort);
        $itemPerPage = $itemPerPage > 0 ? $itemPerPage : false;

        return $dataItem->paginate($itemPerPage)->appends('sort', $sort);
        // return $dataItem->get();
    }

   
    public function getById(int $id): object
    {
        // dd($id);
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
