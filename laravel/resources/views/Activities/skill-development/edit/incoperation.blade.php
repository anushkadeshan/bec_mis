@extends('layouts.main')
@section('content')
<div class="container-fluid">

<div class="row">
	  <div class="col-12">
	    <!-- Custom Tabs -->
	    <div class="card">
	      <div class="card-header d-flex p-0">
	        <h3 class="card-title p-3">Incorporation of soft skill component</h3>
	        <ul class="nav nav-pills ml-auto p-2" id="tabs">
	          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Genaral</a></li>
	        </ul>
	      </div><!-- /.card-header -->
	      <div class="card-body">
	      	<form id="institute-review" method="post" enctype="multipart/form-data">
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
						    <label for="dm_name">6. Date of Review</label>
						    <input type="date" name="program_date" id="review_date" class="form-control" value="{{$meeting->program_date}}">
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
	            	<div class="col-md-4">
	            		<div class="form-group">
						    <label for="dm_name">7. Institute </label>
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
	            	<div class="col-md-5">
	            		<div class="form-group">
						    <label for="institutional_review">8. if TVEC regiestered, Expiry date of registration</label>
						    <input type="date" id="tvec_ex_date" name="tvec_ex_date" class="form-control" value="{{$meeting->tvec_ex_date}}">
						</div>
	            	</div>
	            </div>
	            
                <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
						    <label for="dm_name">9.	Nature of assistance provided to incorporate soft skill components (please describe)</label>
						    <textarea class="textarea" name="nature_of_assistance" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$meeting->nature_of_assistance}}</textarea>
						</div>
	            	</div>	            	
	            </div>
            {{csrf_field()}}
            <input type="hidden" id="r_id" name="m_id" value="{{$meeting->m_id}}">
            <button type="submit" name="button" id="submit" class="btn btn-info btn-flat"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>			
	          </div>
	          <!-- /.tab-pane -->

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

$(document).ready(function(){
     $("#institute-review").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/skill/update-incoperation',   
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
              toastr.success('Succesfully update Incoperate Details ! ', 'Congratulations', {timeOut: 5000});
			        $("#institute-review")[0].reset();

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