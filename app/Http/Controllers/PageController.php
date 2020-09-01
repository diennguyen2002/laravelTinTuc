<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class PageController extends Controller
{
    function trangchu(){
       $theloai = TheLoai::all();
       return view('pages.trangchu', compact('theloai'));
    }

}
