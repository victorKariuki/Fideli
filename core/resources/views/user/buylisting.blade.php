@extends('layouts.main')

@section('content')


<!-- Row -->
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header border-0">
										<div>
											<h3 class="card-title">Buy Coin</h3>
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
									<div class="table-responsive">
										<table class="table card-table table-vcenter text-nowrap">
											<thead >
												<tr>
													<th>Buy From</th>
													<th>Pay with</th>
													<th>Average trade speed</th>
													<th>Rate</th>
												</tr>
											</thead>
											<tbody>
											    @foreach($buyoffers as $buyoffer)
												<tr>
													<th scope="row">
													    <?php
													    $names=App\User::where('id',$buyoffer->user_id)->get();
													    ?>
													    
													  @foreach($names as $name)
													  {{$name->firstname}}  {{$name->lastname}}
													  @endforeach
													 <br>
													   <i class="fa fa-thumbs-up" aria-hidden="true"></i> 0
													    
													
													</th>
													<td>{{$buyoffer->payment}}</td>
													<td>New</td>
													<td>{{$buyoffer->rate}}%<br>
													
													 Limits: {{$buyoffer->min}}-{{$buyoffer->max}} <br>
													<button class="btn btn-info">Buy sp</button>
													
												
													</td>
												</tr>
												<br>
												@endforeach
											
											</tbody>
										</table>
									</div>
									<!-- table-responsive -->
								</div>
							</div><!-- col end -->
						</div>
						<!-- End Row -->

@endsection