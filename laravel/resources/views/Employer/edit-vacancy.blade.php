@extends('layouts.main')
@section('content')
<div class="container">
    <section class="content">
    	<form action="{{ URL::to('vacancy/update') }}" method="post" id="vacancy">
    	<div class="row">
    		<div class="col-md-6">

	    		<div class="card card-primary">
	    			<div class="card-header">
	            		<h3 class="card-title">Vacancy Details</h3>
	          		</div>
	          		<div class="card-body">
	          			
	          				<div class="form-group">
                    			<label for="title">Job Title</label>
                    			<input type="text" class="form-control" value="{{ $vacancy->title }}" name="title" id="title" placeholder="Enter Job Title">
                  			</div>
                  			<div class="form-group">
                  				<label for="description">Job Description</label>
                  				<textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Job Description">{{ $vacancy->description }}</textarea>
                  			</div>
                  			<div class="row">
                  				<div class="col-md-6">
			      					<div class="form-group">
		                    			<label for="job_type">Job Type</label>
		                    			<select id="job_type" selected="{{ $vacancy->job_type }}"  name="job_type" class="form-control">
		                    				<option value="">Select Option</option>
		                    				<option @if($vacancy->job_type=="Full Time") selected="selected @endif">Full Time</option>
		                    				<option @if($vacancy->job_type=="Part Time") selected="selected @endif">Part Time</option>
		                    				<option @if($vacancy->job_type=="Contractual") selected="selected @endif">Contractual</option>
		                    				<option @if($vacancy->job_type=="Internship") selected="selected @endif">Internship</option>
		                    				<option @if($vacancy->job_type=="Temporary") selected="selected @endif">Temporary</option>
		                    				<option @if($vacancy->job_type=="Work from Home") selected="selected @endif">Work from Home</option>                    				
		                    			</select>
		                  			</div>
	                  			</div>
	                  			<div class="col-md-6">
	                  				<div class="form-group"	>
	                  					<label for="business_function">Business Function</label>
	                  					<select class="form-control" name="business_function">
	                  						<option value="">Select Option</option>
	                  						<option @if($vacancy->business_function=="Administration") selected="selected @endif">Administration</option>
	                  						<option @if($vacancy->business_function=="Accounting & Finance") selected="selected @endif">Accounting &amp; Finance</option>
	                  						<option @if($vacancy->business_function=="Customer Support") selected="selected @endif">Customer Support</option>
	                  						<option @if($vacancy->business_function=="Data Entry & Analysis") selected="selected @endif">Data Entry &amp; Analysis</option>
	                  						<option @if($vacancy->business_function=="Creative, Design & Architecture") selected="selected @endif">Creative, Design &amp; Architecture</option>
	                  						<option @if($vacancy->business_function=="Education & Training") selected="selected @endif">Education &amp; Training</option>
	                  						<option @if($vacancy->business_function=="Hospitality") selected="selected @endif">Hospitality</option>
	                  						<option @if($vacancy->business_function=="Human Resources") selected="selected @endif">Human Resources</option>
	                  						<option @if($vacancy->business_function=="IT & Telecom") selected="selected @endif">IT &amp; Telecom</option>
	                  						<option @if($vacancy->business_function=="Legal") selected="selected @endif">Legal</option>
	                  						<option @if($vacancy->business_function=="Logistics") selected="selected @endif">Logistics</option>
	                  						<option @if($vacancy->business_function=="Management") selected="selected @endif">Management</option>
	                  						<option @if($vacancy->business_function=="Manufacturing") selected="selected @endif">Manufacturing</option>
	                  						<option @if($vacancy->business_function=="Marketing & PR") selected="selected @endif">Marketing &amp; PR</option>
	                  						<option @if($vacancy->business_function=="Operations") selected="selected @endif">Operations</option>
	                  						<option @if($vacancy->business_function=="Quality Assurance") selected="selected @endif">Quality Assurance</option>
	                  						<option @if($vacancy->business_function=="Research &amp; Technical") selected="selected @endif">Research &amp; Technical</option>
	                  						<option @if($vacancy->business_function=="Sales &amp; Distribution") selected="selected @endif">Sales &amp; Distribution</option>
	                  						<option @if($vacancy->business_function=="Security") selected="selected @endif">Security</option>
	                  						<option @if($vacancy->business_function=="Others") selected="selected @endif">Others</option>
	                  					</select>
	                  				</div>
	                  			</div>
                  			</div>
                  			<div class="row">
                  				<div class="col-md-6">
                  					<div class="form-group">
                  						<label for="location">Location</label>
                  						<div id="locationList"></div>	
                  						<input class="form-control" value="{{ $vacancy->location }}" type="text" id="location" name="location" placeholder="Enter Location">
                  						
                  						{{ csrf_field() }}
                  				   	</div>
                  				</div>
                  				<div class="col-md-6">
                  					<div class="form-group"	>
			                  			<label for="salary">Salary</label>
			                  			<input class="form-control" step="any" value="{{ $vacancy->salary }}" type="number" id="salary" name="salary" placeholder="Optional">
			                  		</div>
                  				</div>
                  			</div>
                  			<div class="row">
                  				<div class="col-md-6">
                  					<div class="form-group">
                  						<label for="location">Total Vacancies</label>
                  						<div id="total_vacancies"></div>	
                  						<input class="form-control" step="1" value="{{ $vacancy->total_vacancies }}"  type="number" id="total_vacancies" name="total_vacancies" placeholder="Optional">
                  						
                  				   	</div>
                  				</div>
                  				<div class="col-md-6">
                  					<div class="form-group">
                  						<label>Closing Date</label>

                  						<div class="input-group">
                    						<div class="input-group-prepend">
                      							<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    						</div>
                    						<input value="{{ $vacancy->dedline }}" type="date" id="dedline" name="dedline" class="form-control" >
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
		          					<option @if($vacancy->min_qualification =="Ordinary Level") selected="selected @endif">Ordinary Level</option>
		          					<option @if($vacancy->min_qualification =="Advanced Level") selected="selected @endif">Advanced Level</option>
		          					<option @if($vacancy->min_qualification =="Certificate") selected="selected @endif">Certificate</option>
		          					<option @if($vacancy->min_qualification =="Diploma") selected="selected @endif">Diploma</option>
		          					<option @if($vacancy->min_qualification =="Higher Diploma") selected="selected @endif">Higher Diploma</option>
		          					<option @if($vacancy->min_qualification =="Degree") selected="selected @endif">Degree</option>
		          					<option @if($vacancy->min_qualification =="Masters") selected="selected @endif">Masters</option>
		          					<option @if($vacancy->min_qualification =="Doctorate") selected="selected @endif">Doctorate</option>
		          					<option @if($vacancy->min_qualification =="Skilled Apprentice") selected="selected @endif">Skilled Apprentice</option>
		          				</select>
		          			</div>	
		          			</div>
		          			<div class="col-md-6">
		          				<div class="form-group">
			          				<label for="specializaion">Educational Specialization</label>
			          				<select name="specializaion" id="specializaion" class="form-control">
			          					<option value="">Select Option</option>
			          					<option @if($vacancy->specializaion=="Art & Humanities") selected="selected @endif">Art &amp; Humanities</option>
			          					<option @if($vacancy->specializaion=="Business & Management") selected="selected @endif">Business &amp; Management</option>
			          					<option @if($vacancy->specializaion=="Accounting") selected="selected @endif">Accounting</option>
			          					<option @if($vacancy->specializaion=="Design & Fashion") selected="selected @endif">Design &amp; Fashion</option>
			          					<option @if($vacancy->specializaion=="Engineering") selected="selected @endif">Engineering</option>
			          					<option @if($vacancy->specializaion=="Events & Hospitality") selected="selected @endif">Events &amp; Hospitality</option>
			          					<option @if($vacancy->specializaion=="Finance & Commerce") selected="selected @endif">Finance &amp; Commerce</option>
			          					<option @if($vacancy->specializaion=="Human Resources") selected="selected @endif">Human Resources</option>
			          					<option @if($vacancy->specializaion=="Information Technology") selected="selected @endif">Information Technology</option>
			          					<option @if($vacancy->specializaion=="Law") selected="selected @endif">Law</option>
			          					<option @if($vacancy->specializaion=="Marketing & Sales") selected="selected @endif">Marketing &amp; Sales</option>
			          					<option @if($vacancy->specializaion=="Media & Journalism") selected="selected @endif">Media &amp; Journalism</option>
			          					<option @if($vacancy->specializaion=="Medicine") selected="selected @endif">Medicine</option>
			          					<option @if($vacancy->specializaion=="Sciences") selected="selected @endif">Sciences</option>
			          					<option @if($vacancy->specializaion=="Vocational & Technical") selected="selected @endif">Vocational &amp; Technical</option>
			          					<option @if($vacancy->specializaion=="Others") selected="selected @endif">Others</option>
			          				</select>
		          				</div>	
		          			</div>
		          		</div>
		          		<div class="form-group">
			          		<label for="skills">Required Skills</label>
			          		<textarea name="skills" id="skills" placeholder="Optional" class="form-control">{{ $vacancy->skills }}</textarea>		
		          		</div>
		          		<div class="form-group">
			          		<label for="gender">Gender Preferance</label>
			          		<select name="gender" id="gender" class="form-control">
			          			<option value="">Select Option</option>
			          			<option @if($vacancy->gender=="Male") selected="selected" @endif>Male</option>
			          			<option @if($vacancy->gender =="Female") selected="selected" @endif>Female</option>
			          			<option @if($vacancy->gender=="Any") selected="selected" @endif>Any</option>		
			          		</select>
		          		</div>
		          		<?php 
		          		$user = auth()->user();
		          		$roleName= 'Employer' 
		          		?>
		          		@if(!$user->is($roleName))
		          		<div class="form-group">
			          		<label for="gender">Employer</label>
			          		<select name="employer_id" id="employer_id" class="form-control">
			          			<option value="">Select Option</option>
			          			@foreach($employers as $employer)
			          			<option @if($employer->id == $vacancy->employer_id) selected="selected" @endif value="{{ $employer->id }}">{{ $employer->name }}</option>
			          			@endforeach
			          		</select>
		          		</div>
		          		@endif	
		          		<input type="hidden" class="" value="{{ $vacancy->id }}" name="id" id="id"></input>
		          		<div class="form-group">
		          			<input type="submit" id="update-vacancy" class="btn btn-primary btn-flat" value="Update">
		          		</div>
	          		</div>
	          	</div>		
    		</div>		
    	</div>
    	</form>
    </section>
</div>
@endsection
@section('scripts')
@if(session("success"))
<script type="text/javascript">
  toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
  toastr.success("{{ session("success") }}");
@endif
</script>
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
			                $("#vacancy")[0].reset();
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
@endsection