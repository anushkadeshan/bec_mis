@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Gap identification of CIC unit - Edit</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="pes" id="pes" method="post" enctype="multipart/form-data">
	        <div class="tab-content">
	          <div class="tab-pane active" id="tab_1">
	          	<div class="row">
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="district">1. District</label>
						    <select name="district" id="district" class="form-control" data-dependent="dsd">
								<option value="">{{$meeting->district}}</option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
						    <select name="dsd" id="dsd" class="form-control">
								<option value="">{{$meeting->dsd}}</option>
								
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
	          				<label for="gn_division">3. GN Divisions Covered</label><br>
    						{{$meeting->gnd}}
   						</div>
	          		</div>
	          		<div class="col-md-3">
	          			<div class="form-group">
						    <label for="dm_name">4. District Manager</label>
						    <select name="dm_name" id="dm_name" class="form-control">
								<option value="">{{$meeting->dm_name}}</option>
    					   </select>
						</div>
	          		</div>
	          	</div>
	            <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">7. Date of visit to the PES unit</label>
						    <input type="date" name="program_date" id="date" class="form-control" value="{{$meeting->program_date}}">
						</div>
	            	</div>

	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Responding Officer
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">8. Name</label>
						    <input type="text" name="responding_officer_name" id="responding_officer_name" class="form-control"  value="{{$meeting->responding_officer_name}}">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">9. Designation</label>
						    <input type="text" name="responding_officer_des" id="responding_officer_des" class="form-control" value="{{$meeting->responding_officer_des}}">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">10. Contact details</label>
						    <input type="text" name="responding_officer_contacts" id="responding_officer_contacts" class="form-control" value="{{$meeting->responding_officer_contacts}}">
						</div>
	            	</div>

	            </div>

                <div class="row">
	            	<div class="col-md-9">
	            		<div class="form-group">
						    <label for="dm_name">11. Type of services rendered through the unit (please put numbers & describe)</label>
						    <textarea class="textarea" name="type_of_services" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->type_of_services}}</textarea>
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="records">12. Do you have the records of youth catered during last six months ?</label>
						    <select name="records" id="records" class="form-control">
								<option value="">Select Option</option>
								<option @if($meeting->records=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->records=="No") selected @endif value="No">No</option>
								<option @if($meeting->records=="Incomplete") selected @endif value="Incomplete">Incomplete</option>
								
    					   </select>
						</div>
	            	</div>	            	
	            </div>	
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    No of Youth Catered
	                  </span>
                </div>
                <br>	
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">13. Total Male (18-24)</label>
						    <input type="number" name="male_18_24" id="male_18_24" class="form-control"  value="{{$meeting->male_18_24}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">14. Total Male (25-30)</label>
						    <input type="number" name="male_25_30" id="male_25_30" class="form-control" value="{{$meeting->male_25_30}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">15. Total Male (>30)</label>
						    <input type="number" name="male_30" id="male_30" class="form-control" value="{{$meeting->male_30}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">15. No of PWD Male</label>
						    <input type="number" name="pwd_male" id="pwd_male" class="form-control" value="{{$meeting->pwd_male}}">
						</div>
	            	</div>
	            </div>	
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">16. Total Female (18-24)</label>
						    <input type="number" name="female_18_24" id="female_18_24" class="form-control" value="{{$meeting->female_18_24}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">17. Total Female (25-30)</label>
						    <input type="number" name="female_25_30" id="female_25_30" class="form-control" value="{{$meeting->female_25_30}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">18. Total Female (>30)</label>
						    <input type="number" name="female_30" id="female_30" class="form-control" value="{{$meeting->female_30}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">19. No of PWD Female</label>
						    <input type="number" name="pwd_female" id="pwd_female" class="form-control" value="{{$meeting->pwd_female}}">
						</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    18. Details of most demanding services by youth
	                  </span>
                </div>
                <br>
	           <div class="row">
	           	  <div class="form-group">
  
	          			<table class="table table-striped" id="dynamic_field">
						  <thead>
						    <tr>
						      <th width="500" scope="col">Male</th>
						      <th width="500" scope="col">Female</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($services as $service)
						    <tr>
						      <td>{{$service->male}}</td>
						      <td>{{$service->female}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$service->id}}" data-male="{{$service->male}}" data-female="{{$service->female}}" id="edit2"><i class="fa fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>

	          	</div>
	           </div>
	           <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    19. Gaps identified in the unit for delivering the services
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Unit is available at divisional secretariat</label>
	            			<select name="unit_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->unit_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->unit_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Separate space is given in the DS office for unit</label>
	            			<select name="space_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->space_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->space_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Sufficient stationary is available at the unit</label>
	            			<select name="stationary_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->stationary_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->stationary_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            </div>
	            <br>
	            <h5>Does following materials available sufficiently in the unit ? </h5>
	            <div class="row">
	            	<div class="col-md-3">
	            		<div class="form-group">
	            			<label for="">Office chairs</label>
	            			<select name="chairs_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->chairs_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->chairs_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
	            			<label for="">Office tables</label>
	            			<select name="tables_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->tables_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->tables_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
	            			<label for="">Office cupboards</label>
	            			<select name="cupboards_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->cupboards_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->cupboards_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
	            			<label for="">Stationary items</label>
	            			<select name="stationary_items_available" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->stationary_items_available=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->stationary_items_available=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">If you lack any of the above materials please mention your requirement of each item:</label>
						    <textarea class="textarea" name="lack_of_items" placeholder="Requirement (amount)"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->lack_of_items}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
	            			<label for="staff">How many staffs attached to the unit at the moment?</label>
						    <input type="number" name="staff" id="staff" class="form-control" value="{{$meeting->staff}}">
	            			
	            		</div>
	            	</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
	            			<label for="">Does the existing staff sufficient?</label>
	            			<select name="sufficient_staff" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->sufficient_staff=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->sufficient_staff=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">If not sufficient what is the additional requirement of staff?</label>
						    <textarea class="textarea" name="additional_staff" placeholder="Capacity (requirment)"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->additional_staff}}</textarea>
						</div>
	            	</div>	            	
	            </div>
	            
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    VT Database
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Do you maintain a VT database?</label>
	            			<select name="vt_database" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->vt_database=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->vt_database=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Is the database updated during last six months?</label>
	            			<select name="update_vt" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->update_vt=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->update_vt=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">If not when was it last updated?</label>
	            			<input type="date" name="last_updated_vt" class="form-control" value="{{$meeting->last_updated_vt}}">
	            		</div>
	            	</div>
	            </div>
	            <div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    Job Database
	                  </span>
                </div>
                <br>
                <div class="row">
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Do you maintain a Job database?</label>
	            			<select name="job_database" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->job_database=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->job_database=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">Is the database updated during last six months?</label>
	            			<select name="update_job" class="form-control">
	            				<option value="">Select Option</option>
	            				<option @if($meeting->update_job=="Yes") selected @endif value="Yes">Yes</option>
	            				<option @if($meeting->update_job=="No") selected @endif value="No">No</option>
	            				
	            			</select>
	            		</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
	            			<label for="">If not when was it last updated?</label>
	            			<input type="date" name="last_updated_job" class="form-control" value="{{$meeting->last_updated_job}}">
	            		</div>
	            	</div>

	            </div>
	            <div class="row">
		            	<div class="col-md-12">
		            		<div class="form-group">
							    <label for="dm_name">Any particular reason for not updating the VT/Job database:</label>
							    <textarea class="textarea" name="reasons_to_not_update" placeholder="Enter some tetx here"
	                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->reasons_to_not_update}}</textarea>
							</div>
		            	</div>	            	
	            	</div>
	            	<div class="row">
		            	<div class="col-md-12">
		            		<div class="form-group">
							    <label for="dm_name">Any other gaps in delivering the service:</label>
							    <textarea class="textarea" name="gaps" placeholder="Enter some tetx here"
	                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->gaps}}</textarea>
							</div>
		            	</div>	            	
	            	</div>
	          	{{csrf_field()}}
              <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

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
	<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					      <div class="modal-dialog" role="document">
					        <div class="modal-content">
					          <div class="modal-header">
					            <h5 class="modal-title" id="exampleModalLongTitle">Update Services Information</h5>
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					              <span aria-hidden="true">&times;</span>
					            </button>
					          </div>
					          <div class="modal-body">
					              <!-- form start -->
					                  
					              <form role="form" method="get" id="myForm1">
					                  {{ csrf_field() }}
					                  <div class="form-group">
					                    <label for="name">Male</label>
					                    <input type="text" class="form-control" id="male1" name="male" >
					                     
					                  </div>
					                  <div class="form-group">
					                    <label for="name">Female</label>
					                    <input type="text" class="form-control" id="female1" name="female" >
					                  </div>
					                  <input type="hidden" id="id_p" name="id_p"></input>
					              
					          </div>
					          <div class="modal-footer">
					            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					            <button type="button" id="update-part" class="btn btn-primary">Update changes</button>
					        </form>
					          </div>
					        </div>
					      </div>
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
     $("#pes").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activities/career-guidance/pes-update',   
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
              toastr.success('Succesfully Updated PES units identification Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#pes")[0].reset();

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
        $('#male1').val($(this).data('male'));
        $('#female1').val($(this).data('female'));     
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-pes',
                      
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