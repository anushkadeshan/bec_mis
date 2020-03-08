@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Material support for CIC units </h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Meterial Supports</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form name="pes" id="pes" method="post" enctype="multipart/form-data">
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
								<option value="">{{$meeting->dsd}}</option>

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
						    <label for="dm_name">6. Date of gap identification visit to the PES unit</label>
						    <input type="date" name="visit_date" id="date" class="form-control" value="{{$meeting->visit_date}}">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="support_date">7. Date of material transfer to PES unit</label>
						    <input type="date" name="program_date" id="date" class="form-control" value="{{$meeting->program_date}}">
						</div>
	            	</div>

	            </div>
	            
                <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">8.	Type of gaps identified in the PES unit (please put numbers & describe)</label>
						    <textarea class="textarea" name="gaps" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$meeting->gaps}}</textarea>
						</div>
	            	</div>
	            	
	            </div>

	            <div class="form-group col-md-4">

						<label for="family_id">Completion report-Gap identification</label>
										      
                        <div class="input-group">
                        
                        <input data-toggle="tooltip" data-placement="top" title="Search Completion report-Gap identification and select" type="text" id="pes_name" name="res_id" class="form-control" placeholder="Search and select" value="{{$meeting->pdsd}} ({{$meeting->pdate}})"> 
                      </div>
                      <div id="res_list"></div>
                          <input type="hidden" id="pes_identification_id" name="pes_identification_id" value="{{$meeting->pes_identification_id}}">
					</div>
              <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	            {{csrf_field()}}
				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>	
	            </form>
	           
	          </div>
	          <div class="tab-pane" id="tab_2">
	          <div class="row">
	          	<div style="width: 100%; height: 20px; border-bottom: 1px solid blue; text-align: center;padding-bottom: 10px">
	                  <span class="badge badge-info" style="font-size: 20px; padding: 0 10px; ">
	                    9. Materials provided for particular PES unit
	                  </span>
                </div>
                <br> <br>
	           
  
	          			<table class="table table-striped" id="example1">
						  <thead>
						    <tr>
						      <th scope="col" width="85">Gap number as mentioned in the section 8 above </th>
						      <th scope="col">Materials provided </th>
						      <th scope="col" width="85">No. of units</th>
						      <th scope="col">Usage of the material</th>
						      <th scope="col">Date provided</th>
						      <th scope="col">Cost (Rs.)</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($gaps as $gap)
						    <tr>
						      <td>{{$gap->gap_num}}</td>
						      <td>{{$gap->meterials_provided}}</td>
						      <td>{{$gap->units}}</td>
						      <td>{{$gap->usage}}</td>
						      <td>{{$gap->date_provided}}</td>
						      <td>{{$gap->cost}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$gap->id}}" data-meterials_provided="{{$gap->meterials_provided}}" data-units="{{$gap->units}}" data-usage="{{$gap->usage}}" data-date_provided="{{$gap->date_provided}}" data-cost="{{$gap->cost}}" id="edit2"><i class="fa fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
						<h5>Add a new participant (if you have missed)</h5>	
						<table class="table table-borderless" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col" width="85">Gap number as mentioned in the section 8 above </th>
						      <th scope="col">Materials provided </th>
						      <th scope="col" width="85">No. of units</th>
						      <th scope="col">Usage of the material</th>
						      <th scope="col">Date provided</th>
						      <th scope="col">Cost (Rs.)</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	<form id="add-gaps">
						  		{{csrf_field()}}
						    <tr>
						      <td><input type="number" name="gap_num" class="form-control name-list"></td>
						      <td><input type="text" name="meterials_provided" class="form-control position-list"></td>
						      <td><input type="number" name="units" class="form-control branch-list"></td>
						      <td><input type="text" name="usage" class="form-control branch-list"></td>
						      <td><input type="date" name="date_provided" class="form-control branch-list"></td>
						      <td><input type="number" name="cost" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
						    </tr>
	           				
              				<input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

						    </form>
						  </tbody>
						</table>
						<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					      <div class="modal-dialog" role="document">
					        <div class="modal-content">
					          <div class="modal-header">
					            <h5 class="modal-title" id="exampleModalLongTitle">Update Gaps Information</h5>
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					              <span aria-hidden="true">&times;</span>
					            </button>
					          </div>
					          <div class="modal-body">
					              <!-- form start -->
					                  
					              <form role="form" method="get" id="myForm1">
					                  {{ csrf_field() }}
					                  <div class="form-group">
					                    <label for="name">Materials provided</label>
					                    <input type="text" class="form-control" id="meterials_provided1" name="meterials_provided" >
					                     
					                  </div>
					                  <div class="form-group">
					                    <label for="name">No. of units</label>
					                    <input type="text" class="form-control" id="units1" name="units" >
					                  </div>

					                  <div class="form-group">
					                    <label for="name">Usage of the material</label>
					                    <input type="text" class="form-control" id="usage1" name="usage" >
					                     
					                  </div>
					                  <div class="form-group">
					                    <label for="name">Date provided</label>
					                    <input type="text" class="form-control" id="date_provided1" name="date_provided" >
					                     
					                  </div>
					                  <div class="form-group">
					                    <label for="name">Cost (Rs.)</label>
					                    <input type="text" class="form-control" id="cost1" name="cost" >
					                     
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
   });
$(document).ready(function(){
//search resourse Person
			 $('#pes_name').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/pes_list',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#res_list').fadeIn();  
			           $('#res_list').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#dsds li', function(){  
			    	$('#res_list').fadeOut(); 
			        $('#pes_name').val($(this).text()); 
			        var res_id = $(this).attr('id');
			        $('#pes_identification_id').val(res_id);
			         
			    });  

   	  $(document).on('click','#next', function(){
   	  	$('#tabs a[href="#tab_2"]').tab('show');
   	  });

   	});

$(document).ready(function(){
     $("#pes").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activities/career-guidance/pes-support-update',   
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
              toastr.success('Succesfully updated Material support for PES units Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#pes")[0].reset();

            }
            else{
             printValidationErrors(data.error);
              
            }         
        },

            error: function (jqXHR, exception, data) {    
                console.log(jqXHR);
            	toastr.error('Error !', ""+data.errors+"");

                toastr.error('Error !', 'Please check if all the fields are filled')
            },
        });
    });
  });
 
 function printValidationErrors(msg){
        $.each(msg, function(key,value){
        	toastr.error('Validation Error !', ""+value+"");
        });
    }
//edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#meterials_provided1').val($(this).data('meterials_provided'));
        $('#usage1').val($(this).data('usage'));
        $('#units1').val($(this).data('units'));
        $('#date_provided1').val($(this).data('date_provided'));        
        $('#cost1').val($(this).data('cost'));        
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/update-pes-s',
                      
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
        var form = $('#add-gaps');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-gap-pes',
                      
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
              $("#add-gaps")[0].reset();
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
	#autocomplete, #dsds {
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
#autocomplete,  #dsds > li {
  padding: 3px 20px;
}
#autocomplete, #dsds > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}

tr td {
  padding: 1px !important;
  margin: 1px !important;

}
</style>
@endsection