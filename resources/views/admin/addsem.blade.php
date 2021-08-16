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
              @isset($sems)
              <h3 class="card-title">Update Semester</h3>
              @else
              <h3 class="card-title">Add New Semester</h3>
              @endisset
              <a type="button" href="{{ route('admin.semesters.list') }}" class="btn btn-danger" style="float:right">Back</a>
            </div>
            <form class="allform" enctype="multipart/form-data" id="semesterform" update-url="/admin/semesters/update" form-url="/admin/semesters/add">
            {{-- method="POST" action="@isset($sems) {{ route('admin.semesters.update') }} @else {{ route('admin.semesters.store') }} @endisset"  --}}
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="firstname">Semester Name</label>
                  @isset($sems)
                  <input type="hidden" class="form-control" id="id" name="id" value="{{ $sems->id }}">
                  <input type="text" class="form-control" id="semestername" name="semestername" value="{{ $sems->semestername }}" placeholder="Enter Semester Name">
                  @else
                  <input type="text" class="form-control" id="semestername" name="semestername" value="{{ old('semestername') }}" placeholder="Enter Semester Name">
                  @endisset
                  {{-- @error('semestername')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                  @enderror --}}

                </div>
                <div class="form-group">
                  <label for="active">Is Active Or Not</label>
                  @isset($sems)
                  <select class="form-control" name="active" id="active">
                      <option value="active" {{$sems->is_active == 'active' ? 'selected' : ''}}> Active </option>
                      <option value="deactive" {{$sems->is_active == 'deactive' ? 'selected' : ''}}> Not Active </option>
                  </select>
                  @else
                  <select class="form-control" name="active" id="active">
                    <option value="active" selected> Active </option>
                    <option value="deactive"> Not Active </option>
                </select>
                  @endisset
                </div>

                {{-- @error('active')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                @enderror --}}
                <input type="hidden" name="module_name" value="semesters">
              </div>
              <div class="card-footer">
                @isset($sems)
                <button type="submit" class="btn btn-primary" id="update">Update</button>
                @else
                <button type="submit" class="btn btn-primary" id="submit">Add</button>
                @endisset
                <a type="button" href="{{ route('admin.semesters.list') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
      
      </div>
      
    </div><!-- /.container-fluid -->
  </section>
 </div>


@endsection