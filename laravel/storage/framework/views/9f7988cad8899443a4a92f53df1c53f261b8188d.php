<?php $__env->startSection('title',' Mobile App Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <h2>Staff Visit</h2>
            <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title">Staff Details</h3>
									<p class="panel-subtitle"></p>
								</div>
								<div class="panel-body">
                                    <ul class="list-unstyled list-justify">
										<li><strong>Name</strong> : <span class="text-muted"><?php echo e($user->data()['name']); ?></span></li>
										<li><strong>EPF</strong> : <span><?php echo e($user->data()['epf']); ?></span></li>
										<li><strong>Phone</strong> : <span><?php echo e($user->data()['phone']); ?></span></li>
                                        <li><strong>Reporting To</strong> : <span><?php echo e($user->data()['reportingTo']); ?></span></li>
                                        <li><strong>District</strong> : <span><?php echo e($user->data()['district']); ?></span></li>
									</ul>

								</div>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-headline">
								<div class="panel-heading">
									<h3 class="panel-title">Session Details</h3>
									<p class="panel-subtitle"></p>
								</div>
								<div class="panel-body">
                                    <ul class="list-unstyled list-justify">
										<li><strong>ID</strong> : <span class="text-muted"><?php echo e($session['id']); ?></span></li>
										<li><strong>Date</strong> : <span><?php echo e($session['date']); ?></span></li>
										<li><strong><strong>Client</strong></strong> : <span><?php echo e($session['client']); ?></span></li>
                                        <li><strong>Purpose To</strong> : <span><?php echo e($session['purpose']); ?></span></li>
                                        <hr>
                                        <li><strong>Session Start Time</strong> : <span><?php echo e($session['start_time']); ?></span></li>
                                        <li><strong>Session End Time</strong> : <span><?php echo e($session['end_time']); ?></span></li>
                                        <hr>
                                        <li><strong>Session Start Latitude</strong> : <span><?php echo e($session['start_lat']); ?></span></li>
                                        <li><strong>Session Start Longitude</strong> : <span><?php echo e($session['start_long']); ?></span></li>
                                        <li><strong>Session Start Address</strong> : <span class="text-right">
                                            <?php
                                               $myArray = explode(',', $session['start_address']);
                                            ?>
                                            <?php $__currentLoopData = $myArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($item); ?> <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span></li>

                                        <br>
                                        <div class="btn-group">
                                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo e($session['start_lat']); ?>,<?php echo e($session['start_long']); ?>">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-location-arrow"></i>
                                                    View Start Location
                                                </button>
                                            </a>
                                        </div>
                                        <hr>
                                        <li><strong>Session End Latitude</strong> : <span><?php echo e($session['end_lat']); ?></span></li>
                                        <li><strong>Session End Longitude</strong> : <span><?php echo e($session['end_long']); ?></span></li>
                                        <li><strong>Session End Address</strong> : <span class="text-right">
                                            <?php
                                               $myArray = explode(',', $session['end_address']);
                                            ?>
                                            <?php $__currentLoopData = $myArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($item); ?> <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span></li>
                                        <br>
                                        <div class="btn-group">
                                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo e($session['end_lat']); ?>,<?php echo e($session['end_long']); ?>">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="fa fa-location-arrow"></i>
                                                    View End Location
                                                </button>
                                            </a>
                                        </div>
                                        <br>
                                        <br>
                                        <a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin=<?php echo e($session['start_lat']); ?>,<?php echo e($session['start_long']); ?>&destination=<?php echo e($session['end_lat']); ?>,<?php echo e($session['end_long']); ?>">
                                            <button type="button" class="btn btn-success">
                                                    <i class="fa fa-map-signs"></i>
                                                     View Directions
                                            </button>
                                        </a>
                                        <strong> Approximate Length between two locations </strong>: <?php echo e($distance); ?>m
                                        <hr>
                                        <li><strong>Created At</strong> : <span><?php echo e(date('Y-m-d | H:i:s',strtotime($session['created_at']))); ?></span></li>
                                        <li><strong>Updated At</strong> : <span><?php if(isset($session['updated_at'])): ?>
                                            <?php echo e(date('Y-m-d | H:i:s',strtotime($session['updated_at']))); ?>

                                            <?php endif; ?></span></li>
									</ul>
								</div>
							</div>
                        </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
   function changeStatus(a,id) {
        var value = (a.value || a.options[a.selectedIndex].value);
        alert(value);  //crossbrowser solution =)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: BaseUrl+'/change/role',
            dataType: "json",
            data:{
                'role':value,
                'user':id
            },
            success: function(response) {
                location.reload();
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.firebase', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>