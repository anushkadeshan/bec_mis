@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Training Institutes</h3> 
        		</div>
        		<div class="col-md-7">
        			
        		</div> 
                @can('add-institute')
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
            <table id="example1" class="table row-border table-hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Contacts</th>
                        <th>Contact Person</th>
                        <th>TVEC Reg?</th>
                        @can('edit-institute')
                        <th>Action</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($institutes as $institute)
                    <tr class="institute{{$institute->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $institute->name }}</td>
                        <td>{{ $institute->location }}</td>
                        <td>{{ $institute->address }}</td>
                        <td>{{ $institute->phone }} <br> <i class="fas fa-envelope-open-text"></i>&nbsp;{{ $institute->email }}</td>
                        <td>{{ $institute->contact_person }}</td>
                        <td>{{ $institute->is_registerd }}</td>
                        
                        <td>
                        	@can('view-institute')
                        	<div class="btn-group">
                                <a href="{{ URL::to('institute/' . $institute->id . '/view') }}">
                                    <button type="button" id="view-institute" data-id="{{$institute->id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a>
                            
                            @endcan
                            @can('edit-institute')
                            
                                    <button type="submit" id="edit-institute" data-id="{{$institute->id}}" data-name="{{ $institute->name }}" data-location="{{ $institute->location }}" data-address="{{ $institute->address }}" data-contact="{{ $institute->contact_person }}" data-email="{{ $institute->email }}" data-phone="{{ $institute->phone }}" data-is_registerd="{{ $institute->is_registerd }}" data-reg_no="{{ $institute->reg_no }}" data-type="{{ $institute->type }}" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                        	@endcan
                        	@can('delete-institute')
                            
                                <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button type="button" id="delete-institute" data-id="{{$institute->id}}" class="btn btn-block btn-danger btn-flat btn-sm" ><i class="fas fa-trash-alt"></i> </button>
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
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Training Institutes</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
              <!-- form start -->
              <form action="" id="institute" method="post" accept-charset="utf-8">
              {{ csrf_field() }}  
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="name">Name</label>
             		 	<input type="text" name="name" id="name" class="form-control">
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="location">Location</label>
             		 	<input type="text" name="location" id="location" class="form-control">
             		 	<div id="locationList"></div>
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="address">Address</label>
             		 	<textarea class="form-control" id="address" name="address" rows="2"></textarea>
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="contact_person">Contact Person</label>
             		 	<input type="text" name="contact_person" id="contact_person" class="form-control">
             		 	
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="phone">Contact Number</label>
             		 	<input type="text" name="phone" id="phone" class="form-control">
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="email">Email Address</label>
             		 	<input type="text" name="email" id="email" class="form-control">
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="is_registerd">is Registered in TVEC ?</label>
             		 	<select class="form-control" name="is_registerd" id="is_registerd">
             		 		<option value="">Select Option</option>
             		 		<option value="Yes">Yes</option>
             		 		<option value="No">No</option>
             		 	</select>
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group" id="reg" style="display: none">
             		 	<label for="reg_no">TVEC Registration No</label>
             		 	<input type="text" name="reg_no" id="reg_no" class="form-control">
             		 </div> 
             	</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reg_no">Institute Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">Select Option</option>
                            <option value="Government">Government</option>
                            <option value="Non Government">Non Government</option>
                            <option value="Private">Private</option>
                        </select>
                     </div> 
                </div>
             </div>
             </form>
	      </div>
	      	
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="add-institute" class="btn btn-primary">Save changes</button>
		      </div>
	    </div>
	 </div>
</div>

