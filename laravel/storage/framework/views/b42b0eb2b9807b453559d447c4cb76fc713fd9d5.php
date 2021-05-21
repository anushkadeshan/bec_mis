
<?php $__env->startSection('title','Work Place Assesments |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-8">
                      
            <h4>Work place assessment <small class="badge badge-success"> <?php echo e(count($meetings)); ?></small></h4>
          </div>
          <div class="col-md-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(Route('home')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(url('m&e-reports')); ?>">Reports</a></li>
              <li class="breadcrumb-item active">4.2.1</li>
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
                      <?php if(is_null($branch_id)): ?>
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Branch &nbsp;&nbsp;</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                              <option value="">All</option>
                              <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </a>
                      </li> 
                      <?php else: ?>
                      <input type="hidden" name="branch_id" value="<?php echo e($branch_id); ?>"> 
                      <?php endif; ?>
                      <li class="nav-item">
                        <a class="nav-link">
                            
                         <div class="input-group date" data-provide="datepicker">
                      <input type="text" class="form-control" id="dateStart" data-date-end-date="0d" placeholder="From">
                     <div class="input-group-addon">
                      <span class="text-muted" class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">
                         <div class="input-group date" data-provide="datepicker">
                            <input type="text" name="dateEnd" id="dateEnd" class="form-control" data-date-end-date="0d" placeholder="To">
                            <div class="input-group-addon">
                          <span class="text-muted" class="glyphicon glyphicon-th"></span>
                      </div>
                          </div>
                        </a>
                      </li>
                     <!-- <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">Employer &nbsp;&nbsp;</label>
                            <select name="employer_id" id="employer_id" class="form-control">
                              <option value="">All</option>
                              <?php $__currentLoopData = $employers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($employer->id); ?>"><?php echo e($employer->employer_name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </a>
                      </li> 
                    -->
                      <li class="nav-item">
                          <a class="nav-link">
                            <button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i id="loading" class="fas fa-filter"></i> Filter</button>
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
                        <i class="fa fa-graduation-cap"></i>Assesments
                      </a>
                      
                    </div>

                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?>
                        <div class="col-md-12">
                          <table id="example10" class="table row-border table-hover">
                                <thead>
                                    <tr>
                                        <th width="20">#</th>
                                        <th>Branch</th>
                                        <th>No of Assesments </th>
                                    </tr>
                                    <tbody> 
                                    </tbody>
                                </thead>        
                            </table>
                          
                        </div>
                        <?php endif; ?>  
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <table id="example" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Review Date</th>
                            <th>Employer </th>
                            <th>Head of Organization</th>
                            <th>Branch</th>
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
                                    <h3 class="card-title">Assesment Details</h3>
                              </div>
                              <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item border-0"><strong>District : </strong><span class="text-muted" id="district"></span></li>
                              <li class="list-group-item border-0"><strong>DSDs : </strong><span class="text-muted" id="dsd"></span></li>
                              <li class="list-group-item border-0"><strong>DM Name : </strong><span class="text-muted" id="dm_name"></span></li>
                              <li class="list-group-item border-0"><strong>Review Date : </strong><span class="text-muted" id="meeting_date"></span></li>
                              <fieldset class="border p-2 list-group-flush">
                              <legend  class="w-auto text-primary"><small> Employer Details</small></legend>
                              <div class="row">
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Employer Name : </strong> <br><span class="text-muted" id="employer"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Head of Organization : </strong><br><span class="text-muted" id="head_of_org"></span></li>
                                </div>
                                 <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Organization is registered ? : </strong><br><span class="text-muted" id="registered"></span></li>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Type of registration : </strong><br><span class="text-muted" id="type_of_reg"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong> Nature of Business : </strong><br><span class="text-muted" id="nature_of_business"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong> No of employees  : </strong><br><span class="text-muted" id="no_of_employers"></span></li>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Worksites  : </strong><br><span  class="text-muted" id="worksites"></span></li>
                                </div>
                                <div class="col-md-4">
                                <li class="list-group-item border-0"><strong>Departments : </strong><br><span class="text-muted" id="departments"></span></li>
                                </div>
                                
                              </div>
                              <li class="list-group-item border-0"><strong>General Working Hours </strong><br></li>
                              <div class="card card-info card-outline">
                                <div class="card-body">
                                <div class="row"> 
                                <div class="col-md-3">
                                  <li class="list-group-item border-0"><strong>Time: From </strong><br><span class="text-muted" id="time_from"></span></li>
                                </div>  
                                 <div class="col-md-3">
                                  <li class="list-group-item border-0"><strong>Time: To </strong><br><span class="text-muted" id="time_to"></span></li>
                                </div>
                                <div class="col-md-3">
                                  <li class="list-group-item border-0"><strong>Days: From </strong><br><span class="text-muted" id="days_from"></span></li>
                                </div>
                                <div class="col-md-3">
                                  <li class="list-group-item border-0"><strong>Days: To </strong><br><span class="text-muted" id="days_to"></span></li>
                                </div>        
                              </div>
                              </div>
                              </div>
                              <li class="list-group-item border-0"><strong>Proportion of employees belongs to following categories</strong><br></li> 
                              <div class="card card-info card-outline">
                                <div class="card-body">
                                <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Women </strong><br><span class="text-muted" id="women"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Full time (40+ hrs a week) </strong><br><span class="text-muted" id="full_time"></span></li>
                                </div>
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Part time </strong><br><span class="text-muted" id="part_time"></span></li>
                                </div>
                              </div>
                                <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Working shifts </strong><br><span class="text-muted" id="shifts"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Contract basis </strong><br><span class="text-muted" id="contract"></span></li>
                                </div>
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Permanent </strong><br><span class="text-muted" id="permanant"></span></li>
                                </div>
                              </div>
                              <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Regularly working at different locations other than main site </strong><br><span class="text-muted" id="different_locations"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Disabled &/or have special needs </strong><br><span class="text-muted" id="disabled"></span></li>
                                </div>
                                
                              </div>
                              </div>
                              </div>
                              <div class="card card-info card-outline">
                                <div class="card-body">
                                <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Separate Human Resource department? </strong><br><span class="text-muted" id="hrd"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Appointment letter for the employees? </strong><br><span class="text-muted" id="app_letter"></span></li>
                                </div>
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Probation period which new recruits are subjected to? </strong><br><span class="text-muted" id="probation"></span></li>
                                </div>
                              </div>
                                <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong> Duration of probation </strong><br><span class="text-muted" id="duration"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Organization’s leave policy </strong><br><span class="text-muted" id="leave_policy"></span></li>
                                </div>
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Has a gender policy? </strong><br><span class="text-muted" id="gender_policy"></span></li>
                                </div>
                              </div>
                              <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Mechanism to avoid work place harassment?</strong><br><span class="text-muted" id="harassment"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>About the mechanism </strong><br><span class="text-muted" id="elaborate"></span></li>
                                </div>
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Equal opportunity for every levels of employees </strong><br><span class="text-muted" id="equal_opportunity"></span></li>
                                </div>
                              </div>
                              <div class="row"> 
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Prepared language</strong><br><span class="text-muted" id="prepared_language"></span></li>
                                </div>  
                                 <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Starting salary range </strong><br><span class="text-muted" id="starting_salary"></span></li>
                                </div>
                                <div class="col-md-4">
                                  <li class="list-group-item border-0"><strong>Facilities to your employees </strong><br><span class="text-muted" id="facilities"></span></li>
                                </div>
                              </div>
                              </div>
                              </div>
                              </div>
                              </fieldset>
                               
                              
                              <li class="list-group-item border-0"><strong>Branch: </strong><span class="text-muted" id="branch"></span></li>
                            </ul>
                          </div>
                        </div>  
                      </div>  
                         
                        <?php echo e(csrf_field()); ?>  
                        
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

 function fetch_data(dateStart = '', dateEnd = '',branch='' /*,course='',employer=''*/)
 {
  $.ajax({
   url:"<?php echo e(url('reports-me/job/assesment/fetch')); ?>",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,branch:branch/*,employer:employer*/},
   dataType:"json",
   beforeSend: function(){
     $("#loading").attr('class', 'fa fa-spinner fa-lg faa-spin animated');
   },
   complete: function(){
     $("#loading").attr('class', 'fas fa-filter');
    
   },
   success:function(data)
   {
  dataTable2.clear().draw();
    var count2 = 1;
    $.each(data.summary, function(index, value2) {
     
    dataTable2.row.add([count2++, value2.name, value2.total]).draw();
    });

  dataTable.clear().draw();
   var count = 1;

  $.each(data.data, function(index, value) {
    //console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.program_date, value.e_name, value.head_of_org, value.branch_name,'<div class="btn-group"><button type="button" name="view" data-id="'+value.m_id+'" class="btn btn-warning btn-flat btn-sm btn_view"><i class="fa fa-eye"></i></button><a href="<?php echo e(url('reports-me/assesment')); ?>/'+value.m_id+'/edit"><button type="button" name="view" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></button></a></div>']).draw();

  });
   
   $('#total_records').text(data.data.length);
    
   }
  });

  $('#filter').click(function(){
  var dateStart = $('#dateStart').val();
  var dateEnd = $('#dateEnd').val();
  var branch = $('#branch_id').val();
  //var employer = $('#employer_id').val();
  if(dateStart != '' &&  dateEnd != '')
  {
   fetch_data(dateStart, dateEnd, branch,employer);
  
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
 // $('#employer_id').val('');
  fetch_data();
 });
 }

});

