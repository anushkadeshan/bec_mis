@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">ToT on Career guidance</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Resourse Person</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Attachments</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="tot" id="tot" method="post" enctype="multipart/form-data">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="title_of_action">1. Title of the Action</label>
                  <select name="title_of_action" id="title_of_action" class="form-control" data-dependent="ds_division">
                    <option value="">Select Option</option>
                    @foreach($activities as $activity)
                    <option @if($activity->activity=='Developing training module to aware parents and youth on existing career context/career guidance') selected @endif value="{{ $activity->id}}">{{ $activity->code }} | {{ $activity->activity }}</option>
                    @endforeach
                </select>
              </div> 
              </div>
              <div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">2. Activity code as per the Logframe</label>
						    <select name="activity_code" id="activity_code" class="form-control">
								<option value="">Select Option</option>
								@foreach($activities as $activity)
								<option  @if($activity->code=='2.1.3') selected @endif value="{{ $activity->code}}">{{ $activity->code }}</option>
								@endforeach
    					   </select>
						</div>
	            	</div>
             </div>  
             
             <div class="row">
             	<div class="col-md-3">
             		<div class="form-group">
	          			<label for="date">3. Program Date</label>
    					<input type="date" name="meeting_date" id="date" class="form-control">
   					</div>
             		 
             	</div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="date"> No of Days</label>
              <input type="number" name="days" id="days" class="form-control">
            </div>
                 
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="time">4. Time Start</label>
                  <input type="time" name="time_start" id="time" class="form-control">
                </div>
                
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="time">5. Time End</label>
                  <input type="time" name="time_end" id="time1" class="form-control">
                </div>
                
              </div>
              <div class="col-md-3">
             		<div class="form-group">
             		 	<label for="venue">6. Venue</label>
             		 	<input type="text" id="venue" name="venue" class="form-control">
             		 </div> 
             		
             	</div>
             	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Program Cost</label>
						    <input type="text" name="program_cost" id="program_cost" class="form-control">
						</div>
	            	</div>
             </div>
              <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    8. Participants Details
	                  </span>
                </div>
                <br>
              <div  class="row" >
                  <table class="table table-borderless" id="dynamic_field1"> 
                    <thead>
                      <tr>
                        <th>Organization</th>
                        <th>No of Male</th>
                        <th>No of Male</th>
                        <th>No of PWD Male</th>
                        <th>No of PWD Female</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><select name="organization[]" class="form-control">
                        	<option value="BEC">BEC</option>
                        	<option value="GVT. Officials">GVT. Officials</option>
                        	<option value="GVT. Training Institutes">GVT. Training Institutes</option>
                        	<option value="PVT. Training Institutes">PVT. Training Institutes</option>
                        </select></td>
                        <td><input type="number" name="total_male[]" class="form-control"></td>
                        <td><input type="number" name="total_female[]" class="form-control"></td>
                        <td><input type="number" name="pwd_male[]" class="form-control"></td>
                        <td><input type="number" name="pwd_female[]" class="form-control"></td>
                        <td><button type="button" class="btn btn-success btn-flat" id="add-org">Add Next</button></td>
                       
                      </tr>
                     
                    </tbody>
                  </table>
              </div> 
              <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">9. Mode of Conduct</label>
						    <textarea class="textarea" name="mode_of_conduct" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">10. Topics Discussed </label>
						    <textarea class="textarea" name="topics" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">11. Deliverables</label>
						    <textarea class="textarea" name="deliverables" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
	            	</div>	            	
	            </div> 
	           <button type="button" class="btn btn-primary" id="gvt">Add Resourse Person</button>
	          </div>

	          <div class="tab-pane" id="tab_2">
	          	<div class="row">
	          		<div class="form-group col-md-6">

						<label for="family_id">Resourse Person</label>
										      
                        <div class="input-group">
                        
                        <input data-toggle="tooltip" data-placement="top" title="Search Resorse Person name and select" type="text" id="res_name" name="res_id" class="form-control" placeholder="Search Name of Resourse Person">
                        <div style="cursor: pointer" onclick="window.open('{{Route('activities/resourse-person')}}', '_blank');" class="input-group-prepend">
                          <span data-toggle="tooltip" data-placement="top" title="Add Resourse Person to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                        </div>  
                      </div>
                      <div id="res_list"></div>
                          <input type="hidden" id="resourse_person_id" name="resourse_person_id" value="">
					</div>
					<div class="form-group col-md-2">

						
					</div>	
	          	</div>
	          	<button type="button" id="att" class="btn btn-info btn-flat">Next</button>	
	          </div>
	          <div class="tab-pane" id="tab_3">
	          	<div class="row">
	          		<div class="col-md-3">
	          			<div class="form-group">
	          				<label>Attendance Sheet(scan as a one file)</label>
	          				<input type="file" name="attendance" class="form-control">
	          			</div>	
	          		</div>
	          		
	          		<div class="col-md-3">
	          			<div class="form-group">
	          				<label>Photos</label>
	          				<input type="file" name="image[]" class="form-control" multiple>
	          			</div>	
	          		</div>
	          		<div class="col-md-6">
	          			<div class="form-group">
	          				<label>Training report from resource person (including pre & posttest)</label>
	          				<input type="file" name="training_report" class="form-control">
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
   	  
   	  $(document).on('click','#gvt', function(){
   	  	$('#tabs a[href="#tab_2"]').tab('show');
   	  });
   	  
   	  $(document).on('click','#att', function(){
   	  	$('#tabs a[href="#tab_3"]').tab('show');
   	  });
   	});

$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" class="form-control name_list" /></td><td><input type="text" name="gender[]" class="form-control position-list"></td>						      <td><input type="text" name="designation[]" class="form-control branch-list"></td><td><input type="text" name="institute[]" class="form-control branch-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });

$(document).ready(function(){  
      var i=1;  
      $('#add-org').click(function(){  
           i++;  
           $('#dynamic_field1').append('<tr id="row1'+i+'"><td><select name="organization[]" class="form-control"><option value="BEC">BEC</option><option value="GVT. Officials">GVT. Officials</option><option value="GVT. Training Institutes">GVT. Training Institutes</option><option value="PVT. Training Institutes">PVT. Training Institutes</option></select></td><td><input type="number" name="total_male[]" class="form-control"></td><td><input type="number" name="total_female[]" class="form-control"></td><td><input type="number" name="pwd_male[]" class="form-control"></td><td><input type="number" name="pwd_female[]" class="form-control"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove1">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row1'+button_id+'').remove();  
      });   
 });
$(document).ready(function(){
     $("#tot").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activities/career-guidance/tot-cg-add',   
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
              toastr.success('Succesfully Add ToT on Career guidance reprot ! ', 'Congratulations', {timeOut: 5000});
			  $("#tot")[0].reset();

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
			 $('#res_name').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/resoursePersonList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#res_list').fadeIn();  
			           $('#res_list').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#resourse_person li', function(){  
			    	$('#res_list').fadeOut(); 
			        $('#res_name').val($(this).text()); 
			        var res_id = $(this).attr('id');
			        $('#resourse_person_id').val(res_id);
			         
			    });  
		});
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
<style type="text/css" media="screen">
	#autocomplete, #resourse_person {
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
#autocomplete,  #resourse_person > li {
  padding: 3px 20px;
}
#autocomplete, #resourse_person > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection