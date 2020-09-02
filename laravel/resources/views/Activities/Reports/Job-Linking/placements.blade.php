@extends('layouts.reports')
@section('title','Job Placement |')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                      
            <h3>Job Fares/ Interviews</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">4.2.4</li>
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
                            <button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i class="fas fa-filter"></i> Filter</button>
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
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Job Fares/Interviews</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3">More</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Ind. Placements</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_5">More</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div>
                    <fieldset class="border p-2">
                          <legend  class="w-auto"><small>Interviews/Job Fairs</small></legend>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_records"></span>
                        <i class="fa fa-handshake"></i>Interviews
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

                      @cannot('branch')
                        <div class="col-md-12">
                          <table id="example10" class="table row-border table-hover">
                                <thead>
                                    <tr>
                                        <th width="20">#</th>
                                        <th>Branch</th>
                                        <th>No of Job Fairs </th>
                                        <th>Total Cost </th>
                                    </tr>
                                    <tbody> 
                                    </tbody>
                                </thead>        
                            </table>
                          
                        </div>
                        @endcan  
                    </fieldset>
                    <fieldset class="border p-2">
                          <legend  class="w-auto"><small>Individual Placements</small></legend>
                          <a class="btn btn-app zoom">
                          <span class="badge bg-warning" id="total_records2"></span>
                          <i class="fa fa-handshake"></i>Placements
                      </a>

                      @cannot('branch')
                        <div class="col-md-12">
                          <table id="example11" class="table row-border table-hover">
                                <thead>
                                    <tr>
                                        <th width="20">#</th>
                                        <th>Branch</th>
                                        <th>No of Placements </th>
                                        <th>Total Male </th>
                                        <th>Total Female </th>
                                    </tr>
                                    <tbody> 
                                    </tbody>
                                </thead>        
                            </table>
                          
                        </div>
                        @endcan  
                    </fieldset>

                    </div>
                    <div class="card card-success">
                    <div  class="card-header">
                     Youth Placed in Jobs - Interviews
                    </div>
                    <div  class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div id="curve_chart" style=" height: 400px"></div>
                          
                        </div>
                    </div>  
                      
                    </div>   
                    </div>
                    <div class="card card-primary">
                    <div  class="card-header">
                     Salary Range Analysis 
                    </div>
                    <div  class="card-body">
                    
                          <div id="curve_chart1" style=" height: 400px"></div>
                          
                        </div>
                    <div class="row">
                        <div class="col-md-6">
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
                            <th>Venue</th>
                            <th>Program Cost</th>
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
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">Job Interview Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">

                              <li class="list-group-item border-0"><strong>District : </strong><span class="text-muted" id="district"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span class="text-muted" id="dsd"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span class="text-muted" id="dm_name"></span></li>
                              <div class="row">
                                <div class="col-md-4">
                              <li class="list-group-item border-0"><strong>Program Date : </strong><span class="text-muted" id="meeting_date"></span></li>
                              </div>
                                <div class="col-md-4">
                              <li class="list-group-item border-0"><strong>Time Start : </strong><span class="text-muted" id="time_start"></span></li>
                              </div>
                                <div class="col-md-4">
                              <li class="list-group-item border-0"><strong>Time End : </strong><span class="text-muted" id="time_end"></span></li>
                              </div>
                              </div>
                              <li class="list-group-item border-0"><strong>Venue : </strong><span class="text-muted" id="venue"></span></li>

                              <li class="list-group-item border-0"><strong>Program Cost: </strong><span class="text-muted" id="program_cost"></span></li>
                              <div class="card card-success card-outline">
                              <div class="card-header">
                                    <h3 class="card-title">Employer Details <small class="badge badge-danger" id="total_participants"></small></h3>
                                  </div>
                                  <div class="card-body">

                                  <table id="example2" class="table row-border table-hover">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Employer Name </th>
                                              <th>Phone</th>
                                              <th>Vacancies Offered</th>
                                              <th>Male</th>
                                              <th>Female</th>
                                              <th>PWD Male</th>
                                              <th>PWD Female</th>
                                          </tr>
                                          <tbody> 
                                          </tbody>
                                          
                                      </thead>        
                                    </table>  
                             </div>
                           </div>
                          
                          <div class="card card-success card-outline">
                              <div class="card-header">
                                    <h3 class="card-title">Youth Details <small class="badge badge-primary" id="total_participants1"></small></h3>
                                  </div>
                                  <div class="card-body">

                                  <table id="example3" class="table row-border table-hover">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Youth Name </th>
                                              <th>Phone</th>
                                              <th>Type of Support</th>
                                              <th>Employer</th>
                                              <th>Vacancies</th>
                                              <th>Salary</th>
                                          </tr>
                                          <tbody> 
                                          </tbody>
                                          
                                      </thead>        
                                    </table> 
                             </div>
                           </div>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span class="text-muted" id="branch"></span></li>
                            </ul>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-12">
                         
                        <button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i>  Print</button>
                        <a id="link" href="" target="_blank">  <button type="button" id="download_a" name="file_name" class="btn btn-primary btn-flat" data-id="" data-attendance=""><i class="fas fa-download"></i> Attendanace-Youth</button></a>
                        <a id="link3" href="" target="_blank">  <button type="button" id="download_a" name="file_name" class="btn btn-default btn-flat" data-id="" data-attendance=""><i class="fas fa-download"></i> Attendanace-Employer</button></a> 
                        <a id="link2" href="" target="_blank">  <button type="button" id="download_a" name="id" class="btn btn-warning btn-flat"><i class="fas fa-download"></i> Photos</button></a> 
                      
                        {{ csrf_field() }}  
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_4">
                     <table id="example5" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program Date</th>
                            <th>Youth</th>
                            <th>Employer</th>
                            <th>Industry</th>
                            <th>Vacancy</th>
                            <th>Salary</th>
                            <th>Branch</th>
                            <th>Action</th>
                          
                        </tr>
                        <tbody> 
                        </tbody>
                    </thead>        
                 </table>   
              {{ csrf_field() }}
                  </div>

                  <div class="tab-pane print" id="tab_5">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">Individual Placements Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">

                              <li class="list-group-item border-0"><strong>District : </strong><span class="text-muted" id="district2"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span class="text-muted" id="dsd2"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span class="text-muted" id="dm_name2"></span></li>
                              <li class="list-group-item border-0"><strong>Placement Date : </strong><span class="text-muted" id="meeting_date2"></span></li>
                              <li class="list-group-item border-0"><strong>Youth Name: </strong><span class="text-muted" id="youth"></span></li>

                              <li class="list-group-item border-0"><strong>Employer: </strong><span class="text-muted" id="employer"></span></li>
                              <li class="list-group-item border-0"><strong>Vacancy Placed: </strong><span class="text-muted" id="vacancy"></span></li>
                              <li class="list-group-item border-0"><strong>Type of Support: </strong><span class="text-muted" id="support"></span></li>
                              <li class="list-group-item border-0"><strong>Salary: </strong><span class="text-muted" id="salary"></span></li>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span class="text-muted" id="branch2"></span></li>
                            </ul>
                          </div>
                        </div>  
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
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
    });

