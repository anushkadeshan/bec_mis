@extends('layouts.main')
@section('title','View Youth Followers |')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-5">
        			<h3 class="card-title">List of youth seleceted by employers to hire   <span class="badge badge-danger">{{$new_count}} </span> </h3> 
        		</div>
        		<div class="col-md-7 text-right">
        			<span class="badge badge-primary">Total {{$followers->count()}}</span>
        		</div>

        	</div>
        </div>
        <br>
        <!-- /.card-header -->
        <div class="container-fluid">
        	<div class="callout callout-danger">
             	<h5><i class="fa fa-info"></i> Note:</h5>
             	Inform to youth and employer abouth this selection and arrange an interview and followup. 		
        	</div>
        </div>
        
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Youth Name</th>
                        <th>Youth Address</th>
                        <th>Youth Contacts</th>        
                        <th>Employer</th>
                        <th>Employer Email</th>
                        <th>Employer Phone</th>
                        <th width="150">Status</th>    
                
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($followers as $followers)
                    <tr class="followers{{$followers->id}}">
                        <td>{{ $no++ }}</td>
                        <td><a href="{{ URL::to('youth/' . $followers->youth_id . '/view') }}">{{ $followers->youth_name }}</a></td>
                        <td>{{ $followers->family_address }}</td>
                        <td>{{ $followers->youth_phone }} <br> <small>{{ $followers->youth_email }}</small></td>
                        <td>{{ $followers->employer_name }}</td>
                        <td>{{ $followers->employer_email }}</td>
                        <td>{{ $followers->employer_phone }}</td>
                        
                        <td>
                        	<form id="status_form">
                        		{{csrf_field()}}
                        		<div class="form-group">                        		
	                        		<select name="status" id="status" data-id="{{$followers->employers_follow_youths_id}}" class="form-control" >
	                        			<option value="">Select Status</option>
	                        			<option @if($followers->status=="Conatced Employer") selected @endif>Conatced Employer</option>
	                        			<option @if($followers->status=="Contacted Youth") selected @endif>Contacted Youth</option>
	                        			<option @if($followers->status=="Interview Scheduled") selected @endif>Interview Scheduled</option>
	                        			<option @if($followers->status=="Interviewed") selected @endif>Interviewed</option>
	                        			<option @if($followers->status=="Hired") selected @endif>Hired</option>
	                        			<option @if($followers->status=="Rejected") selected @endif>Rejected</option>
	                        		</select>
                        		</div>
                            </form>
                        </td>
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
	$(document).ready(function (){
		$(document).on('change' , '#status', function (){
            var id = $(this).attr('data-id');
            var status = $(this).children("option:selected").val();
            //alert(role);
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/youth/followers/status',
                          
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
</script>
@endsection