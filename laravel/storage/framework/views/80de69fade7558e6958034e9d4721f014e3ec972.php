
<?php $__env->startSection('title',''.$course->name.' |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid" >
	<section class="content-header">
 
        <div class="row">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(Route('courses/view')); ?>">All Institues</a></li>
              <li class="breadcrumb-item active"><?php echo e($course->name); ?></li>
            </ol>
          </div>
        </div>
      
    </section>
    <div class="card" style="margin-top: 10px">
        <div class="card-header">
        	<div class="row">
        		
        		<div class="col-md-6">
        			<h2 class="card-title"><?php echo e($course->name); ?> | <small class="text-muted"><?php echo e($course_catogery->course_category); ?> </small></h2> 

        		</div>
        		<div class="col-md-6 text-right">
        		<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-course')): ?>	<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#addModel">Add institutes to course</button> <?php endif; ?>
        		</div>
        	</div>
        </div>
        <!-- /.card-header --> 
        <div class="card-body">  
           <div class="row">
           		<div class="col-md-3 text-dark-grey">
           			<div class="nav-item">
           				Course Name
           			</div>
           			<div class="nav-item">
           				Duration
           			</div>
           			<div class="nav-item">
           				Course Fee
           			</div>
           			<div class="nav-item">
           				Course Type
           			</div>
                	<div class="nav-item">
                  		Course Standards
                	</div>
           			<div class="nav-item">
           				Course Time
           			</div>
           			<div class="nav-item">
           				Mediums
           			</div>
           			<div class="nav-item">
           				Minimum Qualification
           			</div>
                <div class="nav-item">
                 is Softskill embeded to course ?
                </div>
                	
           		</div>
           		<div class="col-md-3 text-muted">
           			<div class="nav-item">
           				<?php echo e($course->name); ?>

           			</div>
           			<div class="nav-item">
           				<?php echo e($course->duration); ?>

           			</div>
           			<div class="nav-item">
           				<?php echo e($course->course_fee); ?>

           			</div>
           			<div class="nav-item">
                  		<?php echo e($course->course_type); ?>

                  
           			</div>
	                <div class="nav-item">
	                  <?php echo e($course->standard); ?>

	                </div>
           			<div class="nav-item">
                  		<?php echo e($course->course_time); ?>

           			</div>
	                <div class="nav-item">
	                	<?php
                        	$data = json_decode($course->medium);
                        		echo implode(', ', $data);
                        ?>
	                </div>
           			<div class="nav-item">
           				<?php echo e($course->min_qualification); ?>

           				
           			</div>
                <div class="nav-item">
                  <?php echo e($course->embeded_softs_skills); ?>

                  
                </div>	
           		</div>
           		<div class="col-md-2">
           			<div class="nav-item">
           				Institutes
           			</div>
           			
           		</div>
           		<div class="col-md-4 text-muted">
                <?php $__currentLoopData = $course->institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           			<a href="<?php echo e(URL::to('institute/'.$institue->id.'/view')); ?>">
                   <div class="nav-item">
                      <?php echo e($institue->name); ?>

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
	        <h5 class="modal-title" id="exampleModalLongTitle">Add institites which conducts this course</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
             <form action="" method="" id="institutes" accept-charset="utf-8">
				 <div class="form-group">
				 	<label for=""></label>
				 	<?php echo e(csrf_field()); ?>

				 	<select name="institute_id[]" id="institute_id" class="form-control" multiple size="18">
				 		<?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 		<option
				 		<?php $__currentLoopData = $course->institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 		<?php if($institue->id == $ins->id): ?> selected="selected" <?php endif; ?>
				 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 		value="<?php echo e($institue->id); ?>"><?php echo e($institue->name); ?></option>
				 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 	</select>
				<input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
				 </div>	
             </form>			
	      </div>
	      	
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="add-institutes" class="btn btn-primary">Save changes</button>
		      </div>
	    </div>
	 </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
	$(document).ready(function (){
		$(document).on('click','#add-institutes', function(){
			var form = $('#institutes');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/courses/add-institutes',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Institutes added to coures Successfully ! ', 'Congratulations', {timeOut: 5000});
			                $("#institutes")[0].reset();
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