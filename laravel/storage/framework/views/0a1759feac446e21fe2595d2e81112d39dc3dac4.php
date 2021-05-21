
<?php $__env->startSection('title','Courses |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-4">
        			<h3 class="card-title">Vocational and Professional Courses</h3> 
        		</div>
        		<div class="col-md-6">
        			
        		</div> 
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-course')): ?>
        		<div class="col-md-2">
        			<!-- Button trigger modal -->
		        	<div class="text-right">
					<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#addModel">Add New</button>
					</div>
        		</div>
                <?php endif; ?>
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Course Fee</th>
                        <th>Type</th>
                        <th>Standard</th>
                        <th>Full/Part Time</th>
                        <th>Medium</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-course')): ?>
                        <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="course<?php echo e($course->id); ?>">
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($course->name); ?></td>
                        <td><?php echo e($course->duration); ?></td>
                        <td align="right"><?php echo e(number_format($course->course_fee,2,".",",")); ?></td>
                        <td><?php echo e($course->course_type); ?></td>
                        <td><?php echo e($course->standard); ?></td>
                        <td><?php echo e($course->course_time); ?></td>
                        <td>
                        	<?php
                        		$data = json_decode($course->medium);
                        		echo implode(', ', $data);
                        	?>	
                        </td>
                        
                        <td>

                        	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-institute')): ?>
                        	<div class="btn-group">
                        		<?php echo e(csrf_field()); ?>

                                <a href="<?php echo e(URL::to('courses/' . $course->id . '/view')); ?>">
                                    <button type="button" id="view-course" data-id="<?php echo e($course->id); ?>" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a>
                            
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-institute')): ?>
                            
                                    <button type="submit" id="edit-course" data-id="<?php echo e($course->id); ?>" data-name="<?php echo e($course->name); ?>" data-duration="<?php echo e($course->duration); ?>" data-fee="<?php echo e($course->course_fee); ?>" data-type="<?php echo e($course->course_type); ?>" data-standard="<?php echo e($course->standard); ?>" data-time="<?php echo e($course->course_time); ?>" data-medium="<?php echo e($course->medium); ?>" data-min_qul="<?php echo e($course->min_qualification); ?>" data-c_cat="<?php echo e($course->course_catogery); ?>" data-embeded="<?php echo e($course->embeded_softs_skills); ?>" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                            <?php endif; ?>
                        	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-institute')): ?>
                            
                                <form id="userDelete" method="post" >
                                <?php echo e(csrf_field()); ?>

                                    <button type="button" id="delete-course" data-id="<?php echo e($course->id); ?>" class="btn btn-block btn-danger btn-flat btn-sm" ><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>        
            </table>      
            
        </div>

    </div>
</div>
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Course Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
              <!-- form start -->
              <form action="" id="course" method="post" accept-charset="utf-8">
              <?php echo e(csrf_field()); ?>  
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="name">Course Name</label>
             		 	<input type="text" name="name" id="name" class="form-control">
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
                    	<label>Duration</label>

                    	<div class="input-group">
                      		<input type="number" id="duraion" name="duration" class="form-control">
							<div class="input-group-append">
                        		<span class="input-group-text">Months</span>
                      		</div>
                   		 </div>

                  </div>
             	</div>
             </div>
             <div class="row">
             	
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="contact_person">Course Type</label>
 						<select name="course_type" id="course_type" class="form-control">
 							<option value="">Select Option</option>
 							<option value="Vocational Training">Vocational Training</option>
 							<option value="Proffessional Training">Proffessional Training</option>
 							<option value="Soft Skills">Soft Skills</option>
 						</select>
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label>Standard/ Level</label>             		 	
             		 	<input type="text" name="standard" id="standard" class="form-control">
             		 
             		</div>
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="course_fee">Course Fee</label>
             		 	<div class="input-group">
             		 		<div class="input-group-append">
                        		<span class="input-group-text">LKR</span>
                      		</div>
             		 	<input type="number" step="1000" name="course_fee" id="course_fee" class="form-control">
             		 	<div class="input-group-append">
                        		<span class="input-group-text">.00</span>
                      		</div>
             		 	</div>
             		 	
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="course_time">Full/ Part Time</label>
 						<select name="course_time" id="course_time" class="form-control">
 							<option value="">Select Option</option>
 							<option>Full Time</option>
 							<option>Part Time</option>
 							<option>Both</option>
 						</select>
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="medium">Medium</label>
             		 	<select class="form-control" name="medium[]" id="medium" multiple>
             		 		<option>Sinhala</option>
             		 		<option>English</option>
             		 		<option>Tamil</option>
             		 	</select>
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
		          		<label for="min_qualification">Minimum Qualification</label>
		          		<select name="min_qualification" id="min_qualification" class="form-control">
		          			<option value="">Select Option</option>
		          			<option>Ordinary Level</option>
		          			<option>Advanced Level</option>
		          			<option>Certificate</option>
		          			<option>Diploma</option>
		          			<option>Higher Diploma</option>
		          			<option>Degree</option>
		          			<option>Masters</option>
		          			<option>Doctorate</option>
		          			<option>Skilled Apprentice</option>
		          		</select>
		          	</div> 
             	</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_catogery">Course Category</label>
                        <select name="course_catogery" id="course_catogery" class="form-control">
                            <option value="">Select Option</option>
                             <?php $__currentLoopData = $course_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cc->id); ?>"><?php echo e($cc->course_category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="embeded_softs_skills" id="em_label">Is this course embedded with softskilles?</label>
                        <select name="embeded_softs_skills" id="embeded_softs_skills" class="form-control">
                            <option value="">Select Option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        
                        </select>
                    </div> 
                </div>
             </div>
             </form>
	      </div>
	      	
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="add-course" class="btn btn-primary">Save changes</button>
		      </div>
	    </div>
	 </div>
