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
          <h1 class="m-0">Semester</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">Semester</li>
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
              <h3 class="card-title">Add New Semester</h3>
              <a type="button" href="/semesterlist" class="btn btn-danger" style="float:right">Back</a>
            </div>
            <form method="POST" action="@isset($user) /updatesemester @else /addsemester @endisset" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="firstname">Semester Name</label>
                  @isset($user)
                  <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
                  <input type="text" class="form-control" id="semestername" name="semestername" value="{{ $user->semestername }}" placeholder="Enter Semester Name">
                  @else
                  <input type="text" class="form-control" id="semestername" name="semestername" value="{{ old('semestername') }}" placeholder="Enter Semester Name">
                  @endisset
                  @error('semestername')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                  @enderror

                </div>
                <div class="form-group">
                  <label for="active">Is Active Or Not</label>
                  @isset($user)
                  <select class="form-control" name="active" id="active">
                      <option value="1"> Active </option>
                      <option value="0"> Not Active </option>
                  </select>
                  @else
                  <select class="form-control" name="active" id="active">
                    <option value="1"> Active </option>
                    <option value="0"> Not Active </option>
                </select>
                  @endisset
                </div>

                @error('active')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                @enderror
                
              </div>
              <div class="card-footer">
                @isset($user)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Add</button>
                @endisset
                <a type="button" href="/semesterlist" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
      
      </div>
      
    </div><!-- /.container-fluid -->
  </section>
 </div>


@endsection