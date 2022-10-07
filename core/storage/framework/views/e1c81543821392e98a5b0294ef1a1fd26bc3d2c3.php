<?php $__env->startSection('content'); ?>
        <div class="main-panel">
            <div class="content">
              
              
                <div class="page-inner mt--5">
                    
                    <div id="prnt"></div>
                    <!--<div class="row">-->
                    <!--    <div class="col-md-12">-->
                    <!--        <div class="card">-->
                    <!--            <div class="card-header">-->
                    <!--                <div class="card-head-row">-->
                    <!--                    <div class="card-title">                                            -->
                                          
                    <!--                        <a href="/register/<?php echo e($user->username); ?>" class="text-danger" id="reflnk" >-->
                    <!--                             <?php echo e(__('Referral link:')); ?>:: <small><?php echo e(env('APP_URL').__('/register/').$user->username); ?></small>-->
                    <!--                        </a>                                            -->
                    <!--                    </div>                                       -->
                    <!--                </div>-->
                    <!--            </div>                                -->
                    <!--        </div>-->
                    <!--    </div>-->
                        
                    <!--</div>-->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"><?php echo e(__('My Downlines')); ?></div>
                                </div>
                                <div class="card-body pb-5">
                                    <?php
                                        $ref_levels = App\ref_set::all();
                                        $rsum = 0;
                                    ?>                    
                                        <?php $__currentLoopData = $ref_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $activities = App\ref::where('username', $user->username)->where('level', $ref_level->id)->orderby('id', 'asc')->get();
                                                // $rsum += $activities
                                            ?>
                                            
                                            <div class="table-responsive mt-5">                                        
                                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                                    <thead>
                                                        <tr>
                                                            <!-- <th data-field="state" data-checkbox="true"></th> -->
                                                            <th><?php echo e(__('Name')); ?></th>
                                                            <th><?php echo e(__('Username')); ?></th>
                                                            <th><?php echo e(__('Level')); ?></th>
                                                            <th><?php echo e(__('Amount Earned')); ?></th>
                                                            <th><?php echo e(__('Investment')); ?></th>
                                                            <th><?php echo e(__('Date Registered')); ?></th>   
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <?php if(count($activities) > 0 ): ?>
                                                            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php  
                                                                    $ref_d = App\User::find($activity->user_id);                
                                                                ?>
                                                                <tr>                                                            
                                                                    <td>
                                                                        <?php echo e($ref_d->firstname); ?> <?php echo e($ref_d->lastname); ?>

                                                                    </td>
                                                                    <td><?php echo e($ref_d->username); ?></td>
                                                                    <td><?php echo e($activity->level); ?></td>
                                                                    <td><?php echo e(env('CURRENCY').' '.$activity->amount); ?></td>
                                                                    <td>
                                                                        <?php  
                                                                            $ref_inv = App\investment::where('user_id', $activity->user_id)->get();
                                                                            echo count($ref_inv);
                                                                        ?>
                                                                    </td>                                                            
                                                                    <td><?php echo e(substr($ref_d->created_at,0,10)); ?></td>                     
                                                                </tr>
                                                                <?php ($rsum += $activity->amount); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <tr>                                                    
                                                                <td colspan="4">No data</td>                     
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <!-- <th data-field="state" data-checkbox="true"></th> -->
                                                            <th><?php echo e(__('Name')); ?></th>
                                                            <th><?php echo e(__('Username')); ?></th>
                                                            <th><?php echo e(__('Amount Earned')); ?></th>
                                                            <th><?php echo e(__('Investment')); ?></th>
                                                            <th><?php echo e(__('Date Registered')); ?></th>   
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <br><br>
                                            </div>
                                                       
                                                    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                   
                                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

           

<?php $__env->stopSection(); ?>
            
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/truthful/smartpaptraders.com/core/resources/views/user/downlines.blade.php ENDPATH**/ ?>