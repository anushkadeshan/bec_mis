@extends('layouts.reports')
@section('title','Regional Meeting |')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                  		
            <h3>1.1.1 Attending BMIC regional meeting <small class="badge badge-danger"> {{count($meetings)}}</small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">1.1.1</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 hidden-print">
      <div class="card card-warning card-outline">
                    <div class="card-header">
                      <h3 class="card-title">Filters</h3>
                    </div>
                    <div class="card-body">
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #5E6971; color: white;">
                      <?php $branch_id = Auth::user()->branch; ?> 
                      @if(is_null($branch_id)) 
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
                      @else
                      <input type="hidden" name="branch_id" value="{{$branch_id}}"> 
                      @endif

                      <li class="nav-item">
                        <a class="nav-link">
                            
                         <div class="input-group date" data-provide="datepicker">
                			<input type="text" class="form-control" id="dateStart" data-date-end-date="0d" placeholder="From">
               			 <div class="input-group-addon">
                    	<span class="glyphicon glyphicon-th"></span>
                		</div>
            			</div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">
                         <div class="input-group date" data-provide="datepicker">
                            <input type="text" name="dateEnd" id="dateEnd" class="form-control" data-date-end-date="0d" placeholder="To">
                            <div class="input-group-addon">
                    			<span class="glyphicon glyphicon-th"></span>
                			</div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        	<a class="nav-link">
                      			<button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i class="fas fa-filter"></i> Filter <i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button>
                      			<button type="button" name="refresh" id="refresh" class="btn btn-default btn-flat">Refresh</button>
                      		</a>
                      </li>
                                      
                      </ul>
                    </div>
                  </div>
    </div>
    <div class="col-md-9">
      <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Data</h3>
                <ul class="nav nav-pills ml-auto p-2" id="tabs">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Summary</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Programs</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3">More</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  	<div id="">
                  		<a class="btn btn-app">
                  			<span class="badge bg-warning" id="total_records"></span>
                  			<i class="fa fa-handshake"></i>Meetings
                		</a>
                  	</div>
                    <div  class="row">
                      @cannot('branch')
                      <div class="col-md-6">
                        <table id="example3" class="table row-border table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch</th>
                                <th>No of Meetings</th>
                            </tr>
                            <tbody> 
                            </tbody>
                        </thead>        
                     </table>
                      </div>
                      @endcan
                    </div>
                      
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <table id="example" class="table row-border table-hover">
		                <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>Date</th>
		                        <th>District</th>
		                        <th>Branch</th>
		                        <th>Action</th>
		                      
		                    </tr>
		                    <tbody>	
		                    </tbody>
		                </thead>        
            		 </table>   
            	{{ csrf_field() }}
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane print" id="tab_3">
                    <div class="row">
                    	<div class="col-md-6">
                    		<div class="card card-success card-outline">
                    			<div class="card-header">
                                		<h3 class="card-title">Meeting Details</h3>
                            	</div>
                            	<div class="card-body">
		                    		<ul class="list-group list-group-flush">
									  <li class="list-group-item border-0"><strong>District : </strong><span id="district"></span></li>
									  <li class="list-group-item border-0"><strong>DSDs : </strong><span id="dsd"></span></li>
									  <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name"></span></li>
									  <li class="list-group-item border-0"><strong>Meeting Date : </strong><span id="meeting_date"></span></li>
									  <li class="list-group-item border-0"><strong>Time Start : </strong><span id="time_start"></span></li>
									  <li class="list-group-item border-0"><strong>Time End : </strong><span id="time_end"></span></li>
									  <li class="list-group-item border-0"><strong>Venue : </strong><span id="venue"></span></li>
									  <li class="list-group-item border-0"><strong>Matters Discussed: </strong><span id="matters"></span></li>
									  <li class="list-group-item border-0"><strong>Decisions Agreed: </strong><span id="decisions"></span></li>
									  <li class="list-group-item border-0"><strong>Matters to be further followed up: </strong><span id="decisions_to_followed"></span></li>
									  <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch"></span></li>
									</ul>
								</div>
							</div>	
                    	</div>	
                    	<div class="col-md-6">
                    		<div class="card card-primary card-outline">
                    			<div class="card-header">
                                		<h3 class="card-title">Participants <small class="badge badge-danger" id="total_participants"></small></h3>
                            	</div>
                            	<div class="card-body">
                            		<table id="example2" class="table row-border table-hover">
    						                <thead>
    						                    <tr>
    						                        <th>#</th>
    						                        <th>Name</th>
    						                        <th>Position</th>
    						                        <th>Branch</th>
    						                    </tr>
    						                    <tbody>	
    						                    </tbody>
    						                </thead>        
                		 				</table>
                            	</div>
                          </div>
                         
                    		<button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i> Print</button>
                    			
                    	</div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('js/printThis.js') }}" ></script>

