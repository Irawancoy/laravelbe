<?php
namespace App\Helpers\Admin\Dashboard;
use App\Models\Admin\DashboardModel;

class DashboardHelper
{
   protected $dashboardModel;
     public function __construct()
     {
           $this->dashboardModel = new DashboardModel();
     }
 public function getData()
 {
      $tahun=date('Y');
     
     
     $dateSekarang =date('Y-m-d');
     $dateKemarin=date('Y-m-d', strtotime('-1 day', strtotime($dateSekarang)));
     $bulanIni=date('Y-m-d');
     $bulanKemarin=date('Y-m-d', strtotime('-31 day', strtotime($bulanIni)));
     $tahunIni=date('Y-m-d');
     $tahunKemarin=date('Y-m-d');
// dd($bulanKemarin);
     $data=[
          'hari_ini'=>$this->dashboardModel->getDay($dateSekarang),
          'kemarin'=>$this->dashboardModel->getKemarin($dateKemarin),
    'bulan_ini'=>$this->dashboardModel->getBulan(date('m',strtotime($bulanIni)),date('Y',strtotime($bulanIni))),
    'bulan_kemarin'=>$this->dashboardModel->getBulan(date('m',strtotime($bulanKemarin)),date('Y',strtotime($bulanKemarin))),
    'tahun_ini'=>$this->dashboardModel->getTahunIni($tahunIni) ,
     'tahun_kemarin'=>$this->dashboardModel->getTahunKemarin($tahunKemarin),
     'cash'=>$this->dashboardModel->cash(),
          'dp'=>$this->dashboardModel->dp(),
     ];
//      dd($tahun);
     for ($i=1; $i <=12 ; $i++) { 
       $data['nama_bulan'][$i]=$this->dashboardModel->getBulan($i,$tahun)->nama_bulan;
           $data['total_perbulan'][$i]=$this->dashboardModel->getBulan($i,$tahun)->total;
     }

  
return $data;
 }
}