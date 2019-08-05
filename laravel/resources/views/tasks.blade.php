@extends('layouts.main')
@section('content')
<div class="container">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Tasks</h3> 
        		</div>
        		<div class="col-md-6">
        			
        		</div>
                @can('create-Employer')
        		<div class="col-md-3 text-right">
        			<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#exampleModalCenter">Add a Task</button>
        		</div>
                @endcan
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Due Date</th>
                        <th>Saverity</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($tasks as $task)
                    <tr class="task{{$task->id}}">
                        <td>{{ $no++ }}</td>
                        <td>{{ $task->task }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->severity }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{{ $task->updated_at }}</td>
                        <td>
                            <div class="btn-group">
                            	{{ csrf_field() }}
                                    <button type="button" id="edit-task" data-id="{{$task->id}}" data-task="{{$task->task}}" data-due_date="{{$task->due_date}}" data-severity="{{$task->severity}}" class="btn btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                                    <button type="button" id="delete-task" data-id="{{$task->id}}" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>
    </div> 
	
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add a Task</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action=""  method="post" id="myForm">
	      		<div class="form-group">
	      			<label>Task</label>
	      			<input type="text" name="task" class="form-control">
	      		</div>
	      		<div class="form-group">
	      			<label>Severity</label>
	      			<select name="severity" class="form-control">
	      				<option value="">Select Option</option>
	      				<option>High</option>
	      				<option>Low</option>
	      			</select>
	      		</div>	
	      		<div class="form-group">
	      			<label>Due Date</label>
	      			<input type="date" name="due_date" class="form-control">
	      		</div>
	      		{{csrf_field()}}
	      	</form>
	      </div>
	      <div class="modal-footer">

	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="add-task" class="btn btn-primary btn-flat">Add Task</button>
	      </div>
	    </div>
	</div>
</div>

<div class="modal fade" id="update-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Update Task</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action=""  method="post" id="myForm1">
	      		<div class="form-group">
	      			<label>Task</label>
	      			<input type="text" id="task" name="task" class="form-control">
	      		</div>
	      		<div class="form-group">
	      			<label>Severity</label>
	      			<select name="severity" id="severity" class="form-control">
	      				<option value="">Select Option</option>
	      				<option>High</option>
	      				<option>Low</option>
	      			</select>
	      		</div>	
	      		<div class="form-group">
	      			<label>Due Date</label>
	      			<input type="date" id="due_date" name="due_date" class="form-control">
	      			<input type="hidden" id="id" name="id" class="form-control">
	      		</div>
	      		{{csrf_field()}}
	      	</form>
	      </div>
	      <div class="modal-footer">

	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="update-task" class="btn btn-primary btn-flat">Update Task</button>
	      </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
<script>
   //Employer add
    $(document).on('click' , '#add-task' ,function (){
        var form = $("#myForm");
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/add-task',
                      
            data: form.serialize(),
                      
            success: function(data) {  

                toastr.success('Task Successfully Added to the database ! ', 'Congratulations', {timeOut: 5000});
                $("#myForm")[0].reset();            
            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
    });
$('#exampleModalCenter').on('hidden.bs.modal', function () {
  window.location.reload();
});
	$(document).on('click', '#edit-task', function(){
        var id = $(this).data('id');
        $('#id').val($(this).data('id'));
        $('#task').val($(this).data('task'));
        $('#severity').val($(this).data('severity'));
        $('#due_date').val($(this).data('due_date'));
        $('#update-model').modal('show');
        
    });

   //Employer add
    $(document).on('click' , '#update-task' ,function (){
        var form = $("#myForm1");
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/update-task',
                      
            data: form.serialize(),
                      
            success: function(data) {  

                toastr.success('Task Successfully updated ! ', 'Congratulations', {timeOut: 5000});
                $("#myForm1")[0].reset();   
        		window.location.reload();                 
        		$('#update-model').modal('hide');

            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
    });

//delete institute
$(document).ready(function(){
    $(document).on('click' , '#delete-task' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/delete-task',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Task Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.task' +id).remove();
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