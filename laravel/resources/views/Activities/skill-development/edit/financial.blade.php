@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Financial assistance to follow VT/Professional courses - Edit</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Youths</a></li>
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
								<option value="">{{$meeting->district}}</option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dsd">2. DSD </label>
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
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">6. Program Date</label>
						    <input type="date" name="program_date" id="program_date" class="form-control" value="{{$meeting->program_date}}">
						</div>
	            	</div>
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">7. Cost of the support </label>
						    <input type="nymber" name="cost" id="cost" class="form-control" value="{{$meeting->cost}}">
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
						    <label for="dm_name">8. Institute </label> 
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search Institute name and select" type="text" id="ins_name" name="res_id" class="form-control" placeholder="Search Name of Institute" value="{{$meeting->institute_name}}">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('institutes/view')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add an institute to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="is_list"></div>
                          <input type="hidden" id="institute_id" name="institute_id" value="{{$meeting->institute_id}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="institutional_review">9.Institutional review done ?</label>
						    <select name="institutional_review" id="institutional_review" class="form-control">
								<option value="">Select Option</option>
								<option @if($meeting->institutional_review=="Yes") selected @endif @if($meeting->institutional_review=="Yes") selected @endif value="Yes">Yes</option>
								<option @if($meeting->institutional_review=="No") selected @endif value="No">No</option>
								
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
						    <label for="dm_name">10. Course </label>
						    <div class="input-group">                       
		                        <input data-toggle="tooltip" data-placement="top" title="Search course name and select" type="text" id="course_name" name="res_id" class="form-control" placeholder="Search Name of Course" value="{{$meeting->course_name}}">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                     </div>
                      	<div id="course_list"></div>
                          <input type="hidden" id="course_id" name="course_id" value="{{$meeting->course_id}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="start_date">11. Start Date ?</label>
						    <input type="date" name="start_date" id="start_date" class="form-control" value="{{$meeting->start_date}}">

						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="start_date">12. Expected date of completion ?</label>
						    <input type="date" name="end_date" id="end_date" class="form-control" value="{{$meeting->end_date}}">

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
						    <label for="dm_name">13. Total Male</label>
						    <input type="number" name="total_male" id="total_male" class="form-control" value="{{$meeting->total_male}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
	            		<div class="form-group">
						    <label for="dm_name">14. Total Female</label>
						    <input type="number" name="total_female" id="total_female" class="form-control" value="{{$meeting->total_female}}">
						</div>
	            	</div>
	            	<div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">15. PWD Male</label>
		                	<input type="number" name="pwd_male" id="pwd_male" class="form-control" value="{{$meeting->pwd_male}}">
		            	</div>
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                	<label for="dm_name">16. PWD Female</label>
		                	<input type="number" name="pwd_female" id="pwd_female" class="form-control" value="{{$meeting->pwd_female}}">
		            	</div>
		            </div>
	            </div>	
              <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	           {{csrf_field()}}
				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Update</button>
			</form>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	
	          	<div class="form-group">
  
	          			<table class="table table-borderless" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col">Youth ID</th>
						      <th scope="col">Approved Amount</th>
						      <th scope="col">No of Installments</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($youths as $youth)
						    <tr>
						      <th>{{$youth->name}}</th>
						      <td style="text-align: center">{{$youth->approved_amount}}</td>
						      <td>{{$youth->installments}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$youth->f_id}}" data-approved_amount="{{$youth->approved_amount}}" data-installments="{{$youth->installments}}" data-dropout="{{$youth->dropout}}" data-reoson="{{$youth->reoson_to_dropout}}" id="edit2"><i class="fas fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
						<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					      <div class="modal-dialog" role="document">
					        <div class="modal-content">
					          <div class="modal-header">
					            <h5 class="modal-title" id="exampleModalLongTitle">Update Youth Information</h5>
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					              <span aria-hidden="true">&times;</span>
					            </button>
					          </div>
					          <div class="modal-body">
					              <!-- form start -->
					                  
					              <form role="form" method="get" id="myForm1">
					                  {{ csrf_field() }}
					                  
					                  <div class="form-group">
					                    <label for="name">Approved Amount</label>
					                    <input type="number" class="form-control" id="approved_amount1" name="approved_amount" >
					                  </div>
					                 <div class="form-group">
					                    <label for="name">No of Installments</label>
					                    <input type="number" class="form-control" id="installments1" name="installments" >
					                  </div>
					                 <div class="form-group">
					                    <label for="name">is Youth Dropout ?</label>
					                    <select name="dropout" class="form-control" id="dropout1">
									      	<option value="">Select Option</option>
									      	<option value="1">Yes</option>
									      	<option value="0">No</option>
									    </select>
					                     
					                  </div>
					                  <div class="form-group">
					                 	<label for="name">If yes reoson to dropout</label>
					                 	<textarea class="form-control" name="reoson_to_dropout" id="reason1"></textarea>
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
					    <br>
					    <br>
					    <h5>Add youths if you have missed</h5>
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
						<table class="table table-borderless" id="dynamic_field">
						  <thead>
						    <tr>
						      <th scope="col">Youth ID</th>
						      <th scope="col">Approved Amount</th>
						      <th scope="col">No of Installments</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <form id="add-youth">						      
						      <th><input type="number" name="youth_id" class="form-control"></th>
						      <td><input type="number" name="approved_amount" class="form-control position-list"></td>
						      <td><input type="number" name="installments" class="form-control position-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
						      <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">
              				  <input type="hidden" id="edate" name="edate" value="{{$meeting->end_date}}">
							  
	           				  {{csrf_field()}}
						      </form>
						    </tr>
						    
						  </tbody>
						</table>
						
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
     $("#course_support").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-finacial-support',   
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
              toastr.success('Succesfully update Course Support Details ! ', 'Congratulations', {timeOut: 5000});
			  $("#course_support")[0].reset();

            }
            else{
            $('#loading').hide();
               toastr.error('May be youth details are mismatched !', 'Something Error !');	
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
$(document).ready(function(){
//institutte review
   $('#review_report').keyup(function(){ 
          var query = $(this).val();
          if(query != '')
          {
           var _token = $('input[name="_token"]').val();
           $.ajax({
            url: SITE_URL + '/review_report_list',
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
             $('#review_list').fadeIn();  
             $('#review_list').html(data);
            }
           });
          }
      });

      $(document).on('click', '#review_reports li', function(){  
        $('#review_list').fadeOut(); 
          $('#review_report').val($(this).text()); 
          var ins_id = $(this).attr('id');
          $('#review_report1').val(ins_id);
           
      });  
});

//edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#approved_amount1').val($(this).data('approved_amount'));
        $('#installments1').val($(this).data('installments'));
        $('#dropout1').val($(this).data('dropout'));
         $('#reason1').val($(this).data('reoson'));
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-youth-finacial',
                      
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

//add youth
   $(document).ready(function(){
     $(document).on('click' , '#add2' ,function (){
        var form = $('#add-youth');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-new-finacial-youth',
                      
            data: form.serialize(),

            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },          
            success: function(data) {
              if($.isEmptyObject(data.error)){              
              toastr.success('Succesfully added a youth ! ', 'Congratulations', {timeOut: 5000});
              $("#add-youth")[0].reset();
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
  #autocomplete, #institute, #course, #youths,#review_reports {
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
#autocomplete,  #institute, #course, #youths, #review_reports> li {
  padding: 3px 20px;
}
#autocomplete, #institute, #course, #youths, #review_reports > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection