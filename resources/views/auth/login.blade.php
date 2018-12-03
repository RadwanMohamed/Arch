@extends('layouts.app')

@section('content')



  <div class="container margin">

      <div class=" form-group  contact_bottom">
          <h3>تسجيل الدخول</h3>
      </div>

      <form method="POST" action="{{ route('login') }}" >



         @csrf
         <div class="form-group row" style="margin-top:50px">
             <div class="col-md-6" >
             <input id="email" placeholder="البريد الالكتروني" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
             @if ($errors->has('email'))
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('email') }}</strong>
                 </span>
             @endif
             </div>

             <div class="col-md-6 ">
             <input id="password" placeholder="كلمة المرور" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
             @if ($errors->has('password'))
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('password') }}</strong>
                 </span>
             @endif
             </div>
         </div>

         <div class="form-group row">
             <div class="col-md-6 offset-md-2">
                 <div class="form-check">
                     <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                     <label class="form-check-label" for="remember" >
                         تذكرني
                     </label>
                 </div>
             </div>
         </div>

         <div class="form-group row  login-buttons ">
             <div class="col-md-6 ">
                 <button type="submit" class="btn  btn-success">
                      تسجيل الدخول
                 </button>
             </div>
                <div class="col-md-6 offset-md-10">
                 @if (Route::has('password.request'))
                     <a class="btn btn-secondary" href="{{ route('password.request') }}">
                         {{ __('Forgot Your Password?') }}
                     </a>
                 @endif
             </div>
             </div>
         </div>
     </form>
  </div>


@endsection
