@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Job Interviews</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Employers and Youths</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Attachments</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="res_person" id="res_person" method="post" enctype="multipart/form-data">
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
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
						    <select name="dsd[]" id="dsd" class="form-control" multiple>
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
								<option @if($activity->activity=='Youth placed in private sectors') selected @endif value="{{ $activity->activity}}">{{ $activity->activity }}</option>
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
								<option @if($activity->code=='4.2.4') selected @endif value="{{ $activity->code}}">{{ $activity->code }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">6. Program Date</label>
						    <input type="date" name="program_date" id="program_date" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Time Start</label>
						    <input type="time" name="time_start" id="time_start" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">8. Time End</label>
						    <input type="time" name="time_end" id="time_end" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">9. Venue</label>
						    <input type="text" name="venue" id="venue" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">10. Program Cost</label>
						    <input type="text" name="program_cost" id="program_cost" class="form-control">
						</div>
	            	</div>
	            </div>		
	           <button type="button" class="btn btn-primary btn-flat" id="gvt">Add Employers</button>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	<h5 class="text-success">Add Employer Participant Details </h5>
	          	<div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
	          		<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">Search Employer and copy Employer ID </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search Employer name" type="text" id="employer" name="employer" class="form-control" placeholder="Search Employer Name">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('employers')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add a Employer to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="employer_list"></div>
						</div>
	            	</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dm_name">Employer ID</label>

	          				<div class="input-group"> 
                          		<input type="text" id="employer_id" class="form-control" value="" >
                          		<div data-clipboard-target="#employer_id" id="copy" style="cursor: pointer" class="input-group-prepend copy">
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
						      <th width="150px" scope="col">Employer ID</th>
						      <th width="550px" scope="col">Vacancies offered on the date if interviewed </th>
						      <th width="150px" scope="col">Male</th>
						      <th width="150px" scope="col">Female</th>
						      <th width="150px" scope="col">PWD Male</th>
						      <th width="150px" scope="col">PWD Female</th>
						      <th width="150px" scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th><input type="text" name="employer_id[]" class="form-control name-list"></th>
						      <td><input type="text" name="vacancies[]" class="form-control position-list"></td>
						      <td><input type="text" name="total_male[]" class="form-control branch-list"></td>
						      <td><input type="text" name="total_female[]" class="form-control branch-list"></td>
						      <td><input type="text" name="pwd_male[]" class="form-control branch-list"></td>
						      <td><input type="text" name="pwd_female[]" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add"><i class="fas fa-plus"></i></button></td>
						    </tr>
						    
						  </tbody>
						</table>
						
	          	</div>
	          	<hr>
	          	<h5 class="text-success">Add Youth Placement Details </h5>

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
  
	          			<table class="table table-borderless" id="dynamic_field1">
						  <thead>
						    <tr>
						      <th scope="col">Youth ID</th>
						      <th scope="col">Type of Support By BEC</th>
						      <th scope="col">Employer ID</th>
						      <th scope="col">Vacancy Placed</th>
						      <th scope="col">Salary</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th><input type="text" name="youth_id[]" class="form-control name-list"></th>
						      <td><input type="text" name="type_of_support[]" class="form-control position-list"></td>
						      <td><input type="number" name="employer[]" class="form-control position-list"></td>
						      <td><input type="text" name="vacancies[]" class="form-control position-list"></td>
						      <td><input type="text" name="salary[]" class="form-control position-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add1"><i class="fas fa-plus"></i></button></td>
						    </tr>
						    
						  </tbody>
						</table>
						
	          	</div> 
	          </div>
	          <div class="tab-pane" id="tab_4">
	          	<div class="row">
	          		<div class="col-md-4">
	          			<div class="form-group">
	          				<label>Attendance Sheet-Youths</label>
	          				<input type="file" name="attendance_youths" class="form-control">
	          			</div>	
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
	          				<label>Attendance Sheet-Employers</label>
	          				<input type="file" name="attendance_employers" class="form-control">
	          			</div>	
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
	          				<label>Photos</label>
	          				<input type="file" name="images[]" class="form-control" multiple>
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
   	  $(document).on('click','#att', function(){
   	  	$('#tabs a[href="#tab_4"]').tab('show');
   	  });
   	});

$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><th><input type="text" name="employer_id[]" class="form-control name-list"></th><td><input type="text" name="vacancies[]" class="form-control position-list"></td><td><input type="text" name="total_male[]" class="form-control branch-list"></td><td><input type="text" name="total_female[]" class="form-control branch-list"></td><td><input type="text" name="pwd_male[]" class="form-control branch-list"></td><td><input type="text" name="pwd_female[]" class="form-control branch-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });

$(document).ready(function(){  
      var i=1;  
      $('#add1').click(function(){  
           i++;  
           $('#dynamic_field1').append('<tr id="row'+i+'"><th><input type="text" name="youth_id[]" class="form-control name-list"></th><td><input type="text" name="type_of_support[]" class="form-control position-list"></td><td><input type="number" name="employer[]" class="form-control position-list"></td><td><input type="text" name="vacancies[]" class="form-control position-list"></td><td><input type="text" name="salary[]" class="form-control position-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove1">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });
$(document).ready(function(){
     $("#res_person").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/job-linking/add-placement',   
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
              toastr.success('Succesfully Add Job Placements Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#res_person")[0].reset();

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
       $('#employer').keyup(function(){ 
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
              $('#employer').val($(this).text()); 
              $('#employer_id').focus(); 
              var ins_id = $(this).attr('id');
              $('#employer_id').val(ins_id);
               
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