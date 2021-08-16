@extends('layouts.adminLayout') @section('title','Subjects List') @section('contant')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Students</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            {{-- @isset($sub)
                            <h3 class="card-title">Update Students</h3>
                            @else --}}
                            <h3 class="card-title">Add New Students</h3>
                            {{-- @endisset --}}
                            <a type="button" href="{{ route('admin.students.list') }}" class="btn btn-danger" style="float:right">Back</a>
                        </div>
                        <form method="POST" enctype="multipart/form-data" class="allform" id="studentform" update-url="/admin/students/update" form-url="/admin/students/add">
                            {{-- action="@isset($sub) {{ route('admin.subjects.update') }} @else {{ route('admin.subjects.store') }} @endisset" --}} 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label> 
                                            @isset($stud)
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $stud->id }}">
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $stud->firstname }}" placeholder="Enter First Name"> 
                                            @else
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Enter First Name"> 
                                            @endisset
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label> 
                                            @isset($stud) 
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $stud->lastname }}" placeholder="Enter Last Name"> 
                                             @else
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Enter Last Name"> 
                                            @endisset
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label> 
                                        @isset($stud) 
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $stud->email }}" placeholder="Enter First Name"> 
                                        @else
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter First Name"> 
                                        @endisset
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datofbirth">Date Of Birth</label>
                                         @isset($stud)
                                        <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="{{ $stud->dateofbirth }}" placeholder="Enter First Name">
                                         @else
                                        <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="{{ old('dateofbirth') }}" placeholder="Enter First Name"> 
                                        @endisset
                                    </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                      <label>Address</label>
                                      @isset($stud)
                                      <textarea name="address" id="address" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 85px;">{{ $stud->address }}</textarea>
                                       @else
                                       <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your Address" style="margin-top: 0px; margin-bottom: 0px; height: 85px;"></textarea>
                                      @endisset
                                    </div>
                                  </div>
                                </div>

                                <div class="row">

                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Passing Year</label> 
                                      @isset($stud)
                                        <select class="form-control" name="passingyear" aria-label="Default select example">
                                          <option selected disabled>Select Passing Year</option>
                                          <option value="2021" {{ ($stud->passingyear) ? 'selected' : '' }}>2021</option>
                                          <option value="2020" {{ ($stud->passingyear) ? 'selected' : '' }}>2020</option>
                                          <option value="2019" {{ ($stud->passingyear) ? 'selected' : '' }}>2019</option>
                                          <option value="2018" {{ ($stud->passingyear) ? 'selected' : '' }}>2018</option>
                                          <option value="2017" {{ ($stud->passingyear) ? 'selected' : '' }}>2017</option>
                                        </select>
                                      @else
                                        <select class="form-control" name="passingyear" aria-label="Default select example">
                                          <option selected disabled>Select Passing Year</option>
                                          <option value="2021">2021</option>
                                          <option value="2020">2020</option>
                                          <option value="2019">2019</option>
                                          <option value="2018">2018</option>
                                          <option value="2017">2017</option>
                                        </select>
                                      @endisset
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datofbirth">Semester</label> 
                                        @isset($stud)
                                        <select class="form-control" name="semester" aria-label="Default select example">
                                          <option selected disabled>Select Semester</option>
                                          @foreach ($sems as $data)
                                            <option value="{{ $data->id }}" {{ ($stud->semester) ? 'selected' : '' }}> {{ $data->semestername }} </option>
                                          @endforeach
                                        </select>
                                        @else
                                          <select class="form-control" name="semester" aria-label="Default select example">
                                            <option selected disabled>Select Semester</option>
                                            @foreach ($sems as $data)
                                              <option value="{{ $data->id }}"> {{ $data->semestername }} </option>
                                            @endforeach
                                          </select>
                                        @endisset
                                    </div>
                                  </div>

                                </div>

                                <div class="row">

                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datofbirth">Subjects</label> 
                                        @isset($stud)
                                        <select class="form-control js-example-basic-single" name="subjects[]" aria-label="Default select example">
                                          @foreach ($subs as $data)
                                            <option value="{{ $data->id }}" {{ ($stud->subjects == $data->id) ? 'selected' : '' }}> {{ $data->subjectname }} </option>
                                          @endforeach
                                        </select>
                                        @else
                                        <select class="form-control js-example-basic-single" name="subjects[]" aria-label="Default select example">
                                          @foreach ($subs as $data)
                                            <option value="{{ $data->id }}"> {{ $data->subjectname }} </option>
                                          @endforeach
                                        </select>
                                        @endisset
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datofbirth" class="form-label">Select Age</label>
                                        @isset($stud)
                                          <span id="ageshow" class="ml-5">{{ $stud->age }}</span> <br>
                                          <input type="range" class="form-range" id="age" name="age" min="0" max="50" onchange="updateTextInput(this.value);">
                                        @else    
                                          <span id="ageshow" class="ml-5">25</span> <br>
                                          <input type="range" class="form-range" id="age" name="age" min="0" max="50" onchange="updateTextInput(this.value);">
                                        @endisset
                                    </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="custom-file">
                                    <label for="avtar">Select Avtar</label> 
                                    <input type="file" class="custom-file-input" id="avtar" name="avtar">
                                    <label class="custom-file-label" for="avtar">Choose file</label>
                                  </div>
                                  <div>Not Compolasory</div>
                                </div>
                                <div class="card-footer">
                                  <input type="hidden" name="module_name" value="students">
                                  @isset($stud)
                                    <button type="submit" class="btn btn-primary" id="update">Update</button>
                                  @else
                                    <button type="submit" class="btn btn-primary" id="submit">Add</button>
                                  @endisset
                                  <a type="button" href="{{ route('admin.students.list') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                        </form>
                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->
    </section>
    </div>


    @endsection