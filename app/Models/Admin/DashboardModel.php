<?php
namespace App\Models\Admin;
 use Illuminate\Database\Eloquent\Model;
     use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
     public function getDay(){
          $query ="select CURDATE() as tanggal,
          SUM(CASE WHEN tanggal=CURDATE()THEN t_transaksi.total_bayar ELSE 0 END) as total
          FROM t_transaksi;";
          return DB::select($query);
          
     }

     public function getKemarin(){
          $query="select DATE_SUB(CURDATE(), INTERVAL 1 DAY) as tanggal,
          SUM(CASE WHEN tanggal=DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN t_transaksi.total_bayar ELSE 0 END) as total
          FROM t_transaksi;";
          return DB::select($query);
     }
public function getBulan($bulan,$tahun)
{
     $tahun=date('Y');
     
     // dd($queryTahun);
     $query="select MONTHNAME('2023-".$bulan."-01') as nama_bulan,
SUM(CASE WHEN MONTH(tanggal)=".$bulan." AND YEAR(tanggal)=".$tahun." THEN t_transaksi.total_bayar ELSE 0 END) as total
     FROM t_transaksi ";
    
     return DB::selectOne($query);
  
}
public function getTahunIni()
{
$query="select YEAR(CURDATE()) as tahun,
SUM(CASE WHEN YEAR(tanggal)=YEAR(CURDATE()) THEN t_transaksi.total_bayar ELSE 0 END) as total
FROM t_transaksi";

     return DB::select($query);
}
public function getTahunKemarin(){
     $query="select YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) as tahun,
     SUM(CASE WHEN YEAR(tanggal)=YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) THEN t_transaksi.total_bayar ELSE 0 END) as total
     FROM t_transaksi";
     return DB::select($query);
}

public function cash(){
     $query="select COALESCE(COUNT(*), 0) AS jumlah
             FROM t_transaksi
             WHERE jenis = 'cash'";
          
     return DB::select($query);
   }
   
   public function dp(){
     $query="select COALESCE(COUNT(*), 0) AS jumlah
             FROM t_transaksi
             WHERE jenis = 'dp'";
        
     return DB::select($query);
   }
   
}

