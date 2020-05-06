@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Job Applications  @can('change-job-status') <span class="badge badge-danger">{{$new_count}} @endcan</span> </h3> 
        		</div>
        		<div class="col-md-9 text-right">
        			<span class="badge badge-primary">Total {{$applications->count()}}</span>
        		</div>

        	</div>
        </div>
        <br>
        <!-- /.card-header -->
        @cannot('change-job-status')
        <div class="container">
        	<div class="callout callout-danger">
             	<h5><i class="fa fa-info"></i> Note:</h5>
             	You will informed by berendina team regarding below job applications immediately.  		
        	</div>
        </div>
        @endcan
        <div class="card-body"> 
            @can('change-job-status')
            <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <div class="form-group">   
                        <label for="Status">Hiring Status</label>                           
                        <select name="status" id="status_filter" class="form-control" >
                            <option value="">All</option>
                            <option>Conatced Employer</option>
                            <option>Contacted Youth</option>
                            <option>Interview Scheduled</option>
                            <option>Interviewed</option>
                            <option>Hired</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                </div>

            </div> 
            @endcan 
            <br>      
            <table id="example" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Youth Name</th>
                        <th>Job Title</th>
                        <th>Applied On</th>
                        @can('change-job-status')
                        <th>Employer</th>
                        <th>Employer Email</th>
                        <th>Employer Phone</th>
                        <th>status</th>
                        <th width="150">Status</th>    
                        @endcan                 
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($applications as $application)
                    <tr class="application{{$application->id}}">
                        <td>{{ $no++ }}</td>
                        <td><a @cannot('employer') data-toggle="tooltip" data-placement="top" title="{{$application->phone}}" @endcan href="{{ URL::to('youth/' . $application->youth_id . '/view') }}">{{ $application->youth_name }}</a></td>
                        <td><a href="{{ URL::to('vacancy/' . $application->vacancy_id . '/view') }}">{{ $application->title }}</a></td>
                        <td>
                        	<?php 
                        		$dt = new DateTime($application->applied_on);
								
                        	?>
                        	{{ $dt->format('Y-m-d') }}

                        </td>
                        @can('change-job-status')
                        <td>{{ $application->employer_name }}</td>
                        <td>{{ $application->employer_email }}</td>
                        <td>{{ $application->employer_phone }}</td>
                        <td>{{ $application->status }}</td>
                        
                        <td>
                        	<form id="status_form">
                        		{{csrf_field()}}
                        		<div class="form-group">                        		
	                        		<select name="status" id="status" data-id="{{$application->application_id}}" class="form-control" >
	                        			<option value="">Select Status</option>
	                        			<option @if($application->status=="Conatced Employer") selected @endif>Conatced Employer</option>
	                        			<option @if($application->status=="Contacted Youth") selected @endif>Contacted Youth</option>
	                        			<option @if($application->status=="Interview Scheduled") selected @endif>Interview Scheduled</option>
	                        			<option @if($application->status=="Interviewed") selected @endif>Interviewed</option>
	                        			<option @if($application->status=="Hired") selected @endif>Hired</option>
	                        			<option @if($application->status=="Rejected") selected @endif>Rejected</option>
	                        		</select>
                        		</div>
                            </form>
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

	$(document).ready(function (){
		$(document).on('change' , '#status', function (){
            var id = $(this).attr('data-id');
            var status = $(this).children("option:selected").val();
            //alert(role);
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/youth/application/status',
                          
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'status': status
                    
                },
                cache: false,          
                success: function(data) {              
                toastr.success('Status Successfully Changed ! ', 'Congratulations', {timeOut: 5000});
                //$('#example1').DataTable().ajax.reload();           
                },

                error: function (jqXHR, exception) {    
                    console.log(jqXHR);
                    toastr.error('Something Error !', 'Status not Changed!');
                    
                },
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


$(document).ready(function() {
   var table = $('#example').DataTable( {
        "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
            },
            {
                "targets": [ 2 ],
                "visible": true
            },

            {
                "targets": [ 3 ],
                "visible": true
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

    

      $('#status_filter').on('change', function () {
          table.columns(7).search( this.value ).draw();
      } );
});

</script>
@endsection