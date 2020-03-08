@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Job Interviews</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Employers</a></li>
	          <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Youths</a></li>
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
								<option value="">{{$meeting->district}}</option>
    					   </select>
						</div>
	          		</div>
	          		<div class="col-md-4">
	          			<div class="form-group">
						    <label for="dsd">2. DSD (Leave blank if not relevant)</label>
						    <select name="dsd[]" id="dsd" class="form-control" multiple>
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
						    <input type="date" name="program_date" id="program_date" class="form-control" value="{{$meeting->program_date}}">
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
						    <input type="text" name="program_cost" id="program_cost" class="form-control" value="{{$meeting->program_cost}}">
						</div>
	            	</div>
	            </div>	

               <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	           {{csrf_field()}}
				<button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;Update</button>
			   </form>
	          </div>
	          <!-- /.tab-pane -->
	          
	          <div class="tab-pane" id="tab_2">
	          	
	          	<div class="form-group">
  
	          			<table class="table table-striped" id="example1">
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
						  	@foreach($employers as $employer)
						    <tr>
						      <th>{{$employer->name}}</th>
						      <td>{{$employer->vacancies}}</td>
						      <td>{{$employer->total_male}}</td>
						      <td>{{$employer->total_female}}</td>
						      <td>{{$employer->pwd_male}}</td>
						      <td>{{$employer->pwd_female}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$employer->e_id}}" data-vacancies="{{$employer->vacancies}}" data-total_male="{{$employer->total_male}}" data-total_female="{{$employer->total_female}}" data-pwd_male="{{$employer->pwd_male}}" data-pwd_female="{{$employer->pwd_female}}"  id="edit2"><i class="fas fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
						<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Update Employer Information</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                            
                        <form role="form" method="get" id="myForm1">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                              <label for="name">Vacancies offered on the date if interviewed</label>
                              <input type="text" class="form-control" id="vacancies1" name="vacancies" >
                            </div>
                            <div class="form-group">
                              <label for="name">Male</label>
                              <input type="number" class="form-control" id="total_male1" name="total_male" >
                            </div>
                            <div class="form-group">
                              <label for="name">Female</label>
                              <input type="number" class="form-control" id="total_female1" name="total_female" >
                            </div>
                            <div class="form-group">
                              <label for="name">PWD Male</label>
                              <input type="number" class="form-control" id="pwd_male1" name="pwd_male" >
                            </div>
                            <div class="form-group">
                              <label for="name">PWD Female</label>
                              <input type="number" class="form-control" id="pwd_female1" name="pwd_female" >
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
              <h5>Add Employers if you have missed</h5>
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
						  	<form id="add-employer">
						    <tr>
						      <th><input type="text" name="employer_id" class="form-control name-list"></th>
						      <td><input type="text" name="vacancies" class="form-control position-list"></td>
						      <td><input type="text" name="total_male" class="form-control branch-list"></td>
						      <td><input type="text" name="total_female" class="form-control branch-list"></td>
						      <td><input type="text" name="pwd_male" class="form-control branch-list"></td>
						      <td><input type="text" name="pwd_female" class="form-control branch-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add2">Add</button></td>
						    </tr>
						    <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	           				{{csrf_field()}}
						  </form>
						  </tbody>
						</table>
						
	          	</div>
	          	<button type="button" id="res" class="btn btn-info btn-flat">Next</button>	
	            
	          </div>
	          <div class="tab-pane" id="tab_3">
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
  
	          			<table class="table table-striped" id="example1">
						  <thead>
						    <tr>
						      <th scope="col">Youth ID</th>
						      <th scope="col">Type of Support By BEC</th>
						      <th scope="col">Employer</th>
						      <th scope="col">Vacancy Placed</th>
						      <th scope="col">Salary</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($youths as $youth)
						    <tr>
						      <th>{{$youth->name}}</th>
						      <td>{{$youth->type_of_support}}</td>
						      <td>{{$youth->employer_name}}</td>
						      <td>{{$youth->vacancies}}</td>
						      <td>{{$youth->salary}}</td>
						      <td><button type="button" class="btn btn-success btn-flat btn-sm" data-id="{{$youth->y_id}}" data-type_of_support="{{$youth->type_of_support}}" data-employer="{{$youth->employer}}" data-vacancies="{{$youth->vacancies}}" data-salary="{{$youth->salary}}" id="edit3"><i class="fas fa-edit"></i></button></td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
						<div class="modal fade" id="updateModel1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            
                        <form role="form" method="get" id="myForm2">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                              <label for="name">Type of Support By BEC</label>
                              <input type="text" class="form-control" id="type_of_support1" name="type_of_support" >
                            </div>
                            <div class="form-group">
                              <label for="name">Employer</label>
                              <input type="text" class="form-control" id="employer1" name="employer" disabled >
                            </div>
                            <div class="form-group">
                              <label for="name">Vacancy Placed</label>
                              <input type="text" class="form-control" id="vacancies2" name="vacancies" >
                            </div>
                            <div class="form-group">
                              <label for="name">Salary</label>
                              <input type="text" class="form-control" id="salary1" name="salary" >
                            </div>

                            <input type="hidden" id="id_y" name="id_p"></input>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" id="update-part1" class="btn btn-primary">Update changes</button>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <h5>Add youths if you have missed</h5>
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
						  	<form id="add-youth">
						    <tr>
						      <th><input type="text" name="youth_id" class="form-control name-list"></th>
						      <td><input type="text" name="type_of_support" class="form-control position-list"></td>
						      <td  data-toggle="tooltip" data-placement="top" title="Search Employer ID from Previous Tab"><input type="number" name="employer" class="form-control position-list"></td>
						      <td><input type="text" name="vacancies" class="form-control position-list"></td>
						      <td><input type="text" name="salary" class="form-control position-list"></td>
						      <td><button type="button" class="btn btn-success btn-flat" id="add3">Add</button></td>
						    </tr>
						    <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">

	           				{{csrf_field()}}
						    </form>
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
     $("#res_person").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/job-linking/update-placement',   
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
              toastr.success('Succesfully Updated Job Placements Details ! ', 'Congratulations', {timeOut: 5000});
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

//edit 

  $(document).on('click', '#edit2', function(){
        var id = $(this).data('id');
        $('#id_p').val($(this).data('id'));
        $('#vacancies1').val($(this).data('vacancies'));
        $('#total_male1').val($(this).data('total_male'));
        $('#total_female1').val($(this).data('total_female'));
        $('#pwd_male1').val($(this).data('pwd_male'));
        $('#pwd_female1').val($(this).data('pwd_female'));
        $('#updateModel').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part' ,function (){
        var form = $('#myForm1');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-employer',
                      
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
        var form = $('#add-employer');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/add-new-employer',
                      
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
              $("#add-employer")[0].reset();
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


//edit 

  $(document).on('click', '#edit3', function(){
        var id = $(this).data('id');
        $('#id_y').val($(this).data('id'));
        $('#type_of_support1').val($(this).data('type_of_support'));
        $('#employer1').val($(this).data('employer'));
        $('#vacancies2').val($(this).data('vacancies'));
        $('#salary1').val($(this).data('salary'));
        $('#updateModel1').modal('show');
        
    });

  //update
   $(document).ready(function(){
     $(document).on('click' , '#update-part1' ,function (){
        var form = $('#myForm2');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-youth-placement',
                      
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
     $(document).on('click' , '#add3' ,function (){
        var form = $('#add-youth');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/cg/add-new-placement-youth',
                      
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