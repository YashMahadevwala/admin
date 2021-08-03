@extends('layouts.simpleLayout')
@section('title','Forgate Password')

@section('contant')


<body class="hold-transition login-page">
<div class="login-box" style="margin: 9% auto">
  <div class="login-logo">
    <a href=""><b>{{ env('APP_NAME') }}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="{{ route('setpassword.setpassword') }}" method="post">
        @csrf
        <div class="input-group mb-3">
         
          <input type="hidden" value="{{ base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=')) }}" name="id">
          {{-- <p>{{ $data->email }}</p> --}}
          
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
            <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
        @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('confirm_password')
            <p style="color: red"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
        @enderror
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('admin.login') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->



@endsection