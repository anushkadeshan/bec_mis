@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Backups</h3> 
        		</div>
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>Size</th>
                        <th>Created Date</th>
                        <th>Download</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($backups as $key =>  $backup)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $backup->getilename }}</td>
                        <td>{{ $backup->size }}</td>
                        <td>{{ date('Y:m:d', strtotime($backup->aTime)) }}</td>
                        
                        <td><a href="{{asset('app/BEC-MIS/'. $backup->filename)}}"><i class="fas fa-download"></i></a></td>
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>

    </div>
</div>

@endsection
@section('scripts')
<script>
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



</script>

@endsection