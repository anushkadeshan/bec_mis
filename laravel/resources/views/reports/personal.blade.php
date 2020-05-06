@extends('layouts.reports')
@section('content')
<div class="container-fluid">
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Personal Reports</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{Route('reports/index')}}">Reprots Selection</a></li>
              <li class="breadcrumb-item active">Personal Reports</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="card card-warning card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Filters</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #5E6971; color: white;">
                				
                				<li class="nav-item">
            						<a class="nav-link">
	              							<div class="form-group">
                   								<label for="gender">Gender: &nbsp;&nbsp;</label>
                   								<select name="gender" id="gender" class="form-control">
                   									<option value="">All</option>
                   									<option value="Male">Male</option>
                   									<option value="Female">Female</option>
                   								</select>
                   							</div>
            						</a>
            					
          						</li>
          						<li class="nav-item">
            						<a class="nav-link">
	              							<div class="form-group">
                            <label for="maritial_status">Marital Status &nbsp;&nbsp;</label>
                            <select name="maritial_status" id="maritial_status" class="form-control">
                              <option value="">All</option>
                              <option>Single</option>
                              <option>Married</option>
                              <option>Divorced</option>
                              <option>Seperated</option>
                              <option>Dependent</option>
                              <option>Widow</option>
                            </select>
                          </div>
	              						
            						</a>
          						</li>
          						<li class="nav-item">
            						<a class="nav-link">

	              							<div class="form-group">
                                <label for="nationality">Nationility: &nbsp;&nbsp;</label>
                                <select name="nationality" id="nationality" class="form-control">
                                  <option value="">All</option>
                                  <option>Sinhala</option>
                                  <option>Tamil</option>
                                  <option>Muslim</option>
                                  <option>Burger</option>
                                  <option>Other</option>
                                </select>
                              </div>
            						</a>
          						</li>
          						<li class="nav-item">
            						<a class="nav-link">
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
            						</a>
          						</li>
          						<li class="nav-item">
            						<a class="nav-link">
	              						<div class="form-group">
                            <label for="disability">Are you differtnly abled? &nbsp;&nbsp;</label>
                            <select name="disability" id="disability" class="form-control">
                              <option value="">All</option>
                              <option>Yes</option>
                              <option>No</option>
                            </select>
                          </div>
            						</a>
          						</li>
                      @can('admin')
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Branch &nbsp;&nbsp;</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                              <option value="">All</option>
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}">{{$branch->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </a>
                      </li>
          						@endcan
                			</ul>
                		</div>
                	</div>
		</div>
		<div class="col-md-9">
			<div class="card card-success card-outline">
              	<div class="card-header">
                	<h3 class="card-title">Youth Details <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <div class="card-body">
                	 <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Maritail Status</th>
                        <th>Nationality</th>
                        <th>Edu. Qualificaton</th>
                        <th>Disability</th>
                        <th>Branch</th>
                        <th>NIC</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                	@foreach($youths as $youth)
                	<tr>
                		<td>{{$youth->name}}</td>
                		<td>{{$youth->gender}}</td>
                		<td>{{$youth->maritial_status}}</td>
                		<td>{{$youth->nationality}}</td>
                		<td>{{$youth->highest_qualification}}</td>
                    <td>{{$youth->disability}}</td>
                    <td>{{$youth->branch_id}}</td>
                    <td>{{$youth->nic}}</td>
                		<td><a href="{{ URL::to('youth/' . $youth->id . '/view') }}">
                                    <button type="button" id="view-youth" data-id="{{$youth->id}}" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a></td>
                		
                	</tr>
                	@endforeach
                </tbody>
            </table>      
                </div>
            </div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script	>

	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
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
                "targets": [ 6 ],
                "visible": false,
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
    
    $('#gender').on('change', function () {
          const regExSearch = '^' + this.value + '$';
          table.columns(1).search(regExSearch, true, false).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      });

      $('#maritial_status').on('change', function () {
          table.columns(2).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#nationality').on('change', function () {
          table.columns(3).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#highest_qualification').on('change', function () {
          table.columns(4).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#disability').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#branch_id').on('change', function () {
          table.columns(6).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
} );
</script>
@endsection