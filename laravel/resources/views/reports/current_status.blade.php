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
                                <label for="gender">Status &nbsp;&nbsp;</label>
				          						  <select name="current_status" id="current_status" class="form-control">
                                    <option value="">All</option>
                                    <option >Permanent Job After Vocational/Prof Training</option>
                                    <option >Permanent Job without Vocational/Prof Training</option>
                                    <option >Temporary Job After Vocational/Prof Training</option>
                                    <option >Temporary Job without Vocational/Prof Training</option>
                                    <option >Following a course</option>
                                    <option >Self Employed</option>
                                    <option >No Job</option>
                                    
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
                        <th>Address</th>
                        <th>Contacts</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Branch</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
             @foreach($youths as $youth)
                	<tr>
                		<td>{{$youth->name}}</td>
                		<td>{{$youth->family->address}}</td>
                		<td>{{$youth->phone}}</td>
                		<td>{{$youth->email}}</td>
                    <td>{{$youth->current_status}}</td>
                		<td>{{$youth->branch_id}}</td>
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
                "targets": [ 5 ],
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

    

      $('#current_status').on('change', function () {
          table.columns(4).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#branch_id').on('change', function () {
          table.columns(5).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
});

   	$(document).ready(function(){
   	  $(document).on('change','#district',function(e){
   	  		
   	  		var district = e.target.value;
   	  		

   	  		$.get('/ds-division?district=' +district, function(data){
   	  			//success
   	  			console.log(data);
   	  			$('#ds_division').empty();
   	  			$('#gn_division').empty();	  		
   	  			$.each(data, function(index, dsObj){
   	  				$('#ds_division').append('<option value="'+dsObj.ID+'">'+dsObj.DSD_Name+'</option>');

   	  			});
   	  		});
   	  });

   	  $(document).on('change','#ds_division',function(e){
   	  		
   	  		var ds_division = e.target.value;
   	  		

   	  		$.get('/gn-division?ds_division=' +ds_division, function(data){
   	  			//success
   	  			console.log(data);
   	  			$('#gn_division').empty();
   	  			$.each(data, function(index, gnObj){
   	  				$('#gn_division').append('<option value="'+gnObj.GN_ID+'">'+gnObj.GN_Office+'</option>');

   	  			});
   	  		});
   	  });
   	});
</script>
@endsection