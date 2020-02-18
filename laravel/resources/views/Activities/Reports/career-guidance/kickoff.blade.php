@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                      
            <h3>2.1.2 Kick Off Meetings and House Hold Surveys </h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">2.1.2</li>
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
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Kickoffs</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">HHS</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3">More - Kick off</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_5">More - HHS</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div>
                    <fieldset class="border p-2">
                          <legend  class="w-auto"><small>Kick-offs</small></legend>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_records"></span>
                        <i class="fa fa-handshake"></i>Events
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
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="applications"></span>
                        <i class="fa fa-file-medical"></i>Applications
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="selected"></span>
                        <i class="fa fa-file-signature"></i>Selected
                      </a>
                      </fieldset>
                    </div>
                    <div>
                    <fieldset class="border p-2">
                      <legend  class="w-auto"><small>House Hold Surveys</small></legend>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_records2"></span>
                        <i class="fa fa-poll"></i>Surveys
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning"  id="total_male2"></span>
                        <i class="fa fa-mars" style="color:blue"></i>Total Male
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning"  id="total_female2"></span>
                        <i class="fa fa-venus" style="color:#FF00CD"></i>Total Female
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_p_male2"></span>
                        <i class="fa fa-wheelchair" style="color:blue"></i>PWD Male
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_p_female2"></span>
                        <i class="fa fa-wheelchair" style="color:#FF00CD"></i>PWD Female
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="applications2"></span>
                        <i class="fa fa-file-medical"></i>Applications
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="selected2"></span>
                        <i class="fa fa-file-signature"></i>Selected
                      </a>
                    </fieldset>
                    </div>
                    <div class="card card-success">
                    <div  class="card-header">
                      Youth Participation for Kick Offs
                    </div>
                    <div  class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div id="curve_chart" style=" height: 400px"></div>
                          
                        </div>
                    </div>  
                      
                    </div>   
                    </div>
                    <div class="card card-success">
                    <div  class="card-header">
                      Youth Participation for House Hold Survey
                    </div>
                    <div  class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div id="curve_chart1" style=" height: 400px"></div>
                          
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
              <div class="tab-pane" id="tab_4">
                     <table id="example5" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Survey Date</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>PWD M</th>
                            <th>PWD F</th>
                            <th>Branch</th>
                            <th>Action</th>
                          
                        </tr>
                        <tbody> 
                        </tbody>
                    </thead>        
                 </table>   
              {{ csrf_field() }}
                  </div>
                  <!-- /.kick ooff -->
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
                              <li class="list-group-item border-0"><strong>No. of initial assessment forms collected: </strong><span id="no_of_forms"></span></li>
                              <li class="list-group-item border-0"><strong>Number of youth selected for BEC programs: </strong><span id="no_of_selected_youth"></span></li>
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
                        {{ csrf_field() }}  
                      </div>
                    </div>
                  </div>

                  <!-- /.household -->

                  <div class="tab-pane" id="tab_5">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">House Hold Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>District : </strong><span id="district1"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span id="dsd1"></span></li>
                              <li class="list-group-item border-0"><strong>GNDs : </strong><span id="gnd1"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name1"></span></li>
                              <li class="list-group-item border-0"><strong>Survey Date : </strong><span id="meeting_date1"></span></li>
                              <li class="list-group-item border-0"><strong>Total Male: </strong><span id="total_male3"></span></li>
                              <li class="list-group-item border-0"><strong>Total Female: </strong><span id="total_female3"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Male: </strong><span id="pwd_male1"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Female: </strong><span id="pwd_female1"></span></li>
                              <li class="list-group-item border-0"><strong>No. of initial assessment forms collected: </strong><span id="no_of_forms1"></span></li>
                              <li class="list-group-item border-0"><strong>Number of youth selected for BEC programs: </strong><span id="no_of_selected_youth1"></span></li>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch1"></span></li>
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
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    });

