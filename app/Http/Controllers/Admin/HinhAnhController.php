<?php

namespace App\Http\Controllers\Admin;

use App\hinh_anh;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HinhAnhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if ($request->hasFile('img')) {
            $image = Str::random() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move("uploads/product/", $image);
            $data = collect($request->all())->merge([
                'ten' => $image,
                'sp_id' => $id
            ])->toArray();
            hinh_anh::create($data);
            return redirect('/admin/product/' . $request->cat)->with("message", "Thêm ảnh thành công !");
        }
        return redirect('/admin/product/' . $request->cat)->with("error", "Thêm ảnh thất bại!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        hinh_anh::find($id)->delete();
        return redirect()->back()->with("message", "Xóa thành công!");
    }
}
