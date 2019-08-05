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
        		<div class="col-md-2 text-right">
        			<!-- Button trigger modal -->
					<a href="{{ROUTE('new-vacancy')}}"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#updateModel">Add Vacancy</button></a>
        		</div>
                @endcan
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            @can('apply-vacancy')
            <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
                <div class="col-md-3">
                        <div class="form-group row" >
                            <label for="business_function">Business Function</label>
                            <select class="form-control" id="business_function" name="business_function">
                                <option value="">All</option>
                                <option>Administration</option>
                                <option>Accounting &amp; Finance</option>
                                <option>Customer Support</option>
                                <option>Data Entry &amp; Analysis</option>
                                <option>Creative, Design &amp; Architecture</option>
                                <option>Education &amp; Training</option>
                                <option>Hospitality</option>
                                <option>Human Resources</option>
                                <option>IT &amp; Telecom</option>
                                <option>Legal</option>
                                <option>Logistics</option>
                                <option>Management</option>
                                <option>Manufacturing</option>
                                <option>Marketing &amp; PR</option>
                                <option>Operations</option>
                                <option>Quality Assurance</option>
                                <option>Research &amp; Technical</option>
                                <option>Sales &amp; Distribution</option>
                                <option>Security</option>
                                <option>Others</option>
                            </select>
                        </div>   
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="location">Location</label>  
                        <input class="form-control" type="text" id="location" name="location" placeholder="Enter Location">
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> 
                        <label for="specializaion">Educational Specialization</label>
                            <select name="specializaion" id="specializaion" class="form-control">
                                <option value="">All</option>
                                <option>Art &amp; Humanities</option>
                                <option>Business &amp; Management</option>
                                <option>Accounting</option>
                                <option>Design &amp; Fashion</option>
                                <option>Engineering</option>
                                <option>Events &amp; Hospitality</option>
                                <option>Finance &amp; Commerce</option>
                                <option>Human Resources</option>
                                <option>Information Technology</option>
                                <option>Law</option>
                                <option>Marketing &amp; Sales</option>
                                <option>Media &amp; Journalism</option>
                                <option>Medicine</option>
                                <option>Sciences</option>
                                <option>Vocational &amp; Technical</option>
                                <option>Others</option>
                            </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="job_type">Job Type</label>
                        <select id="job_type" name="job_type" class="form-control">
                            <option value="">All</option>
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Contractual</option>
                            <option>Internship</option>
                            <option>Temporary</option>
                            <option>Work from Home</option>                                 
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
                        <th>Job Type</th>
                        <th>Location</th>
                        <th>Edu. Specialization</th>
                        <th>Business Funtion</th>
                        @can('edit-vacancies')
                        <th>Action</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    @foreach ($vacancies as $vacancy)
                    <tr id='clickable-row' style="cursor: pointer" data-href='{{ URL::to('vacancy/' . $vacancy->id . '/view') }}' class="vacancy{{$vacancy->id}}">
                        <td>{{ $no++ }}</td>
                        <td><a href="{{ URL::to('vacancy/' . $vacancy->id . '/view') }}">{{ $vacancy->title }}</a>
                            <br><i class="fas fa-clock fa-xs"><small> {{$vacancy->dedline}}</small>
                        </td>
                        <td>{{ $vacancy->job_type }}</td>
                        <td>{{ $vacancy->location }}</td>
                        <td>{{ $vacancy->specializaion }}</td>
                        <td>{{ $vacancy->business_function }}</td>
                        @can('edit-vacancies')
                        <td>
                            <div class="btn-group">
                                <a href="{{ URL::to('vacancy/' . $vacancy->id . '/edit') }}">
                                    <button type="submit" id="edit-vacancy" data-id="{{$vacancy->id}}" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                                </a>
                                <form id="userDelete" method="post" >
                                {{ csrf_field() }}
                                    <button type="button" id="delete-vacancy" data-id="{{$vacancy->id}}" class="btn btn-block btn-danger btn-flat btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                            
                        </td>
                        @endcan
                    </a>
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
$(document).ready(function() {
    var table =  $('#example').DataTable();

    $('#business_function').on('change', function () {
        table.columns(5).search( this.value ).draw();
    } );

    $('#location').on('keyup', function () {
        table.columns(3).search( this.value ).draw();
    } );

    $('#specializaion').on('change', function () {
        table.columns(4).search( this.value ).draw();
    } );

    $('#job_type').on('change', function () {
        table.columns(2).search( this.value ).draw();
    } );
});

jQuery(document).ready(function($) {
    $("#clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

</script>

@endsection