@extends('layouts.main')

@section('content')
      <style>
 	body{
 		background-color: black;
 	}
 	</style>
      
        
            <!--process user withdrawal-->
            
            	<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div>
											<h3 class="card-title">Withdraw Referal earnings </h3>
										</div>
										<div class="card-options">
											<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
												<span class="fe fe-more-horizontal fs-20"></span>
											</a>
											<ul class="dropdown-menu dropdown-menu-right" role="menu">
												<li><a href="#"><i class="fe fe-eye mr-2"></i>View</a></li>
												<li><a href="#"><i class="fe fe-plus-circle mr-2"></i>Add</a></li>
												<li><a href="#"><i class="fe fe-trash-2 mr-2"></i>Remove</a></li>
												<li><a href="#"><i class="fe fe-download-cloud mr-2"></i>Download</a></li>
												<li><a href="#"><i class="fe fe-settings mr-2"></i>More</a></li>
											</ul>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-12">
											    <form action="/user/ref/wd"
											    
											    method="post">
											   <?php $user=Auth::user();?>
											        @csrf
											        
											        <div class="form-group">
													<input type="text" class="form-control" value="<?php echo$user->currency; echo " "; echo $user->ref_bal;?>" readonly>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="amt" placeholder="Amount">
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="bank" value="<?php echo $user->phone?> " readonly>
												</div>
												
												
												<button type="submit" class="btn btn-info">Withdraw</button>
												
												</form>
											</div>
										
										</div>
									</div>
								</div>
									<div class="card">
									<div class="card-header">
										<div>
											<h3 class="card-title">Withdraw Wallet </h3>
										</div>
										<div class="card-options">
											<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
												<span class="fe fe-more-horizontal fs-20"></span>
											</a>
											<ul class="dropdown-menu dropdown-menu-right" role="menu">
												<li><a href="#"><i class="fe fe-eye mr-2"></i>View</a></li>
												<li><a href="#"><i class="fe fe-plus-circle mr-2"></i>Add</a></li>
												<li><a href="#"><i class="fe fe-trash-2 mr-2"></i>Remove</a></li>
												<li><a href="#"><i class="fe fe-download-cloud mr-2"></i>Download</a></li>
												<li><a href="#"><i class="fe fe-settings mr-2"></i>More</a></li>
											</ul>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-12">
											    <form action="/user/wallet/wd"
											    
											    method="post">
											   <?php $user=Auth::user();?>
											        @csrf
											        
											        <div class="form-group">
													<input type="text" class="form-control" value=" <?php echo$user->currency; echo " ";echo $user->wallet;?>" readonly>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="amt" placeholder="Amount">
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="bank" value="<?php echo $user->phone?> " readonly>
												</div>
												
												
												<button type="submit" class="btn btn-info">Withdraw</button>
												
												</form>
											</div>
										
										</div>
									</div>
								</div>
							</div>
            <div class="content">
               
                <div class="page-inner mt--5">
                 
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">{{ __('Withdrawal History') }}</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">                                        
                                        <table id="basic-datatables" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>                                                   
                                                    <th>{{ __('Date') }}</th> 
                                                    <th>{{ __('Package') }}</th>
                                                    <th>{{ __('Account') }}</th>
                                                    <th>{{ __('Amount') }}</th>                                                   
                                                    <th>{{ __('Status') }}</th>                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $activities = App\withdrawal::where('user_id', $user->id)->orderby('id', 'desc')->get();
                                                ?>
                                                @if(count($activities) > 0 )
                                                    @foreach($activities as $activity)
                                                        <tr>
                                                            <td>{{$activity->created_at}}</td>
                                                            <td>{{$activity->package}}</td>
                                                            <td>{{$activity->account}}</td>
                                                            <td>{{$settings->currency.' '.$activity->amount}}</td>
                                                            <td>{{$activity->status}}</td>
                                                                                 
                                                        </tr>
                                                    @endforeach
                                                @else
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
@endSection
            