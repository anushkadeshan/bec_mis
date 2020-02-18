@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Review of institutions -Edit </h3>
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
								<option value="">{{$meeting->district}}</option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dsd">2. DSD </label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value="">{{$meeting->dsd}}</option>
								
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
						    <label for="dm_name">6. Date of Review</label>
						    <input type="date" name="program_date" id="review_date" class="form-control" value="{{$meeting->program_date}}">
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
		                        <input data-toggle="tooltip" data-placement="top" title="Search Institute name and select" type="text" id="ins_name" name="res_id" class="form-control" placeholder="Search Name of Institute" value="{{$meeting->institute_name}}">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('institutes/view')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add an institute to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="is_list"></div>
                          <input type="hidden" id="institute_id" name="institute_id" value="{{$meeting->institute_id}}">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">8.Head of Institute </label>
						    <input type="text" id="head_of_institute" name="head_of_institute" class="form-control" value="{{$meeting->head_of_institute}}">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">9. Contact No</label>
						    <input type="number" id="contact" name="contact" class="form-control" value="{{$meeting->contact}}">
						</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">10. Date of commencement </label>
						    <input type="date" id="commencement_date" name="commencement_date" class="form-control" value="{{$meeting->commencement_date}}">
						</div>
	            	</div>
	            	<div class="col-md-5">
	            		<div class="form-group">
						    <label for="institutional_review">11. if TVEC regiestered, Expiry date of registration</label>
						    <input type="date" id="tvec_ex_date" name="tvec_ex_date" class="form-control" value="{{$meeting->tvec_ex_date}}">
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
								<option @if($meeting->ojt_compulsory=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->ojt_compulsory=="No") selected @endif value="No">No</option>
    					   </select>

						</div>
	            	</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">13. If not, what are the courses that OJT is not compulsory ?</label>  
						    <textarea name="courses_not_compulsory" id="courses_not_compulsory" class="form-control">{{$meeting->courses_not_compulsory}}</textarea>
						</div>
	            	</div>
	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">15. Is there follow up services on passed out trainees? </label>  
						    <select name="followup" id="followup" class="form-control">
								<option value="">Select Option</option>
								<option @if($meeting->followup=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->followup=="No") selected @endif value="No">No</option>
    					   </select>
						</div>
	            	</div>
	            	<?php 
                    $services = array("Job placement","Assisting for self-employment","Other","Tracer Study survey");
                    ?>
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="start_date">16. If yes, what are such services offered ?</label>
						    <select name="services_offered[]" id="services_offered" class="form-control" multiple>
								@foreach($services as $service)
                                    <option>{{$service}}</option>                                 
                                @endforeach
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
								<option @if($meeting->trainee_allowance=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->trainee_allowance=="No") selected @endif value="No">No</option>
    					   </select>
						</div>
            		</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">18. If yes, amount (per month) ?</label>  
						    <input type="number" id="amount" name="amount" class="form-control" value="{{$meeting->amount}}">
						</div>
	            	</div>
	            	<div class="col-md-5">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">19. Source/s of funding for trainee allowance? </label>  
					    <input type="text" id="source" name="source" class="form-control" value="{{$meeting->source}}">
						</div>
            		</div>
            	</div>
	            <div class="row">
            		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">20.	Soft skill development components included in the curriculums? </label>  
						    <select name="soft_skill" id="soft_skill" class="form-control">
								<option value="">Select Option</option>
								<option @if($meeting->soft_skill=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->soft_skill=="No") selected @endif value="No">No</option>
								<option @if($meeting->soft_skill=="Need improvements") selected @endif value="Need improvements">Need improvements</option>
    					   </select>
						</div>
            		</div>
            		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="courses_not_compulsory">21. Does the institute agree to incorporate/update soft skill components at their own expenses? </label>  
						    <select name="agreement_soft_skill" id="agreement_soft_skill" class="form-control">
								<option value="">Select Option</option>
								<option @if($meeting->agreement_soft_skill=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->agreement_soft_skill=="No") selected @endif value="No">No</option>
								<option @if($meeting->agreement_soft_skill=="Not decided") selected @endif value="Not decided">Not decided</option>
    					   </select>
						</div>
            		</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="gaps">22. What are the existing gaps to incorporate soft skill components</label>  
						    <textarea name="gaps" id="gaps" class="form-control">{{$meeting->gaps}}</textarea>
						</div>
	            	</div>

            	</div>			
	           {{csrf_field()}}
               <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
				</form>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	
	          	<div class="form-group">
  
	          			<table class="table table-striped" id="example1">
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
						  	@foreach($courses as $course)
						    <tr>
						      <th>{{$course->name}}</th>
						      <td>{{$course->period_intake}}</td>
						      <td>{{$course->intake_per_batch}}</td>
						      <td>{{$course->current_following}}</td>
						      <td>{{$course->passed_out}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$course->i_id}}" data-period_intake="{{$course->period_intake}}" data-current_following="{{$course->current_following}}" data-intake_per_batch="{{$course->intake_per_batch}}" data-passed_out="{{$course->passed_out}}" id="edit2"><i class="fas fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
						<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		                <div class="modal-dialog" role="document">
		                  <div class="modal-content">
		                    <div class="modal-header">
		                      <h5 class="modal-title" id="exampleModalLongTitle">Update Course Information</h5>
		                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                        <span aria-hidden="true">&times;</span>
		                      </button>
		                    </div>
		                    <div class="modal-body">
		                        <!-- form start -->
		                            
		                        <form role="form" method="get" id="myForm1">
		                            {{ csrf_field() }}
		                            
		                            <div class="form-group">
		                              <label for="name">Period of Intake</label>
		                              <input type="text" class="form-control" id="period_intake1" name="period_intake" >
		                            </div>
		                            <div class="form-group">
		                              <label for="name">Intake per Batch</label>
		                              <input type="number" class="form-control" id="intake_per_batch1" name="intake_per_batch" >
		                            </div>
		                            <div class="form-group">
		                              <label for="name"># Students Currently following</label>
		                              <input type="number" class="form-control" id="current_following1" name="current_following" >
		                            </div>
		                            <div class="form-group">
		                              <label for="name"># Students passed out</label>
		                              <input type="number" class="form-control" id="passed_out1" name="passed_out" >
		                            </div>
		                            <input type="hidden" id="id_p" name="id_p"></input>
		                        </form>
		                    </div>
		                    <div class="modal-footer">
		                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                      <button type="button" id="update-part" class="btn btn-primary">Update changes</button>
		                    </div>
		                  </div>
                </div>
              </div>
              <br>
              <br>
              <h5>Add youths if you have missed</h5>
              <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
	          		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">Search Course and copy ID </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search course name and select" type="text" id="course_name" name="res_id" class="form-control" placeholder="Search Name of Course">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
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
						    <form id="add-course">
						      <th><input type="number" name="course_id" class="form-control"></th>
						      <td><input type="string" name="period_intake" class="form-control position-list"></td>
						      <td><input type="number" name="intake_per_batch" class="form-control position-list"></td>
						      <td><input type="number" name="current_following" class="form-control position-list"></td>
						      <td><input type="number" name="passed_out" class="form-control position-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
						      {{csrf_field()}}
              				 <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">
						  </form>
						    </tr>
						    
						  </tbody>
						</table>
	          	</div>
	          	
	            
	          </div>
	        </div>
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


$(document).ready(function(){
     $("#institute-review").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-institute-review',   
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
              toastr.success('Succesfully update Institute Review Details ! ', 'Congratulations', {timeOut: 5000});
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

//edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#period_intake1').val($(this).data('period_intake'));
        $('#intake_per_batch1').val($(this).data('intake_per_batch'));
        $('#current_following1').val($(this).data('current_following'));
        $('#passed_out1').val($(this).data('passed_out'));
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-review',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully updated the report ! ', 'Congratulations', {timeOut: 5000});
              $("#myForm1")[0].reset();
              location.reload();


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

//add youth
   $(document).ready(function(){
     $(document).on('click' , '#add2' ,function (){
        var form = $('#add-course');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-review',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully added a youth ! ', 'Congratulations', {timeOut: 5000});
              $("#add-course")[0].reset();
              location.reload();


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
@endsection