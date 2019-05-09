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
	          									<label for="title">District</label>
    											<select name="district" id="district" class="form-control" data-dependent="ds_division">
			    									<option value="">All</option>
			     									@foreach($districts as $district)
			     									<option value="{{ $district->name_en}}">{{ $district->name_en }}</option>
			     									@endforeach
			    								</select>
   											</div>
            						</a>
            					
          						</li>
          						<li class="nav-item">
            						<a class="nav-link">
	              							<div class="form-group">
				          						<label for="ds_division">DS Division</label>
			    								<select name="ds_division" id="ds_division" class="form-control">
			     									<option value="">All</option>
			    								</select>
			   								</div>
	              						
            						</a>
          						</li>
          						<li class="nav-item">
            						<a class="nav-link">
	              						<div class="form-group">
			          						<label for="gn_division">GN Division</label>
		    								<select name="gn_division" id="gn_division" class="form-control">
		     									<option value="">All</option>
		    								</select>
		   								</div>
            						</a>
          						</li>          						
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
                	 <table id="example" class="table table-bordered table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>District</th>
                        <th>DS Division</th>
                        <th>DS ID</th>
                        <th>DS Division</th>
                        <th>GN ID</th>
                        <th></th>
                    </tr>
                </thead> 
                <tbody>
                 	@foreach($youths as $youth)
                	<tr>
                		<td>{{$youth->name}}</td>
                		<td>{{$youth->address}}</td>
                		<td>{{$youth->district}}</td>
                		<td>{{$youth->DSD_Name}}</td>
                		<td>{{$youth->ID}}</td>
                		<td>{{$youth->GN_Office}}</td>
                		<td>{{$youth->GN_ID}}</td>
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
                "targets": [ 4 ],
                "visible": false,
            },
            {
                "targets": [ 6 ],
                "visible": false
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

    

      $('#district').on('change', function () {
          table.columns(2).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#ds_division').on('change', function () {
          table.columns(4).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#gn_division').on('change', function () {
          table.columns(6).search( this.value ).draw();
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