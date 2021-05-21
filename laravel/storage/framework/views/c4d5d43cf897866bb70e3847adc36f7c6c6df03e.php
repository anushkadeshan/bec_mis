
<?php $__env->startSection('title','System Audits |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
                  		
            <h3>User Activities <small class="badge badge-success"> <?php echo e(count($audits)); ?></small></h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(Route('home')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(url('m&e-reports')); ?>">Reprots</a></li>
              <li class="breadcrumb-item active">2.1.1</li>
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
                        
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                      <li class="nav-item">
                        <a class="nav-link">
                            <div class="form-group">
                            <label for="disability">User &nbsp;&nbsp;</label>
                            <select name="user_id" id="user_id" class="form-control">
                              <option value="">All</option>
                              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </a>
                      </li> 
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
                      			<button type="button" name="filter" id="filter" class="btn btn-primary btn-flat"><i class="fas fa-filter"></i> Filter  <i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i></button>
                      			<button type="button" name="refresh" id="refresh" class="btn btn-default btn-flat">Refresh</button>
                      		</a>
                      </li>
                      <?php endif; ?>
                                      
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
                <h3 class="card-title p-3">Audit Logs <small class="text-muted">(Limited to 500 records due to heavy load.)</small> </h3>
                <ul class="nav nav-pills ml-auto p-2" id="tabs">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Laravel Audit</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Mysql Audit</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div  class="row">
                        <div class="col-md-12">
                          <table id="example2" class="table row-border table-hover display">
		                <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>User</th>
	                            <th>Event</th>
	                            <th>Auditable ID</th>
	                            <th>Model</th>
	                            <th>Old value</th>
	                            <th>New Value</th>
		                        <th>IP</th>
		                        <th>User Agent</th>
		                        <th>Created at</th>
		                    </tr>
		                    <tbody>	
		                    </tbody>
		                </thead>        
            		 </table>
                        </div>
                    </div>  
                    
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <table id="example3" class="table row-border table-hover">
		                <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>User</th>
	                            <th>Event</th>
	                            <th>Auditable ID</th>
	                            <th>Model</th>
		                        <th>Created at</th>
		                    </tr>
		                    <tbody>	
		                    </tbody>
		                </thead>        
            		 </table>   
            	<?php echo e(csrf_field()); ?>

                  </div>
                  <!-- /.tab-pane -->
                
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

var dataTable = $("#example2").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

        "columnDefs": [
            {
                "targets": [ 6 ],
                "visible": false,
            },

            {
                "targets": [ 5 ],
                "visible": false
            }
        ],
    });


var dataTable1 = $("#example3").DataTable({
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

 function fetch_data(dateStart = '', dateEnd = '',user='')
 {
  $.ajax({
   url:"<?php echo e(route('audit/fetch')); ?>",
   method:"POST",
   data:{dateStart:dateStart, dateEnd:dateEnd, _token:_token,user:user},
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
  $.each(data.laravel, function(index, value) {
    console.log(value);
    // use data table row.add, then .draw for table refresh
    dataTable.row.add([count++, value.name, value.event, value.auditable_id,value.auditable_type,value.old_values, value.new_values, value.ip_address, value.user_agent, value.date]).draw();

  });
  
  //mysql

  dataTable1.clear().draw();
   var count1 = 1;

  $.each(data.mysql, function(index, value1) {
    console.log(value1);
    // use data table row.add, then .draw for table refresh
    dataTable1.row.add([count1++, value1.name, value1.action, value1.relevent_id,value1.relevent_table, value1.date]).draw();

  }); 
    
   }
  });

  $('#filter').click(function(){
  var dateStart = $('#dateStart').val();
  var dateEnd = $('#dateEnd').val();
  var user = $('#user_id').val();
  if(dateStart != '' &&  dateEnd != '')
  {
   fetch_data(dateStart, dateEnd, user);
  }
  else
  {
    toastr.error('Error !', 'Both Date is required');
   
  }
 });

 $('#refresh').click(function(){
  $('#dateStart').val('');
  $('#dateEnd').val('');
  $('#user_id').val('');
  fetch_data();
 });
 }

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