<?php $__env->startSection('title','Finacially Assisted Youths |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-warning card-outline">
                <div class="card-header">
                  <h3 class="card-title">Filters</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #5E6971; color: white;">

                    <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="bank_account"> Course ? </label>
                              <select name="bank_account" id="bank_account" class="form-control">
                                <option value="">All</option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option><?php echo e($course->course_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </select>
                            </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="bank_account"> Institute ? </label>
                              <select name="bank_account" id="bank_account1" class="form-control">
                                <option value="">All</option>
                                <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option><?php echo e($institute->institute_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </select>
                            </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="smart_phone">Course Status ?</label>
                              <select name="smart_phone" id="smart_phone" class="form-control">
                                <option value="">All</option>
                                <option>Finished</option>
                                <option>Ongoing</option>
                                <option>Dropout</option>

                              </select>
                            </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="training">Job Placement ?</label>
                              <select name="training" id="training" class="form-control">
                                <option value="">All</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                              </select>
                        </div>
                    </a>
                  </li>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?>
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                        <label for="disability">Branch &nbsp;&nbsp;</label>
                        <select name="branch_id" id="branch_id" class="form-control">
                          <option value="">All</option>
                          <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($branch->ext); ?>"><?php echo e($branch->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </a>
                  </li>
                  <?php endif; ?>
                  </ul>
                </div>
              </div>
        </div>
        <div class="col-md-9">
            <div class="card">
        <div class="card-header">
            <h3 class="card-title">Youth Information whom Financially supported <small class="badge badge-success"> <?php echo e(count($youths)); ?></small><span  class="badge badge-success float-right" id="row_count"></span></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Institute</th>
                        <th>Course</th>
                        <th>Type</th>
                        <th>Program Date</th>
                        <th>Course Start</th>
                        <th>Course End</th>
                        <th>Course Status</th>
                        <th>Job Link</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><th>Branch</th><?php endif; ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    <?php $__currentLoopData = $youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($youth->youth_name); ?></td>
                        <td><?php echo e($youth->gender); ?></td>
                        <td><?php echo e($youth->institute_name); ?></td>
                        <td><?php echo e($youth->course_name); ?></td>
                        <td><?php echo e($youth->course_type); ?></td>
                        <td><?php echo e($youth->program_date); ?></td>
                        <td><?php echo e($youth->start_date); ?></td>
                        <td><?php echo e($youth->end_date); ?></td>
                        <td>
                            <?php switch($youth->dropout):
                                case (1): ?>
                                    <small class="badge badge-danger"><?php echo e("Dropout"); ?></small>
                                <?php break; ?>
                                <?php case (0): ?>
                                    <?php if($youth->end_date < date("Y-m-d")): ?>
                                        <small class="badge badge-warning"><?php echo e("Finished"); ?></small>
                                    <?php else: ?>
                                        <small class="badge badge-success"><?php echo e("Ongoing"); ?></small>
                                    <?php endif; ?>
                                <?php break; ?>
                                <?php default: ?>

                            <?php endswitch; ?>

                        </td>
                        <td align="center">
                            <?php
                                $placement = DB::table('placements_youths')->where('youth_id',$youth->youth_id)->first();
                                $ind = DB::table('placement_individual')->where('youth_id',$youth->youth_id)->first();
                            ?>

                            <?php if(!is_null($placement)||!is_null($ind)): ?><span class="text-center text-success"><i class="fas fa-check-circle"><span style="display: none">1</span></i></span> <?php else: ?> <span class="text-center text-danger"><i class="fas fa-times-circle"><span style="display: none">0</span></i></span> <?php endif; ?>
                        </td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><td><?php echo e($youth->ext); ?></td><?php endif; ?>
                        <td><a href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/view')); ?>" target="_blank">
                                    <button type="button" id="view-youth" data-id="<?php echo e($youth->youth_id); ?>" class="btn btn-block btn-warning btn-flat btn-sm" ><i class="fas fa-eye"></i> </button>
                        </a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>
            </table>

        </div>
    </div>
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
    $('#bank_account').on('change', function () {
          table2.columns(3).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
    $('#bank_account1').on('change', function () {
          table2.columns(2).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
    $('#smart_phone').on('change', function () {
          table2.columns(7).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#training').on('change', function () {
          table2.columns(8).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#branch_id').on('change', function () {
          table2.columns(9).search( this.value ).draw();
          var info = $('#example2').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>