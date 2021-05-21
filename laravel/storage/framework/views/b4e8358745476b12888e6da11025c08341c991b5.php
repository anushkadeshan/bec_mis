<?php $__env->startComponent('mail::message'); ?>

# Monthly Progress Report for <?php echo e($data['month']); ?> - <?php echo e($data['year']); ?>


<?php $__env->startComponent('mail::panel'); ?>
<h4 style="color:black">Career Guidance</h4>
<?php echo $__env->renderComponent(); ?>
<?php $__env->startComponent('mail::table'); ?>
|Branch | CG Youths |
|:-------------|:--------|
|<?php $__currentLoopData = $data['cg']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php echo e($d->branch_name); ?> | <?php echo e($d->count); ?>             
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php echo $__env->renderComponent(); ?>

<hr>
<?php $__env->startComponent('mail::panel'); ?>
<h4 style="color:black">Soft Skills</h4>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::table'); ?>
|Branch | Soft Skills Youths |
|:-------------|:--------|
<?php $__currentLoopData = $data['soft']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php echo e($d->branch_name); ?> | <?php echo e($d->count); ?>             
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php echo $__env->renderComponent(); ?>

<hr>
<?php $__env->startComponent('mail::panel'); ?>
<h4 style="color:black">Financial Assistance</h4>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::table'); ?>
|Branch | Finacial Assisted Youths |
|:-------------|:--------|
<?php $__currentLoopData = $data['vt']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php echo e($d->branch_name); ?> | <?php echo e($d->count); ?>             
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php echo $__env->renderComponent(); ?>

<hr>
<?php $__env->startComponent('mail::panel'); ?>
<h4 style="color:black">Government Course Supports</h4>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::table'); ?>
|Branch | Supported Youths |
|:-------------|:--------|
<?php $__currentLoopData = $data['vt']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php echo e($d->branch_name); ?> | <?php echo e($d->count); ?>             
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php echo $__env->renderComponent(); ?>

<hr>
<?php $__env->startComponent('mail::panel'); ?>
<h4 style="color:black">Job Placement</h4>
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::table'); ?>
|Branch | Placed Youths |
|:-------------|:--------|
<?php $__currentLoopData = $data['placement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php echo e($d->branch_name); ?> | <?php echo e($d->count); ?>             
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php echo $__env->renderComponent(); ?>
<br>
Thanks,<br>
BEC Automation Reports System

<?php echo $__env->renderComponent(); ?>

