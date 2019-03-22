@extends('layouts.main')
@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Resourse Person Details</h3>
		</div>
		<div class="card-body">
			<form id="resourse" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-4">
						<label for="name">1. Name</label>
						<input type="text" name="name" class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label for="profession">2. Designation/Profession</label>
						<input type="text" name="profession" id="profession" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label for="institute">3. Institute</label>
						<input type="text" name="institute" id="institute" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="cv">4. CV</label>
						<input type="file" name="cv" id="cv" class="form-control">
					</div>
				</div>
				{{csrf_field()}}
				<button type="submit" class="btn btn-info btn-flat" id="submit"><i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i> &nbsp;&nbsp;Submit</button>
				
				
			</form>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	 $(document).ready(function(){
     $("#resourse").on('submit' ,function (e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activity/add-resourse',   
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
              toastr.success('Succesfully Add Resourse Person ! ', 'Congratulations', {timeOut: 5000});
			  $("#resourse")[0].reset();

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
</script>
@endsection