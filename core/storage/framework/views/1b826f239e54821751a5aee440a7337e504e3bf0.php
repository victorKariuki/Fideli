<?php $__env->startSection('content'); ?>
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
                    <?php if(Session::has('err_send')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(Session::get('err_send')); ?>

                        </div>
                        <?php echo e(Session::forget('err_send')); ?>

                    <?php endif; ?>
                    <div class="">                        
                        <form action="/user/send/funds" method="post" enctype="multipart/form-data">
                          <div class="form-group" align="left">                       
                              <input type="hidden" class="regTxtBox" name="_token" value="<?php echo e(csrf_token()); ?>">
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
                              <span class=" input-group-text "><?php echo e($settings->currency); ?></span>
                            </div>                                                     
                            <input type="text" class="form-control" name="s_amt"  required placeholder="Enter amount you want to send" >
                          </div>
                                        
                          <div class="form-group" align="">
                            <br><br>
                              <button type="submit" class="btn btn_blue"><?php echo e(__('Send')); ?></button>
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
                    <?php echo $__env->make('user.inc.transfer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
            </div>
            
          </div> 

                
          
        </div>
      </div>

       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/truthful/smartpaptraders.com/core/resources/views/user/send_money.blade.php ENDPATH**/ ?>