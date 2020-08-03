<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class TinTucController extends Controller
{
    public function getDanhsach(){
        $tintuc = TinTuc::orderBy('id','desc')->get();
        return view('admin.tintuc.danhsach', ['tintuc'=> $tintuc ]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::all();
        return view('admin.tintuc.them', compact('theloai', 'loaitin', 'tintuc'));
    }

    public function postThem(Request $request){

        $this->validate($request, [
            'Ten' => 'required|min:3|max:100|unique:Loaitin,Ten',
        ],[
            'Ten.required' => 'Tên chưa được nhập',
            'Ten.min' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.max' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.unique' => 'Tên đã tồn tại',
        ]);

        $loaitin = new Loaitin();
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();
       
        return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua', ['theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }

    public function postSua(Request $request, $id) {
        $this->validate($request, [
            'Ten' => 'required|min:3|max:100|unique:TheLoai,Ten',
        ],[
            'Ten.required' => 'Tên chưa được nhập',
            'Ten.min' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.max' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.unique' => 'Tên đã tồn tại',
        ]);

        $loaitin = LoaiTin::find($id);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();
       
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
