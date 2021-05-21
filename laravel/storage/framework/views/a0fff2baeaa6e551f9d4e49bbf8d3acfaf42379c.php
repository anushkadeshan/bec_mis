<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                      
            <h3>ToT on Career guidance
              <small class="badge badge-success"> <?php echo e(count($meetings)); ?></small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(Route('home')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(url('m&e-reports')); ?>">Reports</a></li>
              <li class="breadcrumb-item active">2.1.3</li>
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
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">List</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3">More</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <fieldset class="border p-2">
                        <legend  class="w-auto"><small>ToT Participants</small></legend>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_records"></span>
                        <i class="fa fa-handshake"></i>ToT Programs
                      </a>
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_cost"></span>
                        <i class="fa fa-dollar-sign"></i>Total Cost
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

                    </fieldset>
                    <br>
                    <div class="card card-success">
                    <div  class="card-header">
                      ToT Participants by Year
                    </div>
                    <div  class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div id="curve_chart" style=" height: 400px"></div>
                          
                        </div>
                    </div>  
                      
                    </div>   
                    </div>
                    <br>
                    <div class="card card-success">
                    <div  class="card-header">
                      ToT Participants by Organization
                    </div>
                    <div  class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div id="columnchart_material" style=" height: 400px"></div>
                          
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
                            <th>No of Days</th>
                            <th>Venue</th>
                            <th>Program Cost</th>
                            <th>Action</th>
                          
                        </tr>
                        <tbody> 
                        </tbody>
                    </thead>        
                 </table>   
              <?php echo e(csrf_field()); ?>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane print" id="tab_3">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">ToT Program Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>Program Date : </strong><span id="meeting_date"></span></li>
                              <li class="list-group-item border-0"><strong>No of Days : </strong><span id="days"></span></li>
                              <li class="list-group-item border-0"><strong>Time Start : </strong><span id="ts"></span></li>
                              <li class="list-group-item border-0"><strong>Time End : </strong><span id="te"></span></li>
                              <li class="list-group-item border-0"><strong>Venue : </strong><span id="venue"></span></li>
                              <li class="list-group-item border-0"><strong>Total Cost: </strong><span id="program_cost"></span></li>
                              <li class="list-group-item border-0"><strong>Mode of Conduct : </strong><span id="mode"></span></li>
                              <li class="list-group-item border-0"><strong>Topics Discussed : </strong><span id="topics"></span></li>
                              <li class="list-group-item border-0"><strong>Deliverables : </strong><span id="del"></span></li>

                              <li class="list-group-item border-0"><strong>Resourse Person: </strong><span id="rp"></span></li>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch"></span></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                                    <h3 class="card-title"> Participants <small class="badge badge-danger" id="total_participants"></small></h3>
                              </div>
                              <div class="card-body">
                                <table id="example2" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Organization</th>
                                          <th>Male</th>
                                          <th>Female</th>
                                          <th>Pwd Male</th>
                                          <th>Pwd Female</th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                  </thead>        
                                </table>
                              </div>
                          </div>  
                      </div> 
                       
                     
                    <div class="row">
                        <button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i> Print</button>
                        <a id="link" href="" target="_blank">  <button type="button" id="download_a" name="file_name" class="btn btn-primary btn-flat" data-id="" data-attendance=""><i class="fas fa-download"></i> Attendance</button></a> 
                        <a id="link2" href="" target="_blank">  <button type="button" id="download_a" name="id" class="btn btn-warning btn-flat"><i class="fas fa-download"></i> Download Photos</button></a> 
                        <a id="link3" href="" target="_blank">  <button type="button"  name="file_name" class="btn btn-primary btn-flat" ><i class="fas fa-download"></i> Training Report</button></a>
                        <?php echo e(csrf_field()); ?> 
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="<?php echo e(asset('js/printThis.js')); ?>" ></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

$(document).ready(function() {

var dataTable = $("#example").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
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

 function fetch_data(dateStart = '', dateEnd = '')
 {
  $.ajax({
   url:"<?php echo e(Route('reports-me/cg/tot/fetch')); ?>",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token},
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

  $.each(data.data1, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.meeting_date, value.days, value.venue, value.program_cost,'<button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button>']).draw();
    
    var total_cost = value.program_cost;
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
  if(dateStart != '' &&  dateEnd != '')
  {
   fetch_data(dateStart, dateEnd);
  }
  else
  {
    toastr.error('Error !', 'Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#dateStart').val('');
  $('#dateEnd').val('');
  fetch_data();
 });
 }

});

