<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class RekapModel extends Model
{
    use HasFactory, HasRelationships;
    protected $table = 't_detail_transaksi';
    protected $primaryKey = 'id_detail';


   
    public function getAllTransaksi(){
        $query="SELECT t_detail_transaksi.id_detail as id_detail, 
        t_detail_transaksi.id_transaksi  as id_transaksi, 
        t_detail_transaksi.id_menu as id_menu,
        t_detail_transaksi.jumlah as jumlah_menu, 
        t_detail_transaksi.total as total,
        t_menu.nama as nama_menu,
        t_menu.harga as harga,
        t_transaksi.total_bayar as total_bayar,
        t_transaksi.jenis as jenis_transaksi,
        t_transaksi.tanggal as tanggal_transaksi,
        t_customer.nama as nama_customer"

        
        ." FROM t_detail_transaksi"
        ." INNER JOIN t_menu ON t_detail_transaksi.id_menu = t_menu.id_menu"
        ." INNER JOIN t_transaksi ON t_detail_transaksi.id_transaksi = t_transaksi.id_transaksi"
        ." INNER JOIN t_customer ON t_transaksi.id_user = t_customer.id";
        $data = collect(DB::select($query));
        
        $groupedMenus = $data->groupBy('id_transaksi')->map(function ($group) {
            return [
                'id_detail' => $group[0]->id_detail,
                'id_transaksi' => $group[0]->id_transaksi,
                // 'nama_ruangan' => $group[0]->nama_ruangan,
                'menu' => $group->map(function($item) {
                    return [
                        'id_menu'=>$item->id_menu,
                        'nama'=>$item->nama_menu,
                        'harga'=>$item->harga,
                        'jumlah'=>$item->jumlah_menu,
                        'total'=>$item->total,
                    ];
                }),
                'total_bayar' => $group[0]->total_bayar,
                'jenis_transaksi' => $group[0]->jenis_transaksi,
                'tanggal_transaksi' => $group[0]->tanggal_transaksi,
                'nama_customer' => $group[0]->nama_customer,
            ];
        })->values()->toArray();
        
        return $groupedMenus;
    }
    

}
