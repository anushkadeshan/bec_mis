@extends('layouts.main')
@section('content')
<div class="container">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Awareness on work place conditions </h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Attachments</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="aware" id="aware" method="post" enctype="multipart/form-data">
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
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
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
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">6. Program Date</label>
						    <input type="date" name="program_date" id="meeting_date" class="form-control" value="{{$meeting->program_date}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">7. Time Start</label>
						    <input type="time" name="time_start" id="time_start" class="form-control" value="{{$meeting->time_start}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">8. Time End</label>
						    <input type="time" name="time_end" id="time_end" class="form-control" value="{{$meeting->time_end}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">9. Venue</label>
						    <input type="text" name="venue" id="venue" class="form-control" value="{{$meeting->venue}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">10. Program Cost</label>
						    <input type="text" name="cost" id="program_cost" class="form-control" value="{{$meeting->cost}}">
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
						    <label for="dm_name">11. Total Male</label>
						    <input type="number" name="total_male" id="total_male" class="form-control" value="{{$meeting->total_male}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">12. Total Female</label>
						    <input type="number" name="total_female" id="total_female" class="form-control" value="{{$meeting->total_female}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">13. PWD Male</label>
						    <input type="number" name="pwd_male" id="pwd_male" class="form-control" value="{{$meeting->pwd_male}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">14. PWD Female</label>
						    <input type="number" name="pwd_female" id="pwd_female" class="form-control" value="{{$meeting->pwd_female}}">
						</div>
	            	</div>
	            	
	            </div>	
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">19. Mode of Awareness</label>
						    <textarea class="textarea" name="mode_of_awareness" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->mode_of_awareness}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">20. Topics Covered </label>
						    <textarea class="textarea" name="topics" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->topics}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">21. Deliverables</label>
						    <textarea class="textarea" name="deliverables" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->deliverables}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="card card-info card-outline">
	                <div class="card-body">
	                	<div class="row">
	            			<div class="col-md-4">
	            				<div class="form-group">
                    				<label for="part_time">22. If any exposure visits conducted ?</label>
                    				<select name="exposure_visit" id="exposure_visit" class="form-control">
				                      <option value="">Select Option</option>
				                      <option @if($meeting->exposure_visit=="Yes") selected @endif value="Yes">Yes</option>
                					  <option @if($meeting->exposure_visit=="No") selected @endif value="No">No</option>
                    				</select>
                    			</div>
	            			</div>
	            		</div>
	            		<div class="row" id="hide" @if($meeting->exposure_visit=="No") style="display:none" @endif>
	            			<div class="col-md-4">
	            				<div class="form-group">
                    				<label for="part_time">Place of visit (Name & address)</label>
                    				<textarea id="place" name="palce" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->palce}}</textarea>
                    			</div>
	            			</div>
	            			<div class="col-md-4">
	            				<div class="form-group">
                    				<label for="part_time">Any demonstrations done (please describe)</label>
                    				<textarea id="demonstraion" name="demonstraion" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->demonstraion}}</textarea>
                    			</div>
	            			</div>
	            			<div class="col-md-4">
	            				<div class="form-group">
                    				<label for="part_time">Matters discussed (Please describe)</label>
                    				<textarea id="matters_discussed" name="matters_discussed" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->matters_discussed}}</textarea>
                    			</div>
	            			</div>
	            		</div>
	                </div>
            	</div>
            	<div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">23. Any concerns raised by the job seekers</label>
						    <textarea class="textarea" name="any_concerns" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->any_concerns}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	           {{csrf_field()}}
               <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Update</button>
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
      $(document).on('change' , '#exposure_visit', function (){
		var status = $(this).children("option:selected").val();

		if(status=="Yes"){
			$('#hide').show();
		}

		else{
			$('#hide').hide();
			$('#place').val("");
			$('#demonstraion').val("");
			$('#matters_discussed').val("");


		}

      }); 
 });
$(document).ready(function(){
     $("#aware").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/job-linking/update-awareness',   
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
              toastr.success('Succesfully Add Awareness Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#aware")[0].reset();

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