<div class="modal fade" id="update-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Update Training Institutes</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
              <!-- form start -->
              <form action="" id="institute1" method="post" accept-charset="utf-8">
              {{ csrf_field() }}  
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="name">Name</label>
             		 	<input type="text" name="name" id="name1" class="form-control">
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="location">Location</label>
             		 	<input type="text" name="location" id="location1" class="form-control">
             		 	<div id="locationList"></div>
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="address">Address</label>
             		 	<textarea class="form-control" id="address1" name="address" rows="2"></textarea>
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="contact_person">Contact Person</label>
             		 	<input type="text" name="contact_person" id="contact_person1" class="form-control">
             		 	
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="phone">Contact Number</label>
             		 	<input type="text" name="phone" id="phone1" class="form-control">
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="email">Email Address</label>
             		 	<input type="text" name="email" id="email1" class="form-control">
             		 </div> 
             	</div>
             </div>
             <div class="row">
             	<div class="col-md-6">
             		<div class="form-group">
             		 	<label for="is_registerd">is Registered in TVEC ?</label>
             		 	<select class="form-control" name="is_registerd" id="is_registerd1">
             		 		<option value="">Select Option</option>
             		 		<option value="Yes">Yes</option>
             		 		<option value="No">No</option>
             		 	</select>
             		 </div> 
             	</div>
             	<div class="col-md-6">
             		<div class="form-group" id="reg1" style="display: none">
             		 	<label for="reg_no1">TVEC Registration No</label>
             		 	<input type="text" name="reg_no" id="reg_no1" class="form-control">
             		 </div> 
             	</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reg_no">Institute Type</label>
                        <select class="form-control" name="type" id="type1">
                            <option value="">Select Option</option>
                            <option value="Government">Government</option>
                            <option value="Non Government">Non Government</option>
                            <option value="Private">Private</option>
                        </select>
                     </div> 
                </div>
             </div>
             <input type="hidden" name="id" id="id">
             </form>
	      </div>
	      	
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="update-institute" class="btn btn-primary">Update changes</button>
		      </div>
	    </div>
	 </div>
</div>
@endsection
@section('scripts')
<script>
//get location data to field
   $(document).ready(function(){
   	$('#location').keyup(function(){ 
	    var query = $(this).val();
			if(query != ''){
			    var _token = $('input[name="_token"]').val();
			    $.ajax({
			        url: SITE_URL + '/locationList',
			        method:"POST",
			        data:{query:query, _token:_token},
			        success:function(data){
			           $('#locationList').fadeIn();  
			           $('#locationList').html(data);
			          }
			    });
			}
	});

	$(document).on('click', 'li', function(){  
		$('#locationList').fadeOut(); 
		$('#location').val($(this).text());  
			         
	}); 
			 
	});	

$(document).ready(function(){
	$(document).on('change' , '#is_registerd', function (){
    	
    	if(this.value=='Yes'){
    		$('#reg').show();	
    	}
    	else{
    		$('#reg').val("");
    		$('#reg').hide();
    	}
    }); 
});	

$(document).ready(function(){
	$(document).on('change' , '#is_registerd1', function (){
    	
    	if(this.value=='Yes'){
    		$('#reg1').show();
    		
    	}
    	else{
    		$('#reg1').val("");
    		$('#reg1').hide();
    	}
    }); 
});	

$(document).ready(function(){
	// add institute to database
   		$(document).ready(function(){
   			$(document).on('click', '#add-institute', function(){
   				var form = $('#institute');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/institutes/add-institute',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Successfull Addred information ! ', 'Congratulations', {timeOut: 5000});
			                $("#institute")[0].reset();
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

$('#addModel').on('hidden.bs.modal', function () {
  window.location.reload();
});


	$(document).on('click', '#edit-institute', function(){
        var id = $(this).data('id');
        $('#id').val($(this).data('id'));
        $('#name1').val($(this).data('name'));
        $('#phone1').val($(this).data('phone'));
        $('#email1').val($(this).data('email'));
        $('#address1').val($(this).data('address'));
        $('#contact_person1').val($(this).data('contact'));
        $('#type1').val($(this).data('type'));
        
        $('#is_registerd1').val($(this).data('is_registerd'));

        $('#location1').val($(this).data('location'));
        var is_registerd = $('#is_registerd1').val();
        if(is_registerd=='Yes'){
    		$('#reg1').show();
    		$('#reg_no1').val($(this).data('reg_no'));
    		
    	}
    	else{
    		$('#reg1').hide();
    	}
        $('#update-model').modal('show');
        
    });
//update Institite 

$(document).ready(function(){
	// add institute to database
   		$(document).ready(function(){
   			$(document).on('click', '#update-institute', function(){
   				var form = $('#institute1');

   				$.ajax({
   					type: 'POST',
            		url: SITE_URL + '/institutes/update-institute',
            		data: form.serialize(),
            		success:function(data){
            			if($.isEmptyObject(data.error)){
			                toastr.success('Successfull Updated information ! ', 'Congratulations', {timeOut: 5000});
			                $("#institute1")[0].reset();
        					$('#update-model').modal('hide');

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

//delete institute
$(document).ready(function(){
    $(document).on('click' , '#delete-institute' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/institutes/delete-institute',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Institite Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.institute' +id).remove();
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