</div>


<div class="modal fade" id="update-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Course Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!-- form start -->
              <form action="" id="course1" method="post" accept-charset="utf-8">
              <?php echo e(csrf_field()); ?>  
             <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Course Name</label>
                        <input type="text" name="name" id="name1" class="form-control">
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Duration</label>

                        <div class="input-group">
                            <input type="number" id="duration1" name="duration" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">Months</span>
                            </div>
                         </div>

                  </div>
                </div>
             </div>
             <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_person">Course Type</label>
                        <select name="course_type" id="course_type1" class="form-control">
                            <option value="">Select Option</option>
                            <option value="Vocational Training">Vocational Training</option>
                            <option value="Proffessional Training">Proffessional Training</option>
                            <option value="Soft Skills">Soft Skills</option>
                        </select>
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="standard-label"></label>
                        <input type="text" id="standard_edit1" name="standard" class="form-control">
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_fee">Course Fee</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">LKR</span>
                            </div>
                        <input type="number" step="1000" name="course_fee" id="course_fee1" class="form-control">
                        <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_time">Full/ Part Time</label>
                        <select name="course_time" id="course_time1" class="form-control">
                            <option value="">Select Option</option>
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Both</option>
                        </select>
                     </div> 
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="medium">Medium</label>
                        <select class="form-control" name="medium[]" id="medium1" multiple>
                            <option>Sinhala</option>
                            <option>English</option>
                            <option>Tamil</option>
                        </select>
                     </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_catogery">Course Category</label>
                        <select name="course_catogery" id="course_catogery1" class="form-control">
                            <option value="">Select Option</option>
                             <?php $__currentLoopData = $course_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cc->id); ?>"><?php echo e($cc->course_category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="min_qualification">Minimum Qualification</label>
                        <select name="min_qualification" id="min_qualification1" class="form-control">
                            <option value="">Select Option</option>
                            <option>Ordinary Level</option>
                            <option>Advanced Level</option>
                            <option>Certificate</option>
                            <option>Diploma</option>
                            <option>Higher Diploma</option>
                            <option>Degree</option>
                            <option>Masters</option>
                            <option>Doctorate</option>
                            <option>Skilled Apprentice</option>
                        </select>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="embeded_softs_skills" id="em_label1">Is this course embedded with softskilles?</label>
                        <select name="embeded_softs_skills" id="embeded_softs_skills1" class="form-control">
                            <option value="">Select Option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        
                        </select>
                    </div> 
                </div>
            
                
             </div>
             <input type="hidden" id="id" name="id">
             </form>
          </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="update-course" class="btn btn-primary">Save changes</button>
              </div>
        </div>
     </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $('#addModel').on('hidden.bs.modal', function () {
        window.location.reload();
    });
	$(document).ready(function(){
        $(document).on('change' , '#course_type', function (){

	    	if(this.value=='Vocational Training'){
                $("#standard").prop("type", "number");    		  			
	    	}

	    	else{
                $("#standard").prop("type", "text");                      

	    			
	    	}
    	});

        $(document).on('change' , '#course_type1', function (){

            if(this.value=='Vocational Training'){
               $('#standard-label').text('NVQ Level');
               $("#standard_edit1").prop("type", "number");                      
            }

            else{
                $('#standard-label').text('Standard');

                $("#standard_edit1").prop("type", "text");                      

                    
            }
        });

        $(document).on('change' , '#course_type', function (){

            if(this.value=='Soft Skills'){
                $("#embeded_softs_skills").hide();
                $("#em_label").hide();

            }

            else{
                $("#embeded_softs_skills").show(); 
                $("#em_label").show();

                    
            }
        });

        $(document).on('change' , '#course_type1', function (){

            if(this.value=='Soft Skills'){
                $("#embeded_softs_skills1").hide();
                $("#em_label1").hide();
                                                                            
            }

            else{
                $("#embeded_softs_skills1").show(); 
                $("#em_label1").show();

                    
            }
        });
	});

	$(document).ready(function(){
		$(document).on('click', '#add-course', function(){
   				var form = $('#course');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/courses/add',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Course Successfully Added ! ', 'Congratulations', {timeOut: 5000});
			                $("#course")[0].reset();
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

	function printValidationErrors(msg){
        $.each(msg, function(key,value){
        	toastr.error('Validation Error !', ""+value+"");
        });
    }

    //delete institute
$(document).ready(function(){
    $(document).on('click' , '#delete-course' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/courses/delete',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Course Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.course' +id).remove();
            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'You Do not have permission to delete employer')
            },
        });
    });
});
//open edit form
$(document).on('click', '#edit-course', function(){
        var id = $(this).data('id');
        $('#id').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#duration1').val($(this).data('duration'));
        $('#course_type1').val($(this).data('type'));
        var course_type = $(this).data('type');

        if(course_type =='Vocational Training'){
           var myString = $(this).data('standard');
           var lastChar = myString[myString.length-1]
           $('#standard-label').text('NVQ Level');
           $('#standard_edit1').val(lastChar);

           $("#standard_edit1").prop("type", "number");


        }
        else{
           $('#standard-label').text('Standard');
           $("#standard_edit1").prop("type", "text");

            $('#standard_edit1').val($(this).data('standard'));
        }

        $('#course_time1').val($(this).data('time'));
        $('#course_fee1').val($(this).data('fee'));
        
        $('#medium1').val($(this).data('medium'));
        $('#embeded_softs_skills1').val($(this).data('embeded'));

        $('#min_qualification1').val($(this).data('min_qul'));
        $('#course_catogery1').val($(this).data('c_cat'));
        $('#update-model').modal('show');
        
    });
//update Course
$(document).ready(function(){
        $(document).ready(function(){
            $(document).on('click', '#update-course', function(){
                var form = $('#course1');

                $.ajax({
                    type: 'POST',
                    url: SITE_URL + '/courses/update',
                    data: form.serialize(),
                    success:function(data){
                        if($.isEmptyObject(data.error)){
                            toastr.success('Successfull Updated information ! ', 'Congratulations', {timeOut: 5000});
                            $("#course1")[0].reset();
                            $('#update-model').modal('hide');
                            window.location.reload();

                        }
                        else{
                            printValidationErrors(data.error);

                        }
                    },
                    error:function(data, jqXHR){
                        console.log(jqXHR);
                    }

                });
            });
        });


        function printValidationErrors(msg){
        $.each(msg, function(key,value){
            toastr.error('Validation Error !', ""+value+"");
        });
        }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>