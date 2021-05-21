 
<?php $__env->startSection('title','CG Youth List |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Youth Information who completed Career Guidance <small class="badge badge-success"> <?php echo e(count($youths)); ?></small></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>CG-Program Date</th>
                        <th>CF 1</th>
                        <th>CF 2</th>
                        <th>CF 3</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1 ?>
                    <?php $__currentLoopData = $youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($youth->youth_name); ?></td>
                        <td><?php echo e($youth->program_date); ?></td>
                        <td><?php echo e($youth->career_field1); ?></td>
                        <td><?php echo e($youth->career_field2); ?></td>
                        <td><?php echo e($youth->career_field3); ?></td>
                        <td><?php echo e($youth->ext); ?></td>
                        <td><a href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/view')); ?>" target="_blank">
                                    <button type="button" id="view-youth" data-id="<?php echo e($youth->youth_id); ?>" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                        </a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>        
            </table>      
            
        </div>
    </div>      
 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>