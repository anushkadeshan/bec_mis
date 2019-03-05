@extends('layouts.main')
@section('content')
<div class="container">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-4">
        			<h3 class="card-title">Career Guidances</h3> 
        		</div>
        		<div class="col-md-6">
        			
        		</div> 
                @can('view-activities')
        		<div class="col-md-2">
        			<!-- Button trigger modal -->
		        	<div class="text-right">
					<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#addModel">Add New</button>
					</div>
        		</div>
                @endcan
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>District</th>
                        <th>DS Division</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Resourse Person</th>
                        @can('view-activities')
                        <th>Action</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($career_guidances as $cg)
                    <tr class="cg{{$cg->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $cg->district }}</td>
                        <td>{{ $cg->ds_division }}</td>
                        <td>{{ $cg->date }}</td>
                        <td>{{ $cg->time }}</td>
                        <td>{{ $cg->venue }}</td>
                        <td>{{ $cg->male }}</td>
                        <td>{{ $cg->female }}</td>
                        <td>{{ $cg->resourse_person }}</td>
                        
                        <td>

                        	@can('view-activities')
                        	<div class="btn-group">
                        	
                             <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button type="button" id="delete-cg" data-id="{{$cg->id}}" class="btn btn-block btn-danger btn-flat btn-sm" ><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </div>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>

    </div>
</div>
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Career Guidance Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
              <!-- form start -->
              <form action="" id="career" method="post" accept-charset="utf-8">
              {{ csrf_field() }}
               <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">Activity</label>
                  <select name="activity_id" id="activity_id" class="form-control" data-dependent="ds_division">
                    <option value="">Select Option</option>
                    @foreach($activities as $activity)
                    <option value="{{ $activity->id}}">{{ $activity->code }} | {{ $activity->activity }}</option>
                    @endforeach
                </select>
              </div> 
              </div>
             </div>   
             <div class="row">
             	<div class="col-md-6">
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
             	<div class="col-md-6">
             		<div class="form-group">
	          			<label for="ds_division">DS Division</label>
    					<select name="ds_division" id="ds_division" class="form-control">
     						<option value="">Select Option</option>
    					</select>
   					</div>
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
	          			<label for="date">Date</label>
    					<input type="date" name="date" id="date" class="form-control">
   					</div>
             		 
             	</div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="time">Time</label>
                  <input type="time" name="time" id="time" class="form-control">
                </div>
                
              </div>
             </div>
             <div class="row">
             	
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="venue">Venue</label>
             		 	<input type="text" id="venue" name="venue" class="form-control">
             		 </div> 
             		
             	</div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="resourse_person">Resourse Person's Name</label>
                  <input type="text" id="resourse_person" name="resourse_person" class="form-control">
                 </div>  
              </div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="male">Number of Male Youths</label>
             		 	<input type="number" name="male" class="form-control" id="male">
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="female">Number of Female Youths</label>
             		 	<input type="number" name="female" class="form-control" id="female">
             		 </div>
		          	</div> 
             	</div> 
              </form>             
             </div>
             {{csrf_field()}}
             
	      	
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="add-cg" class="btn btn-primary">Save changes</button>
		      </div>
	    </div>
	 </div>
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
   	  				$('#gn_division').append('<option value="'+gnObj.GN_Office+'">'+gnObj.GN_Office+'</option>');

   	  			});
   	  		});
   	  });
   	});

 $(document).ready(function(){
  // add career guidance to database
      $(document).ready(function(){
        $(document).on('click', '#add-cg', function(){
          var form = $('#career');

          $.ajax({
            type: 'POST',
                url: SITE_URL + '/activities/add-cg',
                data: form.serialize(),
                success:function(data){
                  if($.isEmptyObject(data.error)){
                      toastr.success('Successfull Added information ! ', 'Congratulations', {timeOut: 5000});
                      $("#career")[0].reset();
                      
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

 //delete cg
$(document).ready(function(){
    $(document).on('click' , '#delete-cg' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/activities/cg/delete',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Details Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.cg' +id).remove();
            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'You Do not have permission to delete employer')
            },
        });
    });
});
</script>
@endsection