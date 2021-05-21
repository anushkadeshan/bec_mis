
<?php $__env->startSection('title',''.$institute->name.' |'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid" >
	<section class="content-header">
 
        <div class="row">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(Route('institutes/view')); ?>">All Institues</a></li>
              <li class="breadcrumb-item active"><?php echo e($institute->name); ?></li>
            </ol>
          </div>
        </div>
      
    </section>
    <div class="card" style="margin-top: 10px">
        <div class="card-header">
        	<div class="row">
        		
        		<div class="col-md-6">
        			<h2 class="card-title"><?php echo e($institute->name); ?> - <?php echo e($institute->location); ?></h2> 

        		</div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-institute')): ?>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#addModel">Add Courses Provided</button>
            </div>
            <?php endif; ?>
        	</div>
        </div>
        <!-- /.card-header --> 
        <div class="card-body">  
           <div class="row">
           		<div class="col-md-2 text-dark-grey">
           			<div class="nav-item">
           				Institute Name
           			</div>
           			<div class="nav-item">
           				Location
           			</div>
           			<div class="nav-item">
           				Address
           			</div>
           			<div class="nav-item">
           				Email
           			</div>
                <div class="nav-item">
                  Phone
                </div>
           			<div class="nav-item">
           				Contact Person
           			</div>
           			<div class="nav-item">
           				is Registered in TVEC ?
           			</div>
                <div class="nav-item">
                  <?php if($institute->reg_no): ?>
                  TVEC Reg. No
                  <?php endif; ?>
                </div>	
           		</div>
           		<div class="col-md-5 text-muted">
           			<div class="nav-item">
           				<?php echo e($institute->name); ?>

           			</div>
           			<div class="nav-item">
           				<?php echo e($institute->location); ?>

           			</div>
           			<div class="nav-item">
           				<?php echo e($institute->address); ?>

           			</div>
           			<div class="nav-item">
                  <?php if($institute->email): ?><?php echo e($institute->email); ?>

                  <?php else: ?>
                  <?php echo e("not mentioned"); ?>

                  <?php endif; ?>
           			</div>
                <div class="nav-item">
                  <?php echo e($institute->phone); ?>

                </div>
           			<div class="nav-item">
                  <?php if($institute->contact_person): ?><?php echo e($institute->contact_person); ?>

                  <?php else: ?>
                  <?php echo e("not mentioned"); ?>

                  <?php endif; ?>
           			</div>
                <div class="nav-item">
                  <?php echo e($institute->is_registerd); ?>

                </div>
           			<div class="nav-item">
           				<?php if($institute->reg_no): ?><?php echo e($institute->reg_no); ?>

           				<?php else: ?>
           			
           				<?php endif; ?>
           				
           			</div>	
           		</div>
           		<div class="col-md-1">
           			<div class="nav-item">
           				Courses
           			</div>
           			
           		</div>
           		<div class="col-md-4 text-muted">
                <?php $__currentLoopData = $institute->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           			<a href="<?php echo e(URL::to('courses/'.$course->id.'/view')); ?>">
                   <div class="nav-item">
                      <?php echo e($course->name); ?>

                    </div>
                </a>
           			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           		</div>	
           </div>	      		
            
        </div>
       
</div>
</div>
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Courses which institute provided</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <form action="" method="" id="courses" accept-charset="utf-8">
         <div class="form-group">
          <label for=""></label>
          <?php echo e(csrf_field()); ?>

          <select name="course_id[]" id="institute_id" class="form-control" multiple size="18">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option
            <?php $__currentLoopData = $institute->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($course->id == $cou->id): ?> selected="selected" <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        <input type="hidden" name="institute_id" value="<?php echo e($institute->id); ?>">
         </div> 
             </form>      
        </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="add-courses" class="btn btn-primary">Save changes</button>
          </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
  $(document).ready(function (){
    $(document).on('click','#add-courses', function(){
      var form = $('#courses');

          $.ajax({
            type: 'POST',
                url: SITE_URL + '/institutes/add-courses',
                data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Courses added to institute Successfull! ', 'Congratulations', {timeOut: 5000});
                      $("#courses")[0].reset();
                      window.location.reload();                     
                  }
                  else{
                      printValidationErrors(data.error);

                  }
                },
                error:function(data,jqXHR){
                  console.log(jqXHR);
                  
                }

          });
    });


  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>