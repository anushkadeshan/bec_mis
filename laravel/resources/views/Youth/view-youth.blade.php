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
            @can('search-youth')
            <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">District</label>
                        <select name="district" id="district" class="form-control" data-dependent="ds_division">
                            <option value="">All</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->name_en}}">{{ $district->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="highest_qualification">Highest Educational Qualification:</label>
                        <select name="highest_qualification" id="highest_qualification" class="form-control">
                            <option value="">All</option>
                            <option>Ordinary Level</option>
                            <option>Advanced Level</option>
                            <option>Certificate</option>
                            <option>Diploma</option>
                            <option>Higher Diploma</option>
                            <option>Degree</option>
                            <option>Masters</option>
                            <option>Doctorate</option>
                            <option>Skilled Apprentice</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>    
            @endcan
        	<table id="example" class="table row-border table-hover" style="width:100%">
        		<thead>
        			<tr>
        				<th>#</th>
        				<th>Name</th>
        				<th>Gender</th>
                        @can('add-youth')
        				<th>NIC</th>
        				<th>Current Status</th>
                        @can('admin')
                        <th>Branch</th>
                        @endcan
                        <th>Progress</th>
        				<th>Action</th>
                        @endcan
                        @can('search-youth')
                        <th>District</th>
                        <th>Highest Edu. Qulification</th>
                        <th>Action</th>
                        @endcan
        			</tr>
        		</thead>
        		<tbody>
        			<?php  $no=1; ?> 
                    @foreach($youths->chunk(100) as $chunk)
        			@foreach($chunk as $youth)
        			<tr class="youth{{$youth->youth_id}}">
        				<td>{{$no++}}</td>
        				<td>{{ $youth->youth_name }}</td>
        				<td>{{ $youth->gender }}</td>
                        @can('add-youth')
        				<td>{{ $youth->nic }}</td>
        				<td>{{ $youth->current_status }}</td>
                        @can('admin')
                        <td>{{ $youth->ext }}</td>
                        @endcan
        				<td width="180">
        					<form id="cg" style="margin-bottom: 5px;">
        						{{csrf_field()}}

        						<input type="checkbox" name="cg" class="form-control cg" @if ($youth->cg) checked @endif  data-id="{{$youth->youth_id}}">
								<label> &nbsp; Career Guidance</label>	
        					</form>
        					
        					<form id="soft" style="margin-bottom: 5px;">
        						{{csrf_field()}}

        						<input type="checkbox" name="soft_skills" class="soft" @if ($youth->soft_skills) checked @endif data-id="{{$youth->youth_id}}">
								<label>&nbsp; Soft Skill</label>
							</form>

							<form id="vt" name="vt"  style="margin-bottom: 5px;">
        						{{csrf_field()}}

								<input type="checkbox" class="vt" data-id="{{$youth->youth_id}}" @if ($youth->vt) checked @endif>
								<label>&nbsp; VT Course</label>
							</form>

							<form id="prof" name="prof"   style="margin-bottom: 5px;">
        						{{csrf_field()}}

								<input type="checkbox" class="prof" data-id="{{$youth->youth_id}}" @if ($youth->prof) checked @endif>
								<label>&nbsp; Prof. Course</label>
							</form>

							<form id="job" name="jobs" style="margin-bottom: 5px;">
        						{{csrf_field()}}

								<input type="checkbox" class="jobs" data-id="{{$youth->youth_id}}" @if ($youth->jobs) checked @endif>
								<label>&nbsp; Job</label>
							</form>
                            <form id="bss" name="bss" style="margin-bottom: 5px;">
                                {{csrf_field()}}

                                <input type="checkbox" class="bss" data-id="{{$youth->youth_id}}" @if ($youth->bss) checked @endif>
                                <label>&nbsp; BSS Beneficiary</label>
                            </form>
        				</td>
        				<td>
        					@can('view-youth')
                        	<div class="btn-group">
                                @can('admin')
                        		<a href="{{ URL::to('youth/' . $youth->youth_id . '/view-progress') }}" target="_blank">
                                    <button type="button" id="view-progress" data-id="{{$youth->youth_id}}" class="btn btn-block btn-primary btn-flat btn-sm" ><i class="fas fa-tasks"></i> </button>
                                </a>
                                @endcan
                                <a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}" target="_blank">
                                    <button type="button" id="view-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a>
                            
                            @endcan
                            @can('edit-youth')
                            <a href="{{ URL::to('youth/' . $youth->youth_id . '/edit') }}" target="_blank" title="">
                                    <button type="submit" id="edit-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                            </a>        
                        	@endcan
                        	@can('delete-youth')
                            
                                <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button data-toggle="confirmation" type="button" id="delete-youth" data-id="{{$youth->youth_id}}" class="btn btn-block btn-danger btn-flat btn-sm" ><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </div>
                            @endcan
        				</td>
                        @endcan
                        @can('search-youth')
                        <td>{{$youth->family->district}}</td>
                        <td>{{$youth->highest_qualification}}</td>
                        <td>
                            <a href="{{ URL::to('youth/' . $youth->youth_id . '/view') }}">
                                    <button type="button" id="view-youth" data-id="{{$youth->id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> Profile </button>
                                </a>
                        </td>
                        @endcan
        			</tr>
                    @endforeach
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

    //bss checked 
    $(document).on('ifClicked', '.bss', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-bss',
                      
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

$(document).ready(function() {
    var table =  $('#example').DataTable();

    $('#district').on('change', function () {
        table.columns(3).search( this.value ).draw();
    } );

    $('#highest_qualification').on('change', function () {
        table.columns(4).search( this.value ).draw();
    } );

});
</script>

@endsection