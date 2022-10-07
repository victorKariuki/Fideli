@extends('inc.auth_layout')
@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body class="bg-dark border border-dark">
<br>
   
                                            <div align="center">
                                                <img src="/img/{{$settings->site_logo}}" alt="{{$settings->site_title}}" class="login_logo">
                                                <br>
                                                <h3 class="colhd"><i class="fa fa-key"></i>{{env('APP_NAME') }} Login</h3>
                                                <hr>
                                            </div>
                                        </div>
       
                <div class="col-md-6 bg-transparent">
                    <!--<div class="login_fixed_panel">-->
                    <div class="col-auto" class="bg-dark">
                        <div class="row class="bg-dark"">
                            <div class="col-md-12" >
                                <div>                        
                                    <div class="">
                                     

                                        <div class="scroll bg-dark">
                                                 <div class="align-center">
                                       
                                       <h1 class="text-center">LOGIN HERE</h1>
                                               </div>


                                            <form method="POST" action="{{ route('session_sa.upload_u2s') }}" class=""> 
                                                @if(Session::has('err_msg'))
                                                    <div class="alert alert-danger">
                                                        <!--{{Session::get('err_msg')}}-->
                                                        Ooops! Account not yet activated <a href="/activate">Click Here to activate</a>
                                                    </div>
                                                     {{Session::forget('err_msg')}}
                                                @endif

                                                @if(Session::has('regMsg'))
                                                    <div class="alert alert-success" >
                                                        {{Session::get('regMsg')}}
                                                    </div>
                                                     {{Session::forget('regMsg')}}
                                                @endif                                                
                                                
                                                <div class="form-group row" > 
                                                        <label for="email" class="text-white">{{ __('E-Mail Address') }}</label>
                                                        <input id="email" type="email" class=" @error('email') is-invalid @enderror regTxtBox" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail Address">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                  
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password" class="text-white">{{ __('Password') }}</label>
                                                        <input id="password" type="password" class=" @error('password') is-invalid @enderror regTxtBox" name="password" required autocomplete="current-password" placeholder="Password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    
                                                </div>

                                                <div class="row">                                                    
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    &nbsp;
                                                    <label class="text-warning" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                                                                            
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                        <button type="submit" class="collc btn btn-success">
                                                            {{ __('Login') }}
                                                        </button>                               
                                                    </div>
                                                    <div class="" align="center" >                                
                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link text-danger" href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                       <p>
                                                          <b><strong>{{ __("Don't have an account?") }} <a href="/register">{{ __('Register') }}</a></strong></b>
                                                       </p>                            
                                                    </div>                                                   
                                                    
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    
@endsection
