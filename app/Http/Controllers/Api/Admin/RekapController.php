<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Rekap\RekapHelper;

class RekapController extends Controller
{
    protected $rekapHelper;
    public function __construct()
    {
        $this->rekapHelper = new RekapHelper();
    }

  public function rekapTransaksi(){
        $data=$this->rekapHelper->getTransaksi();
        return response()->json($data);
  }
    
}