$('body').on('click', '.btn_view', function () {

      var meeting_id = $(this).data('id');
       

      $.get("<?php echo e(url('reports-me/job/assesment')); ?>" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_3"]').tab('show');
          $('#tabs a[href="#tab_3"]').attr("data-toggle", "tab");

          $('#district').text(data.meeting.district);
          $('#dsd').text(data.meeting.dsd);
          $('#dm_name').text(data.meeting.dm_name);
          $('#meeting_date').text(data.meeting.program_date);

          $('#employer').text(data.meeting.e_name);
          $('#head_of_org').text(data.meeting.head_of_org);
          $('#registered').text(data.meeting.registered);
          $('#type_of_reg').text(data.meeting.type_of_reg);
          $('#nature_of_business').text(data.meeting.nature_of_business);
          $('#no_of_employers').text(data.meeting.no_of_employers);
          $('#worksites').text(data.meeting.worksites);
          $('#departments').text(data.meeting.departments);
          $('#time_from').text(data.meeting.time_from);
          $('#time_to').text(data.meeting.time_to);
          $('#days_from').text(data.meeting.days_from);
          $('#days_to').text(data.meeting.days_to);
    
          $('#women').text(data.meeting.women);
          $('#full_time').text(data.meeting.full_time);
          $('#part_time').text(data.meeting.part_time);
          $('#shifts').text(data.meeting.shifts);
          $('#contract').text(data.meeting.contract);
          $('#permanant').text(data.meeting.permanant);
          $('#different_locations').text(data.meeting.different_locations);
          $('#disabled').text(data.meeting.disabled);
          
          $('#hrd').text(data.meeting.hrd);
          $('#app_letter').text(data.meeting.app_letter);
          $('#probation').text(data.meeting.probation);
          $('#duration').text(data.meeting.duration);
          $('#leave_policy').text(data.meeting.leave_policy);
          $('#gender_policy').text(data.meeting.gender_policy);
          $('#harassment').text(data.meeting.harassment);
          $('#elaborate').text(data.meeting.elaborate);
          $('#equal_opportunity').text(data.meeting.equal_opportunity);
          $('#prepared_language').text(data.meeting.prepared_language);
          $('#starting_salary').text(data.meeting.starting_salary);
          $('#facilities').text(data.meeting.facilities);

          $('#branch').text(data.meeting.branch_name); 

         
         
 
      })

   });

$('body').on('click', '#review_id', function () {

      var meeting_id = $(this).data('id');
     // alert(meeting_id);
       

      $.get("<?php echo e(url('reports-me/skill/institute-review')); ?>" +'/' + meeting_id +'/view', function (data) {
          $('#tabs a[href="#tab_4"]').tab('show');
          $('#tabs a[href="#tab_4"]').attr("data-toggle", "tab");

          $('#district1').text(data.meeting.district);
          $('#dsd1').text(data.meeting.dsd);
          $('#dm_name1').text(data.meeting.dm_name);
          $('#meeting_date1').text(data.meeting.program_date);
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