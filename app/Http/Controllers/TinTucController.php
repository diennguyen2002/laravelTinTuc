<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;

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
            'TieuDe' => 'required|unique:TinTuc,TieuDe|min:5|max:150'
        ],[
           'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
           'TieuDe.unique' =>  'Tiêu đề đã tồn tại',
           'TieuDe.min' => 'Tên tiêu đề phải lớn hơn 5 và nhỏ hơn 150 ký tự',
           'TieuDe.max' => 'Tên tiêu đề phải lớn hơn 5 và nhỏ hơn 150 ký tự',
        ]);

        $tintuc = new TinTuc();
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $ext = $file->getClientOriginalExtension();
            if(!in_array($ext, array('jpg', 'png', 'jpeg'))){
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được nhập file có đuôi jpg|png|jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(7) . "_" . $name;
            while(file_exists('upload/tintuc/'.$Hinh)){
                $Hinh = Str::random(7) . "_" . $name;
            }
            $file->move('upload/tintuc/', $Hinh);
            $tintuc->Hinh = $Hinh;
        } else {
            $tintuc->Hinh = '';
        }
        
        $tintuc->save();
       
        return redirect('admin/tintuc/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getSua($id){
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::where('idTheLoai',$tintuc->loaitin->idTheLoai)->get();
        return view('admin.tintuc.sua', compact('tintuc','theloai','loaitin'));
    }

    public function postSua(Request $request, $id) {
        $this->validate($request, [
            'TieuDe' => 'required|unique:TinTuc,TieuDe|min:5|max:150'
        ],[
           'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
           'TieuDe.unique' =>  'Tiêu đề đã tồn tại',
           'TieuDe.min' => 'Tên tiêu đề phải lớn hơn 5 và nhỏ hơn 150 ký tự',
           'TieuDe.max' => 'Tên tiêu đề phải lớn hơn 5 và nhỏ hơn 150 ký tự',
        ]);

        $tintuc = TinTuc::find($id);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $ext = $file->getClientOriginalExtension();
            if(!in_array($ext, array('jpg', 'png', 'jpeg'))){
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được nhập file có đuôi jpg|png|jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(7) . "_" . $name;
            while(file_exists('upload/tintuc/'.$Hinh)){
                $Hinh = Str::random(7) . "_" . $name;
            }
            $file->move('upload/tintuc/', $Hinh);
            unlink('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        
        $tintuc->save();
       
        return redirect('admin/tintuc/sua/'.$tintuc->id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
