@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
                      
            <h4>Support for course enrollment & directing to Gvt. Institutes <small class="badge badge-success"> {{count($meetings)}}</small></h4>
          </div>
          <div class="col-md-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">3.1.1</li>
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
                      <!--
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Course &nbsp;&nbsp;</label>
                            <select name="course_id" id="course_id" class="form-control">
                              <option value="">All</option>
                              @foreach($courses as $course)
                              <option value="{{$course->id}}">{{$course->course_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Institute &nbsp;&nbsp;</label>
                            <select name="institute_id" id="institute_id" class="form-control">
                              <option value="">All</option>
                              @foreach($institutes as $institute)
                              <option value="{{$institute->id}}">{{$institute->institute_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </a>
                      </li> 
                    -->
                      <li class="nav-item">
                          <a class="nav-link">
                            <button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i id="loading" class="fas fa-filter"></i> Filter <i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button>
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
                  <li class="nav-item"><a class="nav-link" href="#tab_4">Review Report</a></li>
                  
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
                    </div>

                    @cannot('branch')
                        <div class="col-md-12">
                          <table id="example10" class="table row-border table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Branch</th>
                                        <th>No of Times</th>
                                        <th>Total Male</th>
                                        <th>Total Female</th>
                                        <th>Total Youths</th>
                                        <th>Youths still in courses</th>
                                    </tr>
                                    <tbody> 
                                    </tbody>
                                </thead>        
                            </table>
                          
                        </div>
                        @endcan

                    <div class="card card-success">
                    <div  class="card-header">
                     Enrolled Youths <a href="{{Route('view_gvt_youths')}}"><span  class="badge badge-warning float-right" id="row_count">View Youth Report</span></a>
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
                            <th>Course</th>
                            <th>Institute</th>
                            <th>Course End</th>
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
                                    <h3 class="card-title">Program Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>District : </strong><span id="district"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span id="dsd"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name"></span></li>
                              <li class="list-group-item border-0"><strong>Program Date : </strong><span id="meeting_date"></span></li>
                              <li class="list-group-item border-0"><strong>Institute : </strong><a href="" id="link3" target="_blank"><span id="institute"></span></a></li>
                              <li class="list-group-item border-0"><strong>Institute Review Done ? : </strong><span id="review"></span></li>
                              <li class="list-group-item border-0"><strong>Course : </strong><a href="" id="link2" target="_blank"><span id="course"></span></a></li> 
                              <li class="list-group-item border-0"><strong>Start Date: </strong><span id="s-date"></span></li>
                              <li class="list-group-item border-0"><strong>End Date: </strong><span id="e-date"></span></li>
                              <li class="list-group-item border-0"><strong>Total Male: </strong><span id="total_male"></span></li>
                              <li class="list-group-item border-0"><strong>Total Female: </strong><span id="total_female"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Male: </strong><span id="pwd_male"></span></li>
                              <li class="list-group-item border-0"><strong>PWD Female: </strong><span id="pwd_female"></span></li>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch"></span></li>
                            </ul>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-6">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                <h3 class="card-title">Youth Details <small class="badge badge-danger" id="total_participants"></small></h3>
                              </div>
                              <div class="card-body">

                              <table id="example2" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name </th>
                                          <th>Nature of Support</th>
                                          <th>Inst. Type </th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                      
                                  </thead>        
                                </table> 
                        <button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i>  Print</button>
                        <button type="button" id="review_id" name="file_name" class="btn btn-primary btn-flat" data-id="" data-attendance=""><i class="fas fa-download"></i> Review Report</button>
                        
                        {{ csrf_field() }}  
                         </div>
                       </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab_4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                    <h3 class="card-title">Review Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>District : </strong><span id="district1"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span id="dsd1"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name1"></span></li>
                              <li class="list-group-item border-0"><strong>Review Date : </strong><span id="meeting_date1"></span></li>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Institute Details</small></legend>
                              <div class="row">
                                <div class="col-md-5">
                                <li class="list-group-item border-0"><strong>Institute : </strong> <br><a href="" id="link-new" target="_blank"><span id="institute1"></span></a></li>
                                </div>
                                <div class="col-md-7">
                                <li class="list-group-item border-0"><strong>Head of Institute : </strong><br><span id="head"></span></li>
                                </div>
                                 <div class="col-md-5">
                                <li class="list-group-item border-0"><strong>Contact : </strong><br><span id="contact"></span></li>
                                </div>
                                 <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Commenced on : </strong><br><span id="c_date"></span></li>
                                </div>
                                 <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>TVEC Expiary on  : </strong><br><span id="e_date"></span></li>
                                </div>
                              </div>
                              </fieldset>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Others</small></legend>
                              <div class="row">
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Is the OJT compulsory for all courses ?  : </strong><br> <span id="ojt"></span></li>
                                </div>
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Courses that OJT is not compulsory : </strong><br>  <span id="courses"></span></li>
                                </div>
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Follow up services on passed out trainees : </strong><br>  <span id="follow"></span></li>
                                </div>
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Services offered : </strong><br>  <span id="services"></span></li>
                                </div>
                                <div class="col-md-12">
                                <li class="list-group-item border-0"><strong>Training Allowance : </strong><br>  <span id="allow"></span></li>
                                <li class="list-group-item border-0"><strong>Amount : </strong><br>  <span id="amount"></span></li>
                                <li class="list-group-item border-0"><strong>Source : </strong><br>  <span id="source"></span></li>
                                </div>
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Soft skill development components included ? : </strong><br>  <span id="soft"></span></li>
                                </div>
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Does the institute agree to incorporate/update soft skill components at their own expenses : </strong><br>  <span id="agree"></span></li>
                                </div>
                                <div class="col-md-6">
                                <li class="list-group-item border-0"><strong>Existing gaps to incorporate soft skill components : </strong><br>  <span id="gaps"></span></li>
                                </div>
                              </div>
                              </fieldset>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch1"></span></li>
                            </ul>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                <h3 class="card-title">Courses provided <small class="badge badge-danger" id="total_participants1"></small></h3>
                              </div>
                              <div class="card-body">

                              <table id="example3" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Courses </th>
                                          <th>Period of Intake</th>
                                          <th>Intake per Batch</th>
                                          <th># Students Currently following</th>
                                          <th># Students passed out</th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                      
                                  </thead>        
                                </table> 
                        <button type="button hidden-print" id="print" class="btn btn-success btn-flat"><i class="fas fa-print"></i>  Print</button>
                        
                        {{ csrf_field() }}  
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

 function fetch_data(dateStart = '', dateEnd = '',branch='' /* ,course='',institute=''*/)
 {
  $.ajax({
   url:"{{ Route('reports-me/skill/gvt-support/fetch') }}",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,branch:branch/*,course:course,institute:institute*/},
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

   dataTable2.clear().draw();
    var count2 = 1;
    $.each(data.summary, function(index, value2) {
    // use data table row.add, then .draw for table refresh
    dataTable2.row.add([count2++, value2.name, value2.progs, value2.male, value2.female, value2.male+value2.female, value2.status]).draw();
    });


  $.each(data.data, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.meeting_date, value.total_male, value.total_female, value.course_name,value.institute_name,value.end_date,value.ext,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/gvt-support')}}/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

     var total_male = value.total_male;
     var total_female = value.total_female;
     var total_p_male = value.pwd_male;
     var total_p_female = value.pwd_female;
     if ($.isNumeric(total_male,total_female,total_p_male,total_p_female)) {
          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
      } 
  });
   
   $('#total_records').text(data.data.length);
   $('#total_male1').text(male_sum);
   $('#total_female1').text(female_sum);
   $('#total_p_male').text(pwd_m_sum);
   $('#total_p_female').text(pwd_f_sum);
    
   }
  });

  $('#filter').click(function(){
  var dateStart = $('#dateStart').val();
  var dateEnd = $('#dateEnd').val();
  var branch = $('#branch_id').val();
  /*var course = $('#course_id').val();
  var institute = $('#institute_id').val();*/
  if(dateStart != '' &&  dateEnd != '')
  {
    //alert(branch);
   fetch_data(dateStart, dateEnd , branch /*, course,institute*/);
  
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
  /*$('#course_id').val('');
  $('#institute_id').val('');*/
  fetch_data();
 });
 }

});

