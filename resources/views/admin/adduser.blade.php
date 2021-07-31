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
          <h1 class="m-0">User</h1>
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



  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New User</h3>
              <a type="button" href="{{ route('admin.users.list') }}" class="btn btn-danger" style="float:right">Back</a>
            </div>
            <form method="POST" action="@isset($user) {{ route('admin.users.update') }} @else {{ route('admin.users.add') }} @endisset" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  @isset($user)
                  <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
                  <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" placeholder="Enter First Name">
                  @else
                  <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Enter First Name">
                  @endisset
                  @error('firstname')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                  @enderror

                </div>
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  @isset($user)
                  <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" placeholder="Enter Last Name">
                  @else
                  <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Enter Last Name">
                  @endisset
                </div>

                @error('lastname')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                @enderror

                <div class="form-group">
                  <label for="email">Email</label>
                  @isset($user)
                  <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter Email Address">
                  @else
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                  @endisset
                </div>

                @error('email')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                @enderror

                <div class="form-group">
                  <label for="mobile">Phone Number</label>
                  @isset($user)
                  <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" placeholder="Enter Mobile Number">
                  @else
                  <input type="number" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Enter Mobile Number">
                  @endisset
                </div>

                @error('mobile')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                @enderror

                <div class="form-group">
                  <label for="role">Select Role</label>
                  @isset($user)
                  <select class="form-control" name="role" id="role">
                    @foreach ($role as $item)
                      <option value="{{ $item->role_id }}" {{$user->role_no == $item->role_id  ? 'selected' : ''}}> {{ $item->role_name }} </option>
                    @endforeach
                  </select>
                  @else
                  <select class="form-control" name="role" id="role">
                    @foreach ($role as $item)
                      <option value="{{ $item->role_id }}"> {{ $item->role_name }} </option>
                    @endforeach
                  </select>
                  @endisset

                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Avtar</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="avtar" name="avtar">
                      <label class="custom-file-label" for="avtar">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                  @error('avtar')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                  @enderror
                </div>
              </div>
              <div class="card-footer">
                @isset($user)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Add</button>
                @endisset
                <a type="button" href="{{ route('admin.users.list') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
      
      </div>
      
    </div><!-- /.container-fluid -->
  </section>


@endsection