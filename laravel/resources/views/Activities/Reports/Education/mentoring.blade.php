@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                  		
            <h3>1.2.2 Mentoring program <small class="badge badge-success"> {{count($mentorings)}}</small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">1.2.2</li>
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
                  	<div class="text-center">
                    
                  		<a class="btn btn-app zoom">
                  			<span class="badge bg-warning" id="total_records"></span>
                  			<i class="fa fa-handshake"></i>Meetings
                		  </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning"  id="total_male1"></span>
                        <i class="fa fa-mars" style="color:blue"></i>Total Male
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning"  id="total_female1"></span>
                        <i class="fa fa-venus" style="color:#FF00CD"></i>Total Female
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_p_male"></span>
                        <i class="fa fa-wheelchair" style="color:blue"></i>PWD Male
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_p_female"></span>
                        <i class="fa fa-wheelchair" style="color:#FF00CD"></i>PWD Female
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_fathers"></span>
                        <i class="fa fa-male"></i>Fathers
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_mothers"></span>
                        <i class="fa fa-female"></i>Mothers
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_mg"></span>
                        <i class="fa fa-male" style="color:blue"></i>M-Guardiance
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_fg"></span>
                        <i class="fa fa-female" style="color:#FF00CD" ></i>F-Guardiance
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_cost"></span>
                        <i class="fa fa-dollar-sign"></i>Total Cost
                      </a>
                  	</div>
                    <div  class="row" style="background-color: #CFCFCF">
                        <div class="col-md-12">
                          <div id="curve_chart" style=" height: 500px"></div>
                          
                        </div>
                    </div>  
                    
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <table id="example" class="table row-border table-hover">
		                <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>Program Date</th>
                            <th>M</th>
                            <th>F</th>
                            <th>PWD M</th>
                            <th>PWD F</th>
                            <th>Fathers</th>
                            <th>Mothers</th>
                            <th>M Guard.</th>
		                        <th>F Guard.</th>
		                        <th>Branch</th>
                            <th>Action</th>
		                        <th></th>
		                      
		                    </tr>
		                    <tbody>	
		                    </tbody>
                        <tfoot>
                  <tr>
                    <th></th>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>   
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
          									  <li class="list-group-item border-0"><strong>Program Date : </strong><span id="meeting_date"></span></li>
          									  <li class="list-group-item border-0"><strong>Time Start : </strong><span id="time_start"></span></li>
          									  <li class="list-group-item border-0"><strong>Time End : </strong><span id="time_end"></span></li>
          									  <li class="list-group-item border-0"><strong>Venue : </strong><span id="venue"></span></li>
          									  <li class="list-group-item border-0"><strong>Program Cost: </strong><span id="program_cost"></span></li>
          									  <li class="list-group-item border-0"><strong>Total Male: </strong><span id="total_male"></span></li>
                              <li class="list-group-item border-0"><strong>Total Female: </strong><span id="total_female"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Male: </strong><span id="pwd_male"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Female: </strong><span id="pwd_female"></span></li>
                              <li class="list-group-item border-0"><strong>Mothers: </strong><span id="mothers"></span></li>
                              <li class="list-group-item border-0"><strong>Fathers: </strong><span id="fathers"></span></li>
                              <li class="list-group-item border-0"><strong>Male Gurdians: </strong><span id="male_gurdians"></span></li>
                              <li class="list-group-item border-0"><strong>female Gurdians: </strong><span id="female_gurdians"></span></li>
                              <li class="list-group-item border-0"><strong>Resourse Person: </strong><span id="resourse"></span></li>
                              <li class="list-group-item border-0"><strong>Mode of Conduct: </strong><span id="mode_of_conduct"></span></li>
          									  <li class="list-group-item border-0"><strong>Topics: </strong><span id="topics"></span></li>
                              <li class="list-group-item border-0"><strong>Deliverables: </strong><span id="deliverables"></span></li>
          									  <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch"></span></li>
          									</ul>
          								</div>
          							</div>	
                    	</div>	
                    	<div class="col-md-6">
                    		<div class="card card-primary card-outline">
                    			<div class="card-header">
                                		<h3 class="card-title">Government Officials <small class="badge badge-danger" id="total_participants"></small></h3>
                            	</div>
                            	<div class="card-body">
                            		<table id="example2" class="table row-border table-hover">
						                <thead>
						                    <tr>
						                        <th>#</th>
                                    <th>Name</th>
						                        <th>Gender</th>
						                        <th>Position</th>
						                        <th>Institute</th>
						                    </tr>
						                    <tbody>	
						                    </tbody>
						                </thead>        
            		 				</table>
                            	</div>
                          </div>
                         
                    		<button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i> Print</button>
                        <a id="link" href="" target="_blank">  <button type="button" id="download_a" name="file_name" class="btn btn-primary btn-flat" data-id="" data-attendance=""><i class="fas fa-download"></i> Download Attendanace</button></a> 
                        <a id="link2" href="" target="_blank">  <button type="button" id="download_a" name="id" class="btn btn-warning btn-flat"><i class="fas fa-download"></i> Download Photos</button></a> 
                        @can('verify-report')
                        <br>  
                        <br>  
                        <div  class="form-group">
                          <button type="button" class="btn btn-light" id="verify"><span id="verify-lable">Verify</span> <i id="icon" style="display: none" class="fa fa-check   faa-ring animated" aria-hidden="true"></i> </button>
                        </div>
                        {{ csrf_field() }}  
                        @endcan
                    		{{ csrf_field() }}	
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

