 <!-- app-content-->


<?php $__env->startSection('content'); ?>

<style>
    body{
        background-color: black;
    }
    </style>




      <br>
       
            <?php
            $nji=$user->lastname;
            
            ?>
            
            
					        
          
                
               <?php if($nji=='KENYA'): ?>  
                             
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
					        
					        <?php endif; ?>
					        
          
                  
                  
                 
                    <?php if($nji=='RWANDA'): ?>
                    
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
													<h1 class="btn btn-link mb-0"> <a href="/<?php echo e(env('DEP_LINK')); ?>" >DEPOSIT BY SENDING TO MPESA SAFARICOM </a></h1><br>
													<h2 class="btn btn-link mb-0"> <a href="/<?php echo e(env('DEP_LINK')); ?>" >MPESA NUMBER : +254700518049 </a></h2><br>
													<p class="text-danger mt-1">send directly from tigo, airtel, and any other network</p>
												</div> 
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
					        
                      <?php endif; ?>

 
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
                                    <div class="card-title"><?php echo e(__('Deposit History')); ?></div>
                                </div>
                                <div class="card-body pb-0">
                                    <?php
                                        $deps = App\deposits::where('user_id', $user->id)->orderby('id', 'desc')->paginate(10);
                                    ?>                                                   
                                                
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>  
                                                <th><?php echo e(__('Amount')); ?></th>        
                                                <th><?php echo e(__('Method')); ?></th>
                                                <th><?php echo e(__('Account')); ?></th>
                                                <th><?php echo e(__('Acc Name')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                                <th><?php echo e(__('Url')); ?></th>                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if(count($deps) > 0 ): ?>
                                                <?php $__currentLoopData = $deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr> 
                                                        <td><?php echo e($settings->currency); ?> <?php echo e($dep->amount); ?></td>     
                                                        <td><?php echo e($dep->bank); ?></td>
                                                        <td>
                                                           <?php echo e($dep->account_no); ?>

                                                        </td>
                                                        <td>
                                                           <?php echo e($dep->account_name); ?>

                                                        </td>
                                                        <td><?php echo e($dep->created_at); ?></td>
                                                        <td>
                                                            <?php if($dep->status == 0): ?>
                                                                Pending
                                                            <?php elseif($dep->status == 1): ?>
                                                                Approved
                                                            <?php elseif($dep->status == 2): ?>
                                                                Rejected
                                                            <?php endif; ?>
                                                        </td> 
                                                        <td>
                                                            <?php if($dep->bank == 'BTC'): ?>
                                                                <?php if($dep->account_name == 'Coin Base'): ?>
                                                                    <a href="<?php echo e(route('coinbase.confirm', ['id' => $dep->pop])); ?>" target="_blank" class="btn btn-info">Check</a>
                                                                <?php else: ?>
                                                                    <a href="<?php echo e(route('btc.confirm', ['id' => $dep->account_name])); ?>" target="_blank" class="btn btn-info">Check</a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>                                                                       
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>                                                            
                                                    <td colspan="6"><?php echo e(__('No data')); ?></td>                                        
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div>
                                        <?php echo e($deps->links()); ?>

                                    </div>           
                                    <br><br>  
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
           
           
            </div>
            
<?php $__env->stopSection(); ?>
             
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/everbeei/Fidelityventures.top/core/resources/views/user/load_wallet.blade.php ENDPATH**/ ?>