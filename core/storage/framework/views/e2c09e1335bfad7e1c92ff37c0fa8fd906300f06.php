<!-- app-content-->


<?php $__env->startSection('content'); ?>


<?php
  $totalEarning = 0;    
  $currentEarning = 0;
  $workingDays = 0;
     
  foreach($actInv as $inv)
  {
    $totalElapse = getDays(date('y-m-d'), $inv->end_date);
    if($totalElapse == 0)
    {
      $lastWD = $inv->last_wd;
      $enddate = ($inv->end_date);
      
      $getDays = getDays($lastWD, $enddate);
      $currentEarning += $getDays*$inv->interest*$inv->capital;
      
    }
    else
    {
      $sd = $inv->last_wd;
      $ed = date('Y-m-d');        
      
      $getDays = getDays($sd, $ed);
      $currentEarning += $getDays*$inv->interest*$inv->capital;
    }
  }
?>
			

					    <!-- page-header -->
						<div class="page-header">
							<div class="page-leftheader">
								<h1 class="page-title"> Dashboard</h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="las la-home mr-2 fs-16"></i>Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Dashboard</a></li>
								</ol>
							</div>
							<div class="page-rightheader">
								<div class="btn btn-list pr-0">
									<a href="#" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Filter"><i class="fe fe-filter"></i> </a>
									<a href="#" class="btn btn-secondary btn-icon text-white dropdown-toggle mr-0" data-toggle="dropdown">
										<span>
											<i class="fe fe-external-link"></i>
										</span> Export <span class="caret"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right" role="menu">
										<a href="#" class="dropdown-item"><i class="bx bxs-file-pdf mr-2"></i>Export as Pdf</a>
										<a href="#" class="dropdown-item"><i class="bx bxs-file-image mr-2"></i>Export as Image</a>
										<a href="#" class="dropdown-item"><i class="bx bxs-file mr-2"></i>Export as Excel</a>
									</div>
								</div>
							</div>
						</div>
						<!-- End page-header -->

						<!-- Row -->
						<div class="row">
							<div class="col-lg-3 col-md-6">
								<div class="card bg-gradient-secondary img-card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="mr-5">
												<div class="ecommerce-icon">
													<img src="<?php echo e(url('core/public/assets/images/png/wallet.png')); ?>" alt="img">
												</div>
											</div>
											<div class="text-white mt-3">
												<p class="mb-1 font-weight-semibold fs-14"> WALLET </p>
												<h2 class="mt-1 mb-0 fs-30 font-weight-bold "><?php echo e($settings->currency); ?> <?php echo e(number_format($user->wallet, 2)); ?></h2>
											</div>
										</div>
									</div>
									<img src="<?php echo e(url('core/public/assets/images/png/circle.png')); ?>" alt="img" class="img-card-circle">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="card bg-gradient-success img-card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="mr-5">
												<div class="ecommerce-icon">
													<img src="<?php echo e(url('core/public/assets/images/png/cart.png')); ?>" alt="img">
												</div>
											</div>
											<div class="text-white mt-3">
												<p class="mb-1 font-weight-semibold fs-14"> EARNINGS </p>
												<h2 class="mt-1 mb-0 fs-30 font-weight-bold "><?php echo e($settings->currency); ?> <?php echo e(number_format($currentEarning, 2)); ?></h2>
											</div>
										</div>
									</div>
									<img src="<?php echo e(url('core/public/assets/images/png/circle.png')); ?>" alt="img" class="img-card-circle">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="card bg-gradient-danger img-card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="mr-5">
												<div class="ecommerce-icon">
													<img src="<?php echo e(url('core/public/assets//images/png/location.png')); ?>" alt="img">
												</div>
											</div>
											<div class="text-white mt-3">
												<p class="mb-1 font-weight-semibold fs-14"> REFERRAL BONUS </p>
												<h2 class="mt-1 mb-0 fs-30 font-weight-bold "><?php echo e($settings->currency); ?> <?php echo e(number_format($user->ref_bal, 2)); ?></h2>
											</div>
										</div>
									</div>
									<img src="<?php echo e(url('core/public/assets/images/png/circle.png')); ?>" alt="img" class="img-card-circle">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="card bg-gradient-info img-card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="mr-5">
												<div class="ecommerce-icon">
													<img src="<?php echo e(url('core/public/assets/images/png/gift.png')); ?>" alt="img">
												</div>
											</div>
											<div class="text-white mt-3">
												<p class="mb-1 font-weight-semibold fs-14"> WITHDRAWALS </p>
												<h2 class="mt-1 mb-0 fs-30 font-weight-bold ">
												    
												   
												<?php
									        $total_wd = 0;
									        foreach($wd as $w)
									        {
    											$total_wd += $w->amount;
									        }
									    ?>
									     <?php echo e($settings->currency.' '. $total_wd); ?>

									    </h2>
											</div>
										</div>
									</div>
									<img src="<?php echo e(url('core/public/assets/images/png/circle.png')); ?>" alt="img" class="img-card-circle">
								</div>
							</div>
						</div>
						<!-- End Row -->

							<!-- Row -->
							
			<?php                
                $invs = App\packages::where('status', 1)->orderby('id', 'asc')->get();                
            ?>
            <div class="row">
            <?php if(isset($invs) && count($invs) > 0): ?>
                    <?php $__currentLoopData = $invs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
							<div class="col-sm-6 col-lg-6 col-xl-3">
								<div class="card card-pricing shadow text-center px-3 ">
									<span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white "><?php echo e($inv->package_name); ?></span>
									<div class="bg-transparent border-0">
										<h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30"><span class="price"> <?php echo e($inv->period); ?></span><span class="h6 text-muted ml-2">/ days</span></h1>
									</div>
									<div class="card-body pt-0">
										<ul class="list-unstyled mb-4">
											<li>Min Investment : <?php echo e($settings->currency); ?> <?php echo e($inv->min); ?></li>
											<li>Max Investment : <?php echo e($settings->currency); ?> <?php echo e($inv->max); ?></li>
											<li>Total Interest : <?php echo e($inv->daily_interest*$inv->period*100); ?>%</li>
											<li>Withdrawal Interval : <?php echo e($inv->days_interval); ?> Days</li>
											<li>24/7 support</li>
										</ul>
										<a id="<?php echo e($inv->id); ?>" href="javascript:void(0)"  class="btn btn-primary mb-3" onclick="confirm_inv('<?php echo e($inv->id); ?>', '<?php echo e($inv->package_name); ?>', '<?php echo e($inv->period); ?>', '<?php echo e($inv->daily_interest); ?>', '<?php echo e($inv->min); ?>', '<?php echo e($inv->max); ?>', '<?php echo e($user->wallet); ?>')">Order Now</a>
									</div>
								</div>
							</div><!-- col-end -->
						
						
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
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
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Initiate Investment')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h5><?php echo e(__('Wallet Balance:')); ?> <b><?php echo e($settings->currency); ?> <span id="WalletBal"></span></b></h5> 
                        
                    <p align="center" class="color_blue_b">
                        <?php echo e(__('You are about to invest in ')); ?> <b><span id="pack_inv"></span></b><?php echo e(__(' package which takes a period of')); ?>  <b><span id="period"></span></b><?php echo e(__(' working days and comes with ')); ?>  <b><span id="intr"></span></b>% <?php echo e(__(' total interest')); ?>                  
                    </p>
                    
        <form id="userpackinv" action="/user/invest/packages" method="post">
            <div class="form-group" align="left">
              <div class="pop_form_min_max" align="center">
                <b><?php echo e(__('Min. Capital:')); ?> <?php echo e($settings->currency); ?> <span id="min"></span></b> | 
                <b><?php echo e(__('Max. Capital:')); ?> <?php echo e($settings->currency); ?> <span id="max"></span></b>                      
              </div> 
              <br>                   
              <label><?php echo e(__('Enter Amount to Invest')); ?></label>
              <input type="hidden" class="form-control" name="_token" value="<?php echo e(csrf_token()); ?>">
              <input id="p_id" type="hidden" class="form-control" name="p_id" value="">
              <input type="text" class="form-control" name="capital" placeholder="Enter capital to invest" required>
            </div>
            <div class="form-group">
                <button class="collb btn btn-info"><?php echo e(__('Proceed')); ?></button>
                <span style="">            
                  <a id="popMsg_close_user" href="javascript:void(0)" class="btn btn-danger"><?php echo e(__('Cancel')); ?></a>        
                </span>
                <br><br>
            </div>
        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
       <!--         <div class="row">-->
							<!--<div class="col-xl-12">-->
							<!--	<div class="card">-->
							<!--	       <div>-->
							<!--				<h3 class="card-title"> <?php echo e(__('Referral link:')); ?>:: </h3>-->
							<!--			</div>-->
       <!--                                     <div class="card-options">-->
       <!--                                    <a href="/register/<?php echo e($user->username); ?>" class="text-info" id="reflnk" >-->
       <!--                                         <small><?php echo e(env('APP_URL').__('/register/').$user->username); ?></small>-->
       <!--                                     </a>   -->
       <!--                                     </div>-->
                                            
                                            
       <!--             </div></div></div>-->
						<!-- End Row -->
                        <!-- Row -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<div>
											<h3 class="card-title">Referal link</h3>
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
										<div class="table-responsive">
										 <a href="https://smartpaptraders.com/register/<?php echo e($user->username); ?>" onclick="copyURI(event)" class="btn btn-info" id="reflnk" >
                                                <!--<small><?php echo e(env('APP_URL').__('/register/').$user->username); ?></small>-->
                                                Copy Link
                                            </a>  
                                            
                                            <script>
                                                function copyURI(evt) {
                                                    evt.preventDefault();
                                                    navigator.clipboard.writeText(evt.target.getAttribute('href')).then(() => {
                                                      /* clipboard successfully set */
                                                      swal("Good job!", "You copied the Link,Time to share!", "success");
                                                    }, () => {
                                                      /* clipboard write failed */
                                                    });
                                                }
                                            </script>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<div>
											<h3 class="card-title">User Activities</h3>
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
										<div class="table-responsive">
											<table id="example3" class="table table-striped table-bordered text-nowrap" >
												<thead>
													<tr>
														<th>Actions</th>
														<th>Date</th>
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>User Registered</td>
														<td>2021-09-21 </td>
														
													</tr>
													
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->



					</div><!--End side app-->

					<!-- Right-sidebar-->
					<div class="sidebar sidebar-right sidebar-animate">
						<div class="tab-menu-heading siderbar-tabs border-0">
							<div class="tabs-menu ">
								<!-- Tabs -->
								<ul class="nav panel-tabs">
									<li class=""><a href="#tab1" class="active" data-toggle="tab">Settings</a></li>
									<li><a href="#tab2" data-toggle="tab">Friends</a></li>
									<li><a href="#tab3" data-toggle="tab">Chat</a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">
							<div class="tab-content border-top">
								<div class="tab-pane active" id="tab1">
									<div class="p-3 border-bottom">
										<h5 class="border-bottom-0 mb-0">General Settings</h5>
									</div>
									<div class="p-4">
										<div class="switch-settings">
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Notifications</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Show your emails</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Show Task statistics</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Show recent activity</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">System Logs</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Error Reporting</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Show your status to all</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
											<div class="d-flex mb-2">
												<span class="mr-auto fs-15">Keep up to date</span>
												<label class="custom-switch">
													<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
													<span class="custom-switch-indicator"></span>
												</label>
											</div>
										</div>
									</div>
									<div class="p-3 border-bottom">
										<h5 class="border-bottom-0 mb-0">Overview</h5>
									</div>
									<div class="p-4">
										<div class="progress-wrapper">
											<div class="mb-3">
												<p class="mb-2">Achieves<span class="float-right text-muted font-weight-normal">80%</span></p>
												<div class="progress h-1">
													<div class="progress-bar bg-primary w-80 " role="progressbar"></div>
												</div>
											</div>
										</div>
										<div class="progress-wrapper pt-2">
											<div class="mb-3">
												<p class="mb-2">Projects<span class="float-right text-muted font-weight-normal">60%</span></p>
												<div class="progress h-1">
													<div class="progress-bar bg-secondary w-60 " role="progressbar"></div>
												</div>
											</div>
										</div>
										<div class="progress-wrapper pt-2">
											<div class="mb-3">
												<p class="mb-2">Earnings<span class="float-right text-muted font-weight-normal">50%</span></p>
												<div class="progress h-1">
													<div class="progress-bar bg-success w-50" role="progressbar"></div>
												</div>
											</div>
										</div>
										<div class="progress-wrapper pt-2">
											<div class="mb-3">
												<p class="mb-2">Balance<span class="float-right text-muted font-weight-normal">45%</span></p>
												<div class="progress h-1">
													<div class="progress-bar bg-warning w-45 " role="progressbar"></div>
												</div>
											</div>
										</div>
										<div class="progress-wrapper pt-2">
											<div class="mb-3">
												<p class="mb-2">Toatal Profits<span class="float-right text-muted font-weight-normal">75%</span></p>
												<div class="progress h-1">
													<div class="progress-bar bg-danger w-75" role="progressbar"></div>
												</div>
											</div>
										</div>
										<div class="progress-wrapper pt-2">
											<div class="mb-3">
												<p class="mb-2">Total Likes<span class="float-right text-muted font-weight-normal">70%</span></p>
												<div class="progress h-1">
													<div class="progress-bar bg-teal w-70" role="progressbar"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane  " id="tab2">
									<div class="chat">
										<div class="contacts_card">
											<ul class="contacts mb-0">
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/male/3.jpg" class="rounded-circle user_img" alt="img">
															<span class="online_icon"></span>
														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Maryam Naz</h6>
															<small class="text-muted">Maryam is online</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>01-02-2020</small></div>
													</div>
												</li>
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/female/1.jpg" class="rounded-circle user_img" alt="img">

														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Sahar Darya</h6>
															<small class="text-muted">Sahar left 7 mins ago</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>01-02-2020</small></div>
													</div>
												</li>
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/female/9.jpg" class="rounded-circle user_img" alt="img">
															<span class="online_icon"></span>
														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Maryam Naz</h6>
															<small class="text-muted">Maryam is online</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>01-02-2020</small></div>
													</div>
												</li>
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/female/10.jpg" class="rounded-circle user_img" alt="img">

														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Yolduz Rafi</h6>
															<small class="text-muted">Yolduz is online</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>02-02-2020</small></div>
													</div>
												</li>
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/male/5.jpg" class="rounded-circle user_img" alt="img">
															<span class="online_icon"></span>
														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Nargis Hawa</h6>
															<small class="text-muted">Nargis left 30 mins ago</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>02-02-2020</small></div>
													</div>
												</li>
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/male/7.jpg" class="rounded-circle user_img" alt="img">
															<span class="online_icon"></span>
														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Khadija Mehr</h6>
															<small class="text-muted">Khadija left 50 mins ago</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>03-02-2020</small></div>
													</div>
												</li>
												<li>
													<div class="d-flex bd-highlight">
														<div class="img_cont">
															<img src="../../assets/images/users/female/8.jpg" class="rounded-circle user_img" alt="img">

														</div>
														<div class="user_info">
															<h6 class="mt-1 mb-0 ">Khadija Mehr</h6>
															<small class="text-muted">Khadija left 50 mins ago</small>
														</div>
														<div class="float-right text-right ml-auto mt-auto mb-auto"><small>03-02-2020</small></div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tab3">
									<div class="list d-flex align-items-center border-bottom p-4">
										<div class="">
											<span class="avatar bg-primary brround avatar-md">CH</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>New Websites is Created</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">30 mins ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center border-bottom p-4">
										<div class="">
											<span class="avatar bg-danger brround avatar-md">N</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Prepare For the Next Project</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">2 hours ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center border-bottom p-4">
										<div class="">
											<span class="avatar bg-info brround avatar-md">S</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Decide the live Discussion Time</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">3 hours ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center border-bottom p-4">
										<div class="">
											<span class="avatar bg-warning brround avatar-md">K</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Team Review meeting at yesterday at 3:00 pm</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">4 hours ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center border-bottom p-4">
										<div class="">
											<span class="avatar bg-success brround avatar-md">R</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Prepare for Presentation</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">1 days ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center  border-bottom p-4">
										<div class="">
											<span class="avatar bg-pink brround avatar-md">MS</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Prepare for Presentation</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">1 days ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center border-bottom p-4">
										<div class="">
											<span class="avatar bg-purple brround avatar-md">L</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Prepare for Presentation</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">45 mintues ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="list d-flex align-items-center p-4">
										<div class="">
											<span class="avatar bg-blue brround avatar-md">U</span>
										</div>
										<div class="wrapper w-100 ml-3">
											<p class="mb-0 d-flex">
												<b>Prepare for Presentation</b>
											</p>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<i class="mdi mdi-clock text-muted mr-1"></i>
													<small class="text-muted ml-auto">2 days ago</small>
													<p class="mb-0"></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				
				
				<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/truthful/smartpaptraders.com/core/resources/views/user/index.blade.php ENDPATH**/ ?>