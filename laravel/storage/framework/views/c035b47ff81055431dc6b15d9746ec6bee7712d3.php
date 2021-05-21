
<?php $__env->startSection('title','Baselines |'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
  <hr>  
  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">Baseline Applications to be added ( from 2018 to 2019 ) <span  class="badge badge-success float-right" id="row_count"></span></h3>
    </div>
    <div class="card-body">
   <table id="example2" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Branch</th>
                        <th class="sum">Baselines to be entered</th>
                        <th class="sum">Baselines entered</th>
                        <th class="sum">Balance</th>
                        <th class="sum">Today Added</th>
                        <th class="sum">This Week Added</th>
                        <th class="sum">Last Week Added</th>
                        
                        <th>Status</th> 

                    </tr>
                </thead> 
                <tbody>
                    <?php  
                        $no=1;
                        $previous_week = strtotime("-1 week +1 day");
                        $start_week = strtotime("last sunday midnight",$previous_week);
                        $end_week = strtotime("next saturday",$start_week);
                        $start_week = date("Y-m-d",$start_week);
                        $end_week = date("Y-m-d",$end_week);
                     ?>
                    <?php $__currentLoopData = $cg_youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cg_youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $count = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->count(); ?>
                        <td><?php echo e($no++); ?></td>
                        <th><?php echo e($cg_youth->name); ?></th>
                        <td><?php echo e($cg_youth->target); ?></td>
                        <td> <?php echo e($count); ?></td>
                        <td><?php echo e($cg_youth->target - $count); ?></td>
                        <td><?php $count2 = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->whereDate('created_at', '=', date('Y-m-d'))->count(); ?> <?php echo e($count2); ?></td>
                        <td><?php $count3 = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count(); ?> <?php echo e($count3); ?></td>
                        <td><?php $count4 = DB::table('youths')->where('branch_id',$cg_youth->branch_id)->whereBetween('created_at', [$start_week, $end_week])->count(); ?> <?php echo e($count4); ?></td>
                        
                        
                        <td>
                            <?php if($count< $cg_youth->target): ?> <small class="badge badge-danger"><?php echo e("Not Completed"); ?></small> <?php else: ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody> 
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>       
            </table> 
          </div>
        </div>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="">
  $(document).ready(function() {
   var table2 = $('#example2').DataTable( {

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

   table2.columns( '.sum' ).every( function () {
    var column = this;

            var sum = column
                .data()
                .reduce(function (a, b) { 
                   a = parseInt(a, 10);
                   if(isNaN(a)){ a = 0; }                   

                   b = parseInt(b, 10);
                   if(isNaN(b)){ b = 0; }

                   return a + b;
                });
 
    $( this.footer() ).html( sum );
} );

});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>