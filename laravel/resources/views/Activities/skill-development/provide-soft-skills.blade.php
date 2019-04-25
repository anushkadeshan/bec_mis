@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Softskill training </h3>
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
	            		<div class="form-group">
						    <label for="dm_name">4. Title of the Action</label>
						    <select name="title_of_action" id="title_of_action" class="form-control">
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option @if($activity->activity=="Soft skill training for required youth prior to VT/Professional course enrolment") selected @endif value="{{ $activity->activity}}">{{ $activity->activity }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">5. Activity code as per the Logframe</label>
						    <select name="activity_code" id="activity_code" class="form-control">
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option @if($activity->code=="3.1.3") selected @endif value="{{ $activity->code}}">{{ $activity->code }}</option>
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
                          <input type="hidden" id="institute_id" name="institute_id" value="">
						</div>
	            	</div>
	            	<div class="col-md-4">
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
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="mou_signed">9. MOU signed with institute ?</label>
						    <select name="mou_signed" id="mou_signed" class="form-control">
								<option value="">Select Option</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">10. Date signed ?</label>
						    <input type="date" name="date_signed" id="date_signed" class="form-control">
						    
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="cost">11. Cost ?</label>
						    <input type="number" name="cost" id="cost" class="form-control">
						    
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
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="institutional_review">12.Training Stage ?</label>
						    <select name="training_stage" id="training_stage" class="form-control">
								<option value="">Select Option</option>
								<option value="Prior to VT/Professional training">Prior to VT/Professional training</option>
								<option value="During the VT/Professional training">During the VT/Professional training</option>
								
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="start_date">13. Start Date ?</label>
						    <input type="date" name="start_date" id="start_date" class="form-control">

						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="start_date">14. Expected date of completion ?</label>
						    <input type="date" name="end_date" id="end_date" class="form-control">

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
						    <label for="dm_name">12. Total Male</label>
						    <input type="number" name="total_male" id="total_male" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">13. Total Female</label>
						    <input type="number" name="total_female" id="total_female" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">14. PWD Male</label>
		                	<input type="number" name="pwd_male" id="pwd_male" class="form-control">
		            	</div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">15. PWD Female</label>
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
						      <th scope="col" width="250">Youth ID</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th><input type="number" name="youth_id[]" class="form-control"></th>
						      <td><button type="button" class="btn btn-success btn-flat" id="add"><i class="fas fa-plus"></i></button></td>
						    </tr>
						    
						  </tbody>
						</table>
						
	          	</div>
	          	<button type="button" id="res" class="btn btn-info btn-flat">Next</button>	
	            
	          </div>
	          <div class="tab-pane" id="tab_3">
	          	<div class="row">
	          		<div class="col-md-6">
	          			<div class="form-group">
	          				<label>Institutional review report</label>
	          				<input type="file" name="review_report" class="form-control">
	          			</div>	
	          		</div>
	          		<div class="col-md-6">
	          			<div class="form-group">
	          				<label>MOU</label>
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
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" name="youth_id[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove"><i class="fas fa-times"></i></button></td></tr>');  
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
            url: SITE_URL + '/activity/skill/add-provide-soft',   
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
              toastr.success('Succesfully Added provide soft skill Details ! ', 'Congratulations', {timeOut: 5000});
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