@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tuc
                        <small>Danh sach</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Loại tin</th>
                            <th>Nổi bật</th>
                            <th>Số lượt xem</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>
                                    {{$tt->TieuDe}}
                                    <div><img src="upload/tintuc/{{$tt->Hinh}}" width="70px" alt=""></div>
                                </td>
                                <td>{{$tt->TomTat}}</td>
                                <td>{{$tt->loaitin->theloai->Ten}}</td>   
                                <td>{{$tt->loaitin->Ten}}</td>   
                                <td>{{$tt->NoiBat? 'Có' : 'Không'}}</td> 
                                <td>{{$tt->SoLuotXem}}</td> 
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{ $tt->id }}">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{ $tt->id }}">Sửa</a></td>
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
        
