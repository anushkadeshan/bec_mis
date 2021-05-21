<?php $__env->startSection('content'); ?>
<div class="container-fluid">

</div>
<div class="container-fluid">
  <div class="row">
  
    <div class="col-md-12">
      <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Resource People<span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Proffession</th>
                        <th>Institute</th>
                        <th>CV</th>
                    </tr>
                </thead> 
                <tbody>
                <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($resource->name); ?></td>
                    <td><?php echo e($resource->profession); ?></td>
                    <td><?php echo e($resource->institute); ?></td>
                    <td><a href="<?php echo e(url('download/cv')); ?>/<?php echo e($resource->cv); ?>"><button type="button" class="btn btn-primary btn-flat btn-sm"><i class="fas fa-file-download"> &nbsp; Download</i></button></a></td>               
                    
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </tbody>
            </table>      
                </div>
            </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<style>
  
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>