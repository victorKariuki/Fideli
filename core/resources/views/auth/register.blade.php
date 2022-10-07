@extends('inc.auth_layout')
@section('content')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body class="bg-dark border border-dark">
<br>
   
                                            <div align="center">
                                                <img src="/img/{{$settings->site_logo}}" alt="{{$settings->site_title}}" class="login_logo">
                                                <br>
                                                <h3 class="colhd"><i class="fa fa-key"></i>{{env('APP_NAME') }} Register</h3>
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
                                       
                                       <h1 class="text-center">REGISTER HERE</h1>
                                               </div>
                                            <form method="POST" action="{{ route('register') }}" id="reg"> 
                                            
                                                <input id="csrf" type="hidden"  name="_token" value="{{ csrf_token() }}" >
                                                <div class="form-group text-white row">                                                    
                                                    <div class="col-sm-6">
                                                    <label class="text-white">Enter Firstname: </label>
                                                        <input id="Fname" type="text" class="form-control @error('Fname') is-invalid @enderror regTxtBox" name="Fname" value="{{ old('Fname') }}" required autocomplete="Fname" autofocus placeholder="First Name">

                                                        @error('Fname')
                                                            <span class="invalid-feedback" role="alert alert-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <br><br>
                                                     <div class="col-sm-6">
                                                     <label class="text-white">Choose your country: </label>
                                                         <select class="custom-select" name="Lname" id="Lname" form="reg" >
                                                          <option value="KENYA">KENYA</option>
                                                          <option value="RWANDA">RWANDA</option>
                                                          <option value="UGANDA">UGANDA</option>
                                                          <option value="TANZANIA">TANZANIA</option>
                                                         <option value="OTHERS">OTHERS</option>
                                                        </select>
                                                        <!--<input id="Lname" type="text" class="form-control @error('Lname') is-invalid @enderror regTxtBox" name="Lname" value="{{ old('Lname') }}" required autocomplete="Lname" autofocus placeholder="Last Name">-->

                                                        @error('Lname')
                                                            <span class="invalid-feedback" role="alert alert-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group row"> 

                                                    <div class="col-sm-12">
                                                    <labelclass="text-white">Enter Your Email: </label>
                                                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror regTxtBox" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert alert-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <div class="col-sm-12">
                                                    <label class="text-white">Enter Username: </label>
                                                       <input id="username" type="username" class="form-control @error('username') is-invalid @enderror regTxtBox" name="username" value="{{ old('username') }}" required  placeholder="Usernane">

                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    
                                                    <div class="col-sm-12">
                                                        <label class="text-white">Enter mobile: </label>
                                                       <input id="username" type="number" class="form-control @error('phone') is-invalid @enderror regTxtBox" name="phone" value="{{ old('username') }}" required autocomplete="phone" placeholder=" 254789326743 ">

                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                <!--<strong>{{ $message }}</strong>-->
                                                                <strong>Please include country code e.g 254******* atleast 12 characters</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                    <label class="text-white">Enter password: </label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror regTxtBox" name="password" required autocomplete="new-password" placeholder="Password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <label class="text-white">Repeat Password: </label>
                                                        <input id="password-confirm" type="password" class="form-control regTxtBox" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" >
                                                    </div>

                                                </div>
                                      
                                            
                                           
                                            
                                            <style>
                                            #g-recaptcha-response {
                                            display: block !important;
                                            position: absolute;
                                            margin: -78px 0 0 0 !important;
                                            width: 302px !important;
                                            height: 76px !important;
                                            z-index: -999999;
                                            opacity: 0;
                                        }
                                            </style>

                                                <?php
                                                    $usn = App\User::where('username', Session::get('ref'))->get();
                                                ?>

                                                <div class="row">
                                                    <div class="">
                                                        <input id="ref" type="hidden" class="form-control" name="ref" value="@if(count($usn) > 0){{Session::get('ref')}}@endif" >
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                        <br><br>
                                                        @if($settings->user_reg == 1)
                                                            <button type="submit" class="collc btn btn-info">
                                                                {{ __('Register') }}
                                                            </button>
                                                        @else
                                                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Registration disabled by admin.</div>
                                                        @endif
                                                        <br><br>
                                                         <button type="submit" class="collc btn btn-info">
                                                                <a href="/home.php">HOME</a>
                                                            </button>
                                                          
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                       <p>
                                                          <strong>Already have an account? <a href="/login">Login</a></strong>
                                                         
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
        </div>
    </div>
@endsection
