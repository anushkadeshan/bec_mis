@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Stakeholder meetings </h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Participants</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Attachments</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="stake" id="stake" method="post" enctype="multipart/form-data">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<div class="row">
	          		<div class="col-md-3">
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
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value="">Select Option</option>
								
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
	          				<label for="gn_division">3. GN Divisions Covered</label>
    						<select name="gnd[]" id="gn_division" class="form-control" multiple>
    						</select>
   						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dm_name">4. District Manager</label>
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
						    <label for="dm_name">5. Title of the Action</label>
						    <select name="title_of_action" id="title_of_action" class="form-control">
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option @if($activity->activity=='Stake holder meeting in DSD level to aware BECs new strategic plan / directions') selected @endif value="{{ $activity->activity}}">{{ $activity->activity }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">6. Activity code as per the Logframe</label>
						    <select name="activity_code" id="activity_code" class="form-control">
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option @if($activity->code=='2.1.1') selected @endif value="{{ $activity->code}}">{{ $activity->code }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Program Date</label>
						    <input type="date" name="program_date" id="program_date" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">8. Time Start</label>
						    <input type="time" name="time_start" id="time_start" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">9. Time End</label>
						    <input type="time" name="time_end" id="time_end" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">10. Venue</label>
						    <input type="text" name="venue" id="venue" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">11. Program Cost</label>
						    <input type="number" name="program_cost" id="program_cost" class="form-control">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    No of participants
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
	            	
	            </div>	
	          
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">14. Decisions taken/comments made by the participants</label>
						    <textarea class="textarea" name="decisions" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
	            	</div>	            	
	            </div>
	           <button type="button" class="btn btn-primary btn-flat" id="gvt">Add participants</button>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	<div class="form-group">
  
	          			<table class="table table-borderless" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col">Name</th>
						      <th scope="col">Gender</th>
						      <th scope="col">Designation</th>
						      <th scope="col">Institute</th>
						      <th scope="col">Phone</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th><input type="text" name="name[]" class="form-control name-list"></th>
						      <td><input type="text" name="gender[]" class="form-control position-list"></td>
						      <td><input type="text" name="designation[]" class="form-control branch-list"></td>
						      <td><input type="text" name="institute[]" class="form-control branch-list"></td>
						      <td><input type="text" name="phone[]" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add">Add More</button></td>
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
	          				<label>Attendance Sheet(scan as a one file)</label>
	          				<input type="file" name="attendance" class="form-control">
	          			</div>	
	          		</div>
	          		<div class="col-md-6">
	          			<div class="form-group">
	          				<label>Photos</label>
	          				<input type="file" name="image[]" class="form-control" multiple>
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

   	  $(document).on('change','#dsd',function(e){
   	  		
   	  		var ds_division = e.target.value;
   	  		

   	  		$.get('/gn-division?ds_division=' +ds_division, function(data){
   	  			//success
   	  			console.log(data);
   	  			$.each(data, function(index, gnObj){
   	  				$('#gn_division').append('<option value="'+gnObj.GN_Office+'">'+gnObj.GN_Office+'</option>');

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
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" class="form-control name_list" /></td><td><input type="text" name="gender[]" class="form-control position-list"></td>						      <td><input type="text" name="designation[]" class="form-control branch-list"></td><td><input type="text" name="institute[]" class="form-control branch-list"></td><td><input type="text" name="phone[]" class="form-control branch-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });
$(document).ready(function(){
     $("#stake").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-stake-holder',   
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
              toastr.success('Succesfully Added Stake Holder Meeting Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#stake")[0].reset();

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

  @if (session('error'))
  toastr.error('{{session('error')}}')
  @endif  
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
@endsection