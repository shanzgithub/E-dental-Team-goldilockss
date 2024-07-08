@extends('layouts.adminlayout')
@section('content')

<div class="row">
  @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
    <form method="POST" action="{{ route('regist.new.dentist') }}">
        @csrf
          {{-- <p class="mb-0">Select User Role</p>
          <div class="form-check">
          <input type="radio" id="patient" name="role" value="0" class="form-check-input @error('role') is-invalid @enderror" style="margin: 5px; margin-left: -20px">
          <label for="patient">Patient</label>
          <input type="radio" id="dentist" name="role" value="1" class="form-check-input @error('role') is-invalid @enderror" style="margin: 5px; margin-left: 20px">
          <label for="dentist"style="margin-left: 40px">Dentist</label>
          @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div> --}}
          <input id="role" type="hidden" name="role" value="1">
          <input id="userstatus" type="hidden" name="userstatus" value="1">
          <input id="admin" type="hidden" name="is_admin" value="0">
        
        <div class="form-group first">
          <label for="fullname">Full Name</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="age">Age</label>
          <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age">
          @error('age')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group last mb-4">
          <label for="phoneNumber">Phone Number</label>
          <input id="phoneNumber" type="number" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber">
          @error('phoneNumber')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <p class="mb-0">Select Your Gender</p>
        <input type="radio" id="male" name="gender" value="Male" class="form-check-input @error('gender') is-invalid @enderror" style="margin: 5px; margin-left: -0px">
        <label for="Male" style="margin-left: 20px">Male</label>
        <input type="radio" id="female" name="gender" value="Female" class="form-check-input @error('gender') is-invalid @enderror" style="margin: 5px; margin-left: 20px">
        <label for="Female" style="margin-left: 40px">Female</label>
          @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        <div class="form-group first">
          <label for="email">Email</label>
          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group last mb-4">
          <label for="password">Confirm Password</label>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>
        
        <div class="d-flex mb-5 align-items-center">
          <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
            <input type="checkbox" checked="checked"/>
            <div class="control__indicator"></div>
          </label>
          <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
        </div>

        <button type="submit" class="btn btn-block btn-primary">
          {{ __('Register') }}
        </button>
        <span class="d-block text-left my-4 text-muted">&mdash; Already have an account ? &mdash;<a href="login"> Login here</a> </span>
      </form>
</div>
@endsection