@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class='row'>
                <div class="col-lg-12">
                    @if(count($errors)>0)
                        @foreach($errors->all() as $err)
                            <x-alert type='danger' :message='$err' />
                        @endforeach
                    @endif
                    @php
                        $thongbao = session('thongbao');
                        $loi = session('loi');
                    @endphp
                    @if($thongbao)
                        <x-alert type='success' :message='$thongbao' />       
                    @endif
                    @if($loi)
                        <x-alert type='danger' :message='$loi' />       
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/slide/sua/{{ $slide->id }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" value='{{ $slide->Ten }}' placeholder="Tên" />
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" class="form-control ckeditor" name="NoiDung" placeholder="Nội dung" rows="3">{{ $slide->NoiDung }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Liên kết</label>
                            <input class="form-control" name="link" placeholder="Liên kết" value="{{ $slide->link }}" />
                        </div>
                        <div class="form-group">
                            <label>Hình</label>
                            <div><img src="upload/slide/{{ $slide->Hinh }}" width="70px" alt=""></div>
                            <input type="file" name='Hinh' class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

