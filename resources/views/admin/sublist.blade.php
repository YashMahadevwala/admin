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
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Subjects</li>
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
                  <h3 class="card-title">Subjects List</h3>
                  <a type="button" href="{{ route('admin.subjects.add') }}" class="btn btn-success" style="float:right">Add Subject</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                      <table class="table table-bordered" id="subjects_data">
                        <thead>
                           <tr>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Id</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Subject Name</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Type</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Semester</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Faculty</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Is-Active</th>
                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>
                           </tr>
                        </thead>
                     </table>
                </div></div>
                  {{-- {{ $subs->links("pagination::bootstrap-4") }}
                Showing {{ $subs->perPage() }} Of {{$subs->total() }} results Out Of --}}
                </div>
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
 </div>

  <!-- /.content -->


@endsection