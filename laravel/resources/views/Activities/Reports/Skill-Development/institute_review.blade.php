@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
                      
            <h4>Review of institutions <small class="badge badge-success"> {{count($meetings)}}</small></h4>
          </div>
          <div class="col-md-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reports</a></li>
              <li class="breadcrumb-item active">3.3.1</li>
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
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div>
                    
                      <a class="btn btn-app zoom">
                        <span class="badge bg-warning" id="total_records"></span>
                        <i class="fa fa-graduation-cap"></i>Institutes
                      </a>
                    </div>
                
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <table id="example" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Review Date</th>
                            <th>Institute</th>
                            <th>Head of Institute</th>
                            <th>Contact</th>
                            <th>Date of commencement</th>
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
                                    <h3 class="card-title">Review Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>District : </strong><span id="district"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span id="dsd"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name"></span></li>
                              <li class="list-group-item border-0"><strong>Review Date : </strong><span id="meeting_date"></span></li>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Institute Details</small></legend>
                              <div class="row">
                                <div class="col-md-5">
                                <li class="list-group-item border-0"><strong>Institute : </strong> <br><a href="" id="link3" target="_blank"><span id="institute"></span></a></li>
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
                              <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch"></span></li>
                            </ul>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-12">
                        <div class="card card-success card-outline">
                          <div class="card-header">
                                <h3 class="card-title">Courses provided <small class="badge badge-danger" id="total_participants"></small></h3>
                              </div>
                              <div class="card-body">

                              <table id="example2" class="table row-border table-hover">
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

 function fetch_data(dateStart = '', dateEnd = '',branch='' /*,course='',institute=''*/)
 {
  $.ajax({
   url:"{{ Route('reports-me/skill/institute-review/fetch') }}",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,branch:branch/*,institute:institute*/},
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

  $.each(data, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.program_date, value.institute_name, value.head_of_institute, value.contact,value.commencement_date, value.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/review')}}/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

  });
   
   $('#total_records').text(data.length);

    
   }
  });

  $('#filter').click(function(){
  var dateStart = $('#dateStart').val();
  var dateEnd = $('#dateEnd').val();
  var branch = $('#branch_id').val();
  //var institute = $('#institute_id').val();
  if(dateStart != '' &&  dateEnd != '')
  {
   fetch_data(dateStart, dateEnd, branch/*,institute*/);
  
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
  //$('#institute_id').val('');
  fetch_data();
 });
 }

});

$('body').on('click', '.btn_view', function () {

      var meeting_id = $(this).data('id');
       

      $.get("{{ url('reports-me/skill/institute-review') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.program_date);
          $('#institute').text(data.meeting.institute_name);
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
          $('#branch').text(data.meeting.branch_name); 

         

          var institute = data.meeting.i_id;
          var url3 = SITE_URL+ '/institute/'+institute+'/view';

          $("#link3").attr("href",url3);

          var output1 = '';
          $('#total_participants').text(data.courses.length);

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
          $('#example2 tbody').html(output1);
 
      })

   });



$('#print').click(function () {
    $('.print').printThis({
      pageTitle: "Institute Review",
    });
});

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