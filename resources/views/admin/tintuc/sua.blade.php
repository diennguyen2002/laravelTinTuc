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
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name='TheLoai' id='TheLoai'>
                                @foreach($theloai as $tl)
                                    <option {{ $tl->id == $tintuc->loaitin->theloai->id ? 'selected' : '' }} value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name='LoaiTin' id='LoaiTin'>
                                @foreach($loaitin as $lt)
                                    <option {{ $lt->id == $tintuc->loaitin->id ? 'selected' : '' }} value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" value='{{ $tintuc->TieuDe }}' placeholder="Tiêu đề" />
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo" class="form-control ckeditor" name="TomTat"  placeholder="Tóm tắt" rows="3">{{ $tintuc->TomTat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" class="form-control ckeditor" name="NoiDung" placeholder="Nội dung"  rows="3">{{ $tintuc->NoiDung }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình</label>
                            <div><img src="upload/tintuc/{{ $tintuc->Hinh }}" width="70px" alt=""></div>
                            <input type="file" name='Hinh' class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" {{ $tintuc->NoiBat == 0 ? 'checked' : '' }} type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" {{ $tintuc->NoiBat == 1 ? 'checked' : '' }}  type="radio">Có
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bình luận
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Người dùng</th>
                            <th>Nội dung</th>
                            <th>Ngày đăng</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->user->name}}</td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>   
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}">Xóa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
