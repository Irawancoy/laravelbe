<?php 
namespace App\Helpers\Admin\Rekap;

use App\Models\Admin\RekapModel;

class RekapHelper
{
    protected $rekapModel;
    public function __construct()
    {
        $this->rekapModel = new RekapModel();
    }

    public function getTransaksi(){
            $data=[
               'transaksi'=>$this->rekapModel->getAllTransaksi(),
            ];
            return $data;
    }           
    }
