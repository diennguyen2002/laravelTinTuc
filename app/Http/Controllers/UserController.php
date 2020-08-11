<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\User;

class UserController extends Controller
{
    //
    public function getDanhsach(){
        $user = User::all();
        return view('admin.user.danhsach', compact('user'));
    }

    public function getThem(){
        return view('admin.user.them');
    }

    public function postThem(Request $request){

        $this->validate($request, [
            'name' => 'required|min:3|max:100|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:100',
            'passwordAgain' => 'required|same:password'
        ],[
            'name.required' => 'Tên chưa được nhập',
            'name.min' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'name.max' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'name.unique' => 'Tên đã tồn tại',
            'email.required' => 'Email chưa được nhập',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu chưa được nhập',
            'password.min' => 'Mật khẩu lớn hơn 6 và nhỏ hơn 100 ký tự',
            'password.max' => 'Mật khẩu lớn hơn 3 và nhỏ hơn 100 ký tự',
            'passwordAgain.required' => 'Nhập lại mật khẩu chưa được nhập',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
       
        return redirect('admin/user/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua', compact('user'));
    }

    public function postSua(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|min:3|max:100|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:100',
            'passwordAgain' => 'required|same:password'
        ],[
            'name.required' => 'Tên chưa được nhập',
            'name.min' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'name.max' => 'Tên lớn hơn 3 và nhỏ hơn 100 ký tự',
            'name.unique' => 'Tên đã tồn tại',
            'email.required' => 'Email chưa được nhập',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu chưa được nhập',
            'password.min' => 'Mật khẩu lớn hơn 6 và nhỏ hơn 100 ký tự',
            'password.max' => 'Mật khẩu lớn hơn 3 và nhỏ hơn 100 ký tự',
            'passwordAgain.required' => 'Nhập lại mật khẩu chưa được nhập',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password && bcrypt($request->password) != $user->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();
       
        return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }

    public function getDangNhap(){
        return view('admin.login');
    }

    public function postDangNhap(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:100'
        ],[
            'email.required' => 'Email chưa được nhập',
            'password.required' => 'Password chưa được nhập',
            'password.min' => 'Password phải lớn hơn 6 và nhở hơn 100 ký tự',
            'password.max' => 'Password phải lớn hơn 6 và nhở hơn 100 ký tự',
        ]);

        $credentials = ['email'=>$request->email, 'password'=>$request->password];

        if (Auth::attempt($credentials)) {
            return redirect('admin/user/danhsach');
        } else {
            return redirect('admin/dangnhap')->with('loi','Đăng nhập thất bại');
        }
    }

    public function getDangxuat(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