$('body').on('click', '.btn_view', function () {

      var meeting_id = $(this).data('id');
       

      $.get("<?php echo e(url('reports-me/cg/tot')); ?>" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#days').text(data.meeting.days);
          $('#ts').text(data.meeting.time_start);
          $('#te').text(data.meeting.time_end);
          $('#meeting_date').text(data.meeting.meeting_date);
          $('#venue').text(data.meeting.venue);
          $('#program_cost').text(data.meeting.program_cost);
          $('#rp').text(data.meeting.r_name);
          $('#mode').html(data.meeting.mode_of_conduct);
          $('#del').html(data.meeting.deliverables);
          $('#topics').html(data.meeting.topics);
          $('#branch').text(data.meeting.branch_name);

          var tr = data.meeting.training_report;

          var url = SITE_URL+ '/download/cg/tot/tr/'+tr;
          $("#link3").attr("href",url);
          
          var attendance = data.meeting.attendance;
          var url2 = SITE_URL+ '/download/cg/tot/'+attendance;
          $("#link").attr("href",url2);

          var id = data.meeting.m_id;
          var url1 = SITE_URL+ '/download/cg/tot/photos/'+id;
          $("#link2").attr("href",url1);

        

          //alert(url1)

          var output1 = '';
          $('#total_participants').text(data.participants.length);

          for(var count = 0; count < data.participants.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + (count+1) + '</td>';
           output1 += '<td>' + data.participants[count].organization + '</td>';
           output1 += '<td>' + data.participants[count].total_male + '</td>';
           output1 += '<td>' + data.participants[count].total_female + '</td>';
           output1 += '<td>' + data.participants[count].pwd_male + '</td>';
           output1 += '<td>' + data.participants[count].pwd_female + '</td></tr>';
          }
          $('#example2 tbody').html(output1);

          
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
          ['2018',  <?php if($participants2018->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2018->total_male); ?> <?php endif; ?> , <?php if($participants2018->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2018->total_female); ?><?php endif; ?>, <?php if($participants2018->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2018->pwd_male); ?><?php endif; ?>,<?php if($participants2018->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2018->pwd_female); ?><?php endif; ?>],
          ['2019',  <?php if($participants2019->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2019->total_male); ?> <?php endif; ?> , <?php if($participants2019->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2019->total_female); ?><?php endif; ?>, <?php if($participants2019->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2019->pwd_male); ?><?php endif; ?>,<?php if($participants2019->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2019->pwd_female); ?><?php endif; ?>],
          ['2020',  <?php if($participants2020->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2020->total_male); ?> <?php endif; ?> , <?php if($participants2020->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2020->total_female); ?><?php endif; ?>, <?php if($participants2020->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2020->pwd_male); ?><?php endif; ?>,<?php if($participants2020->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2020->pwd_female); ?><?php endif; ?>],
          ['2021',  <?php if($participants2021->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2021->total_male); ?> <?php endif; ?> , <?php if($participants2021->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($participants2021->total_female); ?><?php endif; ?>, <?php if($participants2021->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2021->pwd_male); ?><?php endif; ?>,<?php if($participants2021->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($participants2021->pwd_female); ?><?php endif; ?>],
          
        ]);

        var options = {
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
        window.addEventListener('resize', drawChart, false);

      }

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
          ['Year', 'Male', 'Female', 'PWD Male' ,'PWD Female'],
          ['BEC', <?php if($bec->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($bec->total_male); ?> <?php endif; ?> , <?php if($bec->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($bec->total_female); ?><?php endif; ?>, <?php if($bec->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($bec->pwd_male); ?><?php endif; ?>,<?php if($bec->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($bec->pwd_female); ?><?php endif; ?>],
          ['GVT officials', <?php if($gvt->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($gvt->total_male); ?> <?php endif; ?> , <?php if($gvt->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($gvt->total_female); ?><?php endif; ?>, <?php if($gvt->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($gvt->pwd_male); ?><?php endif; ?>,<?php if($gvt->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($gvt->pwd_female); ?><?php endif; ?>],
          ['Gvt. Training Institues:',<?php if($gvt_TI->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($gvt_TI->total_male); ?> <?php endif; ?> , <?php if($gvt_TI->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($gvt_TI->total_female); ?><?php endif; ?>, <?php if($gvt_TI->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($gvt_TI->pwd_male); ?><?php endif; ?>,<?php if($gvt_TI->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($gvt_TI->pwd_female); ?><?php endif; ?>],
          ['Pvt. Training Institues:', <?php if($pvt_TI->total_male==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($pvt_TI->total_male); ?> <?php endif; ?> , <?php if($pvt_TI->total_female==null): ?> <?php echo e(0); ?> <?php else: ?> <?php echo e($pvt_TI->total_female); ?><?php endif; ?>, <?php if($pvt_TI->pwd_male==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($pvt_TI->pwd_male); ?><?php endif; ?>,<?php if($pvt_TI->pwd_female==null): ?> <?php echo e(0); ?> <?php else: ?><?php echo e($pvt_TI->pwd_female); ?><?php endif; ?>]
        ]);

        var options1 = {
          chart: {
            title: 'Participants',
            subtitle: '2018-2021',
          }
        };

        var chart1 = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart1.draw(data1, google.charts.Bar.convertOptions(options1));
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>