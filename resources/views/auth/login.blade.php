@extends('layouts.app')
@section('css')

@endsection
<style>
    body {
    background-color: #f2f2f2 !important;
}
</style>
@section('content')
<section class="login-register" id="login_main">
<div class="login-logo">
<a href="{{ route('home') }}" title=""><img src="{{ url('assets/images/vaishnavvivah-logo.png') }}" class="img-responsive" alt=""></a>
</div>

<div class="login-box">
<div class="white-box">
<form method="POST" id="loginform" class="form-horizontal form-material" action="{{ route('login') }}">
      @csrf
<h3 class="box-title m-b-20">Sign In</h3>
<div class="form-group ">
<div class="col-xs-12">
<input type="text" placeholder="Email ID or Mobile" required name="email" value="{{ old('email') }}"  class="form-control">
@if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<input type="password" placeholder="Password" id="password-1" required name="password" class="form-control">
@if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
</div>
</div>
<div class="form-group">
<div class="col-md-12">


<div class="checkbox checkbox-primary pull-left p-t-0" style="display:none">
<input type="checkbox" id="checkbox-signup"  {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }} >
<label for="checkbox-signup"> Remember me </label>
</div>
<a class="text-dark pull-right" id="to-recover" href="{{ url('forget-password') }}"><i class="fa fa-lock m-r-5"></i> Forgot Password?</a> </div>
</div>
<div class="form-group text-center m-t-20">
<div class="col-xs-12">
<button type="submit" name="memlogin" class="btn btn-primary btn-lg btn-block text-uppercase" value="1">Log In</button>
</div>
</div>
<div class="form-group m-b-0">
<div class="col-sm-12 text-center">
<p>Don't have an account? <a class="text-primary m-l-5" href="{{ url('register') }}"><b> Register Free</b></a></p>
<p><a class="m-l-5" href="{{ url('')}}"><b><i class="fa fa-long-arrow-left"></i> Back to home</b></a></p>
</div>
 </div>
</form>
</div>
</div>
</section>
@endsection
