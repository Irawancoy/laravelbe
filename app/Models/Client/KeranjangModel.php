<?php

namespace App\Models\Client;

use App\Models\Admin\LayananModel;
use App\Models\Admin\MenuModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\RecordSignature;

class KeranjangModel extends Model
{

    use  RecordSignature;
    protected $table = 'carts';
    protected $primaryKey = 'id_keranjang';
    public $timestamps = true;

    protected $fillable = [
        'id_customer',
        'id_ruangan',
        'id_menu',
        'duration',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_customer', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo(LayananModel::class, 'id_ruangan', 'id_ruangan');
    }

    public function menu()
    {
        return $this->belongsTo(MenuModel::class, 'id_menu', 'id_menu');
    }

    public function getTotalPriceAttribute()
    {
        $ruanganPrice = $this->ruangan->harga1jam;
        if ($this->duration === '3 jam') {
            $ruanganPrice = $this->ruangan->harga3jam;
        }

        $menuPrice = $this->menu->harga;

        return $ruanganPrice + $menuPrice;
    }
    public function store(array $payload)
    {
        return $this->create($payload);
    }
    public function getCartItemsByUserId($userId)
{
    return $this->where('id', $userId)->get();
}

}
