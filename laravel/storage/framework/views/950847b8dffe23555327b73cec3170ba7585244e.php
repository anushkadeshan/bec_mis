 
<?php $__env->startSection('title','Youth Progress |'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <br>
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
                              <label for="bank_account"> Soft Skill Provided ? </label>
                              <select name="bank_account" id="bank_account" class="form-control">
                                <option value="">All</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                              </select>
                            </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="smart_phone">GVT Course Support ?</label>
                              <select name="smart_phone" id="smart_phone" class="form-control">
                                <option value="">All</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                              </select>
                            </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="training">Financial Support to VT/Prof ?</label>
                              <select name="training" id="training" class="form-control">
                                <option value="">All</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                              </select>
                        </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="when"> Job Linked ?</label>
                              <select name="when" id="when" class="form-control">
                                <option value="">All</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link">
                        <div class="form-group">
                              <label for="when"> Is Youth BSS Beneficiary  ?</label>
                              <select name="bss" id="bss" class="form-control">
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Youth Progress who completed Career Guidance <small class="badge badge-success"> <?php echo e(count($youths)); ?></small> <span  class="badge badge-success float-right" id="row_count"></span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>CG-Program Date</th>
                                <th>Soft Skills</th>
                                <th>GVT Course Support</th>
                                <th>VT/Prof</th>
                                <th>Job</th>
                                <th>Soft</th>
                                <th>GVT</th>
                                <th>VT</th>
                                <th>Job</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><th>Branch</th><?php endif; ?>
                                <th>BSS</th>
                                <th>VT</th>
                                <th>Prof</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            <?php $__currentLoopData = $youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($youth->youth_name); ?> <?php if($youth->bss==1): ?> <span  class="badge badge-primary">BSS</span> <?php endif; ?></td>
                                <td><?php echo e($youth->program_date); ?></td>
                                <td align="center">
                                    <?php
                                        $soft = DB::table('provide_soft_skills_youths')->where('youth_id',$youth->youth_id)->distinct('youth_id')->first();
                                    ?>
                                    <?php if(!is_null($soft)): ?><span class="text-center text-success"><i class="fas fa-check-circle"></i></span> <?php else: ?> <span class="text-center text-danger"><i class="fas fa-times-circle"></i></span> <?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php
                                        $gvt = DB::table('course_supports_youth')->where('youth_id',$youth->youth_id)->first();
                                    ?>
                                    <?php if(!is_null($gvt)): ?><span class="text-center text-success"><i class="fas fa-check-circle"></i></span> <?php else: ?> <span class="text-center text-danger"><i class="fas fa-times-circle"></i></span> <?php endif; ?>
                                </td>
                               <td align="center">
                                    <?php
                                        $vt = DB::table('finacial_supports_youths')->where('youth_id',$youth->youth_id)->first();
                                    ?>
                                    <?php if(!is_null($vt)): ?><span class="text-center text-success"><i class="fas fa-check-circle"></i></span> <?php else: ?> <span class="text-center text-danger"><i class="fas fa-times-circle"></i></span> <?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php
                                        $placement = DB::table('placements_youths')->where('youth_id',$youth->youth_id)->first();
                                        $ind = DB::table('placement_individual')->where('youth_id',$youth->youth_id)->first();
                                    ?>
                                    <?php if(!is_null($placement)||!is_null($ind)): ?><span class="text-center text-success"><i class="fas fa-check-circle"></i></span> <?php else: ?> <span class="text-center text-danger"><i class="fas fa-times-circle"></i></span> <?php endif; ?>
                                </td>
                                <!-- filtering -->
                                <td align="center">
                                    <?php if(!is_null($soft)): ?> <?php echo e(1); ?><?php else: ?> <?php echo e(0); ?><?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php if(!is_null($gvt)): ?> <?php echo e(1); ?><?php else: ?> <?php echo e(0); ?><?php endif; ?>
                                </td>
                               <td align="center">
                                    <?php if(!is_null($vt)): ?> <?php echo e(1); ?><?php else: ?> <?php echo e(0); ?><?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php if(!is_null($placement)||!is_null($ind)): ?> <?php echo e(1); ?><?php else: ?> <?php echo e(0); ?> <?php endif; ?>
                                </td>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><td><?php echo e($youth->ext); ?></td><?php endif; ?>
                                <td><?php echo e($youth->bss); ?></td>
                                <td>
                                    <?php
                                        $vt1 = DB::table('finacial_supports_youths')->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                                        ->join('courses','courses.id','=','finacial_supports.course_id')
                                        ->where('courses.course_type','Vocational Training')
                                        ->where('youth_id',$youth->youth_id)->first();
                                    ?>
                                     <?php if(!is_null($vt1)): ?> <?php echo e(1); ?><?php else: ?> <?php echo e(0); ?><?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        $prof = DB::table('finacial_supports_youths')->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                                        ->join('courses','courses.id','=','finacial_supports.course_id')
                                        ->where('courses.course_type','Proffessional Training')
                                        ->where('youth_id',$youth->youth_id)->first();
                                    ?>
                                     <?php if(!is_null($prof)): ?> <?php echo e(1); ?><?php else: ?> <?php echo e(0); ?><?php endif; ?>
                                </td>
                                <td><a href="<?php echo e(URL::to('youth/' . $youth->youth_id . '/view')); ?>#tab_4" target="_blank">
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
<script >

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});

/* Custom filtering function which will search data in column four between two values */


$(document).ready(function() {
   var table = $('#example').DataTable( {
        "columnDefs": [
            {
                "targets": [ 7 ],
                "visible": false,
            },
            {
                "targets": [ 8 ],
                "visible": false
            },

            {
                "targets": [ 9 ],
                "visible": false
            },

            {
                "targets": [ 10 ],
                "visible": false
            },

            {
                "targets": [ 12 ],
                "visible": false
            }
        ],

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );


      $('#bank_account').on('change', function () {
          table.columns(7).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#smart_phone').on('change', function () {
          table.columns(8).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#training').on('change', function () {
          table.columns(9).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
      $('#when').on('change', function () {
          table.columns(10).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

       $('#branch_id').on('change', function () {
          table.columns(11).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );

      $('#bss').on('change', function () {
          table.columns(12).search( this.value ).draw();
          var info = $('#example').DataTable().page.info();
          $('#row_count').text(info.recordsDisplay+ ' youths filtered out of  ' +info.recordsTotal);
      } );
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>