var dataTable1 = $("#example5").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
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
   url:"{{ Route('reports-me/cg/kick-off-meeting/fetch') }}",
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
  //kick off
  dataTable.clear().draw();
   var count = 1;
   var male_sum = 0;
   var female_sum = 0;
   var pwd_m_sum = 0;
   var pwd_f_sum = 0;
   var cost_sum = 0;
   var sum_applications = 0;
   var sum_selected = 0;


  $.each(data.kick, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.program_date, value.total_male, value.total_female, value.pwd_male,value.pwd_female,value.venue, value.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/kick-off')}}/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

     var total_male = value.total_male;
     var total_female = value.total_female;
     var total_p_male = value.pwd_male;
     var total_p_female = value.pwd_female;
     var total_cost = value.program_cost;
     var no_of_forms = value.no_of_forms;
     var no_of_selected_youth = value.no_of_selected_youth;
     if ($.isNumeric(total_male,total_female,total_p_male,total_p_female,program_cost,no_of_selected_youth,no_of_forms)) {
          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
          cost_sum += parseFloat(total_cost);
          sum_applications += parseFloat(no_of_forms);
          sum_selected += parseFloat(no_of_selected_youth);
      } 
  });
   
   $('#total_records').text(data.kick.length);
   $('#total_male1').text(male_sum);
   $('#total_female1').text(female_sum);
   $('#total_p_male').text(pwd_m_sum);
   $('#total_p_female').text(pwd_f_sum);
   $('#applications').text(sum_applications);
   $('#selected').text(sum_selected);
   $('#total_cost').text(cost_sum.toLocaleString());
    
  //household
  dataTable1.clear().draw();
   var count1 = 1;
   var male_sum1 = 0;
   var female_sum1 = 0;
   var pwd_m_sum1 = 0;
   var pwd_f_sum1 = 0;
   var cost_sum1 = 0;
   var sum_applications1 = 0;
   var sum_selected1 = 0;


  $.each(data.hhs, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable1.row.add([count1++, value.meeting_date, value.total_male, value.total_female, value.pwd_male,value.pwd_female, value.branch_name,'<button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view1"><i class="fa fa-eye"></i></button>']).draw();

     var total_male1 = value.total_male;
     var total_female1 = value.total_female;
     var total_p_male1 = value.pwd_male;
     var total_p_female1 = value.pwd_female;
     var no_of_forms1 = value.no_of_forms;
     var no_of_selected_youth1 = value.no_of_selected_youth;
     if ($.isNumeric(total_male1,total_female1,total_p_male1,total_p_female1,no_of_selected_youth1,no_of_forms1)) {
          male_sum1 += parseFloat(total_male1);
          female_sum1 += parseFloat(total_female1);
          pwd_m_sum1 += parseFloat(total_p_male1);
          pwd_f_sum1 += parseFloat(total_p_female1);
          sum_applications1 += parseFloat(no_of_forms1);
          sum_selected1 += parseFloat(no_of_selected_youth1);
      } 
  });
   
   $('#total_records2').text(data.hhs.length);
   $('#total_male2').text(male_sum1);
   $('#total_female2').text(female_sum1);
   $('#total_p_male2').text(pwd_m_sum1);
   $('#total_p_female2').text(pwd_f_sum1);
   $('#applications2').text(sum_applications1);
   $('#selected2').text(sum_selected1);
    
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
       

      $.get("{{ url('reports-me/cg/kick-off') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.DSD_Name);
          $('#gnd').text(data.meeting.gnd);
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
          $('#resourse').text(data.meeting.r_name);
          $('#mode_of_conduct').html(data.meeting.mode_of_conduct);
          $('#topics').html(data.meeting.topics);
          $('#deliverables').html(data.meeting.deliverables);
          $('#no_of_forms').text(data.meeting.no_of_forms);
          $('#no_of_selected_youth').text(data.meeting.no_of_selected_youth);
          $('#branch').text(data.meeting.branch_name);
          $('#download_a').data('id',data.meeting.attendance); 
          $('#download_a').data('attendance',data.meeting.attendance); 

          var file_id = data.meeting.attendance;
          var url = SITE_URL+ '/download/kick-off/'+file_id;

          $("#link").attr("href",url);

          var id = data.meeting.m_id;
          var url1 = SITE_URL+ '/download/kick-off/photos/'+id;

          $("#link2").attr("href",url1);
          //alert(url1)

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

//household
$('body').on('click', '.btn_view1', function () {

      var meeting_id = $(this).data('id');
       

      $.get("{{ url('reports-me/cg/hhs') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_5"]').tab('show');
          $('#tabs a[href="#tab_5"]').attr("data-toggle", "tab");

          $('#district1').text(data.district);
          $('#dsd1').text(data.dsd);
          $('#gnd1').text(data.gnd);
          $('#dm_name1').text(data.dm_name);
          $('#meeting_date1').text(data.meeting_date);
          $('#total_male3').text(data.total_male);
          $('#total_female3').text(data.total_female);
          $('#pwd_male1').text(data.pwd_male);
          $('#pwd_female1').text(data.pwd_female);
          $('#no_of_forms1').text(data.no_of_forms);
          $('#no_of_selected_youth1').text(data.no_of_selected_youth);
          $('#branch1').text(data.branch_name);


      })

   });

$('#print').click(function () {
    $('.print').printThis({
      pageTitle: "Kick Off Event",
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
          left:55,
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

      //house hold chart

      google.charts.setOnLoadCallback(drawChart1);
      
      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
          ['Year', 'Total Male', 'Total Female','PWD Male','PWD Female'],
          ['2018',  @if($hhs2018->total_male==null) {{0}} @else {{$hhs2018->total_male}} @endif , @if($hhs2018->total_female==null) {{0}} @else {{$hhs2018->total_female}}@endif, @if($hhs2018->pwd_male==null) {{0}} @else{{$hhs2018->pwd_male}}@endif,@if($hhs2018->pwd_female==null) {{0}} @else{{$hhs2018->pwd_female}}@endif],
          ['2019',  @if($hhs2019->total_male==null) {{0}} @else {{$hhs2019->total_male}} @endif , @if($hhs2019->total_female==null) {{0}} @else {{$hhs2019->total_female}}@endif, @if($hhs2019->pwd_male==null) {{0}} @else{{$hhs2019->pwd_male}}@endif,@if($hhs2019->pwd_female==null) {{0}} @else{{$hhs2019->pwd_female}}@endif],
          ['2020',  @if($hhs2020->total_male==null) {{0}} @else {{$hhs2020->total_male}} @endif , @if($hhs2020->total_female==null) {{0}} @else {{$hhs2020->total_female}}@endif, @if($hhs2020->pwd_male==null) {{0}} @else{{$hhs2020->pwd_male}}@endif,@if($hhs2020->pwd_female==null) {{0}} @else{{$hhs2020->pwd_female}}@endif],
          ['2021',  @if($hhs2021->total_male==null) {{0}} @else {{$hhs2021->total_male}} @endif , @if($hhs2021->total_female==null) {{0}} @else {{$hhs2021->total_female}}@endif, @if($hhs2021->pwd_male==null) {{0}} @else{{$hhs2021->pwd_male}}@endif,@if($hhs2021->pwd_female==null) {{0}} @else{{$hhs2021->pwd_female}}@endif],
          
        ]);

        var options1 = {
          title: '',
          curveType: 'function',
          chartArea:{
          left:55,
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

        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));
        
        chart1.draw(data1, options1);
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

.lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #fff;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }


</style>
@endsection