@extends('layouts.main')
@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Youth Progress </h3>
            <p class="text-primary float-left">{{$youth->name }} &nbsp; </p> &nbsp;<p class="text-warning float-left">({{ $youth->branch->name}})</p>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Youth</a></li>
              <li class="breadcrumb-item active">Progress</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    		
	          <div class="col-md-6">
	            <div class="card card-info card-outline @if(!$youth->cg) collapsed-card @endif">
	              <div class="card-header">
	              	<h3 class="card-title">Career Guidance </h3>
	              		<div class="card-tools">
                  			<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  			</button>
               			</div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	@if(!is_null($cg))
	              	<div class="table-responsive">
                    <table class="table">
                    	@foreach($cg as $cg1)
                      <tr>
                        <th style="width:35%">District:</th>
                        <td>{{$cg1->district}}</td>
                      </tr>
                      <tr>
                        <th>DS Division:</th>
                        <td>{{$cg1->DSD_Name}}</td>
                      </tr>
                      <tr>
                        <th>Date of Program:</th>
                        <td>{{$cg1->date}}</td>
                      </tr>
                      <tr>
                        <th>Venue:</th>
                        <td>{{$cg1->venue}}</td>
                      </tr>
                     
                      @endforeach
                    </table>
                  </div>
                  @endif
	              </div>
	              <!-- /.card-body -->
	              @if(!$youth->cg)
	              <div class="overlay">
              	  </div>
              	  @endif
	            </div>
	            <!-- /.card -->
	          </div>

	          
	          <!-- /.col -->
	          <div class="col-md-6">
	            <div class="card card-success card-outline @if(!$youth->soft_skills) collapsed-card @endif">
	              <div class="card-header">
	              	<h3 class="card-title">Soft Skills <small class="text-muted">(Berendina Provided)</small></h3>
	              	<div class="card-tools">
                  		<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  		</button>
               		</div>	
	              	</div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	@if(!is_null($soft))
	              	<div class="table-responsive">
                    <table class="table">
                    	@foreach($soft as $soft_skills)
                      <tr>
                        <th style="width:35%">District:</th>
                        <td>{{$soft_skills->district}}</td>
                      </tr>
                      <tr>
                        <th>DS Division:</th>
                        <td>{{$soft_skills->DSD_Name}}</td>
                      </tr>
                      <tr>
                        <th>Institute:</th>
                        <td>{{$soft_skills->name}}</td>
                      </tr>
                      <tr>
                        <th>Training Stage:</th>
                        <td>{{$soft_skills->training_stage}}</td>
                      </tr>
                      <tr>
                        <th>Start Date:</th>
                        <td>{{$soft_skills->start_date}}</td>
                      </tr>
                      <tr>
                        <th>Completion Date:</th>
                        <td>{{$soft_skills->end_date}}</td>
                      </tr>                   
                      @endforeach
                    </table>
                  </div>
                  @endif
	              </div>
	              <!-- /.card-body -->
	              @if(!$youth->soft_skills)
	              <div class="overlay">
              	  </div>
              	  @endif
	            </div>
	            <!-- /.card -->
	          </div>
	          <!-- /.col -->
	          <div class="col-md-6">
	            <div class="card card-warning card-outline">
	              <div class="card-header">
	              	
	                <h3 class="card-title">Vocational\Professional Training <small class="text-muted">(Berendina Provided)</small></h3>
	                <div class="card-tools">
                  		<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  		</button>
               		</div>
	                <!-- /.card-tools -->
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	
	              </div>
	              <!-- /.card-body -->
	              @if(!$youth->vt&&!$youth->prof)
	              <div class="overlay">
              	  </div>
              	  @endif
	            </div>
	            <!-- /.card -->
	          </div>
	          <!-- /.col -->
	          <div class="col-md-6">
	            <div class="card card-danger card-outline @if(!$youth->jobs) collapsed-card @endif">
	              <div class="card-header">
	              
	                <h3 class="card-title">Jobs <small class="text-muted">(Berendina Provided)</small></h3>
	              	<div class="card-tools">
                  		<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  		</button>
               		</div>
	              </div>
	              <div class="card-body">
	               @if(!is_null($jobs))
	              	<div class="table-responsive">
                    <table class="table">
                    	@foreach($jobs as $job)
                      <tr>
                        <th style="width:35%">District:</th>
                        <td>{{$job->district}}</td>
                      </tr>

                      <tr>
                        <th>Job Interview Date:</th>
                        <td>{{$job->program_date}}</td>
                      </tr>
                      <tr>
                        <th>Interview Venue:</th>
                        <td>{{$job->venue}}</td>
                      </tr>
                      <tr>
                        <th>Employer:</th>
                        <td>{{$job->employer}}</td>
                      </tr>
                      <tr>
                        <th>Vacancy Placed:</th>
                        <td>{{$job->vacancies}}</td>
                      </tr> 
                      <tr>
                        <th>Salary:</th>
                        <td>{{$job->salary}}</td>
                      </tr>                  
                      @endforeach
                    </table>
                  </div>
                  @endif
	              </div>
	              <!-- /.card-body -->

	              @if(!$youth->jobs)
	              <div class="overlay">
              	  </div>
              	  @endif
	            </div>
	            <!-- /.card -->
	          </div>
	          <!-- /.col -->
        	</div>
        <!-- /.row -->
    	</div>
    </section>
