<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhsach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach', ['theloai'=> $theloai ]);
    }

    public function getThem(){
        return view('admin.theloai.them');
    }

    public function postThem(Request $request){

        $this->validate($request, [
            'Ten' => 'required|min:3|max:100|unique:TheLoai,Ten',
        ],[
            'Ten.required' => 'Tên chưa được nhập',
            'Ten.min' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.max' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.unique' => 'Tên đã tồn tại',
        ]);

        $theloai = new TheLoai();
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
       
        return redirect('admin/theloai/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua', ['theloai'=>$theloai]);
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

        $theloai =TheLoai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
       
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        TheLoai::destroy($id);
        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
