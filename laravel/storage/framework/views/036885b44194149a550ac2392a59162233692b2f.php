
<?php $__env->startSection('title','View Youth |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="card">
        <div class="card-header">
        	<div class="row">
        		<div class="col-md-3">
        			<h3 data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?" class="card-title">Youths</h3> 
        		</div>
        		<div class="col-md-7">
        			
        		</div> 
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-institute')): ?>
        		<div class="col-md-2">
        			<!-- Button trigger modal -->
		        	<div class="text-right">
						<a href="<?php echo e(Route('youth/add')); ?>" title=""><button type="button" class="btn btn-primary btn-flat">Add New</button></a>
					</div>
        		</div>
                <?php endif; ?>
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('search-youth')): ?>
            <div class="row container" style="background-color: #5E6971; color: white; padding: 15px">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">District</label>
                        <select name="district" id="district" class="form-control" data-dependent="ds_division">
                            <option value="">All</option>
                            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($district->name_en); ?>"><?php echo e($district->name_en); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="highest_qualification">Highest Educational Qualification:</label>
                        <select name="highest_qualification" id="highest_qualification" class="form-control">
                            <option value="">All</option>
                            <option>Ordinary Level</option>
                            <option>Advanced Level</option>
                            <option>Certificate</option>
                            <option>Diploma</option>
                            <option>Higher Diploma</option>
                            <option>Degree</option>
                            <option>Masters</option>
                            <option>Doctorate</option>
                            <option>Skilled Apprentice</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>    
            <?php endif; ?>
        	<table id="example" class="table row-border table-hover" style="width:100%">
        		<thead>
        			<tr>
        				<th>#</th>
        				<th>Name</th>
        				<th>Gender</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-youth')): ?>
        				<th>NIC</th>
        				<th>Current Status</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                        <th>Branch</th>
                        <?php endif; ?>
                        
        				<th>Action</th>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('search-youth')): ?>
                        <th>District</th>
                        <th>Highest Edu. Qulification</th>
                        <th>Action</th>
                        <?php endif; ?>
        			</tr>
        		</thead>
        		<tbody>
        			<?php  $no=1; ?> 
                    <?php $__currentLoopData = $youths->chunk(100); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        			<?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        			<tr class="youth<?php echo e($youth->youth_id); ?>">
        				<td><?php echo e($no++); ?></td>
        				<td><?php echo e($youth->youth_name); ?></td>
        				<td><?php echo e($youth->gender); ?></td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-youth')): ?>
        				<td><?php echo e($youth->nic); ?></td>
        				<td><?php echo e($youth->current_status); ?></td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                        <td><?php echo e($youth->ext); ?></td>
                        <?php endif; ?>
                        
        				<td>
        					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-youth')): ?>
                        	<div class="btn-group">
                             
                                <a href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/view')); ?>" target="_blank">
                                    <button type="button" id="view-youth" data-id="<?php echo e($youth->youth_id); ?>" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                                </a>
                             
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-youth')): ?>
                            <a href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/edit')); ?>" target="_blank" title="">
                                    <button type="submit" id="edit-youth" data-id="<?php echo e($youth->youth_id); ?>" class="btn btn-block btn-success btn-flat btn-sm"><i class="fas fa-edit"></i></button>
                            </a>        
                        	<?php endif; ?>
                        	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-youth')): ?>
                            
                                <form id="userDelete" method="post" >
                                <?php echo e(csrf_field()); ?>

                                    <button data-toggle="confirmation" type="button" id="delete-youth" data-id="<?php echo e($youth->youth_id); ?>" class="btn btn-block btn-danger btn-flat btn-sm" ><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </div>
                            <?php endif; ?>
        				</td>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('search-youth')): ?>
                        <td><?php echo e($youth->family->district); ?></td>
                        <td><?php echo e($youth->highest_qualification); ?></td>
                        <td>
                            <a href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/view')); ?>">
                                    <button type="button" id="view-youth" data-id="<?php echo e($youth->id); ?>" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> Profile </button>
                                </a>
                        </td>
                        <?php endif; ?>
        			</tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        		</tbody>
        	</table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',

        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    $('#example').on('draw.dt', function () {
    	$('input').iCheck({
    		checkboxClass: 'icheckbox_square-green',
    		radioClass: 'iradio_square-red',
    		increaseArea: '20%' // optional
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



$(document).ready(function(){
	//career guidance checked 
	$(document).on('ifClicked', '.cg', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-cg',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//softskills checked 
	$(document).on('ifClicked', '.soft', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-soft',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//VT checked 
	$(document).on('ifClicked', '.vt', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-vt',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//prof checked 
	$(document).on('ifClicked', '.prof', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-prof',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

	//jobs checked 
	$(document).on('ifClicked', '.jobs', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-jobs',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });

    //bss checked 
    $(document).on('ifClicked', '.bss', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/progress-bss',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'youth_id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Progress Successfully Added ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });
});

//delete youth
$(document).ready(function(){
    $(document).on('click' , '#delete-youth' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/youth/delete-youth',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {              
            toastr.success('Youth Successfully Deleted ! ', 'Congratulations', {timeOut: 5000});
            $('.youth' +id).remove();
            //$('#example1').DataTable().ajax.reload();           
            },

            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Error !', 'You Do not have permission to delete employer')
            },
        });
    });
});

$(document).ready(function() {
    var table =  $('#example').DataTable();

    $('#district').on('change', function () {
        table.columns(3).search( this.value ).draw();
    } );

    $('#highest_qualification').on('change', function () {
        table.columns(4).search( this.value ).draw();
    } );

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>