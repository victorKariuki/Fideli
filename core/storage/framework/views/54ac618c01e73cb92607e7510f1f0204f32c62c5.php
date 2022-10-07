<?php $__env->startSection('content'); ?>


<style>
    body{
        background-color: black;
    }
    </style>
<br><br>

     <div class="card ">
                                <div class="card-header bg-gradient-info">
                                    <div class="card-title bg-gradient-info text-warning"><?php echo e(__('REFERRALS WHO HAVE INVESTED')); ?></div>
                                </div>
                                <div class="card-body bg-gradient-info pb-5">
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
                                                            <th><?php echo e(__('Earned')); ?></th>
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
                                                    
                                                </table>

                                            </div>
                                                       
                                                    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                   
                                                    
                                </div>
                            </div>
        <div class="main-panel bg-success ">
            <div class="card-header bg-gradient-info text-center"><b>ALL THE  REFERALS</b></div>
            <div class="card-body bg-gradient-info">
              
              
              <!------------------------------------------------------->
              
              
              
              
              
              
                        
<table id="" class=" table table-stripped table-hover">
    <thead>
        <tr>                
            <th> <?php echo e(__('firstName')); ?> </th>
            <th> <?php echo e(__('Username')); ?> </th>
            <th> <?php echo e(__('phone')); ?> </th>
            <th> <?php echo e(__('st')); ?> </th>   
        </tr>
    </thead>
    <tbody>

        <?php
            // $activities = App\User::where('referal', $user->username)->orderby('id', 'desc')->get();
              $activities = App\User::where('referal', $user->username)->where('status', 1)->orderby('id', 'desc')->get();
        ?>
        <?php if(count($activities) > 0 ): ?>
            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>                                                            
                    <td><?php echo e($activity->firstname); ?> <?php echo e($activity->lastname); ?></td>
                    <td><?php echo e($activity->username); ?></td>
                  <td><?php echo e($activity->phone); ?></td>                                                                            
                    <td><?php echo e($activity->status); ?></td>                     
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            
        <?php endif; ?>
    </tbody>
</table>

              
   
  
            </div>
</div>
           

<?php $__env->stopSection(); ?>
            
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/everbeei/Fidelityventures.top/core/resources/views/user/downlines.blade.php ENDPATH**/ ?>