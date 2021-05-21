
<?php $__env->startSection('title','Users |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Information</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Branch</th>
                        <th>Activate</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1 ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <form method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">                
                                <select class="form-control" data-id="<?php echo e($user->id); ?>" id="role" name="role">
                                    <option value="0">Select a Role</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option  
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleA): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($roleA->id==$role->id): ?> selected <?php endif; ?> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>  
                            </form>          
                        </td>
                        <td>
                            <form method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group"> 
                                <select class="form-control" data-id="<?php echo e($user->id); ?>" id="branch" name="branch">
                                    <option value="0">Assign</option>
                                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option  
                                    <?php if($user->branch==$branch->id): ?> selected <?php endif; ?> 
                                    value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            </form>    
                        </td>
                        
                        <td><div class="form-group">
                            <form method="post" id="userActivate">
                            <?php echo e(csrf_field()); ?>

                            <label>
                                <input type="checkbox" id="isActive" class="flat-red isActive" data-id="<?php echo e($user->id); ?>" <?php if($user->isActive): ?> checked <?php endif; ?>>
                            </label>
                            
                        </form>
                    </div>       
                        </td>
                        <td>
                            <form id="userDelete" method="post" >
                                <?php echo e(csrf_field()); ?>

                                <button type="button" id="delete" data-id="<?php echo e($user->id); ?>" class="btn btn-block btn-danger btn-flat">Delete</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('ifClicked', '.isActive', function(){    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/userActivate',
                      
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
                      
            success: function(data) {
                          
            toastr.success('Status Successfully Changed ! ', 'Congratulations', {timeOut: 5000});
                          
            },
  
            error: function (jqXHR, exception) {    
                console.log(jqXHR);
                toastr.error('Something Error !', 'Status not Changed!')
            },
        });
        });


        //Assign A branch
        $(document).on('change' , '#branch', function (){
            var user_id = $(this).attr('data-id');
            var branch = $(this).children("option:selected").val();
            //alert(role);
            $.ajax({
                type: 'POST',
                url: SITE_URL + '/branch',
                          
                data: {
                    '_token': $('input[name=_token]').val(),
                    'user_id': user_id,
                    'branch': branch
                    
                },
                cache: false,          
                success: function(data) {              
                toastr.success('Branch Successfully Assigned ! ', 'Congratulations', {timeOut: 5000});
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