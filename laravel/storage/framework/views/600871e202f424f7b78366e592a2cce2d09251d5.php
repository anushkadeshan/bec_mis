
<?php $__env->startSection('title','View Youth Followers |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-5">
        			<h3 class="card-title">List of youth seleceted by employers to hire   <span class="badge badge-danger"><?php echo e($new_count); ?> </span> </h3> 
        		</div>
        		<div class="col-md-7 text-right">
        			<span class="badge badge-primary">Total <?php echo e($followers->count()); ?></span>
        		</div>

        	</div>
        </div>
        <br>
        <!-- /.card-header -->
        <div class="container-fluid">
        	<div class="callout callout-danger">
             	<h5><i class="fa fa-info"></i> Note:</h5>
             	Inform to youth and employer abouth this selection and arrange an interview and followup. 		
        	</div>
        </div>
        
        <div class="card-body">  
            <table id="example1" class="table row-border table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Youth Name</th>
                        <th>Youth Address</th>
                        <th>Youth Contacts</th>        
                        <th>Employer</th>
                        <th>Employer Email</th>
                        <th>Employer Phone</th>
                        <th width="150">Status</th>    
                
                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="followers<?php echo e($followers->id); ?>">
                        <td><?php echo e($no++); ?></td>
                        <td><a href="<?php echo e(URL::to('youth/' . $followers->youth_id . '/view')); ?>"><?php echo e($followers->youth_name); ?></a></td>
                        <td><?php echo e($followers->family_address); ?></td>
                        <td><?php echo e($followers->youth_phone); ?> <br> <small><?php echo e($followers->youth_email); ?></small></td>
                        <td><?php echo e($followers->employer_name); ?></td>
                        <td><?php echo e($followers->employer_email); ?></td>
                        <td><?php echo e($followers->employer_phone); ?></td>
                        
                        <td>
                        	<form id="status_form">
                        		<?php echo e(csrf_field()); ?>

                        		<div class="form-group">                        		
	                        		<select name="status" id="status" data-id="<?php echo e($followers->employers_follow_youths_id); ?>" class="form-control" >
	                        			<option value="">Select Status</option>
	                        			<option <?php if($followers->status=="Conatced Employer"): ?> selected <?php endif; ?>>Conatced Employer</option>
	                        			<option <?php if($followers->status=="Contacted Youth"): ?> selected <?php endif; ?>>Contacted Youth</option>
	                        			<option <?php if($followers->status=="Interview Scheduled"): ?> selected <?php endif; ?>>Interview Scheduled</option>
	                        			<option <?php if($followers->status=="Interviewed"): ?> selected <?php endif; ?>>Interviewed</option>
	                        			<option <?php if($followers->status=="Hired"): ?> selected <?php endif; ?>>Hired</option>
	                        			<option <?php if($followers->status=="Rejected"): ?> selected <?php endif; ?>>Rejected</option>
	                        		</select>
                        		</div>
                            </form>
                        </td>
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
	$(document).ready(function (){
		$(document).on('change' , '#status', function (){
            var id = $(this).attr('data-id');
            var status = $(this).children("option:selected").val();
            //alert(role);
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/youth/followers/status',
                          
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>