@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại tin
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/loaitin/sua/{{ $loaitin->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name='TheLoai'>
                                @foreach($theloai as $tl)
                                    <option 
                                        {{ $loaitin->idTheLoai == $tl->id ? "selected" : "" }} 
                                        value="{{ $tl->id }}">{{ $tl->Ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" value="{{ $loaitin->Ten }}" placeholder="Tên loại tin" />
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            <div class='row'>
                <div class="col-lg-12">
                    @if(count($errors)>0)
                        @foreach($errors->all() as $err)
                            <x-alert type='danger' :message='$err' />
                        @endforeach
                    @endif
                    @php
                        $thongbao = session('thongbao');
                    @endphp
                    @if($thongbao)
                        <x-alert type='success' :message='$thongbao' />       
                    @endif
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
