@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Vacancy Information</h3> 
        		</div>
        		<div class="col-md-7">
        			
        		</div>
                @can('create-vacancies')
        		<div class="col-md-2">
        			<!-- Button trigger modal -->
					<a href="{{ROUTE('new-vacancy')}}"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#updateModel">Add Vacancy</button></a>
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
                        <th>Name</th>
                        <th>Job Type</th>
                        <th>Location</th>
                        <th>Closing date</th>
                        <th>Business Funtion</th>
                        @can('edit-vacancies')
                        <th>Action</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($vacancies as $vacancy)
                    <tr class="vacancy{{$vacancy->id}}">
                        <td>{{ $no++ }}</td>
                        <td><a href="{{ URL::to('vacancy/' . $vacancy->id . '/view') }}">{{ $vacancy->title }}</a></td>
                        <td>{{ $vacancy->job_type }}</td>
                        <td>{{ $vacancy->location }}</td>
                        <td>{{ $vacancy->dedline }}</td>
                        <td>{{ $vacancy->business_function }}</td>
                        @can('edit-vacancies')
                        <td>
                            <div style="float: left;">
                                <a href="{{ URL::to('vacancy/' . $vacancy->id . '/edit') }}">
                                    <button type="submit" id="edit-vacancy" data-id="{{$vacancy->id}}" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                                </a>
                            </div>
                        	
                            <div style="float: left;">
                                <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button type="button" id="delete-vacancy" data-id="{{$vacancy->id}}" class="btn btn-block btn-danger btn-flat btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                            
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                <tbody>        
            </table>      
            
        </div>

    </div> 
</div>


@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
         //employer Delete
    $(document).on('click' , '#delete-vacancy' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/vacancy/delete',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Vacancy Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.vacancy' +id).remove();
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