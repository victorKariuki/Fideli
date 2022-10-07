<?php $__env->startSection('content'); ?>
        <div class="main-panel">
            <div class="content">
              
                
                <div class="page-inner mt--5">
                
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title"><?php echo e(__('My Investment')); ?></div>                                       
                                    </div>
                                </div>
                                <div class="card-body ">  
                                    <div class="table-responsive web-table">
                                        <table class="display table table-hover" >
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Package')); ?></th>
                                                    <th><?php echo e(__('Capital')); ?></th>
                                                    <th><?php echo e(__('Date Invested')); ?></th> 
                                                    <th><?php echo e(__('Elapse')); ?></th>  
                                                    <th><?php echo e(__('Days Spent')); ?></th> 
                                                    <th><?php echo e(__('Status')); ?></th>
                                                    <th><?php echo e(__('Earning')); ?></th>  
                                                    <th><?php echo e(__('Action')); ?></th> 
                                                </tr>
                                            </thead>
                                            <tbody class="web-table">                                                
                                                <?php if(count($actInv) > 0 ): ?>
                                                    <?php $__currentLoopData = $actInv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                            <td><?php echo e($in->package); ?></td>
                                                            <td><?php echo e(($settings->currency)); ?> <?php echo e($in->capital); ?></td>     
                                                            <td><?php echo e($in->date_invested); ?></td>
                                                            <td><?php echo e($in->end_date); ?></td> 
                                                            <td><?php echo e($totalDays); ?></td>
                                                            <td><?php echo e($in->status); ?></td>
                                                            <td><?php echo e($settings->currency); ?> <?php echo e($ern); ?> </td>
                                                            <td>
                                                                <a title="Withdraw" href="javascript:void(0)" class="btn btn-info" onclick="wd('pack', '<?php echo e($in->id); ?>', '<?php echo e($ern); ?>', '<?php echo e($withdrawable); ?>', '<?php echo e($Edays); ?>', '<?php echo e($ended); ?>')">
                                                                   w
                                                                </a>
                                                            </td>           
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="text-right col-md-12"><?php echo e($actInv->links()); ?></div>
                                    </div>

                                    <div class="mobile_table container messages-scrollbar" >
                                                    
                                        <?php if(count($actInv) > 0 ): ?>
                                            <?php $__currentLoopData = $actInv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                 
                                                                            
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>

                
                    
                    					
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
                

    


<?php $__env->stopSection(); ?>
            
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/candlest/tru.candlesticktrade.xyz/core/resources/views/user/my_investment.blade.php ENDPATH**/ ?>