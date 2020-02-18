@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Kick of events  </h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Goverment Officials</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<form name="kick" id="kick" method="post">
	          	<div class="row">
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="{{ $meeting->district}}">{{ $meeting->district }}</option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value="">{{ $meeting->DSD_Name}}</option>
								
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
	          				<label for="gn_division">3. GN Divisions Covered</label>
    						<br>
    						{{ $meeting->gnd}}
   						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dm_name">4. District Manager</label>
						    <select name="dm_name" id="dm_name" class="form-control">
								<option value="{{ $meeting->dm_name}}">{{ $meeting->dm_name}}</option>
    					   </select>
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Program Date</label>
						    <input type="date" name="program_date" id="date" class="form-control" value="{{ $meeting->program_date}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">8. Time Start</label>
						    <input type="time" name="time_start" id="time_start" class="form-control" value="{{ $meeting->time_start}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">9. Time End</label>
						    <input type="time" name="time_end" id="time_end" class="form-control" value="{{ $meeting->time_end}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">10. Venue</label>
						    <input type="text" name="venue" id="venue" class="form-control" value="{{ $meeting->venue}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">11. Program Cost</label>
						    <input type="text" name="program_cost" id="program_cost" class="form-control"  value="{{ $meeting->program_cost}}">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    No of Youth Participated
	                  </span>
                </div>
                <br>		
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">12. Total Male</label>
						    <input type="number" name="total_male" id="total_male" class="form-control"  value="{{ $meeting->total_male}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">13. Total Female</label>
						    <input type="number" name="total_female" id="total_female" class="form-control" value="{{ $meeting->total_female}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">14. PWD Male</label>
						    <input type="number" name="pwd_male" id="pwd_male" class="form-control"  value="{{ $meeting->pwd_male}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">15. PWD Female</label>
						    <input type="number" name="pwd_female" id="pwd_female" class="form-control" value="{{ $meeting->pwd_female}}">
						</div>
	            	</div>
	            	
	            </div>	
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">16. Mode of Conduct</label>
						    <textarea class="textarea" name="mode_of_conduct" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $meeting->mode_of_conduct}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">17. Topics Discussed </label>
						    <textarea class="textarea" name="topics" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $meeting->topics}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">18. Deliverables</label>
						    <textarea class="textarea" name="deliverables" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $meeting->deliverables}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">19. No. of initial assessment forms collected</label>
	            			<input type="number" name="no_of_forms" class="form-control" value="{{ $meeting->no_of_forms}}">
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">20. Number of youth selected for BEC programs</label>
	            			<input type="number" name="no_of_selected_youth" class="form-control" value="{{ $meeting->no_of_selected_youth}}">
	            		</div>
	            	</div>
	            </div>

	            <div class="row">
	          		<div class="form-group col-md-6">

						<label for="family_id">Resourse Person</label>
										      
                        <div class="input-group">
                        
                        <input data-toggle="tooltip" data-placement="top" title="Search Resorse Person name and select" type="text" id="res_name" name="res_id" class="form-control" placeholder="Search Name of Resourse Person" value="{{ $meeting->r_name}}">
                        <div style="cursor: pointer" onclick="window.open('{{Route('activities/resourse-person')}}', '_blank');" class="input-group-prepend">
                          <span data-toggle="tooltip" data-placement="top" title="Add Resourse Person to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                        </div>  
                      </div>
                      <div id="res_list"></div>
                          <input type="hidden" id="resourse_person_id" name="resourse_person_id" value="{{$meeting->resourse_person_id}}">
					</div>
	          	</div>
              <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	           {{csrf_field()}}
				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
			</form>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	<div class="form-group">
  
	          			<table class="table table-striped" id="example1">
						  <thead>
						    <tr>
						      <th scope="col">Name</th>
						      <th scope="col">Gender</th>
						      <th scope="col">Designation</th>
						      <th scope="col">Institute</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($participants as $participant)
						    <tr>
						      <th>{{$participant->name}}</th>
						      <td>{{$participant->gender}}</td>
						      <td>{{$participant->designation}}</td>
						      <td>{{$participant->institute}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$participant->id}}" data-name="{{$participant->name}}" data-gender="{{$participant->gender}}" data-designation="{{$participant->designation}}" data-institute="{{$participant->institute}}" id="edit2"><i class="fa fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
						<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					      <div class="modal-dialog" role="document">
					        <div class="modal-content">
					          <div class="modal-header">
					            <h5 class="modal-title" id="exampleModalLongTitle">Update Participants Information</h5>
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					              <span aria-hidden="true">&times;</span>
					            </button>
					          </div>
					          <div class="modal-body">
					              <!-- form start -->
					                  
					              <form role="form" method="get" id="myForm1">
					                  {{ csrf_field() }}
					                  <div class="form-group">
					                    <label for="name">Name</label>
					                    <input type="text" class="form-control" id="name1" name="name" >
					                     
					                  </div>
					                  <div class="form-group">
					                    <label for="name">Gender</label>
					                    <input type="text" class="form-control" id="gender1" name="gender" >
					                  </div>

					                  <div class="form-group">
					                    <label for="name">Designation</label>
					                    <input type="text" class="form-control" id="designation1" name="designation" >
					                     
					                  </div>
					                  <div class="form-group">
					                    <label for="name">Institute</label>
					                    <input type="text" class="form-control" id="institute1" name="institute" >
					                     
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
					    <h5>Add a new participant (if you have missed)</h5>
						<table class="table table-borderless" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col">Name</th>
						      <th scope="col">Gender</th>
						      <th scope="col">Designation</th>
						      <th scope="col">Institute</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <form id="add-participant">
						      <th><input type="text" name="name" class="form-control name-list"></th>
						      <td><input type="text" name="gender" class="form-control position-list"></td>
						      <td><input type="text" name="designation" class="form-control branch-list"></td>
						      <td><input type="text" name="institute" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
						      <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	           				  {{csrf_field()}}
						  	  </form>
						    </tr>
						    
						  </tbody>
						</table>
						
	          	</div>	            
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

   	});


$(document).ready(function(){
     $("#kick").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activities/career-guidance/kick-off-edit',   
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
              toastr.success('Succesfully Updated Kick off events Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#kick")[0].reset();

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
//edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#gender1').val($(this).data('gender'));
        $('#designation1').val($(this).data('designation'));        
        $('#institute1').val($(this).data('institute'));        
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-kick-p',
                      
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

  //add participant
   $(document).ready(function(){
     $(document).on('click' , '#add2' ,function (){
        var form = $('#add-participant');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-part-kick',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully added a participant ! ', 'Congratulations', {timeOut: 5000});
              $("#add-participant")[0].reset();
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