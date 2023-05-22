<?php 
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\Dashboard\DashboardHelper;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    protected $dashboardHelper;
    public function __construct()
    {
        $this->dashboardHelper = new DashboardHelper();
    }
    public function index(Request $request)
    {
  
        $data = $this->dashboardHelper->getData($request);
        return response()->json($data);
    }
 
}
