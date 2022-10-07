


<?php $__env->startSection('content'); ?>

	<!-- Row -->
	<?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
						<div class="row">
						
							<div class="col-md-12">
								<form  method="post" class="card" action="/offer/update/post/<?php echo e($offer->code); ?>">
									<div class="card-header">
										<div>
											<h3 class="card-title">Update offer <?php echo e($offer->code); ?></h3>
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
									<div class="card-body ">
										<div class="form-group ">
											<label class="form-label">Offer type</label>
											<select class="form-control select2 custom-select" name="offertype">
										
												<option value="1">Buy Smartpap</option>
												<option value="2">Sell Smartpap</option>
												
											</select>
										</div>
										<div class="form-group">
											<label class="form-label">Rate as a %</label>
											<input type="text" class="form-control select2" name="rate" value="<?php echo e($offer->rate); ?>" data-placeholder="%" required>
										
										</div>
										
										<div class="form-group">
											<label class="form-label">Minimum</label>
											<input type="text" class="form-control select2" name="min" value="<?php echo e($offer->min); ?>" data-placeholder="1096" required>
										
										</div>
										
										<div class="form-group">
											<label class="form-label">Maximum</label>
											<input type="text" class="form-control select2" name="max" value="<?php echo e($offer->max); ?>"  data-placeholder="Type a maximum amount ..." required>
										
										</div>
										
										<div class="form-group">
											<label class="form-label">Payment method</label>
											
										<select class="form-control select2" name="payment">
										    <option value="MPESA">MPESA</option>
										</select>
										</div>
										<button class="btn btn-info" type="submit">Submit</button>
									</div>
								</form>
							</div>
						
						</div>
						<!-- End Row-->
						
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
						<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/truthful/smartpaptraders.com/core/resources/views/user/update.blade.php ENDPATH**/ ?>