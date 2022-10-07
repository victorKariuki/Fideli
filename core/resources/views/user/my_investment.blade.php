@extends('layouts.main')

@section('content')
<style>
    body{
        background-color: black;
    }
    </style>
        
            <div class="content">
              
                
                <div class="page-inner mt--5">
                
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-gradient-info">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">{{ __('Your Investment') }}</div>                                       
                                    </div>
                                </div>
                                <div class="card-body ">
                                        <?php                
                $kazi = App\investment::where('usn', $user->username)->orderby('id', 'asc')->get();                
            ?>
                                      @if(count($kazi) > 0 )
                                    
                                    
                                     <!-- Row -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card bg-info">
                                    <div class="card-header">
                                        <div>
                                            <h3 class="card-title">WHATSAPP LINKS</h3>
                                        </div>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                          <p>
                              <a class="btn btn-warning" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                CHECK THEM
                              </a>
                              
                            </p>
                            <div class="collapse" id="collapseExample">
                              <div class="card card-body bg-light">
                                  <a href="{{env('ENOCK_GROUP')}}">Group1</a><br>
                                 
                               </div>
                            </div>
                                            
                                            <script>
                                              
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->  
                        @endif
                        
                        
                                    <div class="table-responsive web-table">
                                        <table class="display table table-hover" >
                                            <thead>
                                                <tr>
                                                     <th>{{ __('Action') }}</th> 
                                                    <th>{{ __('Package') }}</th>
                                                    <th>{{ __('Capital') }}</th>
                                                    <th>{{ __('Date Invested') }}</th> 
                                                    <th>{{ __('Elapse') }}</th>  
                                                    <th>{{ __('Days Spent') }}</th> 
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Earning') }}</th>  
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class="web-table">                                                
                                                @if(count($actInv) > 0 )
                                                    @foreach($actInv as $in)
                                                        <?php
                                                           
                                                            $totalElapse = getDays(date('Y-m-d'), $in->end_date);
                                                            if($totalElapse == 0)
                                                            {
                                                                $lastWD = $in->last_wd;
                                                                $enddate = ($in->end_date);
                                                                $Edays = getDays($lastWD, $enddate);
                                                                $ern  = $Edays*$in->interest*$in->capital;
                                                                $withdrawable = $ern;              
                                                                $totalDays = getDays($in->date_invested, $in->end_date);
                                                                $ended = "yes";
                                                            }
                                                            else
                                                            {
                                                                $lastWD = $in->last_wd;
                                                                $enddate = (date('Y-m-d'));
                                                                $Edays = getDays($lastWD, $enddate);
                                                                $ern  = $Edays*$in->interest*$in->capital;
                                                                $withdrawable = 0;
                                                                if ($Edays >= $in->days_interval)
                                                                {
                                                                    $withdrawable = $in->days_interval*$in->interest*$in->capital;
                                                                }
                                                                                               
                                                                $totalDays = getDays($in->date_invested, date('Y-m-d'));
                                                                $ended = "no";
                                                            }
                                                        ?>
                                                        <tr class="">
                                                        <td>
                                                                <a title="Withdraw" href="javascript:void(0)" class="btn btn-warning float-left" onclick="wd('pack', '{{$in->id}}', '{{$ern}}', '{{ $withdrawable }}', '{{$Edays}}', '{{$ended}}')">
                                                                   withdraw
                                                                </a>
                                                            </td>           
                                                              
                                                            <td>{{$in->package}}</td>
                                                            <td>{{($settings->currency)}} {{$in->capital}}</td>     
                                                            <td>{{$in->date_invested}}</td>
                                                            <td>{{$in->end_date}}</td> 
                                                            <td>{{$totalDays}}</td>
                                                            <td>{{$in->status}}</td>
                                                            <td>{{$settings->currency}} {{$ern}} </td>
                                                            
                                                            
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="text-right col-md-12">{{ $actInv->links() }}</div>
                                    </div>
                                    <script>
                                        function wd(p, id, earn, w_able, days, ended)
                                        {
                                            var id=id;
                                           document.getElementById('inv_id').value=id;
                                           
                                        
                                           
                                              var ended=ended;
                                           document.getElementById('ended').value=ended;
                                           
                                           
                                           var withdrawable_amt=w_able;
                                           document.getElementById('withdrawable_amt').value=withdrawable_amt;
                                           
                                           $('#exampleModal').modal('show');
                                           
                                        }
                                    </script>
                                    
                                    
                                    <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Earnings withdawal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="card-body pt-0" >                
          
          <form id="wd_formssss" action="/user/wdraw/earning" method="post">
              <div class="form-group" align="left">                       
                  <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                  <input id="inv_id" type="hidden" class="form-control" name="p_id" value="">
                  <input id="ended" type="hidden" class="form-control" name="ended" value="">
              </div>
              <div align="left">
                <label>{{ __('Withdrawable Amount') }} </label>
              </div>
              <div class="input-group">                
                <div class="input-group-prepend " >
                  <span class="input-group-text " >{{$settings->currency}}</span>
                </div>                                     
                <input id="withdrawable_amt"  type="text" readonly class="bg_white form-control" name="amt"  required >
              </div>
              <div class="form-group">
                <br><br>
                  <button type="submit" class="btn btn-info"> {{ __('Withdraw') }} </button>
                  <span style="">            
                    <a id="div_withdrawal_close" href="javascript:void(0)" class="btn btn-danger"> {{ __('Cancel') }} </a>        
                  </span>
                  <br>
              </div>
          </form>
        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-warning">Save changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                    <div class="mobile_table container messages-scrollbar" >
                                                    
                                        @if(count($actInv) > 0 )
                                            @foreach($actInv as $in)
                                                <?php

                                                    $totalElapse = getDays(date('y-m-d'), $in->end_date);
                                                    if($totalElapse == 0)
                                                    {
                                                        $lastWD = $in->last_wd;
                                                        $enddate = ($in->end_date);
                                                        $Edays = getDays($lastWD, $enddate);
                                                        $ern  = $Edays*$in->interest*$in->capital;
                                                        $withdrawable = $ern;
                                                                                             
                                                        $totalDays = getDays($in->date_invested, $in->end_date);
                                                        $ended = "yes";

                                                    }
                                                    else
                                                    {
                                                        $lastWD = $in->last_wd;
                                                        $enddate = (date('Y-m-d'));
                                                        $Edays = getDays($lastWD, $enddate);
                                                        $ern  = $Edays*$in->interest*$in->capital;
                                                        $withdrawable = 0;
                                                        if ($Edays >= $in->days_interval)
                                                        {
                                                            $withdrawable = $in->days_interval*$in->interest*$in->capital;
                                                        }
                                                                                       
                                                        $totalDays = getDays($in->date_invested, date('Y-m-d'));
                                                        $ended = "no";
                                                    }

                                                ?>
                                                 
                                                                            
                                                
                                            @endforeach
                                        @else
                                            
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>

                
                    
                                        
            <?php                
                $invs = App\packages::where('status', 1)->orderby('id', 'asc')->get();                
            ?>
            <div class="row">
            @if(isset($invs) && count($invs) > 0)
                    @foreach($invs as $inv)
                        
                            <div class="col-sm-6 col-lg-6 col-xl-3">
                                <div class="card card-pricing shadow text-center px-3 bg-gradient-info ">
                                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-warning text-white ">{{$inv->package_name}}</span>
                                    <div class="bg-white border-0">
                                        <h1 class="h1 font-weight-normal text-primary text-center mb-0 " data-pricing-value="30"><span class="price bg-transparent"> {{$inv->period}}</span><span class="h6 text-muted ml-2">/ days</span></h1>
                                    </div>
                                    <div class="card-body pt-0 bg-info">
                                        <ul class="list-unstyled mb-4">
                                            <li>Min Investment : {{$settings->currency}} {{$inv->min}}</li>
                                            <li>Max Investment : {{$settings->currency}} {{$inv->max}}</li>
                                            <li>Total Interest : {{$inv->daily_interest*$inv->period*100}}%</li>
                                            <li>Withdrawal Interval : {{$inv->days_interval}} Days</li>
                                            <li>24/7 support</li>
                                        </ul>
                                        <a id="{{$inv->id}}" href="javascript:void(0)"  class="btn bg-gradient-warning mb-3" onclick="confirm_inv('{{$inv->id}}', '{{$inv->package_name}}', '{{$inv->period}}', '{{$inv->daily_interest}}', '{{$inv->min}}', '{{$inv->max}}', '{{$user->wallet}}')">Order Now</a>
                                    </div>
                                </div>
                            </div><!-- col-end -->
                        
                        
                    @endforeach
            @endif
            </div>
            

                   
                    
                </div>
            </div>
      <script type="text/javascript">
                function confirm_inv(id,package_name,period,daily_interest,min,max,wallet){
                    
                    var wallet=wallet;
                    var package_name=package_name;
                    var period=period;
                    var daily_interest=daily_interest;
                    var min=min;
                    var max=max;
                     var id=id;
                    $('#exampleModalLong').modal('show');
                    $('#pack_inv').html(package_name);
                    $('#WalletBal').html(wallet);
                    $('#period').html(period);
                    $('#intr').html(daily_interest);
                    $('#min').html(min);
                    $('#max').html(max);
                    $('#p_id').val(id);
                    
                    
                    
                }
            </script>
            <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Initiate Investment') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h5>{{ __('Wallet Balance:') }} <b>{{$settings->currency}} <span id="WalletBal"></span></b></h5> 
                        
                    <p align="center" class="color_blue_b">
                        {{ __('You are about to invest in ') }} <b><span id="pack_inv"></span></b>{{ __(' package which takes a period of') }}  <b><span id="period"></span></b>{{ __(' working days and comes with ') }}  <b><span id="intr"></span></b>% {{ __(' total interest') }}                  
                    </p>
                    
        <form id="userpackinv" action="/user/invest/packages" method="post">
            <div class="form-group" align="left">
              <div class="pop_form_min_max" align="center">
                <b>{{ __('Min. Capital:') }} {{$settings->currency}} <span id="min"></span></b> | 
                <b>{{ __('Max. Capital:') }} {{$settings->currency}} <span id="max"></span></b>                      
              </div> 
              <br>                   
              <label>{{ __('Enter Amount to Invest') }}</label>
              <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
              <input id="p_id" type="hidden" class="form-control" name="p_id" value="">
              <input type="text" class="form-control" name="capital" placeholder="Enter capital to invest" required>
            </div>
            <div class="form-group">
                <button class="collb btn btn-info">{{ __('Proceed') }}</button>
                <span style="">            
                  <a id="popMsg_close_user" href="javascript:void(0)" class="btn btn-danger">{{ __('Cancel') }}</a>        
                </span>
                <br><br>
            </div>
        </form>
                      </div>
                    </div>
                  </div>
                </div>
                

    


@endSection
            