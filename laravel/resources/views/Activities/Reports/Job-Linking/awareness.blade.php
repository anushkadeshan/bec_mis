@extends('layouts.reports')
@section('title','Work Place Awareness |')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                      
            <h3>Awareness on work place conditions <small class="badge badge-success"> {{count($meetings)}}</small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">4.2.2</li>
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
                        <i class="fa fa-handshake"></i>Awarenesses
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
                                        <th width="20">#</th>
                                        <th>Branch</th>
                                        <th>No of Awarenesses </th>
                                        <th>Total Male </th>
                                        <th>Total Female </th>
                                        <th>Total Cost</th>
                                    </tr>
                                    <tbody> 
                                    </tbody>
                                </thead>        
                            </table>
                          
                        </div>
                        @endcan 
                    <div class="card card-success">
                    <div  class="card-header">
                     Participation
                    </div>
                    <div  class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div id="curve_chart" style=" height: 400px"></div>
                          
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
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">Program Details</h3>
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
                              
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Youth Participated</small></legend>
                              <div class="row">
                                <div class="col-md-3">
                                  <li class="list-group-item border-0"><strong>Total Male: </strong><span class="text-muted" id="total_male"></span></li>
                                </div>
                                <div class="col-md-3">

                              <li class="list-group-item border-0"><strong>Total Female: </strong><span class="text-muted" id="total_female"></span></li>
                              </div>
                                <div class="col-md-3">
                              <li class="list-group-item border-0"><strong>PWD Male: </strong><span class="text-muted" id="pwd_male"></span></li>
                              </div>
                                <div class="col-md-3">
                              <li class="list-group-item border-0"><strong>PWD Female: </strong><span class="text-muted" id="pwd_female"></span></li>
                              </div>
                              </div>
                              </fieldset>
      
                              <li class="list-group-item border-0"><strong>Mode of Conduct: </strong><span class="text-muted" id="mode_of_conduct"></span></li>
                              <li class="list-group-item border-0"><strong>Topics: </strong><span class="text-muted" id="topics"></span></li>
                              <li class="list-group-item border-0"><strong>Deliverables: </strong><span class="text-muted" id="deliverables"></span></li>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Exposure Visits</small></legend>
                              <li class="list-group-item border-0"><strong>Exposure visits conducted ?: </strong><span class="text-muted" id="exposure_visit"></span></li>
                              <li class="list-group-item border-0"><strong>Place of visit: </strong><span class="text-muted" id="place"></span></li>
                              <li class="list-group-item border-0"><strong>Any demonstrations done: </strong><span class="text-muted" id="demonstraion"></span></li>
                              <li class="list-group-item border-0"><strong>Matters discussed: </strong><span class="text-muted" id="matters_discussed"></span></li>
                              </fieldset>
                              <li class="list-group-item border-0"><strong>Concerns raised by the job seekers: </strong><span class="text-muted" id="any_concerns"></span></li>
                              
                              <li class="list-group-item border-0"><strong>Branch: </strong><span class="text-muted" id="branch"></span></li>
                            </ul>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-12">
                         
                        <button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i>  Print</button>
                        <a id="link" href="" target="_blank">  <button type="button" id="download_a" name="file_name" class="btn btn-primary btn-flat" data-id="" data-attendance=""><i class="fas fa-download"></i> Attendanace</button></a> 
                        <a id="link2" href="" target="_blank">  <button type="button" id="download_a" name="id" class="btn btn-warning btn-flat"><i class="fas fa-download"></i> Photos</button></a> 
                      
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
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
    });

var dataTable2 = $("#example10").DataTable({
      dom: 'Bfrtip',
            buttons: [
                
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
   url:"{{ Route('reports-me/job/awareness/fetch') }}",
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
   var count = 1;
   var male_sum = 0;
   var female_sum = 0;
   var pwd_m_sum = 0;
   var pwd_f_sum = 0;
   var cost_sum = 0;

  dataTable2.clear().draw();
    var count2 = 1;
    $.each(data.summary, function(index, value2) {
     // status = (value2.status/value2.status)
      //if(isNaN(status) ) { status = 0;} else{ status}
    // use data table row.add, then .draw for table refresh
    dataTable2.row.add([count2++, value2.name, value2.total, value2.male, value2.female, value2.cost.toLocaleString()]).draw();
    });


  $.each(data.data, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.program_date, value.total_male, value.total_female, value.pwd_male,value.pwd_female,value.venue, value.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/awareness')}}/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

     var total_male = value.total_male;
     var total_female = value.total_female;
     var total_p_male = value.pwd_male;
     var total_p_female = value.pwd_female;
     var total_cost = value.cost;
     if ($.isNumeric(total_male,total_female,total_p_male,total_p_female,program_cost)) {
          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
          cost_sum += parseFloat(total_cost);
      } 
  });
   
   $('#total_records').text(data.data.length);
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
       

      $.get("{{ url('reports-me/job/awareness') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.program_date);
          $('#time_start').text(data.meeting.time_start);
          $('#time_end').text(data.meeting.time_end);
          $('#venue').text(data.meeting.venue);
          $('#program_cost').text(data.meeting.cost);
          $('#total_male').text(data.meeting.total_male);
          $('#total_female').text(data.meeting.total_female);
          $('#pwd_male').text(data.meeting.pwd_male);
          $('#pwd_female').text(data.meeting.pwd_female);
          $('#mode_of_conduct').html(data.meeting.mode_of_awareness);
          $('#topics').html(data.meeting.topics);
          $('#deliverables').html(data.meeting.deliverables);
          $('#exposure_visit').text(data.meeting.exposure_visit);
          $('#palce').text(data.meeting.palce);
          $('#demonstraion').text(data.meeting.demonstraion);
          $('#matters_discussed').text(data.meeting.matters_discussed);
          $('#any_concerns').html(data.meeting.any_concerns);
          $('#branch').text(data.meeting.branch_name);

          var file_id = data.meeting.attendance;
          var url = SITE_URL+ '/download/awareness/'+file_id;
          $("#link").attr("href",url);

          var id = data.meeting.m_id;
          var url1 = SITE_URL+ '/download/awareness/photos/'+id;
          $("#link2").attr("href",url1);
          //alert(url1)


      })

   });



$('#print').click(function () {
    $('.print').printThis({
      pageTitle: "CG Training",
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