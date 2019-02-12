@extends('layouts.main')
@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Youth Progress</h3>
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
	            <div class="card card-info card-outline">
	              <div class="card-header">
	                <h3 class="card-title">Career Guidance</h3>

	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	               		<form id="cg">
	               		
		                	<div class="form-group">
		                		<label for="cg_fid">Select CG</label>
										      
		                        <div class="input-group">
		                        <input type="text" id="cg_id"class="form-control" placeholder="Search Date">
		                        <div style="cursor: pointer" onclick="window.open('{{Route('activities/cg/view')}}', '_blank');" class="input-group-prepend">
		                          <span data-toggle="tooltip" data-placement="top" title="Add CG program to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
		                        </div>  
		                      </div>
                        <div id="cgList"></div>
                          <input type="hidden" id="careerGuidance_id" name="careerGuidance_id" value="">
                          <input type="hidden" name="youth_id" value="{{request()->route('id')}}">
		                </div>
		                {{ csrf_field() }}
		                
		                </form>
		                <button type="button" id="cg-add" class="btn btn-primary btn-flat">Add</button>

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
	            <div class="card card-success card-outline">
	              <div class="card-header">
	                <h3 class="card-title">Soft Skills <small class="text-muted">(Berendina Provided)</small></h3>

	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	<form id="soft">
	              	
	                <div class="form-group">
                        <label for="course_name">Course </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Search Course">
                                <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                	<span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                </div>  
                            </div>
              			<div id="courseList"></div>
                     	<input class="form-control" type="hidden" name="course_id" id="course_id">
                    </div>
                     	<div class="row">

	                     	<div class="form-group col-md-6">
	                     		<label>Course Status</label>
	                     		
	                     		<select name="status" class="form-control">
	                     			<option value="">Select Option</option>
	                     			<option>Following</option>
	                     			<option>Followed</option>
								</select>
	                     	</div>
	                     	<div class="form-group col-md-6">
	                     		<label>Completed date <small class="text-muted">(Approximate)</small></label>
	                     		<input type="date" name="completed_at" class="form-control">
	                     	</div>
                     	</div>
                          <input type="hidden" name="youth_id" value="{{request()->route('id')}}">

                    {{csrf_field()}}
                    <button type="button" class="btn btn-primary btn-flat" id="add-soft">Add</button>
                    </form>
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

	                <!-- /.card-tools -->
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <form id="vt">
	              	
	                <div class="form-group">
                        <label for="course_name">Course </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="course_name" id="course_name1" placeholder="Search Course">
                                <div style="cursor: pointer" onclick="window.open('{{Route('courses/view')}}', '_blank');" class="input-group-prepend">
                                	<span data-toggle="tooltip" data-placement="top" title="Add a course to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                </div>  
                            </div>
              			<div id="courseList1"></div>
                     	<input class="form-control" type="hidden" name="course_id" id="course_id1">
                    </div>
                     	<div class="row">

	                     	<div class="form-group col-md-6">
	                     		<label>Course Status</label>
	                     		
	                     		<select name="status" class="form-control">
	                     			<option value="">Select Option</option>
	                     			<option>Following</option>
	                     			<option>Followed</option>
								</select>
	                     	</div>
	                     	<div class="form-group col-md-6">
	                     		<label>Completed date <small class="text-muted">(Approximate)</small></label>
	                     		<input type="date" name="completed_at" class="form-control">
	                     	</div>
                     	</div>
                          <input type="hidden" id="youth_id1" name="youth_id" value="{{request()->route('id')}}">
                     	
                    {{csrf_field()}}
                    <button type="button" class="btn btn-primary btn-flat" id="add-vt">Add</button>
                    </form>
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
	            <div class="card card-danger card-outline">
	              <div class="card-header">
	                <h3 class="card-title">Jobs</h3>
	              </div>
	              <div class="card-body">
	                <form action="" method="get" accept-charset="utf-8">
	                	<div class="form-group">
	                		<label>Job Title</label>
	                		input
	                		<input type="text" name="title" class="form-control">
	                	</div>
	                	<div class="form-group">
                        <label for="course_name">Employer </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="employer_name" id="employer_name" placeholder="Search Employer">
                                <div style="cursor: pointer" onclick="window.open('{{Route('employers')}}', '_blank');" class="input-group-prepend">
                                	<span data-toggle="tooltip" data-placement="top" title="Add an employer to list" class="input-group-text"><i style="color: blue;" class="fa fa-plus"></i></span>
                                </div>  
                            </div>
              			<div id="employerList"></div>
                    </div>
	                </form>
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
