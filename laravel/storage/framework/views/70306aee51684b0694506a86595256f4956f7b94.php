<?php $__env->startSection('title',' Mobile App Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Users</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Uid</th>
                                <th>Email</th>
                                <th>is Enabled</th>
                                <th>Created</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($user->uid); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <form action="<?php echo e(url('firebase-disableUser')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="uid" value="<?php echo e($user->uid); ?>">
                                        <div class="form-group">
                                            <select name="status" onchange="this.form.submit()" id="disable" class="form-control">
                                                <option <?php if($user->disabled==false): ?> selected <?php endif; ?> value="false">Enabled</option>
                                                <option <?php if($user->disabled==true): ?> selected <?php endif; ?> value="true">Disabled</option>
                                            </select>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <?php echo e($user->metadata->createdAt->format('Y-m-d | H:i:s')); ?>

                                </td>
                                <td>
                                    <?php echo e($user->metadata->lastLoginAt->format('Y-m-d | H:i:s')); ?>

                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')" href="<?php echo e(url('firebase-deleteUser/'.$user->uid)); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button> </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
   function changeStatus(a,id) {
        var value = (a.value || a.options[a.selectedIndex].value);
        alert(value);  //crossbrowser solution =)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: BaseUrl+'/change/role',
            dataType: "json",
            data:{
                'role':value,
                'user':id
            },
            success: function(response) {
                location.reload();
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.firebase', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>