</div>
@endsection
@section('scripts')
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(document).ready(function(){
//serahc family id
       $('#cg_id').keyup(function(){ 
              var query = $(this).val();
              if(query != '')
              {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                url: SITE_URL + '/cgList',
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#cgList').fadeIn();  
                 $('#cgList').html(data);
                }
               });
              }
          });

          $(document).on('click', '#autocomplete li', function(){  
            $('#cgList').fadeOut(); 
              $('#cg_id').val($(this).text()); 
              var cg_id = $(this).attr('id');
              $('#careerGuidance_id').val(cg_id);
               
          });  
    });

$(document).ready(function(){
		$(document).on('click', '#add-soft', function(){
   				var form = $('#soft');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/soft_skills/add',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Data Successfully Added ! ', 'Congratulations', {timeOut: 5000});
			                $("#soft")[0].reset();
            			}
			            else{
			                printValidationErrors(data.error);

			            }
            		},
            		error:function(data,jqXHR){
            			console.log(jqXHR);
            			
            		}

   				});
   			});
	});

function printValidationErrors(msg){
        $.each(msg, function(key,value){
          toastr.error('Validation Error !', ""+value+"");
        });
      }
	$(document).ready(function(){
//serahc course id
			 $('#course_name').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/softCourseList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#courseList').fadeIn();  
			           $('#courseList').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#autocomplete1 li', function(){  
			    	$('#courseList').fadeOut(); 
			        $('#course_name').val($(this).text()); 
			        var course_id = $(this).attr('id');
			        $('#course_id').val(course_id);
			         
			    });  
		});
	$(document).ready(function(){
//serahc course id
			 $('#course_name1').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/vtCourseList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#courseList1').fadeIn();  
			           $('#courseList1').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#autocomplete2 li', function(){  
			    	$('#courseList1').fadeOut(); 
			        $('#course_name1').val($(this).text()); 
			        var course_id = $(this).attr('id');
			        $('#course_id1').val(course_id);
			         
			    });  
		});
$(document).ready(function(){
		$(document).on('click', '#cg-add', function(){
   				var form = $('#cg');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/cg/add',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Data Successfully Added ! ', 'Congratulations', {timeOut: 5000});
			                $("#cg")[0].reset();
            			}
			            else{
			                printValidationErrors(data.error);

			            }
            		},
            		error:function(data,jqXHR){
            			console.log(jqXHR);
            			
            		}

   				});
   			});
	});
$(document).ready(function(){
		$(document).on('click', '#add-vt', function(){
   				var form = $('#vt');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/vt/add',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Data Successfully Added ! ', 'Congratulations', {timeOut: 5000});
			                $("#vt")[0].reset();
            			}
			            else{
			                printValidationErrors(data.error);

			            }
            		},
            		error:function(data,jqXHR){
            			console.log(jqXHR);
            			
            		}

   				});
   			});
	});

	$(document).ready(function(){
//serahc course id
			 $('#course_name').keyup(function(){ 
			        var query = $(this).val();
			        if(query != '')
			        {
			         var _token = $('input[name="_token"]').val();
			         $.ajax({
			          url: SITE_URL + '/softCourseList',
			          method:"POST",
			          data:{query:query, _token:_token},
			          success:function(data){
			           $('#courseList').fadeIn();  
			           $('#courseList').html(data);
			          }
			         });
			        }
			    });

			    $(document).on('click', '#autocomplete1 li', function(){  
			    	$('#courseList').fadeOut(); 
			        $('#course_name').val($(this).text()); 
			        var course_id = $(this).attr('id');
			        $('#course_id').val(course_id);
			         
			    });  
		});

$(document).ready(function(){
		$(document).on('click', '#add-job', function(){
   				var form = $('#jobs');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/job/add',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Data Successfully Added ! ', 'Congratulations', {timeOut: 5000});
			                $("#jobs")[0].reset();
            			}
			            else{
			                printValidationErrors(data.error);

			            }
            		},
            		error:function(data,jqXHR){
            			console.log(jqXHR);
            			
            		}

   				});
   			});
	});	
</script>

<style type="text/css" media="screen">
	#autocomplete, #autocomplete1, #autocomplete2 {
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
#autocomplete, #autocomplete1, #autocomplete2 > li {
  padding: 3px 20px;
}
#autocomplete, #autocomplete1, #autocomplete2 > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection
