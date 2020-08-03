@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể loại
                        <small>Sửa</small>
                    </h1>
                </div>
               
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/theloai/sua/{{ $theloai->id }}" method="POST">
                        @csrf
                        {{--  <input type="hidden" name="_token" value="{{csrf_token()}}" />  --}}
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" value='{{ $theloai->Ten }}' placeholder="Tên thể loại" />
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
