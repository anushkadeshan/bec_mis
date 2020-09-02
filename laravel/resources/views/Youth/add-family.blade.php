@extends('layouts.main')
@section('title','Add Family |')
@section('content')
<div class="container-fluid">
    <section class="content">
    	<form action="" method="post" id="family">
	    	<div class="card card-primary">
	    			<div class="card-header">
	            		<h3 class="card-title">Basic Family Details of Youth</h3>
	          		</div>
                {{csrf_field()}}
	          		<div class="card-body">
	          			<div class="row">
	          				<div class="col-md-4">
	          					<div class="form-group">
	          						<label for="title">District</label>
    								<select name="district" id="district" class="form-control" data-dependent="ds_division">
    									<option value="">Select Option</option>
     									@foreach($districts as $district)
     									<option value="{{ $district->name_en}}">{{ $district->name_en }}</option>
     									@endforeach
    								</select>
   								</div>
   								
	          				</div>
	          				<div class="col-md-4">
		          				<div class="form-group">
	          						<label for="ds_division">DS Division</label>
    								<select name="ds_division" id="ds_division" class="form-control">
     									<option value="">Select Option</option>
    								</select>
   								</div>
	          				</div>
	          				<div class="col-md-4">
	          					<div class="form-group">
	          						<label for="gn_division">GN Division</label>
    								<select name="gn_division" id="gn_division" class="form-control">
     									<option value="">Select Option</option>
    								</select>
   								</div>
	          				</div>
	          			</div>
	          				<div class="row">
	          					
	          					<div class="col-md-4">
	          						<div class="form-group">
		                    			<label for="head_of_household">Head of Household</label>
		                    			<input type="text" class="form-control" id="head_of_household" name="head_of_household" >
		                  			</div>
	          					</div>
	          					<div class="col-md-4">
			      					<div class="form-group"	>
	                  					<label for="nic_head_of_household">NIC number of Head of Household</label>
		                    			<input type="text" class="form-control" id="nic_head_of_household" name="nic_head_of_household" >
	                  				</div>
	                  			</div>
	                  			<div class="col-md-4">
	                  				<div class="form-group">
                  						<label for="address">Address</label>
		                    			<textarea name="address" rows="2" class="form-control" id="address"></textarea>
                  					</div>
	                  			</div>
	          				</div>
                  			
                  			<div class="row">
                  				<div class="col-md-4">
			      					<div class="form-group">
                  						<label for="">Family Type</label>
                  						<select name="family_type" class="form-control" id="family_type">
                  							<option value="">Select Option</option>
                  							<option>Samurdhi beneficiary</option>
                  							<option>Gvt. beneficiary</option>
                  							<option>Plantation Sector</option>
                  							<option>Other</option>
                  							<option>No any grants</option>
                  						</select>
                  					</div>
	                  			</div>
	                  			<div class="col-md-4">
	                  				<div class="form-group"	>
	                  					<label for="nic_head_of_household">Total Family Members</label>
		                    			<input type="number" class="form-control" id="total_members" name="total_members" >
	                  				</div>
	                  			</div>
	                  			<div class="col-md-4">
	                  				<div class="form-group"	>
	                  					<label for="nic_head_of_household">Total Family Income</label>
		                    			<input type="number" class="form-control" id="total_income" name="total_income" >
	                  				</div>
	                  			</div>
                  			</div>
                  			<div class="form-group">
		          			<input type="button" id="add-family" class="btn btn-primary btn-flat" value="Add Family Details">
		          		</div>	
                  		</div>
	          			
	          		</div>	

    	</form>
    </section>
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
   	  			$('#ds_division').empty();
   	  			$('#gn_division').empty();
   	  			$.each(data, function(index, dsObj){
   	  				$('#ds_division').append('<option value="'+dsObj.ID+'">'+dsObj.DSD_Name+'</option>');

   	  			});
   	  		});
   	  });

   	  $(document).on('change','#ds_division',function(e){
   	  		
   	  		var ds_division = e.target.value;
   	  		

   	  		$.get('/gn-division?ds_division=' +ds_division, function(data){
   	  			//success
   	  			console.log(data);
   	  			$('#gn_division').empty();
   	  			$.each(data, function(index, gnObj){
   	  				$('#gn_division').append('<option value="'+gnObj.GN_ID+'">'+gnObj.GN_Office+'</option>');

   	  			});
   	  		});
   	  });
   	});

$(document).ready(function(){
  // add family to database
      $(document).ready(function(){
        $(document).on('click', '#add-family', function(){
          var form = $('#family');

          $.ajax({
            type: 'POST',
                url: SITE_URL + '/youth/add-family',
                data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfull Added information ! ', 'Congratulations', {timeOut: 5000});
                      $("#family")[0].reset();
                      window.close();
                  }
                  else{
                      printValidationErrors(data.error);

                  }
                },
                error:function(data, jqXHR){
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
});


</script>
<style type="text/css" media="screen">
	#autocomplete {
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
#autocomplete > li {
  padding: 3px 20px;
}
#autocomplete > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
</style>
@endsection