var dataTable2 = $("#example5").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
    }); 

var dataTable3 = $("#example10").DataTable({
      dom: 'Bfrtip',
            buttons: [
                
            ],

            "bFilter": false,
            "bPaginate": false,
            "info":     false,

            

    });  

var dataTable4 = $("#example11").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                
            ],

            "bFilter": false,
            "bPaginate": false,
            "info":     false,

            

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
   url:"{{ Route('reports-me/job/placements/fetch') }}",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,branch:branch},
   dataType:"json",
   beforeSend: function(){
     $("#loading").attr('class', 'fa fa-spinner fa-lg faa-spin animated');
   },
   complete: function(){
     $("#loading").attr('class', 'fas fa-filter');
    
   },
   success:function(data)
   {
  
  dataTable.clear().draw();
  dataTable2.clear().draw();
   var count = 1;
   var male_sum = 0;
   var female_sum = 0;
   var pwd_m_sum = 0;
   var pwd_f_sum = 0;
   var cost_sum = 0;

   dataTable3.clear().draw();
    var count5 = 1;
    $.each(data.summaryJ, function(index, value5) {
     
    dataTable3.row.add([count5++, value5.name, value5.total, value5.cost]).draw();
    });

dataTable4.clear().draw();
    var count6 = 1;
    $.each(data.summaryI, function(index, value6) {
     
    dataTable4.row.add([count6++, value6.name, value6.total, value6.male, value6.female]).draw();
    });

  $.each(data.data1, function(index, value1) {
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value1.program_date, value1.venue, value1.program_cost, value1.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value1.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/placement')}}/'+value1.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

     var total_cost = value1.program_cost;
     if ($.isNumeric(total_cost)) {
          cost_sum += parseFloat(total_cost);
      } 
  });

  

  $.each(data.data2, function(index, value2) {

      var total_male = value2.total_male;
      var total_female = value2.total_female;
      var total_p_male = value2.pwd_male;
      var total_p_female = value2.pwd_female;
     if ($.isNumeric(total_male,total_female,total_p_male,total_p_female)) {

          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
      } 
   });
   
   $('#total_records').text(data.data1.length);
   $('#total_records2').text(data.placements.length);
   $('#total_male1').text(male_sum);
   $('#total_female1').text(female_sum);
   $('#total_p_male').text(pwd_m_sum);
   $('#total_p_female').text(pwd_f_sum);
   $('#total_cost').text(cost_sum.toLocaleString());


   $.each(data.placements, function(index, value3) {
    // use data table row.add, then .draw for table refresh
    dataTable2.row.add([count++, value3.program_date, value3.youth_name, value3.employer_name,value3.industry, value3.vacancy,value3.salary,value3.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value3.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view2"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/individual')}}/'+value3.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();
 
  });
    
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
       

      $.get("{{ url('reports-me/job/placements') }}" +'/' + meeting_id +'/view', function (data) {
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

          $('#branch').text(data.meeting.branch_name);

          var file_id = data.meeting.attendance_youths;
          var url = SITE_URL+ '/download/placements/'+file_id;
          $("#link").attr("href",url);

          var id = data.meeting.m_id;
          var url1 = SITE_URL+ '/download/placements/photos/'+id;
          $("#link2").attr("href",url1);

          var at = data.meeting.attendance_employers;
          var url2 = SITE_URL+ '/download/placements/attendance/'+at;
          $("#link3").attr("href",url2);
          //alert(url1)

          var output1 = '';
          $('#total_participants').text(data.employers.length);

          for(var count = 0; count < data.employers.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + (count+1) + '</td>';
           output1 += '<td>' + data.employers[count].name + '</td>';
           output1 += '<td>' + data.employers[count].phone + '</td>';
           output1 += '<td>' + data.employers[count].vacancies + '</td>';
           output1 += '<td>' + data.employers[count].total_male + '</td>';
           output1 += '<td>' + data.employers[count].total_female + '</td>';
           output1 += '<td>' + data.employers[count].pwd_male + '</td>';
           output1 += '<td>' + data.employers[count].pwd_female + '</td></tr>';
          }
          $('#example2 tbody').html(output1);

          var output2 = '';
          $('#total_participants1').text(data.youths.length);

          for(var count = 0; count < data.youths.length; count++)
          {
            
           output2 += '<tr>';
           output2 += '<td>' + (count+1) + '</td>';
           output2 += '<td><a target="_blank" href="'+SITE_URL+'/youth/'+ data.youths[count].youth_id +'/view">' + data.youths[count].name + '</a></td>';
           output2 += '<td>' + data.youths[count].phone + '</td>';
           output2 += '<td>' + data.youths[count].type_of_support + '</td>';
           output2 += '<td>' + data.youths[count].employer_name + '</td>';
           output2 += '<td>' + data.youths[count].vacancy + '</td>';
           output2 += '<td>' + data.youths[count].salary + '</td></tr>';
          }
          $('#example3 tbody').html(output2);


      })

   });

//individual placements

$('body').on('click', '.btn_view2', function () {

      var meeting_id = $(this).data('id');
       

      $.get("{{ url('reports-me/job/ind-placements') }}" +'/' + meeting_id +'/view', function (data) {


          $('#tabs a[href="#tab_5"]').tab('show');
          $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab");

          $('#district2').text(data.district);
          $('#dsd2').text(data.dsd);
          $('#dm_name2').text(data.dm_name);
          $('#meeting_date2').text(data.program_date);
          $('#youth').text(data.youth_name);
          $('#employer').text(data.employer_name);
          $('#support').text(data.type_of_support);
          $('#vacancy').text(data.vacancy);
          $('#salary').text(data.salary);

          $('#branch2').text(data.branch_name);
      })

   });
$('#print').click(function () {
    $('.print').printThis({
      pageTitle: "Placements",
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
          left:25,
          top: 20,
          bottom:20,
          },
          legend: { position: 'Left',
          interpolateNulls: true,
          animation:{
            duration: 1000,
            easing: 'out',
          }, }

        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        
        chart.draw(data, options);
       window.addEventListener('resize', drawChart, false);

      }

      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart1);
      function drawChart1() {
      var data1 = google.visualization.arrayToDataTable([
        ["Element", "Count", { role: "style" } ],
        ["0-4999", {{$salary1}}, "blue"],
        ["5000-9999", {{$salary2}}, "orange"],
        ["10000-14999", {{$salary3}}, "green"],
        ["15000-19999", {{$salary4}}, "purple"],
        ["20000-24999", {{$salary5}}, "brown"],
        ["Above 25000", {{$salary6}}, "red"],
      ]);

      var view1 = new google.visualization.DataView(data1);
      view1.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options1 = {
        title: "",
        height: 300,
        curveType: 'function',
          chartArea:{
          left:70,
          top: 20,
          bottom:20,
          },
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart1 = new google.visualization.ColumnChart(document.getElementById("curve_chart1"));
      chart1.draw(view1, options1);
      window.addEventListener('resize', drawChart1, false);
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