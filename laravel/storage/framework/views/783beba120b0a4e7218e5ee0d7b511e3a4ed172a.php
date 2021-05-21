
<?php $__env->startSection('title','Completion Reports |'); ?>
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('management')): ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('me-dashboard')): ?>
<div class="container-fluid">
    <br>    
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <a href="<?php echo e(url('/education')); ?>">
            <div class="info-box bg-info-gradient">
              <span class="info-box-icon"><i class="fas fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Education</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div> 
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="<?php echo e(url('/career-guidance')); ?>">
            <div class="info-box bg-success-gradient">
              <span class="info-box-icon"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Career Guidance</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="<?php echo e(url('/skill-development')); ?>">
            <div class="info-box bg-warning-gradient">
              <span class="info-box-icon"><i class="fa fa-award"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-white">Skill Development</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="<?php echo e(url('/job-linking')); ?>">
            <div class="info-box bg-danger-gradient">
              <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Job Linking</span>
                <span class="info-box-number">&nbsp;</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description text-white">
                  Click Here
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->
</div>
<?php endif; ?>
<?php endif; ?>
<hr>
<div class="container-fluid">
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?>
  <div  class="row" style="background-color: #5E6971; color: white;">
    <div class="col-md-4"> 
    <br>     
      <div class="form-group">
        <select name="branch_id" id="branch_id" class="form-control">
          <option value="">Select Branch</option>
          <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($branch->name); ?>"><?php echo e($branch->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select> 
      </div>
    </div>
    <div class="col-md-4"> 
    <br>     
      <div class="form-group">
        <select name="status" id="status" class="form-control">
          <option value="">Select Status</option>
          <option value="Completed">Completed</option>
          <option value="Not Completed">Not Completed</option>
        </select> 
      </div>
    </div>
  </div>
  <br> 
<?php endif; ?>
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Completion Reports to be added ( from 2018 ) <span  class="badge badge-success float-right" id="row_count"></span></h3>
    </div>
    <div class="card-body">
   <table id="example2" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><th>Branch</th> <?php endif; ?>
                        <th>Report</th>
                        
                        <th>Reports entered</th>
                        <th>Today Added</th>
                        
                        

                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>
                    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="employer<?php echo e($report->id); ?>">
                        <td><?php echo e($no++); ?></td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><th><?php echo e($report->name); ?></th> <?php endif; ?>
                        <td><?php echo e($report->report); ?></td>
                        
                        <td><?php $count = DB::table($report->table_name)->where('branch_id',$report->branch_id)->count(); ?> <?php echo e($count); ?></td>
                        <td><?php $count2 = DB::table($report->table_name)->where('branch_id',$report->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereDate($report->table_name.'.created_at', '=', date('Y-m-d'))->count(); ?> <?php echo e($count2); ?></td>
                        
                        
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>        
            </table> 
          </div>
        </div>
    <hr>
  <div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Youths to be added from Completion Reports( from 2018 ) <span  class="badge badge-success float-right" id="row_count1"></span></h3>
     </div>
    <div class="card-body"> 
   <table id="example3" class="table row-border table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><th>Branch</th> <?php endif; ?>
                        <th>Report</th>
                        
                        <th>Youths Added</th>
                        <th>Today Added</th>
                        <th>This Week Added</th>
                        <th>Last Week Added</th>
                        

                    </tr>
                </thead> 
                <tbody>
                    <?php  $no=1; ?>

                    <?php  
                        $no=1;
                        $previous_week = strtotime("-1 week +1 day");
                        $start_week = strtotime("last sunday midnight",$previous_week);
                        $end_week = strtotime("next saturday",$start_week);
                        $start_week = date("Y-m-d",$start_week);
                        $end_week = date("Y-m-d",$end_week);
                     ?>
                    <?php $__currentLoopData = $youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr class="employer<?php echo e($youth->id); ?>">
                        <td><?php echo e($no++); ?></td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('branch')): ?><th><?php echo e($youth->name); ?></th> <?php endif; ?>
                        
                        <td><?php echo e($youth->target); ?></td>
                        
                        <td>

                          <?php $count2 = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->count(); 

                          $individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->count()?> 

                          <?php if($youth->report=='Job Interviews/Placements'): ?> <?php echo e($count2 + $individual); ?> <?php else: ?><?php echo e($count2); ?><?php endif; ?>

                        </td>

                        <td>
                          <?php if($youth->report=='Job Interviews/Placements'): ?>
                            <?php $count = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereDate($youth->table_name_youth.'.created_at', '=', date('Y-m-d'))->count(); 

                            $today_individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->whereDate('created_at', '=', date('Y-m-d'))->count();
                            ?> 
                          <?php echo e($count + $today_individual); ?></td>
                          <?php else: ?>
                            <?php $count = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereDate($youth->table_name_youth.'.created_at', '=', date('Y-m-d'))->count(); ?> <?php echo e($count); ?></td>
                          <?php endif; ?>
                          
                        <td>

                          <?php if($youth->report=='Job Interviews/Placements'): ?>
                            <?php $count_thisweek = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count();

                            $this_individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count();
                             ?> 
                             <?php echo e($count_thisweek + $this_individual); ?>

                          <?php else: ?>
                            <?php $count_thisweek = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count(); ?> <?php echo e($count_thisweek); ?>

                          <?php endif; ?>
                          

                        </td>

                        <td>
                          <?php if($youth->report=='Job Interviews/Placements'): ?>
                            <?php $count_last_week = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [$start_week, $end_week])->count();

                            $lastWeek_individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->whereBetween('created_at', [$start_week, $end_week])->count();

                             ?> 

                            <?php echo e($count_last_week + $lastWeek_individual); ?>

                          <?php else: ?>
                            <?php $count_last_week = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->whereBetween($youth->table_name_youth.'.created_at', [$start_week, $end_week])->count(); ?> 

                            <?php echo e($count_last_week); ?>

                          <?php endif; ?>
                          


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
<script type="">
  $(document).ready(function() {
   var table2 = $('#example2').DataTable( {

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

   var table3 = $('#example3').DataTable( {

        dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
    } );

   $('#branch_id').on('change', function () {
          table2.columns(1).search( this.value ).draw();
          table3.columns(1).search( this.value ).draw();
          var info2 = $('#example2').DataTable().page.info();
          var info3 = $('#example3').DataTable().page.info();
          $('#row_count').text(info2.recordsDisplay+ ' rows filtered out of  ' +info2.recordsTotal);
          $('#row_count1').text(info3.recordsDisplay+ ' rows filtered out of  ' +info3.recordsTotal);
      } );

   $('#status').on('change', function () {
          const regExSearch = '^' + this.value + '$';
          table2.columns(6).search(regExSearch, true, false).draw();
          table3.columns(8).search(regExSearch, true, false).draw();
          var info2 = $('#example2').DataTable().page.info();
          var info3 = $('#example3').DataTable().page.info();
          $('#row_count').text(info2.recordsDisplay+ ' rows filtered out of  ' +info2.recordsTotal);
          $('#row_count1').text(info3.recordsDisplay+ ' rows filtered out of  ' +info3.recordsTotal);
      } );

});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>