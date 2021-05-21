
<?php $__env->startSection('title','Institutes Review |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Review of institutions</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Courses</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="course_support" id="institute-review" method="post" enctype="multipart/form-data">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<div class="row">
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="">Select Option</option>
								<?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($district->name_en); ?>"><?php echo e($district->name_en); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dsd">2. DSD </label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value="">Select Option</option>
								
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dm_name">3. District Manager</label>
						    <select name="dm_name" id="dm_name" class="form-control">
								<option value="">Select Option</option>
								<?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($manager->manager); ?>"><?php echo e($manager->manager); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    					   </select>
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-8">
	            
	            		<div class="form-group">
						    <label for="dm_name">4. Title of the Action</label>
						    <select name="title_of_action" id="title_of_action" class="form-control">
								<option value="">Select Option</option>
								<?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($activity->activity=="Review existing training modules of accredited VT/professional institutes locally available"): ?> selected <?php endif; ?> value="<?php echo e($activity->activity); ?>"><?php echo e($activity->activity); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">5. Activity code as per the Logframe</label>
						    <select name="activity_code" id="activity_code" class="form-control">
								<option value="">Select Option</option>
								<?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($activity->code=="3.3.1"): ?> selected <?php endif; ?> value="<?php echo e($activity->code); ?>"><?php echo e($activity->code); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    					   </select>
						</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">6. Date of Review</label>
						    <input type="date" name="program_date" id="review_date" class="form-control">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Institutes Details
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">7. Institute </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search Institute name and select" type="text" id="ins_name" name="res_id" class="form-control" placeholder="Search Name of Institute">
		                        <div style="cursor: pointer" onclick="window.open('<?php echo e(Route('institutes/view')); ?>', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add an institute to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="is_list"></div>
                          <input type="hidden" id="institute_id" name="institute_id" value="">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">8.Head of Institute </label>
						    <input type="text" id="head_of_institute" name="head_of_institute" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">9. Contact No</label>
						    <input type="number" id="contact" name="contact" class="form-control">
						</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">10. Date of commencement </label>
						    <input type="date" id="commencement_date" name="commencement_date" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-5">
	            		<div class="form-group">
						    <label for="institutional_review">11. if TVEC regiestered, Expiry date of registration</label>
						    <input type="date" id="tvec_ex_date" name="tvec_ex_date" class="form-control">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Others
	                  </span>
                </div>
                <br>
                <div class="row">
	            	
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="start_date">12. Is the OJT compulsory for all the courses you offer ?</label>
						    <select name="ojt_compulsory" id="ojt_compulsory" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
    					   </select>

						</div>
	            	</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">13. If not, what are the courses that OJT is not compulsory ?</label>  
						    <textarea name="courses_not_compulsory" id="courses_not_compulsory" class="form-control"></textarea>
						</div>
	            	</div>
	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">15. Is there follow up services on passed out trainees? </label>  
						    <select name="followup" id="followup" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="start_date">16. If yes, what are such services offered ?</label>
						    <select name="services_offered[]" id="services_offered" class="form-control" multiple>
								<option value="Tracer Study survey">Tracer Study survey</option>
								<option value="Job placement">Job placement</option>
								<option value="Assisting for self-employment">Assisting for self-employment</option>
								<option value="Other">Other</option>
    					   </select>

						</div>
	            	</div>

	            	
	            </div>	
            	<div class="row">
            		<div class="col-md-4">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">17.Do you provide any trainee allowance? </label>  
						    <select name="trainee_allowance" id="trainee_allowance" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
    					   </select>
						</div>
            		</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">18. If yes, amount (per month) ?</label>  
						    <input type="number" id="amount" name="amount" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-5">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">19. Source/s of funding for trainee allowance? </label>  
					    <input type="text" id="source" name="source" class="form-control">
						</div>
            		</div>
            	</div>
	            <div class="row">
            		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">20.	Soft skill development components included in the curriculums? </label>  
						    <select name="soft_skill" id="soft_skill" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								<option value="Need improvements">Need improvements</option>
    					   </select>
						</div>
            		</div>
            		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">21. Does the institute agree to incorporate/update soft skill components at their own expenses? </label>  
						    <select name="agreement_soft_skill" id="agreement_soft_skill" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								<option value="Not decided">Not decided</option>
    					   </select>
						</div>
            		</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="gaps">22. What are the existing gaps to incorporate soft skill components</label>  
						    <textarea name="gaps" id="gaps" class="form-control"></textarea>
						</div>
	            	</div>

            	</div>			
	           <button type="button" class="btn btn-primary btn-flat" id="gvt">Add Current Courses</button>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	<div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
	          		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">Search Course and copy ID </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search course name and select" type="text" id="course_name" name="res_id" class="form-control" placeholder="Search Name of Course">
		                        <div style="cursor: pointer" onclick="window.open('<?php echo e(Route('courses/view')); ?>', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="course_list"></div>
						</div>
	            	</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dm_name">Course ID</label>

	          				<div class="input-group"> 
                          		<input type="text" id="course_id" class="form-control" value="" >
                          		<div data-clipboard-target="#course_id" id="copy" style="cursor: pointer" class="input-group-prepend copy">
                          			<span data-toggle="tooltip" data-placement="top" title="copy to clipboard" class="input-group-text"><i class="fas fa-copy"></i></span>
                          		</div>
                      		</div>
                        </div>

	          		</div>
	          	</div>
	          	<div class="form-group">
  
	          			<table class="table table-borderless" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col" width="150px">Course ID</th>
						      <th scope="col">Period of Intake</th>
						      <th scope="col">Intake per Batch</th>
						      <th scope="col"># Students Currently following</th>
						      <th scope="col"># Students passed out</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th><input type="number" name="course_id[]" class="form-control"></th>
						      <td><input type="string" name="period_intake[]" class="form-control position-list"></td>
						      <td><input type="number" name="intake_per_batch[]" class="form-control position-list"></td>
						      <td><input type="number" name="current_following[]" class="form-control position-list"></td>
						      <td><input type="number" name="passed_out[]" class="form-control position-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add"><i class="fas fa-plus"></i></button></td>
						    </tr>
						    
						  </tbody>
						</table>
						
	          	</div>
	          	<?php echo e(csrf_field()); ?>

				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
	            
	          </div>
	        </div>
	        </form>
	        <!-- /.tab-content -->
	      </div><!-- /.card-body -->
	    </div>
	    <!-- ./card -->
	  </div>
	  <!-- /.col -->
	</div>
	
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
	$(document).ready(function(){
   	  $(document).on('change','#district',function(e){
   	  		
   	  		var district = e.target.value;
   	  		$.get('/ds-division?district=' +district, function(data){
   	  			//success
   	  			console.log(data);
   	  			$('#dsd').empty();

   	  			$.each(data, function(index, dsObj){
   	  				$('#dsd').append('<option value="'+dsObj.DSD_Name+'">'+dsObj.DSD_Name+'</option>');

   	  			});
   	  		});
   	  });

   	  $(document).on('click','#gvt', function(){
   	  	$('#tabs a[href="#tab_2"]').tab('show');
   	  });
   	  $(document).on('click','#res', function(){
   	  	$('#tabs a[href="#tab_3"]').tab('show');
   	  });
   	});

$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" name="course_id[]" class="form-control name_list" /></td><td><input type="string" name="period_intake[]" class="form-control position-list"></td><td><input type="number" name="intake_per_batch[]" class="form-control position-list"></td><td><input type="number" name="current_following[]" class="form-control position-list"></td><td><input type="number" name="passed_out[]" class="form-control position-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove"><i class="fas fa-times"></i></button></td></tr>');  
           $('#youth').val("");
           $('#youth_id').val("");
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });
$(document).ready(function(){
     $("#institute-review").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/add-institute-review',   
            data: new FormData(this),
   			contentType: false,
         	cache: false,
  			processData:false,

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully Added Institute Review Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#institute-review")[0].reset();

            }
            else{
             printValidationErrors(data.error);
              
            }         
        },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'Something Error')
            },
        });
    });
  });
 
 function printValidationErrors(msg){
        $.each(msg, function(key,value){
        	toastr.error('Validation Error !', ""+value+"");
        });
    }
 $(document).ready(function(){
//search resourse Person
       $('#ins_name').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/institutesList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#is_list').fadeIn();  
                 $('#is_list').html(data);
                }
               });
              }
          });

          $(document).on('click', '#institute li', function(){  
            $('#is_list').fadeOut(); 
              $('#ins_name').val($(this).text()); 
              $('#institutional_review').focus(); 

              var ins_id = $(this).attr('id');
              $('#institute_id').val(ins_id);
               
          });  
});

  $(document).ready(function(){
//search resourse Person
       $('#course_name').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/support-courseList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#course_list').fadeIn();  
                 $('#course_list').html(data);
                }
               });
              }
          });

          $(document).on('click', '#course li', function(){  
            $('#course_list').fadeOut(); 
              $('#course_name').val($(this).text()); 
              $('#start_date').focus(); 

              var ins_id = $(this).attr('id');
              $('#course_id').val(ins_id);
               
          });  
});

  $(document).ready(function(){
//search resourse Person
       $('#youth').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/youthList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#youth_list').fadeIn();  
                 $('#youth_list').html(data);
                }
               });
              }
          });

          $(document).on('click', '#youths li', function(){  
            $('#youth_list').fadeOut(); 
              $('#youth').val($(this).text()); 
              $('#youth_id').focus(); 
              var ins_id = $(this).attr('id');
              $('#youth_id').val(ins_id);
               
          });  
});
  <?php if(session('error')): ?>
  toastr.error('<?php echo e(session('error')); ?>')
  <?php endif; ?>  

	new ClipboardJS('.copy');
</script>

<script src="<?php echo e(asset('js/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<script>
  $(function () {
    // bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5({
      toolbar: { fa: true },
      size: 'default'
    })
  })
</script>
<style type="text/css" media="screen">
  #autocomplete, #institute, #course, #youths {
    position: absolute;
    z-index: 1000;
    cursor: default;
    padding: 0;
    margin-top: 2px;
    list-style: none;
    background-color: #ffffff;
    border: 1px solid #ccc;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
#autocomplete,  #institute, #course, #youths> li {
  padding: 3px 20px;
}
#autocomplete, #institute, #course, #youths > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>