$(document).ready(function() {

var dataTable = $("#example").DataTable({

      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

      "createdRow": function ( row, data, index ) {
            if ( data[12] == 0 ) {
                $('td', row).eq(0).addClass('highlight');
            }

            else{
              $('td', row).eq(0).addClass('highlight2');
            }
        },

        "columnDefs": [
            {
                "targets": [ 12 ],
                "visible": false,
            }
        ],
    });

  dataTable.columns( '.sum' ).every( function () {
    var column = this;

            var sum = column
                .data()
                .reduce(function (a, b) { 
                   a = parseInt(a, 10);
                   if(isNaN(a)){ a = 0; }                   

                   b = parseInt(b, 10);
                   if(isNaN(b)){ b = 0; }

                   return a + b;
                });
 
    $( this.footer() ).html( sum );
} );
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
   url:"{{ route('reports-me/education/mentoring/fetch') }}",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,branch:branch},
   dataType:"json",
   success:function(data)
   {
  
  dataTable.clear().draw();
   var count = 1;
   var male_sum = 0;
   var female_sum = 0;
   var fathers_sum = 0;
   var mothers_sum = 0;
   var pwd_m_sum = 0;
   var pwd_f_sum = 0;
   var mg_sum = 0;
   var fg_sum = 0;
   var cost_sum = 0;
  $.each(data, function(index, value) {
    console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.program_date, value.total_male, value.total_female, value.pwd_male,value.pwd_female,value.fathers, value.mothers, value.male_gurdians, value.female_gurdians, value.ext,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button></div>',value.verified]).draw();

     var total_male = value.total_male;
     var total_female = value.total_female;
     var total_fathers = value.fathers;
     var total_mothers = value.mothers;
     var total_p_male = value.pwd_male;
     var total_p_female = value.pwd_female;
     var total_mg = value.male_gurdians;
     var total_fg = value.female_gurdians;
     var total_cost = value.program_cost;
     if ($.isNumeric(total_male,total_female,total_mothers,total_fathers,total_p_male,total_p_female,male_gurdians,female_gurdians,program_cost)) {
          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          mothers_sum += parseFloat(total_mothers);
          fathers_sum += parseFloat(total_fathers);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
          mg_sum += parseFloat(total_mg);
          fg_sum += parseFloat(total_fg);
          cost_sum += parseFloat(total_cost);
      } 
  });
   
   $('#total_records').text(data.length);
   $('#total_male1').text(male_sum);
   $('#total_female1').text(female_sum);
   $('#total_fathers').text(fathers_sum);
   $('#total_mothers').text(mothers_sum);
   $('#total_p_male').text(pwd_m_sum);
   $('#total_p_female').text(pwd_f_sum);
   $('#total_mg').text(mg_sum);
   $('#total_fg').text(fg_sum);
   $('#total_cost').text(cost_sum.toLocaleString());
    
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
       
      $.get("{{ route('reports-me/education/mentoring') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.program_date);
          $('#time_start').text(data.meeting.time_start);
          $('#time_end').text(data.meeting.time_end);
          $('#venue').text(data.meeting.venue);
          $('#program_cost').text(data.meeting.program_cost);
          $('#total_male').text(data.meeting.total_male);
          $('#total_female').text(data.meeting.total_female);
          $('#pwd_male').text(data.meeting.pwd_male);
          $('#pwd_female').text(data.meeting.pwd_female);
          $('#fathers').text(data.meeting.fathers);
          $('#mothers').text(data.meeting.mothers);
          $('#female_gurdians').text(data.meeting.female_gurdians);
          $('#male_gurdians').text(data.meeting.male_gurdians);
          $('#resourse').text(data.meeting.r_name);
          $('#mode_of_conduct').html(data.meeting.mode_of_conduct);
          $('#topics').html(data.meeting.topics);
          $('#deliverables').html(data.meeting.deliverables);
          $('#branch').text(data.meeting.branch_name);
          $('#download_a').data('id',data.meeting.attendance); 
          $('#download_a').data('attendance',data.meeting.attendance); 

          var file_id = data.meeting.attendance;
          var url = SITE_URL+ '/download/mentoring/'+file_id;

          $("#link").attr("href",url);

          var id = data.meeting.m_id;
          var url1 = SITE_URL+ '/download/mentoring/photos/'+id;

          $("#link2").attr("href",url1);
          //alert(url1)

          var verify = data.meeting.verified;

          if(verify==1){
            $("#verify").attr("class" ,'btn btn-success btn-flat');
            $("#verify-lable").text('Verified');

          }

          else{
             $("#verify").attr("class" ,'btn btn-danger btn-flat');
             $("#verify-lable").text('Verify');
             $('#verify').data('id',id);
             $('#verify').data('table','mentoring');
          }



          var output1 = '';
		   $('#total_participants').text(data.participants.length);

		    for(var count = 0; count < data.participants.length; count++)
		    {
		    	
		     output1 += '<tr>';
		     output1 += '<td>' + (count+1) + '</td>';
		     output1 += '<td>' + data.participants[count].name + '</td>';
         output1 += '<td>' + data.participants[count].gender + '</td>';
         output1 += '<td>' + data.participants[count].designation + '</td>';
		     output1 += '<td>' + data.participants[count].institute + '</td></tr>';
		    }
		    $('#example2 tbody').html(output1);


      })

   });

