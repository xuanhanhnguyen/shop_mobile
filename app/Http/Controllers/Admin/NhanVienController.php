<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\nhan_vien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NhanVienController extends Controller
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
        $nv = nhan_vien::with('user')->get();
        return view('admin.nhan_vien.index', compact('nv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nhan_vien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = collect($request->all())->merge([
            'user_id' => Auth::user()->id,
        ])->toArray();


        nhan_vien::create($data);

        return redirect('admin/nv')->with("message", "Thêm nhân viên thành công !");
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
        $nv = nhan_vien::findOrFail($id);
        return view('admin.nhan_vien.update', compact('nv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Auth::user()->id;
        return view('admin.nhan_vien.password', compact('id'));
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
        //
        nhan_vien::find($id)->update($request->all());

        return redirect('admin/nv')->with("message", "Cập nhật nhân viên thành công !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        nhan_vien::findOrFail($id)->delete();
        return redirect('admin/nv')->with("message", "Xóa nhân viên thành công !");
    }
}