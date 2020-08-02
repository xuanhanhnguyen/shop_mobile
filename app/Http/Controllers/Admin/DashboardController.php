<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function show()
    {
        $data = DB::select('SELECT sum(tong_tien) as \'ttien\', MONTH(created_at) as \'thang\' FROM `hoa_don` GROUP BY  MONTH(created_at)');
        $value = [];
        for ($i = 0; $i < 12; $i++) {
            $value[$i] = 0;
            for ($j = 0; $j < sizeof($data); $j++) {
                if ($i + 1 == $data[$j]->thang) {
                    $value[$i] = $data[$j]->ttien;
                }
            }
        }

        $date = getdate();

        $day = DB::select("SELECT ten_sp, sum(don_gia) as \"ttien\"
            FROM chi_tiet_hoa_don ct JOIN san_pham sp on  sp.id=ct.san_pham_id
            WHERE ct.hoa_don_id IN (SELECT id
            FROM hoa_don WHERE DAY(created_at) = ? and MONTH(created_at) = ? and YEAR(created_at) = ?)
            GROUP BY ten_sp ORDER BY ttien ASC limit 3", [$date['mday'], $date['mon'], $date['year']]);

        $mon = DB::select("SELECT ten_sp, sum(don_gia) as \"ttien\"
            FROM chi_tiet_hoa_don ct JOIN san_pham sp on  sp.id=ct.san_pham_id
            WHERE ct.hoa_don_id IN (SELECT id
            FROM hoa_don WHERE MONTH(created_at) = ? and YEAR(created_at) = ?)
            GROUP BY ten_sp ORDER BY ttien ASC limit 3", [$date['mon'], $date['year']]);

        return response()->json(compact('value', 'day', 'mon'));
    }

    public function thong_ke(){
        return view('admin.dashboard');
    }
}
