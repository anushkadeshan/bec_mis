@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Completion Report for attending BMIC regional meeting - Edit</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Participants</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<form name="regional_meeting" id="regional_meeting">
	          	<div class="row">
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="">Select Option</option>
								
								<option selected  value="{{ $meeting->district}}">{{ $meeting->district }}</option>
							
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
						    {{ $meeting->dsd}}
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dm_name">3. District Manager</label>
						    <select name="dm_name" id="dm_name" class="form-control">
								<option value="">Select Option</option>
								<option selected value="{{ $meeting->dm_name}}">{{ $meeting->dm_name }}</option>
    					   </select>
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">6. Meeting Date</label>
						    <input type="date" value="{{$meeting->meeting_date}}" name="meeting_date" id="meeting_date" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Time Start</label>
						    <input type="time" value="{{$meeting->time_start}}" name="time_start" id="time_start" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">8. Time End</label>
						    <input type="time" value="{{$meeting->time_end}}" name="time_end" id="time_end" class="form-control">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">9. Venue</label>
						    <input type="text" value="{{$meeting->venue}}" name="venue" id="venue" class="form-control">
						</div>
	            	</div>
	            </div>	
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">10. Matters discussed</label>
						    <textarea class="textarea" name="matters" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          	{{$meeting->matters}}
                          </textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">11. Decisions agreed (If any)</label>
						    <textarea name="decisions" rows="4"  class="form-control">{{$meeting->decisions}}</textarea>
						</div>
	            	</div>	
	            	<div class="col-md-6">
	            		<div class="form-group">
						    <label for="dm_name">12. Matters to be further followed up</label>
						    <textarea name="decisions_to_followed" rows="4" class="form-control">{{$meeting->decisions_to_followed}}</textarea>
						</div>
	            	</div>            	
	            </div>
	            <input type="hidden" id="r_id" name="r_id" value="{{$meeting->r_id}}">
	           {{csrf_field()}}
						<button type="button" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Update</button>
	          </div>
	          <!-- /.tab-pane -->
	          </form>
	          <div class="tab-pane" id="tab_2">
	          	<div class="form-group">
	          			<table id="example1" class="table table-striped" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col">Name</th>
						      <th scope="col">Position</th>
						      <th scope="col">Branch</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  @foreach($participants as $participant)	
						    <tr>
						      <td>{{$participant->name}}</td>
						      <td>{{$participant->position}}</td>
						      <td>{{$participant->branch}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$participant->id}}" data-name="{{$participant->name}}" data-position="{{$participant->position}}" data-branch="{{$participant->branch}}" id="edit2"><i class="fa fa-edit"></i></button></td>
						    </tr>
						  @endforeach  
						  </tbody>
						</table>
						<h5>Add New Participant ( if you missed )</h5>
	          			<table class="table table-borderless">
						  <thead>
						    <tr>
						      <th scope="col">Name</th>
						      <th scope="col">Position</th>
						      <th scope="col">Branch</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	<form  method="post" id="add-participant">
						    <tr>
						      <th><input type="text" name="name" class="form-control name-list"></th>
						      <td><input type="text" name="position" class="form-control position-list"></td>
						      <td><input type="text" name="branch" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
						    </tr>
                  			{{ csrf_field() }}

	            				<input type="hidden" name="r_id" value="{{$meeting->r_id}}">

						    </form>
						  </tbody>
						</table>
						
	          	</div>
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
                    <label for="name">Position</label>
                    <input type="text" class="form-control" id="phone1" name="position" >
                     
                  </div>

                  <div class="form-group">
                    <label for="name">Branch</label>
                    <input type="text" class="form-control" id="branch1" name="branch" >
                     
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

   	});


 $(document).ready(function(){
     $(document).on('click' , '#submit' ,function (){
        var form = $('#regional_meeting');

        //alert("you are submitting" + $(form).serialize());
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/education/edit-meeting',
                      
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
			  $("#regional_meeting")[0].reset();

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

  //edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#phone1').val($(this).data('position'));
        $('#branch1').val($(this).data('branch'));
        
        $('#updateModel').modal('show');
        
    });
 //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/education/update-meeting',
                      
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
            url: SITE_URL + '/activity/education/add-part',
                      
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