@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Mật khẩu</th>
                            <th>Xóa</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->role == 1 ? 'Admin' : 'Thường' }}</td>
                                <td>{{ $u->password }}</td>
                                {{-- <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoa/{{ $u->id }}"> Xóa</a></td> --}}
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class="deleteClick" data-action="admin/user/xoa/{{ $u->id }}" data-toggle="modal" data-target="#exampleModal" href="javascript:void(0)"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{ $u->id }}">Sửa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{  $user->links() }}
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @include('admin.user.confirm')
@endsection
        
@section('script')

<script>
    $(document).ready(function(){
        $('.deleteClick').click(function(){
            var action = $(this).data('action');
            $('#frmDelete').attr('action', action);
        });
    })
</script>
    
@endsection