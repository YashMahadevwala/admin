@extends('layouts.adminLayout')
@section('title','Subjects List')

@section('contant')


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">


  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Subjects</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">Subjects</li>
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
              @isset($sub)
              <h3 class="card-title">Update Subject</h3>
              @else
              <h3 class="card-title">Add New Subject</h3>
              @endisset
              <a type="button" href="{{ route('admin.subjects.list') }}" class="btn btn-danger" style="float:right">Back</a>
            </div>
            <form method="POST" action="@isset($sub) {{ route('admin.subjects.update') }} @else {{ route('admin.subjects.store') }} @endisset" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="firstname">Subject Name</label>
                  @isset($sub)
                  <input type="hidden" class="form-control" id="id" name="id" value="{{ $sub->id }}">
                  <input type="text" class="form-control" id="subjectname" name="subjectname" value="{{ $sub->subjectname }}" placeholder="Enter Subject Name">
                  @else
                  <input type="text" class="form-control" id="subjectname" name="subjectname" value="{{ old('subjectname') }}" placeholder="Enter Subject Name">
                  @endisset
                  @error('subjectname')
                      <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                  @enderror

                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="active">Is Active Or Not</label>
                      @isset($sub)
                      <select class="form-control" name="active" id="active">
                          <option value="active" {{$sub->is_active == 'active' ? 'selected' : ''}}> Active </option>
                          <option value="deactive" {{$sub->is_active == 'deactive' ? 'selected' : ''}}> Not Active </option>
                      </select>
                      @else
                      <select class="form-control" name="active" id="active">
                        <option value="active" selected> Active </option>
                        <option value="deactive"> Not Active </option>
                    </select>
                      @endisset
                      {{-- @error('active')
                        <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }} </p>
                      @enderror --}}
                    </div>
                  </div>
                  


                  <div class="col-md-6">
                      <div class="form-group">
                  <label for="active">Subject Type</label>
                  @isset($sub)
                  <select class="form-control" name="type" id="type">
                    <option value="programming" {{$sub->type == 'programming' ? 'selected' : ''}}> Programming </option>
                    <option value="coading" {{$sub->type == 'coading'  ? 'selected' : ''}}> Coading </option>
                    <option value="commerce" {{$sub->type == 'commerce'  ? 'selected' : ''}}> Commerce </option>
                    <option value="science" {{$sub->type == 'science'  ? 'selected' : ''}}> Science </option>
                    <option value="primary" {{$sub->type == 'primary'  ? 'selected' : ''}}> Primary </option>
                    <option value="secondary" {{$sub->type == 'secondary'  ? 'selected' : ''}}> Secondary </option>
                    <option value="graphics" {{$sub->type == 'graphics'  ? 'selected' : ''}}> Graphics </option>
                    <option value="designing" {{$sub->type == 'designing'  ? 'selected' : ''}}> Designing </option>
                  </select>
                  @else
                  <select class="form-control" name="type" id="type">
                    <option value="programming" selected> Programming </option>
                    <option value="coading"> Coading </option>
                    <option value="commerce"> Commerce </option>
                    <option value="science"> Science </option>
                    <option value="primary"> Primary </option>
                    <option value="secondary"> Secondary </option>
                    <option value="graphics"> Graphics </option>
                    <option value="designing"> Designing </option>
                  </select>
                  @endisset
                </div>
                  </div>
              </div>


              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="active">Semester</label>
                    @isset($sub)
                    <select class="form-control" name="sem" id="sem">
                      @foreach ($data as $sem)
                      <option value="{{ $sem->id }}" {{$sub->semester == $sem->id  ? 'selected' : ''}}> {{ $sem->semestername }} </option>
                      @endforeach
                    </select>
                    @else 
                      <select class="form-control" name="sem" id="sem">
                          @foreach ($data as $sem)
                          <option value="{{ $sem->id }}" selected> {{ $sem->semestername }} </option>
                          @endforeach
                        </select>
                    @endisset
                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label for="active">Faculty Assign</label>
                    <select class="form-control" name="faculty" id="faculty">
                      @foreach ($fac as $fac)
                      <option value="{{ $fac->id }}" selected> {{ $fac->firstname ." ". $fac->lastname }} </option>
                      @endforeach
                    </select>
                  </div>

                </div>
              </div>
               
                
              </div>
              <div class="card-footer">
                @isset($sub)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Add</button>
                @endisset
                <a type="button" href="{{ route('admin.subjects.list') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
      
      </div>
      
    </div><!-- /.container-fluid -->
  </section>
 </div>


@endsection