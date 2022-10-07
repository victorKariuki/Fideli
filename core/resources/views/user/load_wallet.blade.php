 <!-- app-content-->
@extends('layouts.main')

@section('content')

<style>
    body{
        background-color: black;
    }
    </style>




      <br>
       
            <?php
            $nji=$user->lastname;
            
            ?>
            
            
					        
          
                
               @if ($nji=='KENYA')  
                             
             <div class="row">
                        <div class="col-xl-12">
								<div class="card card-counter bg-secondary">
									<div class="card-body">
										<div class="row">
											
											<div class="col-8 text-center">
												<div class="mt-4 mb-0 text-success">
													<h1 class="btn btn-link mb-0 bd-highlight"> <a href="/Loadwallet" class="bd-highlight"><code>CLICK TO START STK </code></a></h1><br>
													<p class="text-white mt-1">PAY WITH AUTOMATED STK </p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
					        
					        @endif
					        
          
                  
                  
                 
                    @if ($nji=='RWANDA')
                    
                      <div class="row">
                        <div class="col-xl-12">
								<div class="card card-counter bg-gradient-success">
									<div class="card-body">
										<div class="row">
											<div class="col-4">
												<i class="fas fa-money-bill mt-3 mb-0 text-dark"></i>
											</div>
											<div class="col-8 text-center">
												<div class="mt-4 mb-0 text-success">
													<h1 class="btn btn-link mb-0"> <a href="/{{env('DEP_LINK')}}" >DEPOSIT BY SENDING TO MPESA SAFARICOM </a></h1><br>
													<h2 class="btn btn-link mb-0"> <a href="/{{env('DEP_LINK')}}" >MPESA NUMBER : +254700518049 </a></h2><br>
													<p class="text-danger mt-1">send directly from tigo, airtel, and any other network</p>
												</div> 
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
					        
                      @endif

 
  <!--=================================================-->
 
                  <!--=================================================-->
                  
                      
                            						<div class="card card-counter bg-secondary">
									<div class="card-body">
										<div class="row">
											
											<div class="col-8 text-center">
												<div class="mt-4 mb-0 text-success">
													<h1 class="btn btn-link mb-0 bd-highlight"> <a href="#" class="bd-highlight"><code>254746510302 </code></a></h1><br>
													<p class="text-white mt-1">TANZANIA||RWANDA||UGANDA </p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
					        
					        
                              
                  
                  
                            
                            
                      
                            
                                              <!--=============================================-->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-gradient-secondary">
                                <div class="card-header">
                                    <div class="card-title">{{ __('Deposit History') }}</div>
                                </div>
                                <div class="card-body pb-0">
                                    <?php
                                        $deps = App\deposits::where('user_id', $user->id)->orderby('id', 'desc')->paginate(10);
                                    ?>                                                   
                                                
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>  
                                                <th>{{ __('Amount') }}</th>        
                                                <th>{{ __('Method') }}</th>
                                                <th>{{ __('Account') }}</th>
                                                <th>{{ __('Acc Name') }}</th>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Url') }}</th>                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @if(count($deps) > 0 )
                                                @foreach($deps as $dep)
                                                    <tr> 
                                                        <td>{{$settings->currency}} {{$dep->amount}}</td>     
                                                        <td>{{$dep->bank}}</td>
                                                        <td>
                                                           {{$dep->account_no}}
                                                        </td>
                                                        <td>
                                                           {{$dep->account_name}}
                                                        </td>
                                                        <td>{{$dep->created_at}}</td>
                                                        <td>
                                                            @if($dep->status == 0)
                                                                Pending
                                                            @elseif($dep->status == 1)
                                                                Approved
                                                            @elseif($dep->status == 2)
                                                                Rejected
                                                            @endif
                                                        </td> 
                                                        <td>
                                                            @if($dep->bank == 'BTC')
                                                                @if($dep->account_name == 'Coin Base')
                                                                    <a href="{{ route('coinbase.confirm', ['id' => $dep->pop]) }}" target="_blank" class="btn btn-info">Check</a>
                                                                @else
                                                                    <a href="{{ route('btc.confirm', ['id' => $dep->account_name]) }}" target="_blank" class="btn btn-info">Check</a>
                                                                @endif
                                                            @endif
                                                        </td>                                                                       
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>                                                            
                                                    <td colspan="6">{{ __('No data') }}</td>                                        
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $deps->links() }}
                                    </div>           
                                    <br><br>  
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
           
           
            </div>
            
@endSection
             