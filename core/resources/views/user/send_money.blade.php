@extends('layouts.main')

@section('content')


<style>
  body{
    background-color: black;
  }
  </style>
    <br>
    
      <div class="content">
      
        <div class="page-inner mt--5">
          <div id="prnt"></div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="card">

                <div class="card-header">
                  <div class="card-title"> Fund Transfer </div>
                </div>

                <div class="card-body pb-0">                 
                    @if(Session::has('err_send'))
                        <div class="alert alert-danger">
                            {{Session::get('err_send')}}
                        </div>
                        {{Session::forget('err_send')}}
                    @endif
                    <div class="">                        
                        <form action="/user/send/funds" method="post" enctype="multipart/form-data">
                          <div class="form-group" align="left">                       
                              <input type="hidden" class="regTxtBox" name="_token" value="{{csrf_token()}}">
                          </div>                                                    
                          <div class="input-group pad_top10" >
                            <div class="input-group-prepend" >
                              <span class="input-group-text "><i class="fa fa-mobile"></i></span>
                            </div>                        
                            <!--<input type="text" class="form-control" name="phone"  required placeholder="Phone" >-->
                            <input type="text" class="form-control" name="usn"  required placeholder="phone" >
                          </div>
                          <div class="input-group pad_top10">
                            <div class="input-group-prepend" >
                              <span class=" input-group-text ">{{$settings->currency}}</span>
                            </div>                                                     
                            <input type="text" class="form-control" name="s_amt"  required placeholder="Enter amount you want to send" >
                          </div>
                                        
                          <div class="form-group" align="">
                            <br><br>
                              <button type="submit" class="btn btn_blue">{{ __('Send') }}</button>
                              <br>
                          </div>                          
                        </form>  
                        <br><br>                    
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Transfer History </div>
                </div>
                <div class="card-body">
                    @include('user.inc.transfer')
                </div>
              </div>
            </div>
            
          </div> 

                
          
        </div>
      </div>

       
@endSection