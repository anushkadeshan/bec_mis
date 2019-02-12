@extends('layouts.main')
@section('content')
<div class="container">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?" class="card-title">Youths</h3> 
        		</div>
        		<div class="col-md-7">
        			
        		</div> 
                @can('add-institute')
        		<div class="col-md-2">
        			<!-- Button trigger modal -->
		        	<div class="text-right">
						<a href="{{Route('youth/add')}}" title=""><button type="button" class="btn btn-primary btn-flat">Add New</button></a>
					</div>
        		</div>
                @endcan
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        	<table id="example" class="table table-bordered table-striped" style="width:100%">
        		<thead>
        			<tr>
        				<th>#</th>
        				<th>Name</th>
        				<th>Gender</th>
        				<th>NIC</th>
        				<th>Current Status</th>
        				<th>Progress</th>
        				<th>Action</th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php  $no=1; ?> 
        			@foreach($youths as $youth)
        			<tr class="youth{{$youth->id}}">
        				<td>{{$no++}}</td>
        				<td>{{ $youth->name }}</td>
        				<td>{{ $youth->gender }}</td>
        				<td>{{ $youth->nic }}</td>
        				<td>{{ $youth->current_status }}</td>
        				<td width="180">
        					<form id="cg" style="margin-bottom: 5px;">
        						{{csrf_field()}}

        						<input type="checkbox" name="cg" class="form-control cg" @if ($youth->cg) checked @endif  data-id="{{$youth->id}}">
								<label> &nbsp; Career Guidance</label>	
        					</form>
        					
        					<form id="soft" style="margin-bottom: 5px;">
        						{{csrf_field()}}

        						<input type="checkbox" name="soft_skills" class="soft" @if ($youth->soft_skills) checked @endif data-id="{{$youth->id}}">
								<label>&nbsp; Soft Skill</label>
							</form>

							<form id="vt" name="vt"  style="margin-bottom: 5px;">
        						{{csrf_field()}}

								<input type="checkbox" class="vt" data-id="{{$youth->id}}" @if ($youth->vt) checked @endif>
								<label>&nbsp; VT Course</label>
							</form>

							<form id="prof" name="prof"   style="margin-bottom: 5px;">
        						{{csrf_field()}}

								<input type="checkbox" class="prof" data-id="{{$youth->id}}" @if ($youth->prof) checked @endif>
								<label>&nbsp; Prof. Course</label>
							</form>

							<form id="job" name="jobs" style="margin-bottom: 5px;">
        						{{csrf_field()}}

								<input type="checkbox" class="jobs" data-id="{{$youth->id}}" @if ($youth->jobs) checked @endif>
								<label>&nbsp; Job</label>
							</form>
        				</td>
        				<td>
        					@can('view-youth')
                        	<div class="btn-group">
                        		<a href="{{ URL::to('youth/' . $youth->id . '/view-progress') }}">
                                    <button type="button" id="view-progress" data-id="{{$youth->id}}" class="btn btn-block btn-primary btn-flat btn-sm" ><i class="fas fa-tasks"></i> </button>
                                </a>
                                
                                <a href="{{ URL::to('youth/' . $youth->id . '/view') }}">
                                    <button type="button" id="view-youth" data-id="{{$youth->id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a>

                                
                            
                            @endcan
                            @can('edit-youth')
                            <a href="{{ URL::to('youth/' . $youth->id . '/edit') }}" title="">
                                    <button type="submit" id="edit-youth" data-id="{{$youth->id}}" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                            </a>        
                        	@endcan
                        	@can('delete-youth')
                            
                                <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button data-toggle="confirmation" type="button" id="delete-youth" data-id="{{$youth->id}}" class="btn btn-block btn-danger btn-flat btn-sm" ><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </div>
                            @endcan
        				</td>
        			</tr>
        			@endforeach
        		</tbody>
        	</table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        "pageLength": 5,

        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    $('#example').on('draw.dt', function () {
    	$('input').iCheck({
    		checkboxClass: 'icheckbox_square-green',
    		radioClass: 'iradio_square-red',
    		increaseArea: '20%' // optional
  	});
	});
 });
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});



$(document).ready(function(){
	//career guidance checked 
	$(document).on('ifClicked', '.cg', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-cg',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//softskills checked 
	$(document).on('ifClicked', '.soft', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-soft',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//VT checked 
	$(document).on('ifClicked', '.vt', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-vt',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//prof checked 
	$(document).on('ifClicked', '.prof', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-prof',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//jobs checked 
	$(document).on('ifClicked', '.jobs', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-jobs',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });
});

//delete youth
$(document).ready(function(){
    $(document).on('click' , '#delete-youth' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/delete-youth',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Youth Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.youth' +id).remove();
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