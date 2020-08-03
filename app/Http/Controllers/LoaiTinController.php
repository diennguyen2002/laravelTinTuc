<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getDanhsach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach', ['loaitin'=> $loaitin ]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them', ['theloai'=>$theloai]);
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
