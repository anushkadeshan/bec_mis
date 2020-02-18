@extends('layouts.reports')
@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                      
            <h3>Gap identification of PES unit 
              <small class="badge badge-success"> {{count($meetings)}}</small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{url('m&e-reports')}}">Reprots</a></li>
              <li class="breadcrumb-item active">2.2.1</li>
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
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">List</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3">More</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-md-2">
                        <fieldset class="border p-2">
                          <legend  class="w-auto"><small>Idetified</small></legend>
                          <a class="btn btn-app zoom">
                          <span class="badge bg-warning" id="total_records"></span>
                          <i class="fa fa-handshake"></i>PES Units
                          </a>
                        </fieldset>

                      </div>
                      <div class="col-md-10">
                        <fieldset class="border p-2">
                        <legend  class="w-auto"><small>Youth Catered by PES Units</small></legend>
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
                      </div>
                    </div>
                      <br>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <table id="example" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Visit Date</th>
                            <th>DSD</th>
                            <th>Responding Officer Name</th>
                            <th>Contact Number</th>
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
                                    <h3 class="card-title">PES Unit Identification Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>District : </strong><span id="district"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span id="dsd"></span></li>
                              <li class="list-group-item border-0"><strong>GNDs : </strong><span id="gnd"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span id="dm_name"></span></li>
                              <li class="list-group-item border-0"><strong>Date of visit to PES Unit : </strong><span id="meeting_date"></span></li>
                            </ul>
                            <fieldset class="border p-2 list-group-flush">
                            <legend  class="w-auto text-primary"><small> Responding Officer</small></legend>
                            <div class="row">
                              <div class="col-md-4">
                              <li class="list-group-item border-0"><strong>Name : </strong><br> <span id="responding_officer_name"></span></li>
                              </div>
                              <div class="col-md-4">
                              <li class="list-group-item border-0"><strong>Designation : </strong><br>  <span id="responding_officer_des"></span></li>
                              </div>
                              <div class="col-md-4">
                              <li class="list-group-item border-0"><strong>Contact details : </strong><br>  <span id="responding_officer_contacts"></span></li>
                              </div>

                            </div>
                            </fieldset>
                            <br>
                            <ul class="list-group list-group-flush">

                              <li class="list-group-item border-0"><strong>Type of Services rendered through the unit :</strong><br><span id="type_of_services"></span></li>
                              <li class="list-group-item border-0"><strong> Are records of youth catered during last six months ? : </strong><span id="records"></span></li>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> No of Youth Catered</small></legend>
                              <div class="row">
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Total Male (18-24) : </strong><br> <span id="male_18_24"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Total Male (25-30) : </strong><br>  <span id="male_25_30"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Total Male (>30) : </strong><br>  <span id="male_30"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>No of PWD Male : </strong><br>  <span id="pwd_male"></span></li>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Total Female (18-24) : </strong><br> <span id="female_18_24"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Total Female (25-30) : </strong><br>  <span id="female_25_30"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Total Female (>30) : </strong><br>  <span id="female_30"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>No of PWD Female : </strong><br>  <span id="pwd_female"></span></li>
                                </div>
                              </div>
                              </fieldset>
                              <br>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Details of most demanding services by youth</small></legend>
                              <table id="example2" class="table row-border table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Male</th>
                                          <th>Female</th>
                                      </tr>
                                      <tbody> 
                                      </tbody>
                                  </thead>        
                              </table>
                              </fieldset>
                              <br>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Gaps identified in the unit for delivering the services</small></legend>
                              <div class="row">
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Unit is available at divisional secretariat : </strong><br> <span id="unit_available"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Separate space is given in the DS office for unit : </strong><br>  <span id="space_available"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Sufficient stationary is available at the unit : </strong><br>  <span id="stationary_available"></span></li>
                                </div>
                              </div>
                              </fieldset>
                              <br>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Materials available sufficiently in the unit </small></legend>
                              <div class="row">
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Office chairs : </strong><br> <span id="chairs_available"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Office tables : </strong><br>  <span id="tables_available"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Office cupboards : </strong><br>  <span id="cupboards_available"></span></li>
                                </div>
                                <div class="col-md-3">
                                <li class="list-group-item border-0"><strong>Stationary items : </strong><br>  <span id="stationary_items_available"></span></li>
                                </div>

                              </div>
                              </fieldset>
                              <br>

                              <li class="list-group-item border-0"><strong>Requirement of each item if lack : </strong><br><span id="lack_of_items"></span></li>
                              <li class="list-group-item border-0"><strong>Staffs attached to the unit at the moment : </strong><span id="staff"></span></li>
                              <li class="list-group-item border-0"><strong>Does the existing staff sufficient? : </strong><span id="sufficient_staff"></span></li>
                              <li class="list-group-item border-0"><strong>Additional requirement of staff : </strong><br><span id="additional_staff"></span></li>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> VT Database </small></legend>
                              <div class="row">
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Maintain a VT database : </strong><br> <span id="vt_database"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Database updated during last six months : </strong><br>  <span id="update_vt"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong> Last updated date : </strong><br>  <span id="last_updated_vt"></span></li>
                                </div>
                              </div>
                              </fieldset>

                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Job Database </small></legend>
                              <div class="row">
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Maintain a Job database : </strong><br> <span id="job_database"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Database updated during last six months : </strong><br>  <span id="update_job"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong> Last updated date : </strong><br>  <span id="last_updated_job"></span></li>
                                </div>
                              </div>
                              </fieldset>
                              <li class="list-group-item border-0"><strong>Reason for not updating the VT/Job database: </strong><br><span id="reasons_to_not_update"></span></li>
                              <li class="list-group-item border-0"><strong>Gaps in delivering the service : </strong><br><span id="gaps"></span></li>
                              <li class="list-group-item border-0"><strong>Branch: </strong><span id="branch"></span></li>
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
   url:"{{ Route('reports-me/cg/pes/fetch') }}",
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

  $.each(data, function(index, value) {
    console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.meeting_date, value.dsd, value.responding_officer_name, value.responding_officer_contacts, value.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="{{url('reports-me/pes')}}/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

     var total_male = value.male_18_24+value.male_25_30+value.male_30;
     var total_female = value.female_18_24+value.female_25_30+value.female_30;
     var total_p_male = value.pwd_male;
     var total_p_female = value.pwd_female;
     if ($.isNumeric(total_male,total_female,total_p_male,total_p_female)) {
          male_sum += parseFloat(total_male);
          female_sum += parseFloat(total_female);
          pwd_m_sum += parseFloat(total_p_male);
          pwd_f_sum += parseFloat(total_p_female);
      } 
  });
   
   $('#total_records').text(data.length);
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
       

      $.get("{{ url('reports-me/cg/pes') }}" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#gnd').text(data.meeting.gnd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.program_date);
          $('#responding_officer_name').text(data.meeting.responding_officer_name);
          $('#responding_officer_des').text(data.meeting.responding_officer_des);
          $('#responding_officer_contacts').text(data.meeting.responding_officer_contacts);
          $('#type_of_services').html(data.meeting.type_of_services);
          $('#records').text(data.meeting.records);
          $('#male_18_24').text(data.meeting.male_18_24);
          $('#male_25_30').text(data.meeting.male_25_30);
          $('#male_30').text(data.meeting.male_30);
          $('#female_18_24').text(data.meeting.female_18_24);
          $('#female_25_30').text(data.meeting.female_25_30);
          $('#female_30').text(data.meeting.female_30);
          $('#pwd_male').text(data.meeting.pwd_male);
          $('#pwd_female').text(data.meeting.pwd_female);
          $('#unit_available').text(data.meeting.unit_available);
          $('#space_available').text(data.meeting.space_available);
          $('#stationary_available').text(data.meeting.stationary_available);
          $('#chairs_available').text(data.meeting.chairs_available);
          $('#tables_available').text(data.meeting.tables_available);
          $('#cupboards_available').text(data.meeting.cupboards_available);
          $('#stationary_items_available').text(data.meeting.stationary_items_available);
          $('#lack_of_items').html(data.meeting.lack_of_items);
          $('#staff').text(data.meeting.staff);
          $('#sufficient_staff').text(data.meeting.sufficient_staff);
          $('#additional_staff').html(data.meeting.additional_staff);
          $('#update_vt').text(data.meeting.update_vt);
          $('#vt_database').text(data.meeting.vt_database);
          $('#last_updated_vt').text(data.meeting.last_updated_vt);
          $('#job_database').text(data.meeting.job_database);
          $('#update_job').text(data.meeting.update_job);
          $('#reasons_to_not_update').html(data.meeting.reasons_to_not_update);
          $('#gaps').html(data.meeting.gaps);
          $('#branch').text(data.meeting.name);

          var output1 = '';

          for(var count = 0; count < data.services.length; count++)
          {
            
           output1 += '<tr>';
           output1 += '<td>' + (count+1) + '</td>';
           output1 += '<td>' + data.services[count].male + '</td>';
           output1 += '<td>' + data.services[count].female + '</td></tr>';
          }
          $('#example2 tbody').html(output1);

          

      })

   });



$('#print').click(function () {
    $('.print').printThis({
      pageTitle: "Career Guidance Program",
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