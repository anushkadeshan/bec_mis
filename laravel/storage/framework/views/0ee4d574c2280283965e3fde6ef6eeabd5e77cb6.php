<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Stake Holders <small class="badge badge-success"><?php echo e($participants->count()); ?>  </small></h3>
		</div>
		<div class="card-body">
			<table id="example1" class="table row-border table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>DS</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Institute</th>
                        <th>Phone</th>
                    </tr>
                    <tbody>
                    <?php $no=1; ?>
                    <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($participant->name); ?></td>
                        <td><?php echo e($participant->DSD_Name); ?></td>
                        <td><?php echo e($participant->gender); ?></td>
                        <td><?php echo e($participant->designation); ?></td>
                        <td><?php echo e($participant->institute); ?></td>
                        <td><?php echo e($participant->phone); ?></td>
                    </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </thead>        
            </table>
</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>