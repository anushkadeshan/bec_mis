@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Work place assessment</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form id="institute-review" method="post" enctype="multipart/form-data">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<div class="row">
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="">{{$meeting->district}}</option>
    					  </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dsd">2. DSD </label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value="">{{$meeting->district}}</option>
								
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dm_name">3. District Manager</label>
						    <select name="dm_name" id="dm_name" class="form-control">
								<option value="">{{$meeting->dm_name}}</option>
    					   </select>
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">6. Date of Assesment</label>
						    <input type="date" name="program_date" id="review_date" class="form-control" value="{{$meeting->program_date}}">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Employer Details
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
      						    <label for="dm_name">7. Employer </label>
      						    <div class="input-group">                       
      		                        <input data-toggle="tooltip" data-placement="top" title="Search Employer name and select" type="text" id="employer_name" name="res_id" class="form-control" placeholder="Search Name of Employer" value="{{$meeting->e_name}}">
      		                        <div style="cursor: pointer" onclick="window.open('{{Route('employers')}}', '_blank');" class="input-group-prepend">
      		                          <span data-toggle="tooltip" data-placement="top" title="Add an Employer to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
      		                        </div>  
      		            </div>
                    <div id="employer_list"></div>
                    <input type="hidden" id="employer_id" name="employer_id" value="{{$meeting->employer_id}}">
						    </div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
    						    <label for="head_of_org">8. Head of Organization</label>
    						    <input type="text" id="head_of_org" name="head_of_org" class="form-control" value="{{$meeting->head_of_org}}">
						    </div>
	            	</div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="head_of_org">9. Organization is registered ?</label>
                    <select name="registered" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->registered=="Yes") selected @endif value="Yes">Yes</option>
                      <option value="No">No</option>
                      
                    </select>
                </div>
                </div>
	            </div>
	            <div class="row">
                <div class="col-md-4"> @if($meeting->registered=="No") selected @endif
                  <div class="form-group">
                  <label for="head_of_org">10. Type of registration</label>
                  <input type="text" id="type_of_reg" name="type_of_reg" class="form-control" value="{{$meeting->type_of_reg}}">
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  <label for="head_of_org">11. Nature of Business</label>
                  <textarea name="nature_of_business" class="form-control">{{$meeting->nature_of_business}}</textarea>
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">

                  <label for="head_of_org">12. How many employees are there in organization</label>
                  <select name="no_of_employers" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->no_of_employers=="1-10") selected @endif value="1-10">1-10</option>
                      <option @if($meeting->no_of_employers=="11-20") selected @endif value="11-20">11-20</option>
                      <option @if($meeting->no_of_employers=="21-30") selected @endif value="21-30">21-30</option>
                      <option @if($meeting->no_of_employers=="31-50") selected @endif value="31-50">31-50</option>
                      <option @if($meeting->no_of_employers=="51-100") selected @endif value="51-100">51-100</option>
                      <option @if($meeting->no_of_employers=="100") selected @endif value=">100">>100</option>               
                  </select>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="head_of_org">13. Approximately how many worksites are there in your organization?</label>
                  <input type="number" id="worksites" name="worksites" class="form-control" value="{{$meeting->worksites}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group"> 
                  <label for="head_of_org">14. Approximately how many departments are there in organization?</label>
                  <input type="number" id="departments" name="departments" class="form-control" value="{{$meeting->departments}}">
                  </div>
                </div>
              </div>
              
                <label for="dm_name">15. What is the general working hours & days of your organization?</label>
                <br>
                <div class="card card-info card-outline">
                <div class="card-body">
                <div class="row"> 
	            	<div class="col-md-3">
  	            	<div class="form-group">
  						    <label for="time_from">Time: From</label>
                  <input type="time" name="time_from" class="form-control" value="{{$meeting->time_from}}">
  						    </div>
	            	</div>	
                <div class="col-md-3">
                  <div class="form-group">
                  <label for="time_from">Time: To</label>
                  <input type="time" name="time_to" class="form-control" value="{{$meeting->time_to}}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                  <label for="time_from">Days: From</label>
                  <input type="text" name="days_from" class="form-control" value="{{$meeting->days_from}}">
                  </div>
                </div> 
                <div class="col-md-3">
                  <div class="form-group">
                  <label for="time_from">Days: To</label>
                  <input type="text" name="days_to" class="form-control" value="{{$meeting->days_to}}">
                  </div>
                </div>          	
	            </div>
              </div>
              </div>
              <label for="dm_name">16. What proportion of your employees belongs to following categories ?</label>
                <br>
                <div class="card card-info card-outline">
                <div class="card-body">
                <div class="row"> 
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">Women</label>
                    <select name="women" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->women=="All") selected @endif >All</option>
                      <option @if($meeting->women=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->women=="Half") selected @endif>Half</option>
                      <option @if($meeting->women=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->women=="None") selected @endif>None</option>
                      <option @if($meeting->women=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                  </div>
                  
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">Full time (40+ hrs a week)</label>
                    <select name="full_time" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->full_time=="All") selected @endif >All</option>
                      <option @if($meeting->full_time=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->full_time=="Half") selected @endif>Half</option>
                      <option @if($meeting->full_time=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->full_time=="None") selected @endif>None</option>
                      <option @if($meeting->full_time=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">Part time</label>
                    <select name="part_time" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->part_time=="All") selected @endif >All</option>
                      <option @if($meeting->part_time=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->part_time=="Half") selected @endif>Half</option>
                      <option @if($meeting->part_time=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->part_time=="None") selected @endif>None</option>
                      <option @if($meeting->part_time=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                </div>
                </div>
                <div class="row"> 
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">Working shifts</label>
                    <select name="shifts" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->shifts=="All") selected @endif >All</option>
                      <option @if($meeting->shifts=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->shifts=="Half") selected @endif>Half</option>
                      <option @if($meeting->shifts=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->shifts=="None") selected @endif>None</option>
                      <option @if($meeting->shifts=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                  </div>
                  
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">Contract basis</label>
                    <select name="contract" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->contract=="All") selected @endif >All</option>
                      <option @if($meeting->contract=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->contract=="Half") selected @endif>Half</option>
                      <option @if($meeting->contract=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->contract=="None") selected @endif>None</option>
                      <option @if($meeting->contract=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">Permanent</label>
                    <select name="permanant" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->permanant=="All") selected @endif >All</option>
                      <option @if($meeting->permanant=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->permanant=="Half") selected @endif>Half</option>
                      <option @if($meeting->permanant=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->permanant=="None") selected @endif>None</option>
                      <option @if($meeting->permanant=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                </div>
                </div> 
                <div class="row"> 
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="time_from">Regularly working at different locations other than main site</label>
                    <select name="different_locations" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->different_locations=="All") selected @endif >All</option>
                      <option @if($meeting->different_locations=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->different_locations=="Half") selected @endif>Half</option>
                      <option @if($meeting->different_locations=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->different_locations=="None") selected @endif>None</option>
                      <option @if($meeting->different_locations=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="time_from">Disabled &/or have special needs</label>
                    <select name="disabled" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->disabled=="All") selected @endif >All</option>
                      <option @if($meeting->disabled=="More than half") selected @endif>More than half</option>
                      <option @if($meeting->disabled=="Half") selected @endif>Half</option>
                      <option @if($meeting->disabled=="Very few") selected @endif>Very few</option>
                      <option @if($meeting->disabled=="None") selected @endif>None</option>
                      <option @if($meeting->disabled=="Don’t know") selected @endif>Don’t know</option>
                    </select>
                    </div>
                  </div>
                </div> 
                </div>
                </div>
                <div class="row"> 
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">17. Does your organization has a separate Human Resource department? </label>
                    <select name="hrd" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->hrd=="Yes") selected @endif value="Yes">Yes</option>
                      <option @if($meeting->hrd=="No") selected @endif value="No">No</option>
                    </select>
                    </div>
                  </div>                  
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">18. Does your organization provide an appointment letter for the employees?</label>
                    <select name="app_letter" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->app_letter=="Yes") selected @endif value="Yes">Yes</option>
                      <option @if($meeting->app_letter=="No") selected @endif value="No">No</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">19. Is there any probation period which new recruits are subjected to?</label>
                    <select name="probation" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->probation=="Yes") selected @endif value="Yes">Yes</option>
                      <option @if($meeting->probation=="No") selected @endif value="No">No</option>
                    </select>
                    </div>
                </div>
                </div>
                <div class="row"> 
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">20. If yes, what is the duration of probation?</label>
                    <input type="text" name="duration" class="form-control" value="{{$meeting->duration}}">
                    </div>
                  </div>                  
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">21. Can you briefly explain about your organization’s leave policy?</label>
                    <textarea name="leave_policy" class="form-control">{{$meeting->leave_policy}}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">22. Does your organization has a gender policy?</label>
                    <select name="gender_policy" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->gender_policy=="Yes") selected @endif value="Yes">Yes</option>
                      <option @if($meeting->gender_policy=="No") selected @endif value="No">No</option>
                    </select>
                    </div>
                </div>
                </div>
                <div class="row"> 
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">23. Do you have any mechanism to avoid work place harassment?</label>
                    <select name="harassment" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->harassment=="Yes") selected @endif value="Yes">Yes</option>
                      <option @if($meeting->harassment=="No") selected @endif value="No">No</option>
                    </select>
                    </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">24. If yes, could you please elaborate a bit about the mechanism?</label>
                    <textarea name="elaborate" class="form-control">{{$meeting->elaborate}}</textarea>
                    </div>
                </div>                 
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">25. Does your organization provide equal opportunity for every levels of employees to excel in the career path</label>
                    <select name="equal_opportunity" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->equal_opportunity=="Yes") selected @endif value="Yes">Yes</option>
                      <option @if($meeting->equal_opportunity=="No") selected @endif value="No">No</option>
                    </select>
                    </div>
                </div>
                </div>
                <div class="row"> 
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">26. What is the prepared language at workplace ?</label>
                    <select name="prepared_language" class="form-control">
                      <option value="">Select Option</option>
                      <option @if($meeting->prepared_language=="Sinhala") selected @endif >Sinhala</option>
                      <option @if($meeting->prepared_language=="Tamil") selected @endif>Tamil</option>
                      <option @if($meeting->prepared_language=="English") selected @endif>English</option>
                    </select>
                    </div>
                </div>                 
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="part_time">27. What is the starting salary range at your organization?</label>
                    <input type="number" name="starting_salary" class="form-control" value="{{$meeting->starting_salary}}">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="time_from">28. Does your organization provide following facilities to your employees  ?</label>
                    <select name="facilities[]" class="form-control" multiple>
                      <option>EPF & ETF</option>
                      <option>Health Insurance</option>
                      <option>Overtime</option>
                      <option>Special bonus</option>
                      <option>Incentives</option>
                      <option>Transport for night shifts</option>
                      <option>Accommodation</option>
                      <option>Meals</option>
                      <option>Skill development trainings</option>
                      <option>Arrangement for employee complaints</option>
                    </select>
                    </div>
                </div>
                </div>  			
	       {{csrf_field()}}
          <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

        <button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
	          </div>
	          <!-- /.tab-pane -->
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
@endsection
@section('scripts')
<script>
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
	
$(document).ready(function(){
     $("#institute-review").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/job-linking/update-assesment',   
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
              toastr.success('Succesfully updated Workplace Assesment Details ! ', 'Congratulations', {timeOut: 5000});
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
//search Employer
       $('#employer_name').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/employerList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#employer_list').fadeIn();  
                 $('#employer_list').html(data);
                }
               });
              }
          });

          $(document).on('click', '#employers li', function(){  
            $('#employer_list').fadeOut(); 
              $('#employer_name').val($(this).text()); 
              $('#employer_name').focus(); 

              var ins_id = $(this).attr('id');
              $('#employer_id').val(ins_id);
               
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
  @if (session('error'))
  toastr.error('{{session('error')}}')
  @endif  

	new ClipboardJS('.copy');
</script>

<script src="{{ asset('js/bootstrap3-wysihtml5.all.min.js') }}"></script>
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
  #autocomplete, #employers, #youths {
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
#autocomplete,  #employers, #youths > li {
  padding: 3px 20px;
}
#autocomplete, #employers, #youths > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection