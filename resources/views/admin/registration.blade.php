@extends('layouts.simpleLayout')
@section('title','Registration')

@section('contant')


<div class="register-box" style="margin: auto auto">
  <div class="register-logo">
    <a href="#"><b>ADMIN</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{route('admin.register')}}" method="post">
        @csrf
        
        @error('fullname')
            <p style="color: red"> <i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
        @enderror
        <div class="input-group mb-3">
          <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full name" value="{{ old('fullname') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        @error('email')
            <p style="color: red"> <i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
        @enderror
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        @error('password')
            <p style="color: red"> <i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
        @enderror
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        @error('confirm_password')
            <p style="color: red"> <i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
        @enderror
        <div class="input-group mb-3">
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="terms" name="terms" value="agree">
              <label for="terms">
               I agree to the <a href="#">terms</a>
              </label>
           
              
            </div>
            @if ($message = Session::get('termFail'))
              <p style="color: red"> {{ $message }} </p>
            @endif
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="{{route('admin.login')}}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


@endsection