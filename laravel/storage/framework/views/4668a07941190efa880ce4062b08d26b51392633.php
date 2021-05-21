<?php $__env->startSection('title',' Mobile App Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Staff Registered</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>EPF</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>District</th>
                                <th>Reporting To</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                            <?php $__currentLoopData = $snapshot_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $su): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($su->data()['epf']); ?></td>
                                <td><?php echo e($su->data()['name']); ?></td>
                                <td><?php echo e($su->data()['phone']); ?></td>
                                <td><?php echo e($su->data()['district']); ?></td>
                                <td><?php echo e($su->data()['reportingTo']); ?></td>
                                <td>
                                    <a href="<?php echo e(url('firebase-sessions/staff/'.$su->data()['uid'])); ?>"><button type="button" class="btn btn-success">View Sessions</button></a>
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