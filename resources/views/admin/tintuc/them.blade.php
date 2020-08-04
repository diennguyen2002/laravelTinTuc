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
                    <h1 class="page-header">Tin tức
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/tintuc/them" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name='TheLoai' id='TheLoai'>
                                @foreach($theloai as $tl)
                                    <option value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name='LoaiTin' id='LoaiTin'>
                                @foreach($loaitin as $lt)
                                    <option value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Tiêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo" class="form-control ckeditor" name="TomTat" placeholder="Tóm tắt" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" class="form-control ckeditor" name="NoiDung" placeholder="Nội dung"  rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình</label>
                            <input type="file" name='Hinh' class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" checked="" type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" type="radio">Có
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#TheLoai').change(function(){
                $.get('admin/ajax/loaitin/'+$(this).val(), function(data){
                    $('#LoaiTin').html(data);
                })
            })
        })
    </script>
@endsection
