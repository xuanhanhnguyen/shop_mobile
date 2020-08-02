<?php

namespace App\Http\Controllers\Admin;

use App\bao_hanh;
use App\cthd;
use App\hoa_don;
use App\san_pham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaoHanhController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bh = DB::select("SELECT bh.id,bh.hoa_don_id, kh.ten_kh, kh.dien_thoai, sp.ten_sp, bh.thoi_gian_bao_hanh, bh.ly_do_bao_hanh
            FROM bao_hanh bh 
            JOIN san_pham sp on sp.id = bh.san_pham_id
            JOIN hoa_don hd on hd.id = bh.hoa_don_id
            JOIN khach_hang kh on kh.id = hd.khach_hang_id");
        return view('admin.bh.index', compact('bh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sp = san_pham::all();
        $hd = hoa_don::all();
        return view('admin.bh.create', compact('sp', 'hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        bao_hanh::create($request->all());
        return redirect('admin/bh')->with("message", "Thêm thành công !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bh = bao_hanh::findOrFail($id);
        $sp = san_pham::all();
        $hd = hoa_don::all();
        return view('admin.bh.update', compact('bh', 'sp', 'hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = cthd::with('san_pham')->where('hoa_don_id', $id)->get();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bh = bao_hanh::find($id);
        $bh->update($request->all());
        return redirect('admin/bh')->with("message", "Cập nhật thành công !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        bao_hanh::find($id)->delete();
        return redirect('admin/bh')->with("message", "Xóa thành công!");
    }
}
