<?php $__env->startSection('title',' Mobile App Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Staff  Visits</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Client</th>
                                <th>Purpose</th>
                                <th>Action</th>
                            </tr>
                        </thead>

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