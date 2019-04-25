@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Partnership Training</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Youths</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Attachments</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="course_support" id="course_support" method="post" enctype="multipart/form-data">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<div class="row">
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="">Select Option</option>
								@foreach($districts as $district)
								<option value="{{ $district->name_en}}">{{ $district->name_en }}</option>
								@endforeach
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
								@foreach($managers as $manager)
								<option value="{{ $manager->manager}}">{{ $manager->manager }}</option>
								@endforeach
    					   </select>
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-8">
	            	<?php 
		                  $activitiess = array('Follow up of youth who are enrolled for the courses and mentoring support','Identify partnership opportunities in district wise for youth training');

		                  $codes = array('3.1.6','3.1.7');
                 	?>
	            		<div class="form-group">
						    <label for="dm_name">4. Title of the Action</label>
						    <select name="title_of_action[]" id="title_of_action" class="form-control" multiple>
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option @if(in_array($activity->activity,$activitiess)) selected @endif value="{{ $activity->activity}}">{{ $activity->activity }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">5. Activity code as per the Logframe</label>
						    <select name="activity_code[]" id="activity_code" class="form-control" multiple>
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option @if(in_array($activity->code,$codes)) selected @endif value="{{ $activity->code}}">{{ $activity->code }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">6. Program Date</label>
						    <input type="date" name="program_date" id="program_date" class="form-control">
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
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">7. Institute </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search Institute name and select" type="text" id="ins_name" name="res_id" class="form-control" placeholder="Search Name of Institute">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('institutes/view')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add an institute to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="is_list"></div>
                          <input type="hidden" id="institute_id" name="institute_id" value="1">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="institutional_review">8.Institutional review done ?</label>
						    <select name="institutional_review" id="institutional_review" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								
    					   </select>
						</div>
	            	</div>
	            	
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Course Details
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">9. Course </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search course name and select" type="text" id="course_name" name="res_id" class="form-control" placeholder="Search Name of Course">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="course_list"></div>
                          <input type="hidden" id="course_id" name="course_id" value="1">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="start_date">10. Start Date ?</label>
						    <input type="date" name="start_date" id="start_date" class="form-control">

						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="start_date">11. Expected date of completion ?</label>
						    <input type="date" name="end_date" id="end_date" class="form-control">

						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    MOU Details
	                  </span>
                </div>
                <br>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">12. MOU signed ? </label>
						    <select name="mou_signed" id="mou_signed" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="start_date">13. MOU Signed Date ?</label>
						    <input type="date" name="date_mou_signed" id="date_mou_signed" class="form-control">

						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Cost of Support
	                  </span>
                </div>
                <br>		
	            <div class="row">

	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">14. BEC contribution </label>
						    <input type="number" name="bec_contribution" id="bec_contribution" class="form-control prc">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">15. Partner contribution </label>
						    <input type="number" name="partner_contribution" id="partner_contribution" class="form-control prc">
						</div>
	            	</div>
	            	<div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">16. Student contribution </label>
		                	<input type="number" name="student_contribution" id="student_contribution" class="form-control prc">
		            	</div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">17. Total Cost </label>
		                	<input type="number" name="total_cost" id="total_cost" class="form-control">
		            	</div>
		            </div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    No of youth supported
	                  </span>
                </div>
                <br>		
	            <div class="row">

	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">18. Total Male</label>
						    <input type="number" name="total_male" id="total_male" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">19. Total Female</label>
						    <input type="number" name="total_female" id="total_female" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">20. PWD Male</label>
		                	<input type="number" name="pwd_male" id="pwd_male" class="form-control">
		            	</div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">21. PWD Female</label>
		                	<input type="number" name="pwd_female" id="pwd_female" class="form-control">
		            	</div>
		            </div>
	            </div>	
	           <button type="button" class="btn btn-primary btn-flat" id="gvt">Add Supported Youth</button>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	<div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
	          		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">Search Youth by name or NIC and copy youth id </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search youth name or NIC select" type="text" id="youth" name="youth" class="form-control" placeholder="Search Name or NIC of youth">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('youth/add')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add a youth to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="youth_list"></div>
						</div>
	            	</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dm_name">Youth ID</label>

	          				<div class="input-group"> 
                          		<input type="text" id="youth_id" class="form-control" value="" >
                          		<div data-clipboard-target="#youth_id" id="copy" style="cursor: pointer" class="input-group-prepend copy">
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
						      <th scope="col" width="200px">Youth ID</th>
						      <th scope="col" width="250px">Approved Amount</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th><input type="number" name="youth_id[]" class="form-control"></th>
						      <td><input type="text" name="approved_amount[]" class="form-control position-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add"><i class="fas fa-plus"></i></button></td>
						    </tr>
						    
						  </tbody>
						</table>
						
	          	</div>
	          	<button type="button" id="res" class="btn btn-info btn-flat">Next</button>	
	            
	          </div>
	          <div class="tab-pane" id="tab_3">
	          	<div class="row">
	          		<div class="col-md-4">
	          			<div class="form-group">
	          				<label>Institutional review report</label>
	          				<input type="file" name="review_report" class="form-control">
	          			</div>	
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
	          				<label>Group Photo</label>
	          				<input type="file" name="group_photo" class="form-control">
	          			</div>	
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
	          				<label>MoUs signed with partner organizations/students</label>
	          				<input type="file" name="mou_report" class="form-control">
	          			</div>	
	          		</div>
	          		
	          	</div>	
	          	{{csrf_field()}}
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
@endsection
@section('scripts')
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
   	  				$('#dsd').append('<option value="'+dsObj.ID+'">'+dsObj.DSD_Name+'</option>');

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
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" name="youth_id[]" class="form-control name_list" /></td><td><input type="text" name="approved_amount[]" class="form-control position-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove"><i class="fas fa-times"></i></button></td></tr>');  
           $('#youth').val("");
           $('#youth_id').val("");
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });
$(document).ready(function(){
     $("#course_support").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/add-partner-support',   
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
              toastr.success('Succesfully Added Course Support Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#course_support")[0].reset();

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
<script>
	$('.form-group').on('input','.prc', function(){
		var totalSum = 0;
		$('.form-group .prc').each(function(){
			var inputVal = $(this).val();
			if($.isNumeric(inputVal)){
				totalSum += parseFloat(inputVal); 
			}
		});

		$('#total_cost').val(totalSum);
	});

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