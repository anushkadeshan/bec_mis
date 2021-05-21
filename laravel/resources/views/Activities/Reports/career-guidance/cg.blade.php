@extends('layouts.reports')
@section('title','Career Guidances |')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                      
            <h3>2.1.6 Career Guidance & Career fair workshop
              <small class="badge badge-success"> {{count($meetings)}}</small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">2.1.6</li>
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
                    <div>
                    
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_records"></span>
                        <i class="fa fa-handshake"></i>Programs
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
                        <span class="badge bg-warning" id="total_cost"></span>
                        <i class="fa fa-dollar-sign"></i>Total Cost
                      </a>
                      
                    </div>
                    @cannot('branch')
                        <div class="col-md-12">
                          <table id="example10" class="table row-border table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Programs</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Total Youths</th>
                                        <th>Cost</th>
                                    </tr>
                                    <tbody> 
                                    </tbody>
                                </thead>        
                            </table>
                          
                        </div>
                        @endcan
                    <div  class="row">
                      <div  class="col-md-5">
                        <div class="card card-primary">
                          <div  class="card-header">
                            Identified Requirements  <small class="badge badge-danger" id="total_participants"></small>
                          </div>
                          <div  class="card-body">
                            <table id="example6" class="table row-border table-hover"> 
                              <thead>
                                <tr>
                                  <th>Requirement</th>
                                  <th>Male</th>
                                  <th>Female</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                              </tbody>
                            </table>                                
                          </div>   
                          </div>
                      </div>
                      <div  class="col-md-7">
                        <div class="card card-success">
                          <div  class="card-header">
                            Youth Participation (all time) <a href="{{Route('view_cg_youths')}}"><span  class="badge badge-warning float-right" id="row_count">View Youth Report</span></a>
                          </div>
                          <div  class="card-body">
                        
                                <div id="curve_chart" style=" height: 300px"></div>
                                
                          </div>   
                          </div>
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
                            <th>Male</th>
                            <th>Female</th>
                            <th>PWD M</th>
                            <th>PWD F</th>
                            <th>Venue</th>
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
                              <li class="list-group-item border-0"><strong>GNDs : </strong><span id="gnd"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name"></span></li>
                              <li class="list-group-item border-0"><strong>Meeting Date : </strong><span id="meeting_date"></span></li>
                              <li class="list-group-item border-0"><strong>Time Start : </strong><span id="time_start"></span></li>
                              <li class="list-group-item border-0"><strong>Time End : </strong><span id="time_end"></span></li>
                              <li class="list-group-item border-0"><strong>Venue : </strong><span id="venue"></span></li>
                              <li class="list-group-item border-0"><strong>Program Cost: </strong><span id="program_cost"></span></li>
                              <li class="list-group-item border-0"><strong>Total Male: </strong><span id="total_male"></span></li>
                              <li class="list-group-item border-0"><strong>Total Female: </strong><span id="total_female"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Male: </strong><span id="pwd_male"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Female: </strong><span id="pwd_female"></span></li>
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
                                    <h3 class="card-title">Company/ Institute Participants <small class="badge badge-danger" id="total_participants2"></small></h3>
                              </div>
                              <div class="card-body">
                                <table id="example2" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Type of institute/company</th>
                                          <th>Business Address </th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                  </thead>        
                                </table>
                              </div>
                          </div>
                          <div class="card card-primary card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">Summary of the career test</h3>
                              </div>
                              <div class="card-body">
                                <table id="example4" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Career Field </th>
                                          <th>Male</th>
                                          <th>Female </th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                
                                  </thead>        
                                </table>
                              </div>
                          </div>
                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                              <h3 style="float: left" class="card-title">Youth Participaetd to Program<small class="badge badge-danger" id="total_youth"></small> </h3><a href=""><span style="float: right" class="float-right">Summary</span></a>
                              </div>
                              <div class="card-body">
                                <table id="example5" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name  </th>
                                          <th>Career Field</th>
                                          <th>Gender </th>
                                          <th>Phone </th>
                                          <th>Highest Qualification </th>
                                          <th>Current Status </th>
                                          <th></th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                      
                                  </thead>        
                                </table>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">No. of youth identified to support on VT/Professional education  <small class="badge badge-danger" id="total_vt"></small></h3>
                              </div>
                              <div class="card-body">
                                <table id="example3" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Identified requirement  </th>
                                          <th>Male</th>
                                          <th>Female </th>
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
               
            ],
    });