<script>

$(document).ready(function() {
  
  var dataTable = $("#example").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
    });

  var dataTable2 = $("#example3").DataTable({
      dom: 'Bfrtip',
            buttons: [
                
            ],

            "bFilter": false,
            "bPaginate": false,
            "info":     false
    });
  
	var date = new Date();

    $('.input-group').datepicker({
    	todayBtn: 'linked',
  		format:'yyyy-mm-dd',
  		autoclose:true
 	});

 	var _token = $('input[name="_token"]').val();

 fetch_data();

 function fetch_data(dateStart = '', dateEnd = '',branch='')
 {
  $.ajax({
   url:"{{ route('reports-me/education/regional-meeting/fetch') }}",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,branch:branch},
   dataType:"json",
   beforeSend: function(){
        $('#loading').show();
    },
    complete: function(){
        $('#loading').hide();
    }, 
   success:function(data)
   {

    dataTable.clear().draw();
    var count = 1;
    $.each(data.data, function(index, value) {
    console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.meeting_date, value.district, value.name, '<div class="btn-group"><button type="button" name="view" data-id="'+value.r_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/regional')}}/'+value.r_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();
    });

    dataTable2.clear().draw();
    var count2 = 1;
    $.each(data.summary, function(index, value2) {
    // use data table row.add, then .draw for table refresh
    dataTable2.row.add([count2++, value2.name, value2.total]).draw();
    });
    var output = '';
   $('#total_records').text(data.data.length);


   }
  });

  $('#filter').click(function(){
  var dateStart = $('#dateStart').val();
  var dateEnd = $('#dateEnd').val();
  var branch = $('#branch_id').val();
  if(dateStart != '' &&  dateEnd != '')
  {
   fetch_data(dateStart, dateEnd, branch);
  }
  else
  {
    toastr.error('Error !', 'Both Date is required');
   
  }
 });

 $('#refresh').click(function(){
  $('#dateStart').val('');
  $('#dateEnd').val('');
  $('#branch_id').val('');
  fetch_data();
 });
 }

});

$('body').on('click', '.btn_view', function () {

      var meeting_id = $(this).data('id');

      $.get("{{ route('reports-me/education/regional-meeting') }}" +'/' + meeting_id +'/view', function (data) {

          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");
          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.meeting_date);
          $('#time_start').text(data.meeting.time_start);
          $('#time_end').text(data.meeting.time_end);
          $('#venue').text(data.meeting.venue);
          $('#matters').html(data.meeting.matters);
          $('#decisions').text(data.meeting.decisions);
          $('#decisions_to_followed').text(data.meeting.decisions_to_followed);
          $('#branch').text(data.meeting.name);




          var output1 = '';
		   $('#total_participants').text(data.participants.length);

		    for(var count = 0; count < data.participants.length; count++)
		    {
		    	
		     output1 += '<tr>';
		     output1 += '<td>' + (count+1) + '</td>';
		     output1 += '<td>' + data.participants[count].name + '</td>';
		     output1 += '<td>' + data.participants[count].position + '</td>';
		     output1 += '<td>' + data.participants[count].branch + '</td></tr>';
		    }
		    $('#example2 tbody').html(output1);


      })

   });



$('#print').click(function () {
    $('.print').printThis({
    	pageTitle: "Regional Meeting",
    });
});
	
</script>
@endsection