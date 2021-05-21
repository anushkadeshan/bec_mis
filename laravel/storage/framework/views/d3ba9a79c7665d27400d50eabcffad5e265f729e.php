
<?php $__env->startSection('title','Applications |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 class="card-title">Job Applications  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change-job-status')): ?> <span class="badge badge-danger"><?php echo e($new_count); ?> <?php endif; ?></span> </h3> 
        		</div>
        		<div class="col-md-9 text-right">
        			<span class="badge badge-primary">Total <?php echo e($applications->count()); ?></span>
        		</div>

        	</div>
        </div>
        <br>
        <!-- /.card-header -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('change-job-status')): ?>
        <div class="container">
        	<div class="callout callout-danger">
             	<h5><i class="fa fa-info"></i> Note:</h5>
             	You will informed by berendina team regarding below job applications immediately.  		
        	</div>
        </div>
        <?php endif; ?>
        <div class="card-body"> 
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change-job-status')): ?>
            <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <div class="form-group">   
                        <label for="Status">Hiring Status</label>                           
                        <select name="status" id="status_filter" class="form-control" >
                            <option value="">All</option>
                            <option>Conatced Employer</option>
                            <option>Contacted Youth</option>
                            <option>Interview Scheduled</option>
                            <option>Interviewed</option>
                            <option>Hired</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                </div>

            </div> 
            <?php endif; ?> 
            <br>      
            <table id="example" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Youth Name</th>
                        <th>Job Title</th>
                        <th>Applied On</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change-job-status')): ?>
                        <th>Employer</th>
                        <th>Employer Email</th>
                        <th>Employer Phone</th>
                        <th>status</th>
                        <th width="150">Status</th>    
                        <?php endif; ?>                 
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="application<?php echo e($application->id); ?>">
                        <td><?php echo e($no++); ?></td>
                        <td><a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('employer')): ?> data-toggle="tooltip" data-placement="top" title="<?php echo e($application->phone); ?>" <?php endif; ?> href="<?php echo e(URL::to('youth/' . $application->youth_id . '/view')); ?>"><?php echo e($application->youth_name); ?></a></td>
                        <td><a href="<?php echo e(URL::to('vacancy/' . $application->vacancy_id . '/view')); ?>"><?php echo e($application->title); ?></a></td>
                        <td>
                        	<?php 
                        		$dt = new DateTime($application->applied_on);
								
                        	?>
                        	<?php echo e($dt->format('Y-m-d')); ?>


                        </td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change-job-status')): ?>
                        <td><?php echo e($application->employer_name); ?></td>
                        <td><?php echo e($application->employer_email); ?></td>
                        <td><?php echo e($application->employer_phone); ?></td>
                        <td><?php echo e($application->status); ?></td>
                        
                        <td>
                        	<form id="status_form">
                        		<?php echo e(csrf_field()); ?>

                        		<div class="form-group">                        		
	                        		<select name="status" id="status" data-id="<?php echo e($application->application_id); ?>" class="form-control" >
	                        			<option value="">Select Status</option>
	                        			<option <?php if($application->status=="Conatced Employer"): ?> selected <?php endif; ?>>Conatced Employer</option>
	                        			<option <?php if($application->status=="Contacted Youth"): ?> selected <?php endif; ?>>Contacted Youth</option>
	                        			<option <?php if($application->status=="Interview Scheduled"): ?> selected <?php endif; ?>>Interview Scheduled</option>
	                        			<option <?php if($application->status=="Interviewed"): ?> selected <?php endif; ?>>Interviewed</option>
	                        			<option <?php if($application->status=="Hired"): ?> selected <?php endif; ?>>Hired</option>
	                        			<option <?php if($application->status=="Rejected"): ?> selected <?php endif; ?>>Rejected</option>
	                        		</select>
                        		</div>
                            </form>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>        
            </table>      
            
        </div>

    </div> 
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

	$(document).ready(function (){
		$(document).on('change' , '#status', function (){
            var id = $(this).attr('data-id');
            var status = $(this).children("option:selected").val();
            //alert(role);
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/youth/application/status',
                          
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'status': status
                    
                },
                cache: false,          
                success: function(data) {              
                toastr.success('Status Successfully Changed ! ', 'Congratulations', {timeOut: 5000});
                //$('#example1').DataTable().ajax.reload();           
                },

                error: function (jqXHR, exception) {    
                    console.log(jqXHR);
                    toastr.error('Something Error !', 'Status not Changed!');
                    
                },
            });
        });
	});

$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});


$(document).ready(function() {
   var table = $('#example').DataTable( {
        "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
            },
            {
                "targets": [ 2 ],
                "visible": true
            },

            {
                "targets": [ 3 ],
                "visible": true
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

    

      $('#status_filter').on('change', function () {
          table.columns(7).search( this.value ).draw();
      } );
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>