$('body').on('click', '.btn_view', function () {

      var meeting_id = $(this).data('id');
       

      $.get("{{ url('reports-me/skill/gvt-support') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.meeting_date);
          $('#institute').text(data.meeting.institute_name);
          $('#review').text(data.meeting.institutional_review);
          $('#course').text(data.meeting.course_name);
          $('#s-date').text(data.meeting.start_date);
          $('#e-date').text(data.meeting.end_date);
          $('#total_male').text(data.meeting.total_male);
          $('#total_female').text(data.meeting.total_female);
          $('#pwd_male').text(data.meeting.pwd_male);
          $('#pwd_female').text(data.meeting.pwd_female);
          $('#branch').text(data.meeting.branch_name); 

          $('#review_id').data("id",data.meeting.review_report);
          

          //$("#link").attr("href",url);

          var course = data.meeting.c_id;
          var url2 = SITE_URL+ '/courses/'+course+'/view';

          $("#link2").attr("href",url2);

          var institute = data.meeting.i_id;
          var url3 = SITE_URL+ '/institute/'+institute+'/view';

          $("#link3").attr("href",url3);

          var output1 = '';
          $('#total_participants').text(data.youths.length);

          for(var count = 0; count < data.youths.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + (count+1) + '</td>';
           output1 += '<td><a target="_blank" href="'+SITE_URL+'/youth/'+ data.youths[count].youth_id +'/view">' + data.youths[count].name + '</a></td>';
           output1 += '<td>' + data.youths[count].nature_of_support + '</td>';
           output1 += '<td>' + data.youths[count].institute_type + '</td></tr>';
          }
          $('#example2 tbody').html(output1);
 
      })

   });

