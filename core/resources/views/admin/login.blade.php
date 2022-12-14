@extends('inc.auth_layout')
@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body class="bg-dark border border-dark 5px">

<br>
   
                                            <div align="center">
                                                <img src="/img/{{$settings->site_logo}}" alt="{{$settings->site_title}}" class="login_logo">
                                                <br>
                                                <h3 class="colhd"><i class="fa fa-home"></i>{{env('APP_NAME') }} Login</h3>
                                                <hr>
                                            </div>
                                        </div>

                                        <br><br>
                                        <h4 align="center"> {{ __('Admin Login') }} </h4> 
                                        <div id="errMsg" class="card-header alert alert-danger cont_display_none" align="center">         
                                        </div>

                                        @if(Session::has('err2') )         
                                            <script type="text/javascript">            
                                                $('#errMsg').html("{{Session::get('err2')}}");
                                                $('#errMsg').show();
                                            </script>
                                            {{Session::forget('err2')}}
                                        @endif

                                        <div class="panel-body" style="">
                                            <form method="POST" action="/dhadmin/login">                        
                                                <input id="csrf" type="hidden"  name="_token" value="{{ csrf_token() }}" >
                                                <div class="form-group row">
                                                    <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="input-group">
                                                        <input id="" type="hidden" name="_token" value="{{csrf_token()}}" class="form-control">
                                                        <div class="input-group-prepend bg_ash">
                                                            <span class="input-group-text"><i class="fa fa-envelope "></i></span>
                                                        </div>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                                        @error('email')
                                                            <span class="invalid-feedback text-danger" role="alert" >
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password" class=" col-form-label text-md-right">{{ __('Admin Password') }}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend bg_ash">
                                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                                        </div>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                                        @error('password')
                                                            <span class="invalid-feedback text-danger" role="alert" >
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <div class="" align="center">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Login') }}
                                                        </button>                               
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
    </div>
@endsection
