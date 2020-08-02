<?php

namespace App\Http\Controllers;

use App\cthd;
use App\hoa_don;
use App\khach_hang;
use App\loai_sp;
use App\san_pham;
use App\tin_tuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    public function home()
    {
        if (isset(\request()->search) || isset(\request()->cat)) {
            $san_pham = san_pham::where('trang_thai', 1)->where('ten_sp', 'like', '%' . \request()->search . '%')->paginate(12);
            if (isset(\request()->cat)) {
                $san_pham = san_pham::where('trang_thai', 1)->where('loai_id', \request()->cat)->paginate(12);
            }
        } else if (isset(\request()->manny)) {
            switch (\request()->manny) {
                case 1:
                    $san_pham = san_pham::where('trang_thai', 1)->where('gia', '<', 2000000)->paginate(12);
                    break;
                case 2:
                    $san_pham = san_pham::where('trang_thai', 1)->where('gia', '>=', 2000000)->where('gia', '<=', 4000000)->paginate(12);
                    break;
                case 3:
                    $san_pham = san_pham::where('trang_thai', 1)->where('gia', '>=', 4000000)->where('gia', '<=', 7000000)->paginate(12);
                    break;
                case 4:
                    $san_pham = san_pham::where('trang_thai', 1)->where('gia', '>=', 7000000)->where('gia', '<=', 13000000)->paginate(12);
                    break;
                case 5:
                    $san_pham = san_pham::where('trang_thai', 1)->where('gia', '>', 13000000)->paginate(12);
                    break;
                default:
                    $san_pham = san_pham::where('trang_thai', 1)->paginate(12);
            }
        } else {
            $san_pham = san_pham::where('trang_thai', 1)->paginate(12);
        }
        $cat = loai_sp::all();
        $news = tin_tuc::all();
        return view('home', compact('san_pham', 'cat', 'news'));
    }

    public function detail($id)
    {
        $data = san_pham::with('images')->find($id);
        $data->thong_so = explode(';', $data->thong_so);
        $cat = loai_sp::all();
        return view('detail', compact('data', 'cat'));
    }


    public function order(Request $request)
    {
        $sp = san_pham::find($request->san_pham_id);
        if($sp->so_luong - $request->sl_mua < 0){
            return 0;
        }
        $sp->update(['so_luong' => $sp->so_luong - $request->sl_mua]);

        $kh = khach_hang::updateOrCreate(['ten_kh' => $request->ten_kh, 'email' => $request->email, 'dien_thoai' => $request->dien_thoai], ['dia_chi' => $request->dia_chi]);
        $hd = hoa_don::create([
            'khach_hang_id' => $kh->id,
            'tong_tien' => $request->sl_mua * san_pham::find($request->san_pham_id)->gia,
            'create_by' => Auth::user()->id
        ]);

        cthd::create([
            'hoa_don_id' => $hd->id,
            'san_pham_id' => $request->san_pham_id,
            'sl_mua' => $request->sl_mua,
            'don_gia' => $request->sl_mua * san_pham::find($request->san_pham_id)->gia,
        ]);
        return 1;
    }

    public function new($id)
    {
        $cat = loai_sp::all();
        $new = tin_tuc::find($id);
        return view('new-detail', compact('new', 'cat'));
    }

    public function cart(Request $request)
    {
        $cart = \Session::get('cart') ?: [];
        array_push($cart, $request->id);
        \Session::put('cart', array_unique($cart));

        return 1;
    }

    public function orderCart(Request $request)
    {
        foreach ($request->san_pham as $item) {
            $sp = san_pham::find($item['id']);
            if($sp->so_luong - $item['sl_mua'] < 0){
                return 0;
            }
            $sp->update(['so_luong' => $sp->so_luong - $item['sl_mua']]);
        }
        $kh = khach_hang::updateOrCreate(['ten_kh' => $request->ten_kh, 'email' => $request->email, 'dien_thoai' => $request->dien_thoai], ['dia_chi' => $request->dia_chi]);
        $hd = hoa_don::create([
            'khach_hang_id' => $kh->id,
            'tong_tien' => $request->tong_tien,
            'create_by' => Auth::user()->id
        ]);

        foreach ($request->san_pham as $item) {
            cthd::create([
                'hoa_don_id' => $hd->id,
                'san_pham_id' => $item['id'],
                'sl_mua' => $item['sl_mua'],
                'don_gia' => $item['don_gia'],
            ]);
        }

        return 1;
    }

    public function getCart()
    {
        $cart = \Session::get('cart') ?: [];
        $sp = san_pham::whereIn('id', $cart)->get();
        return $sp;
    }

}