$('body').on('click', '#review_id', function () {

      var meeting_id = $(this).data('id');
     // alert(meeting_id);
       

      $.get("{{ url('reports-me/skill/institute-review') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_4"]').tab('show');
          $('#tabs a[href="#tab_4"]').attr("data-toggle", "tab");

          $('#district1').text(data.meeting.district);
          $('#dsd1').text(data.meeting.dsd);
          $('#dm_name1').text(data.meeting.dm_name);
          $('#meeting_date1').text(data.meeting.meeting_date);
          $('#institute1').text(data.meeting.institute_name);
          $('#head').text(data.meeting.head_of_institute);
          $('#contact').text(data.meeting.contact);
          $('#c_date').text(data.meeting.commencement_date);
          $('#e_date').text(data.meeting.tvec_ex_date);
          $('#training_stage').text(data.meeting.training_stage);
          $('#s-date').text(data.meeting.start_date);
          $('#e-date').text(data.meeting.end_date);
          $('#ojt').text(data.meeting.ojt_compulsory);
          $('#courses').text(data.meeting.courses_not_compulsory);
          $('#follow').text(data.meeting.followup);
          $('#services').text(data.meeting.services_offered);
          $('#allow').text(data.meeting.trainee_allowance);
          $('#amount').text(data.meeting.amount);
          $('#source').text(data.meeting.source);
          $('#soft').text(data.meeting.soft_skill);
          $('#agree').text(data.meeting.agreement_soft_skill);
          $('#gaps').text(data.meeting.gaps);
          $('#branch1').text(data.meeting.branch_name); 

         

          var institute = data.meeting.i_id;
          var url3 = SITE_URL+ '/institute/'+institute+'/view';

          $("#link-new").attr("href",url3);

          var output1 = '';
          $('#total_participants1').text(data.courses.length);

          for(var count = 0; count < data.courses.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + (count+1) + '</td>';
           output1 += '<td><a target="_blank" href="'+SITE_URL+'/courses/'+ data.courses[count].course_id +'/view">' + data.courses[count].name + '</a></td>';
           output1 += '<td>' + data.courses[count].period_intake + '</td>';
           output1 += '<td>' + data.courses[count].intake_per_batch + '</td>';
           output1 += '<td>' + data.courses[count].current_following + '</td>';
           output1 += '<td>' + data.courses[count].passed_out + '</td></tr>';
          }
          $('#example3 tbody').html(output1);
 
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