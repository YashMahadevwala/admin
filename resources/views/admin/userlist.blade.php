@extends('layouts.adminLayout')
@section('title','User List')

@section('contant')


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">


  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User list</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  

  <!-- Main content -->
  <section class="content">
    @if (Session::get('success'))
  {{-- {{success_alert()}} --}}
  {!! success_alert(Session::get('success')) !!}
  @elseif(Session::get('updated'))
  {!! success_alert(Session::get('updated')) !!}
  @elseif(Session::get('danger'))
  {!! danger_alert(Session::get('danger')) !!}
@endif
    <div class="container-fluid">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  {{-- <h3 class="card-title">DataTable with minimal features &amp; hover style</h3> --}}
                  <h3 class="card-title">User List</h3>
                  <a type="button" href="{{ route('admin.users.add') }}" class="btn btn-success" style="float:right">Add User</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                    {{-- <table id="user_table" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Full Name</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Phone Number</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Role</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Avtar</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Engine version: activate to sort column ascending">Action</th>
                    </tr>
                    </thead> --}}
                    {{-- <tbody> --}}
                    

                      {{-- @foreach ($users as $k => $user)
                      <tr class="odd">
                        <td class="dtr-control sorting_1" tabindex="0"> {{ $k + 1 }} </td>
                        <td>{{ $user->firstname . " " . $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->role_name }}</td>
                        @if ($user->avtar)
                          <td>{{ $user->avtar }}</td>
                        @else
                          <td> Avtar Not upload </td>
                        @endif 
                        @if ($user->password == '')
                          <td><i class="fas fa-circle" style="color: red"></i></td>
                        @else
                          <td><i class="fas fa-circle" style="color: green"></i></td>
                        @endif  
                        <td><a type="button" href="{{ route('admin.users.edit',[$user->id])}}" class="btn btn-warning" style="float:right">Edit</a></td>
                        <td><button type="button" id="delete" delete-url="/admin/users/delete/" data-id="{{ $user->id }}" class="btn btn-danger btn-del-user" style="float:right">Delete</button></td>
                          {{-- {{ route('admin.users.delete',[$user->id])}}
                        </tr>
                      @endforeach --}}
                    {{-- </tbody> --}}
                  {{-- </table> --}}


                  <table class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info" id="users_data">
                    <thead>
                       <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Id</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">First name</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Last name</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Mobile</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Role</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Status</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 500px">Action</th>
                          {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Test</th> --}}
                       </tr>
                    </thead>
                 </table>


                </div></div>
                {{-- Pagination --}}
                {{-- {{ $users->links("pagination::bootstrap-4") }}
                Showing {{ $users->perPage() }} Of {{$users->total() }} results Out Of --}}
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

    </div><!-- /.container-fluid -->
  </section>

@endsection