$(document).ready(function(){
  $('#verify').click( function(){
    //alert($('#download_a').data('attendance'));
    var _token = $('input[name="_token"]').val();
    var id = $('#verify').data('id');
    var table = $('#verify').data('table');

    $.ajax({
      url: SITE_URL + '/verify/report/',
      method:"POST",
      data:{id:id, table:table, _token:_token},
      //dataType:"json",


      success:function(data)
      {
          $('#icon').show();
          $("#verify").attr("class" ,'btn btn-success btn-flat');
          $("#verify-lable").text('Verified');
          toastr.success('Verified Successfully !', 'Congradulations')

      },

      error: function (jqXHR, exception) {    
        console.log(jqXHR);
        toastr.error('Error !', 'Something Error')
      },

    });

  });
});

$('#print').click(function () {
    $('.print').printThis({
    	pageTitle: "Mentoring Program",
    });
});

$(document).ready(function(){
  $('#download_a').click( function(){
    //alert($('#download_a').data('attendance'));
    var _token = $('input[name="_token"]').val();
    var id = $('#download_a').data('id');
    var attendance = $('#download_a').data('attendance');

    $.ajax({
      url: SITE_URL + '/download/mentoring/',
      method:"GET",
      data:{id:id, attendance:attendance, _token:_token},
      dataType:"json",

      beforeSend: function(){
        $('#loading').show();
      },
      complete: function(){
        $('#loading').hide();
      }, 
      success:function(data)
      {
          console.log(data);
      },

      error: function (jqXHR, exception) {    
        console.log(jqXHR);
        toastr.error('Error !', 'Something Error')
      },

    });

  });
});
	
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Total Male', 'Total Female','PWD Male','PWD Female'],
          ['2018',  @if($participants2018->total_male==null) {{0}} @else {{$participants2018->total_male}} @endif , @if($participants2018->total_female==null) {{0}} @else {{$participants2018->total_female}}@endif, @if($participants2018->pwd_male==null) {{0}} @else{{$participants2018->pwd_male}}@endif,@if($participants2018->pwd_female==null) {{0}} @else{{$participants2018->pwd_female}}@endif],
          ['2019',  @if($participants2019->total_male==null) {{0}} @else {{$participants2019->total_male}} @endif , @if($participants2019->total_female==null) {{0}} @else {{$participants2019->total_female}}@endif, @if($participants2019->pwd_male==null) {{0}} @else{{$participants2019->pwd_male}}@endif,@if($participants2019->pwd_female==null) {{0}} @else{{$participants2019->pwd_female}}@endif],
          ['2020',  @if($participants2020->total_male==null) {{0}} @else {{$participants2020->total_male}} @endif , @if($participants2020->total_female==null) {{0}} @else {{$participants2020->total_female}}@endif, @if($participants2020->pwd_male==null) {{0}} @else{{$participants2020->pwd_male}}@endif,@if($participants2020->pwd_female==null) {{0}} @else{{$participants2020->pwd_female}}@endif],
          ['2021',  @if($participants2021->total_male==null) {{0}} @else {{$participants2021->total_male}} @endif , @if($participants2021->total_female==null) {{0}} @else {{$participants2021->total_female}}@endif, @if($participants2021->pwd_male==null) {{0}} @else{{$participants2021->pwd_male}}@endif,@if($participants2021->pwd_female==null) {{0}} @else{{$participants2021->pwd_female}}@endif],
          
        ]);

        var options = {
          title: 'Youth Participants',
          curveType: 'function',
          legend: { position: 'bottom',
          interpolateNulls: true,
          animation:{
            duration: 1000,
            easing: 'out',
          }, }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        
        chart.draw(data, options);
      }


</script>
<style>
  th { font-size: 15px; }
  td { font-size: 14px; }

  .zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  z-index: 5000;
  transition: all .2s ease-in-out;
}

td.highlight {
      border-left: solid 5px #EB3062;
    }
td.highlight2 {
      border-left: solid 5px #33A532;
    }
</style>
@endsection