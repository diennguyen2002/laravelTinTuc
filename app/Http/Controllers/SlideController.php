<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhsach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach', compact('slide'));
    }

    public function getThem(){
        return view('admin.slide.them');
    }

    public function postThem(Request $request){

        $this->validate($request, [
            'Ten' => 'required|min:3|max:100|unique:slide,Ten',
            'NoiDung' => 'required',
        ],[
            'Ten.required' => 'Tên chưa được nhập',
            'Ten.min' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.max' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'Ten.unique' => 'Tên đã tồn tại',
            'NoiDung.required' => 'Nội dung chưa được nhập'
        ]);

        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        
        if($request->has('link')){
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $ext = $file->getClientOriginalExtension();
            if(!in_array($ext, array('jpg', 'png', 'jpeg'))){
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được nhập file có đuôi jpg|png|jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(7) . "_" . $name;
            while(file_exists('upload/slide/'.$Hinh)){
                $Hinh = Str::random(7) . "_" . $name;
            }
            $file->move('upload/slide/', $Hinh);
            $slide->Hinh = $Hinh;
        } else {
            $slide->Hinh = '';
        }

        $slide->save();
       
        return redirect('admin/slide/them')->with('thongbao','Bạn đã thêm thành công');
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