var dataTable3 = $("#example10").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],

            "bFilter": false,
            "bPaginate": false,
            "info":     false,

           'columnDefs': [
            {
                "targets": [6], // your case first column
                "className": "text-right",
                "width": "4%"
           }],

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
   url:"{{ Route('reports-me/cg/cg/fetch') }}",
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
   var male_sum = 0;
   var female_sum = 0;
   var pwd_m_sum = 0;
   var pwd_f_sum = 0;
   var cost_sum = 0;
    dataTable3.clear().draw();
    var count2 = 1;
    $.each(data.summary, function(index, value2) {
    // use data table row.add, then .draw for table refresh
    dataTable3.row.add([count2++, value2.name, value2.progs, value2.male,value2.female, value2.male+value2.female,value2.cost.toLocaleString()]).draw();
    });
  $.each(data.data2, function(index, value) {

    //console.log(value); 
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.meeting_date, value.total_male, value.total_female, value.pwd_male,value.pwd_female,value.venue, value.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/cg')}}/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

     var total_male = value.total_male;
     var total_female = value.total_female;
     var total_p_male = value.pwd_male;
     var total_p_female = value.pwd_female;
     var total_cost = value.program_cost;
     if ($.isNumeric(total_male,total_female,total_p_male,total_p_female,program_cost)) {
          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
          cost_sum += parseFloat(total_cost);
      } 
  });


  var output1 = '';
          for(var count = 0; count < data.data1.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + data.data1[count].requirement + '</td>';
           output1 += '<td>' + data.data1[count].total_male + '</td>';
           output1 += '<td>' + data.data1[count].total_female + '</td></tr>';



          }
          $('#example6 tbody').html(output1);

   
   $('#total_records').text(data.data2.length);
   $('#total_male1').text(male_sum);
   $('#total_female1').text(female_sum);
   $('#total_p_male').text(pwd_m_sum);
   $('#total_p_female').text(pwd_f_sum);
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
       

      $.get("{{ url('reports-me/cg/cg') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");
          var array = data.meeting.gnd;
          var args = Array.prototype.slice.call(array);
          var stt = array.toString();
          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#gnd').text(stt);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.date);
          $('#time_start').text(data.meeting.time_start);
          $('#time_end').text(data.meeting.time_end);
          $('#venue').text(data.meeting.venue);
          $('#program_cost').text(data.meeting.program_cost);
          $('#total_male').text(data.meeting.total_male);
          $('#total_female').text(data.meeting.total_female);
          $('#pwd_male').text(data.meeting.pwd_male);
          $('#pwd_female').text(data.meeting.pwd_female);
          $('#resourse').text(data.meeting.r_name);
          $('#mode_of_conduct').html(data.meeting.mode_of_conduct);
          $('#topics').html(data.meeting.topics);
          $('#deliverables').html(data.meeting.deliverables);
          $('#branch').text(data.meeting.branch_name);
          $('#download_a').data('id',data.meeting.attendance); 
          $('#download_a').data('attendance',data.meeting.attendance); 

          var file_id = data.meeting.attendance;
          var url = SITE_URL+ '/download/cg/'+file_id;

          $("#link").attr("href",url);

          var id = data.meeting.m_id;
          var url1 = SITE_URL+ '/download/cg/photos/'+id;

          $("#link2").attr("href",url1);
          //alert(url1)

          var output1 = '';
          $('#total_participants2').text(data.participants.length);

          for(var count = 0; count < data.participants.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + (count+1) + '</td>';
           output1 += '<td>' + data.participants[count].name + '</td>';
           output1 += '<td>' + data.participants[count].type + '</td>';
           output1 += '<td>' + data.participants[count].address + '</td></tr>';
          }
          $('#example2 tbody').html(output1);

          var output2 = '';
          //$('#total_vt').text(data.cg_youth_selected.length);

          for(var count = 0; count < data.cg_youth_selected.length; count++)
          {
            
           output2 += '<tr>';
           output2 += '<td>' + (count+1) + '</td>';
           output2 += '<td>' + data.cg_youth_selected[count].requirement + '</td>';
           output2 += '<td>' + data.cg_youth_selected[count].male + '</td>';
           output2 += '<td>' + data.cg_youth_selected[count].female + '</td></tr>';
          }
          $('#example3 tbody').html(output2);


          var output3 = '';
          //$('#total_ct').text(data.cg_careertest_summary.length);

          for(var count = 0; count < data.cg_careertest_summary.length; count++)
          {
            
           output3 += '<tr>';
           output3 += '<td>' + (count+1) + '</td>';
           output3 += '<td>' + data.cg_careertest_summary[count].career_field + '</td>';
           output3 += '<td>' + data.cg_careertest_summary[count].male + '</td>';
           output3 += '<td>' + data.cg_careertest_summary[count].female + '</td></tr>';
          }
          
          $('#example4 tbody').html(output3);

          var output4 = '';
          $('#total_youth').text(data.cg_youths.length);

          for(var count = 0; count < data.cg_youths.length; count++)
          {
            
           output4 += '<tr>';
           output4 += '<td>' + (count+1) + '</td>';
           output4 += '<td>' + data.cg_youths[count].name + '</td>';
           output4 += '<td>' + data.cg_youths[count].career_field1 + '</td>';
           output4 += '<td>' + data.cg_youths[count].gender + '</td>';
           output4 += '<td>' + data.cg_youths[count].phone + '</td>';
           output4 += '<td>' + data.cg_youths[count].highest_qualification + '</td>';
           output4 += '<td>' + data.cg_youths[count].current_status + '</td>';
           output4 += '<td><a href="'+SITE_URL+'/youth/'+data.cg_youths[count].youth_id+'/view" target="_blank"><button type="button" name="view" data-id="'+data.cg_youths[count].youth_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button></a></td></tr>';
          }
          $('#example5 tbody').html(output4);




      })

   });



$('#print').click(function () {
    $('.print').printThis({
      pageTitle: "Career Guidance Program",
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
          title: '',
          curveType: 'function',
          chartArea:{
          left:45,
          top: 20,
          bottom:20,
          right : 10,
          },
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
</style>
@endsection