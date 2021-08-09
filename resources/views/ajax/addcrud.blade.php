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
          <h1 class="m-0">Student</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Student</li>
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
              @isset($user)
              <h3 class="card-title">Update Student</h3>
              @else
              <h3 class="card-title">Add New Student</h3>
              @endisset
              <a type="button" href="{{ route('admin.users.list') }}" class="btn btn-danger" style="float:right">Back</a>
            </div>
            <form id="studentform" method="POST" action="@isset($user) {{ route('admin.users.update') }} @else {{ route('admin.users.add') }} @endisset" enctype="multipart/form-data">
              {{-- @csrf --}}
              <div class="card-body">
                <div class="form-group">
                  <label for="firstname">Student Name</label>
                  @isset($user)
                  <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
                  <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" placeholder="Enter Student Name">
                  @else
                  <input type="text" class="form-control" id="studentname" name="studentname" value="{{ old('firstname') }}" placeholder="Enter Student Name">
                  @endisset
                  @error('firstname')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                  @enderror

                </div>
                  <div class="form-group">
                    <label for="active">Semester</label>
                    @isset($sub)
                    <select class="form-control" name="semester" id="semester">
                      @foreach ($data as $sem)
                      <option value="{{ $sem->id }}" {{$sub->semester == $sem->id  ? 'selected' : ''}}> {{ $sem->semestername }} </option>
                      @endforeach
                    </select>
                    @else 
                      <select class="form-control" name="semester" id="semester">
                          @foreach ($data as $sem)
                          <option value="{{ $sem->id }}" selected> {{ $sem->semestername }} </option>
                          @endforeach
                        </select>
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
                  <label for="active">Select Subject</label>
                  @isset($sub)
                  <select class="form-control" name="subjects" id="subjects">
                    @foreach ($subs as $sub)
                    <option value="{{ $sub->id }}" {{$sub->subjectname == $sub->id  ? 'selected' : ''}}> {{ $sem->semestername }} </option>
                    @endforeach
                  </select>
                  @else 
                    <select class="js-example-basic-multiple" multiple="multiple" class="form-control" name="subjects" id="subjects">
                        @foreach ($subs as $sub)
                        <option value="{{ $sub->id }}"> {{ $sub->subjectname }} </option>
                        @endforeach
                      </select>
                  @endisset
                </div>        

              </div>
              <div class="card-footer">
                @isset($user)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary" id="submit">Add</button>
                @endisset
                <a type="button" href="{{ route('admin.users.list') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
      
      </div>
      
    </div><!-- /.container-fluid -->
  </section>


@endsection