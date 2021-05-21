
<?php $__env->startSection('title','New Vacancy |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <section class="content">
    	<form action="" method="post" id="vacancy">
    	<div class="row">
    		<div class="col-md-6">

	    		<div class="card card-primary">
	    			<div class="card-header">
	            		<h3 class="card-title">Vacancy Details</h3>
	          		</div>
	          		<div class="card-body">
	          			
	          				<div class="form-group">
                    			<label for="title">Job Title</label>
                    			<input type="text" class="form-control" name="title" id="title" placeholder="Enter Job Title">
                  			</div>
                  			<div class="form-group">
                  				<label for="description">Job Description</label>
                  				<textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Job Description"></textarea>
                  			</div>
                  			<div class="row">
                  				<div class="col-md-6">
			      					<div class="form-group">
		                    			<label for="job_type">Job Type</label>
		                    			<select id="job_type" name="job_type" class="form-control">
		                    				<option value="">Select Option</option>
		                    				<option>Full Time</option>
		                    				<option>Part Time</option>
		                    				<option>Contractual</option>
		                    				<option>Internship</option>
		                    				<option>Temporary</option>
		                    				<option>Work from Home</option>                    				
		                    			</select>
		                  			</div>
	                  			</div>
	                  			<div class="col-md-6">
	                  				<div class="form-group"	>
	                  					<label for="business_function">Business Function</label>
	                  					<select class="form-control" name="business_function">
	                  						<option value="">Select Option</option>
	                  						<option>Administration</option>
	                  						<option>Accounting &amp; Finance</option>
	                  						<option>Customer Support</option>
	                  						<option>Data Entry &amp; Analysis</option>
	                  						<option>Creative, Design &amp; Architecture</option>
	                  						<option>Education &amp; Training</option>
	                  						<option>Hospitality</option>
	                  						<option>Human Resources</option>
	                  						<option>IT &amp; Telecom</option>
	                  						<option>Legal</option>
	                  						<option>Logistics</option>
	                  						<option>Management</option>
	                  						<option>Manufacturing</option>
	                  						<option>Marketing &amp; PR</option>
	                  						<option>Operations</option>
	                  						<option>Quality Assurance</option>
	                  						<option>Research &amp; Technical</option>
	                  						<option>Sales &amp; Distribution</option>
	                  						<option>Security</option>
	                  						<option>Others</option>
	                  					</select>
	                  				</div>
	                  			</div>
                  			</div>
                  			<div class="row">
                  				<div class="col-md-6">
                  					<div class="form-group">
                  						<label for="location">Location</label>
                  						<div id="locationList"></div>	
                  						<input class="form-control" type="text" id="location" name="location" placeholder="Enter Location">
                  						
                  						<?php echo e(csrf_field()); ?>

                  				   	</div>
                  				</div>
                  				<div class="col-md-6">
                  					<div class="form-group"	>
			                  			<label for="salary">Salary</label>
			                  			<input class="form-control" step="any" type="number" id="salary" name="salary" placeholder="Optional">
			                  		</div>
                  				</div>
                  			</div>
                  			<div class="row">
                  				<div class="col-md-6">
                  					<div class="form-group">
                  						<label for="location">Total Vacancies</label>
                  						<div id="total_vacancies"></div>	
                  						<input class="form-control" step="1" type="number" id="total_vacancies" name="total_vacancies" placeholder="Optional">
                  						
                  				   	</div>
                  				</div>
                  				<div class="col-md-6">
                  					<div class="form-group">
                  						<label>Closing Date</label>

                  						<div class="input-group">
                    						<div class="input-group-prepend">
                      							<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    						</div>
                    						<input type="date" id="dedline" name="dedline" class="form-control" >
                  						</div>
                  
                					</div>
					            </div>
                  					
                  				</div>
                  				
                  			</div>
	          			
	          		</div>
	    		</div>
    		
    		<div class="col-md-6">
    			<div class="card card-success">
	    			<div class="card-header">
	            		<h3 class="card-title">Candidate Profile</h3>
	          		</div>
	          		<div class="card-body">
		          		<div class="row">
		          			<div class="col-md-6">
		          				<div class="form-group">
		          				<label for="min_qualification">Minimum qualification</label>
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
			          				<label for="specializaion">Educational Specialization</label>
			          				<select name="specializaion" id="specializaion" class="form-control">
			          					<option value="">Select Option</option>
			          					<option>Art &amp; Humanities</option>
			          					<option>Business &amp; Management</option>
			          					<option>Accounting</option>
			          					<option>Design &amp; Fashion</option>
			          					<option>Engineering</option>
			          					<option>Events &amp; Hospitality</option>
			          					<option>Finance &amp; Commerce</option>
			          					<option>Human Resources</option>
			          					<option>Information Technology</option>
			          					<option>Law</option>
			          					<option>Marketing &amp; Sales</option>
			          					<option>Media &amp; Journalism</option>
			          					<option>Medicine</option>
			          					<option>Sciences</option>
			          					<option>Vocational &amp; Technical</option>
			          					<option>Others</option>
			          				</select>
		          				</div>	
		          			</div>
		          		</div>
		          		<div class="form-group">
			          		<label for="skills">Required Skills</label>
			          		<textarea name="skills" id="skills" placeholder="Optional" class="form-control"></textarea>		
		          		</div>
		          		<div class="form-group">
			          		<label for="gender">Gender Preferance</label>
			          		<select name="gender" id="gender" class="form-control">
			          			<option value="">Select Option</option>
			          			<option>Male</option>
			          			<option>Female</option>
			          			<option>Any</option>		
			          		</select>
		          		</div>
		          		<?php 
		          		$user = auth()->user();
		          		$roleName= 'Employer' 
		          		?>
		          		<?php if(!$user->is($roleName)): ?>
		          		<div class="form-group">
			          		<label for="gender">Employer</label>
			          		<select name="employer_id" id="employer_id" class="form-control">
			          			<option value="">Select Option</option>
			          			<?php $__currentLoopData = $employers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			          			<option value="<?php echo e($employer->id); ?>"><?php echo e($employer->name); ?></option>
			          			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			          		</select>
		          		</div>
		          		<?php endif; ?>	
		          		<div class="form-group">
		          			<input type="button" id="add-vacancy" class="btn btn-primary btn-flat" value="Submit">
		          		</div>
	          		</div>
	          	</div>		
    		</div>		
    	</div>
    	</form>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
   <script>
   	//get location data to field
   		$(document).ready(function(){

			 $('#location').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/locationList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#locationList').fadeIn();  
			           $('#locationList').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', 'li', function(){  
			    	$('#locationList').fadeOut(); 
			        $('#location').val($(this).text());  
			         
			    });  
		});

   		// add vacancy to database
   		$(document).ready(function(){
   			$(document).on('click', '#add-vacancy', function(){
          

   				var form = $('#vacancy');
   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/add-vacancy',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Profile Successfully updated ! ', 'Congratulations', {timeOut: 5000});
			                //$("#vacancy")[0].reset();
            			}
			            else{
			                printValidationErrors(data.error);

			            }
            		},
            		error:function(data){
            			
            		}

   				});
   			});
   		});


   		function printValidationErrors(msg){
        $.each(msg, function(key,value){
        	toastr.error('Validation Error !', ""+value+"");
        });
    }


</script>
<style type="text/css" media="screen">
	#autocomplete {
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
#autocomplete > li {
  padding: 3px 20px;
}
#autocomplete > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>