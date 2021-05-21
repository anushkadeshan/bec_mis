<?php $__env->startSection('title','Home |'); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-10">

          </div>
          
        </div>
      </div><!-- Codes by HTMLcodes.ws -->

    </div>
    <!-- /.content-header -->


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-dashboard')): ?>
<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        	<!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">
                 <?php echo e($users_count); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Users</span>
                <span class="info-box-number">
                	<?php if(Auth::check()): ?>
                		<?php echo e($active_users); ?>

                	<?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-pause"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users to Active</span>
                <span class="info-box-number"><?php echo e($users_to_active); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fab fa-yoast"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Youths</span>
                <span class="info-box-number"><?php echo e($total_youths); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Progress Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                  	<div id="columnchart_material" style="height: 350px;"></div>
                  </div>
                  <!-- /.col -->
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box">
		              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Employers</span>
		                <span class="info-box-number">
		                 <?php echo e($employers_count); ?>

		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Vacancies</span>
		                <span class="info-box-number">
		                	<?php if(Auth::check()): ?>
		                		<?php echo e($vacancies_count); ?>

		                	<?php endif; ?>
		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->

		          <!-- fix for small devices only -->
		          <div class="clearfix hidden-md-up"></div>

		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-school"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Training Institutes</span>
		                <span class="info-box-number"><?php echo e($institutes_count); ?></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-graduation-cap"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Courses</span>
		                <span class="info-box-number"><?php echo e($courses_count); ?></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		        </div>
		        <!-- /.row -->
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">

        	<div class="col-12 col-sm-6 col-md-3">
        		<!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Last 8 Hour Active Users</h3>
                <div class="card-tools">

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">

                  <?php $__currentLoopData = $last_activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <?php echo e($activity->user->name); ?>

                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>
          <div class="col-12 col-sm-6 col-md-3">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Online Users</h3>
                <div class="card-tools">

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">

                  <?php $__currentLoopData = $recent_activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <?php echo e($activity->user->name); ?>

                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


        	<div class="col-12 col-sm-6 col-md-6">
        		<div class="card">
	              <div class="card-header">
	                <h3 class="card-title">Goal Completion    <a href="<?php echo e(Route('youth_progress')); ?>"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h3>
	                <div class="card-tools">

	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">

                    <div class="progress-group">
                      Career Guidance
                      <span class="float-right"><b><?php echo e($actual_cg); ?></b>/<?php echo e($total_cg); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php $total_cg = ($actual_cg/$total_cg)*100; ?> <?php echo e($total_cg); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Soft Skills
                      <span class="float-right"><b><?php echo e($actual_soft_skills); ?></b>/<?php echo e($total_soft); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width:  <?php $total_soft = ($actual_soft_skills/$total_soft)*100; ?> <?php echo e($total_soft); ?>%"></div>
                      </div>
                    </div>
                    <div class="progress-group">
                      <span class="progress-text">GVT Course Supports</span>
                      <span class="float-right"><b><?php echo e($count_gvt); ?></b>/<?php echo e($total_gvt); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: <?php $total_gvtt = ($count_gvt/$total_vt)*100; ?> <?php echo e($total_gvtt); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Vocational Training</span>
                      <span class="float-right"><b><?php echo e($actual_vt); ?></b>/<?php echo e($total_vt); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_vt = ($actual_vt/$total_vt)*100; ?> <?php echo e($total_vt); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Professional Training</span>
                      <span class="float-right"><b><?php echo e($actual_prof); ?></b>/<?php echo e($total_prof); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_prof = ($actual_prof/$total_prof)*100; ?> <?php echo e($total_prof); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Job Placement
                      <span class="float-right"><b><?php echo e($actual_jobs); ?></b>/<?php echo e($total_jobs); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php $total_jobs = ($actual_jobs/$total_jobs)*100; ?> <?php echo e($total_jobs); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                </div>
            	</div>
              </div>
            </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Current Status of Youths</h3>
                  </div>
                  <div class="card-body">
                      <table class="table row-border table-hover table-bordered">
                        <thead>
                          <tr>
                            <td></td>
                            <td>Course Ongoing</td>
                            <td>Following Course <span class="text-muted">(BEC  Supported)</span></td>
                            <td>Following Course <span class="text-muted">(BEC Not Supported)</span></td>
                            <td>On the Job</td>
                            <td>No Job</td>
                            <td>Not Contacted</td>
                            <td>Following Soft Skill Course</td>
                            <td>Total</td>
                          </tr>

                        </thead>
                    <tbody>
                        <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(Route('reports-me/skill/soft-skill')); ?>';">
                            <td>Soft Skills</td>
                            <?php $__currentLoopData = $soft_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($actual_soft_skills); ?></td>
                        </tr>

                          <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(Route('reports-me/skill/gvt-support')); ?>';">
                          <td>Directed to Government VT</td>
                            <?php $__currentLoopData = $gvt_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <td align="right"><?php echo e($count_gvt); ?></td>
                        </tr>
                        <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially Assisted - VT</td>
                            <?php $__currentLoopData = $vt_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($actual_vt); ?></td>
                        </tr>
                         <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially assisted - Prof</td>
                            <?php $__currentLoopData = $prof_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($actual_prof); ?></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                            <?php $__currentLoopData = $total_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($actual_soft_skills+$actual_vt+$actual_prof+$count_gvt); ?></td>
                        </tr>
                    <tbody>
                </table>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Reports</span>
                <span class="info-box-number">
                 <?php echo e($total_reports->count()); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-signature"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Reports Today</span>
                <span class="info-box-number">
                  <?php if(Auth::check()): ?>
                    <?php echo e($total_reports_day); ?>

                  <?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">M and E Reports</h3>
                  </div>
                  <div class="card-body">
                      <table id="example3" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report</th>
                            <th>Branch</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $no=1; ?>
                        <?php $__currentLoopData = $total_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total_report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="task">
                            <td><?php echo e($no++); ?></td>
                            <td>
                              <?php $string = $total_report->auditable_type;
                                    $replaced = str_replace("_", " ", $string);?>
                              <?php echo e(ucwords($replaced)); ?>

                            </td>
                            <td><?php echo e($total_report->branch_name); ?></td>
                            <td><?php echo e($total_report->created_at); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tbody>
                </table>
                  </div>
              </div>
            </div>
          </div>
        <div class="row">

        	<div class="col-12 col-sm-6 col-md-6">
        		<!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Job Applications</h3>
                <div class="card-tools">
                  <span class="badge badge-success">New <?php echo e($new_application_count); ?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a href="<?php echo e(Route('youth/applications')); ?>" class="nav-link">
                      <?php echo e($application->title); ?>

                      <span class="float-right <?php if($application->status=="Hired"): ?>text-success <?php else: ?> text-danger <?php endif; ?>">
                        <?php echo e($application->status); ?>

                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>
        	<div class="col-12 col-sm-6 col-md-6">
        		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Youth Followed by Employers</h3>
                <div class="card-tools">
                  <span class="badge badge-success">New <?php echo e($new_follower_count); ?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a href="<?php echo e(Route('youth/followers')); ?>" class="nav-link">
                      <?php echo e($follower->youth_name); ?>

                      <span class="float-right <?php if($follower->status=="Hired"): ?>text-success <?php else: ?> text-danger <?php endif; ?>">
                        <?php echo e($follower->status); ?>

                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
        	</div>
        </div>
        </div>
    </section>

<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('youth-dashboard')): ?>
<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        	<!-- Info boxes -->
        <div class="row">
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Vacancies</span>
                    <span class="info-box-number">
                      <?php if(Auth::check()): ?>
                        <?php echo e($vacancies_count); ?>

                      <?php endif; ?>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-school"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Training Institutes</span>
                    <span class="info-box-number"><?php echo e($institutes_count); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-graduation-cap"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Courses</span>
                    <span class="info-box-number"><?php echo e($courses_count); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-6">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Job Vacancies</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a class="nav-link">
                      <?php echo e($vacancy->title); ?> <span class="badge badge-danger">closing date: <?php echo e($vacancy->dedline); ?> </span>
                      <span class="float-right">
                        <div class="form-group">

                        <?php echo e(csrf_field()); ?>

                        <i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i>
                        <button type="button"  data-id="<?php echo e($vacancy->id); ?>" class="btn btn-primary btn-flat btn-sm" id="apply-vacancy">Apply</button>

                        </div>
                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="<?php echo e(Route('vacancies')); ?>" title="">See More</a></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-12 col-sm-6 col-md-6">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Courses to follow</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a class="nav-link">
                      <?php echo e($course->name); ?>   (<?php $__currentLoopData = $course->institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($ins->name); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>)
                      <span class="float-right">
                        <div class="form-group">
                         <button type="button"  data-id="<?php echo e($course->id); ?>" onclick="window.location='<?php echo e(URL::to('courses/' . $course->id . '/view')); ?>'" class="btn btn-primary btn-flat btn-sm">See Details</button>
                        </div>
                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="<?php echo e(Route('reports/courses')); ?>" title="">See More</a></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('branch-dashboard')): ?>
	<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        	<div class="row">
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box">
		              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Employers</span>
		                <span class="info-box-number">
		                 <?php echo e($employers_count); ?>

		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Vacancies</span>
		                <span class="info-box-number">
		                	<?php if(Auth::check()): ?>
		                		<?php echo e($vacancies_count); ?>

		                	<?php endif; ?>
		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->

		          <!-- fix for small devices only -->
		          <div class="clearfix hidden-md-up"></div>

		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-school"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Training Institutes</span>
		                <span class="info-box-number"><?php echo e($institutes_count); ?></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-graduation-cap"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Courses</span>
		                <span class="info-box-number"><?php echo e($courses_count); ?></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		        </div>
		        <div class="row">
		        	<div class="col-md-8">
		        		<div class="card">
			              <div class="card-header">
			                <h5 class="card-title">Progress Recap Report</h5>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<div id="columnchart_material" style="height: 210px;"></div>
			              </div>
			        	</div>
		        	</div>
		        	<div class="col-md-4">
		        		<div class="card">
			              <div class="card-header">
			                <h5 class="card-title">Goal Completion <a href="<?php echo e(Route('youth_progress')); ?>"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h5>


			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<div class="progress-group">
			                      Career Guidance
			                      <span class="float-right"><b><?php echo e($count_cg); ?></b>/<?php echo e($targets->cg); ?></span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-primary" style="width: <?php $total_cg = ($count_cg/$targets->cg)*100; ?> <?php echo e($total_cg); ?>%"></div>
			                      </div>
			                    </div>
			                    <!-- /.progress-group -->

			                    <div class="progress-group">
			                      Soft Skills
			                      <span class="float-right"><b><?php echo e($count_soft_skills); ?></b>/<?php echo e($targets->soft); ?></span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-danger" style="width: <?php $total_soft = ($count_soft_skills/$targets->soft)*100; ?> <?php echo e($total_soft); ?>%"></div>
			                      </div>
			                    </div>

			                    <!-- /.progress-group -->
			                    <div class="progress-group">
			                      <span class="progress-text">VT Training</span>
			                      <span class="float-right"><b><?php echo e($count_vt); ?></b>/<?php echo e($targets->vt); ?></span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-success" style="width: <?php $total_vt = ($count_vt/$targets->vt)*100; ?> <?php echo e($total_vt); ?>%"></div>
			                      </div>
			                    </div>

			                    <!-- /.progress-group -->
			                    <div class="progress-group">
			                      <span class="progress-text">Professional Training</span>
			                      <span class="float-right"><b><?php echo e($count_prof); ?></b>/<?php echo e($targets->prof); ?></span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-success" style="width: <?php $total_prof = ($count_prof/$targets->prof)*100; ?> <?php echo e($total_prof); ?>%"></div>
			                      </div>
			                    </div>
			                    <!-- /.progress-group -->
			                    <div class="progress-group">
			                      Job Placement
			                      <span class="float-right"><b><?php echo e($count_jobs); ?></b>/<?php echo e($targets->jobs); ?></span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-warning" style="width: <?php $total_jobs = ($count_jobs/$targets->jobs)*100; ?> <?php echo e($total_jobs); ?>%"></div>
			                      </div>
			                    </div>
			                    <!-- /.progress-group -->
			              </div>
			        	</div>
		        	</div>
		        </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="card-success">
                    <div class="card-header">
                      <h3 class="card-title">My Tasks Wall</h3>
                      <div class="card-tools">
                        <span class="badge badge-success"></span>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped" id="example5">
                        <tr>
                          <th>Task</th>
                          <th>Target (to be added)</th>
                          <th>#Added</th>
                          <th>#Balance to be added</th>
                          <th></th>
                        </tr>
                        <tr>
                          <td>Add Baseline Applications </td>
                          <td><?php echo e($cg_youths->target); ?></td>
                          <td><?php echo e($count_youth); ?></td>
                          <td><?php echo e($cg_youths->target-$count_youth); ?></td>
                          <td><?php if($count_youth< $cg_youths->target): ?> <small class="badge badge-danger"><?php echo e("Not Completed"); ?></small> <?php else: ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php endif; ?></td>
                        </tr>
                         <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php $count = DB::table($report->table_name)->where('branch_id',$report->branch_id)->count(); ?>
                         <?php if($count<$report->target): ?>
                          <tr class="employer<?php echo e($report->id); ?>">
                              <td> Add <?php echo e($report->report); ?></td>
                              <td><?php echo e($report->target); ?></td>
                              <td> <?php echo e($count); ?></td>
                              <td><?php echo e($report->target - $count); ?></td>
                              <td>
                                  <?php if($count< $report->target): ?> <small class="badge badge-danger"><?php echo e("Not Completed"); ?></small> <?php else: ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php endif; ?>
                              </td>
                          </tr>
                          <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           <?php $__currentLoopData = $youths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php $count2 = DB::table($youth->table_name_youth)->join($youth->table_name,$youth->table_name.'.id','=',$youth->table_name_youth.'.'.$youth->table_name_youth_id)->where($youth->table_name.'.branch_id',$youth->branch_id)->whereIn(DB::raw('YEAR(program_date)'), [2018,2019,2020] )->count(); $individual = DB::table('placement_individual')->where('branch_id',$youth->branch_id)->count()?>
                           <?php if($count2<$youth->target): ?>
                           <tr class="employer<?php echo e($youth->id); ?>">
                              <td> Add Youths for <?php echo e($youth->report); ?></td>
                              <td><?php echo e($youth->target); ?></td>

                              <td> <?php if($youth->report=='Job Interviews/Placements'): ?> <?php echo e($count2 + $individual); ?> <?php else: ?><?php echo e($count2); ?><?php endif; ?></td>

                              <td><?php if($youth->report=='Job Interviews/Placements'): ?><?php echo e($youth->target - ($count2 + $individual)); ?> <?php else: ?><?php echo e($youth->target-$count2); ?><?php endif; ?></td>
                              <td>
                                <?php if($youth->report=='Job Interviews/Placements'): ?>
                                      <?php if($youth->target ==$count2 + $individual ): ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php elseif( $youth->target <= $count2 + $individual): ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php else: ?> <small class="badge badge-danger"><?php echo e("Not Completed"); ?></small> <?php endif; ?>
                                <?php else: ?>
                                     <?php if($youth->target ==$count2 ): ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php elseif( $youth->target <= $count2): ?> <small class="badge badge-success"><?php echo e("Completed"); ?></small> <?php else: ?> <small class="badge badge-danger"><?php echo e("Not Completed"); ?></small> <?php endif; ?>
                                <?php endif; ?>


                              </td>
                          </tr>
                          <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>

            </div>
            <br>
             <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Tasks By Management</h3>
                      <div class="card-tools">
                        <span class="badge badge-success"></span>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped" id="example3">
                        <tr>
                          <th>Task</th>
                          <th>Due Date</th>
                          <th>Task Created at</th>
                        </tr>
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($task->task); ?></td>
                          <?php $current_date =  date('Y-m-d'); ?>

                          <td style="color: <?php if($current_date>$task->due_date): ?> red <?php else: ?> green <?php endif; ?>"><?php echo e($task->due_date); ?></td>

                          <td ><?php echo e(date('Y-m-d',strtotime($task->created_at))); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>

        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Course Following Details</h3>
                  </div>
                  <div class="card-body">
                      <table class="table row-border table-hover">
                        <thead>
                          <tr>
                          <td></td>
                          <td>Total Youths</td>
                          <td>Ongoing</td>
                          <td>Dropouts</td>
                          </tr>

                        </thead>
                    <tbody>
                          <tr tabindex="0" onmousedown="window.location='<?php echo e(Route('reports-me/skill/gvt-support')); ?>';">
                          <td>Directed to Government VT</td>
                          <td align="center"><span class="badge badge-pill badge-primary"><?php echo e($course_supports); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($gvt_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($gvt_ongoing->gvt_drop); ?></span></td>
                        </tr>
                        <tr tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/soft-skill')); ?>';">
                          <td>Soft Skills</td>
                          <td align="center"> <span class="badge badge-pill badge-primary"><?php echo e($count_soft_skills); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($soft_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($soft_ongoing->soft_drop); ?></span></td>
                        </tr>
                        <tr tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially Assisted - VT</td>
                          <td align="center"><span class="badge badge-pill badge-primary"><?php echo e($count_vt); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($vt_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($vt_ongoing->vt_drop); ?></span></td>
                        </tr>
                         <tr tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially assisted - Prof</td>
                          <td align="center"><span class="badge badge-pill badge-primary"><?php echo e($count_prof); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($prof_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($prof_ongoing->prof_drop); ?></span></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td align="center"><?php echo e($count_prof+$count_vt+$count_soft_skills+$course_supports); ?></td>
                          <td align="center"><?php echo e($prof_ongoing->status+$vt_ongoing->status+$soft_ongoing->status+$gvt_ongoing->status); ?></td>
                          <td align="center"><?php echo e($prof_ongoing->prof_drop+$vt_ongoing->vt_drop+$soft_ongoing->soft_drop+$gvt_ongoing->gvt_drop); ?></td>
                        </tr>
                    <tbody>
                </table>
                  </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Current Status of Youths</h3>
                  </div>
                  <div class="card-body">
                      <table class="table row-border table-hover table-bordered">
                        <thead>
                          <tr>
                            <td></td>
                            <td>Course Ongoing</td>
                            <td>Following Course <span class="text-muted">(BEC  Supported)</span></td>
                            <td>Following Course <span class="text-muted">(BEC Not Supported)</span></td>
                            <td>On the Job</td>
                            <td>No Job</td>
                            <td>Not Contacted</td>
                            <td>Following Soft Skill Course</td>
                            <td>Total</td>
                          </tr>

                        </thead>
                    <tbody>
                        <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(Route('reports-me/skill/soft-skill')); ?>';">
                            <td>Soft Skills</td>
                            <?php $__currentLoopData = $soft_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($count_soft_skills); ?></td>
                        </tr>

                          <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(Route('reports-me/skill/gvt-support')); ?>';">
                          <td>Directed to Government VT</td>
                            <?php $__currentLoopData = $gvt_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($course_supports); ?></td>
                        </tr>
                        <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially Assisted - VT</td>
                            <?php $__currentLoopData = $vt_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($count_vt); ?></td>
                        </tr>
                         <tr data-toggle="tooltip" data-placement="top" title="Click to update current status" tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially assisted - Prof</td>
                            <?php $__currentLoopData = $prof_status_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($count_prof); ?></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                            <?php $__currentLoopData = $total_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($value); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td align="right"><?php echo e($count_prof+$count_vt+$count_soft_skills+$course_supports); ?></td>
                        </tr>
                    <tbody>
                </table>
                  </div>
              </div>
            </div>
        </div>
		    <div class="row">

        	<div class="col-12 col-sm-6 col-md-6">
        		<!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Job Applications</h3>
                <div class="card-tools">
                  <span class="badge badge-success">New <?php echo e($new_application_count); ?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a href="<?php echo e(Route('youth/applications')); ?>" class="nav-link">
                      <?php echo e($application->title); ?>

                      <span class="float-right <?php if($application->status=="Hired"): ?>text-success <?php else: ?> text-danger <?php endif; ?>">
                        <?php echo e($application->status); ?>

                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>
        	<div class="col-12 col-sm-6 col-md-6">
        		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Youth Followed by Employers</h3>
                <div class="card-tools">
                  <span class="badge badge-success">New <?php echo e($new_follower_count); ?></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a href="<?php echo e(Route('youth/followers')); ?>" class="nav-link">
                      <?php echo e($follower->youth_name); ?>

                      <span class="float-right <?php if($follower->status=="Hired"): ?>text-success <?php else: ?> text-danger <?php endif; ?>">
                        <?php echo e($follower->status); ?>

                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
        	</div>
        </div>

        </div>
    </section>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-dashboard')): ?>
  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
           <div class="row">
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Vacancies</span>
                    <span class="info-box-number">
                      <?php if(Auth::check()): ?>
                        <?php echo e($vacancies_count); ?>

                      <?php endif; ?>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Job Applications</span>
                    <span class="info-box-number"><?php echo e($applications->count()); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-rss-square"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Youth Followers</span>
                    <span class="info-box-number"><?php echo e($followers); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-6">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Job Applications</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a class="nav-link">
                      <?php echo e($application->name); ?> <span class="text-muted">applies to</span>  <?php echo e($application->title); ?>

                      <span class="float-right">
                        <div class="form-group">
                         <button type="button"  onclick="window.location='<?php echo e(Route('youth/applications')); ?>'" class="btn btn-primary btn-flat btn-sm">See Details</button>
                        </div>
                        </span>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="<?php echo e(Route('youth/applications')); ?>" title="">See More</a></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-12 col-sm-6 col-md-6">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vacancies </h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  <?php $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a class="nav-link">
                      <?php echo e($vacancy->title); ?>

                      <span class="float-right">
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="<?php echo e(Route('vacancies')); ?>" title="">See More</a></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('me-dashboard')): ?>
<section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Reports</span>
                <span class="info-box-number">
                 <?php echo e($total_reports->count()); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-signature"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Reports Today</span>
                <span class="info-box-number">
                  <?php if(Auth::check()): ?>
                    <?php echo e($total_reports_day); ?>

                  <?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Progress Recap Report</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div id="columnchart_material" style="height: 350px;"></div>
                  </div>
                  <!-- /.col -->
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
            <!-- /.row -->
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">


          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Goal Completion    <a href="<?php echo e(Route('youth_progress')); ?>"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h3>
                  <div class="card-tools">

                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="progress-group">
                      Career Guidance
                      <span class="float-right"><b><?php echo e($actual_cg); ?></b>/<?php echo e($total_cg); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php $total_cg = ($actual_cg/$total_cg)*100; ?> <?php echo e($total_cg); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Soft Skills
                      <span class="float-right"><b><?php echo e($actual_soft_skills); ?></b>/<?php echo e($total_soft); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width:  <?php $total_soft = ($actual_soft_skills/$total_soft)*100; ?> <?php echo e($total_soft); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Vocational Training</span>
                      <span class="float-right"><b><?php echo e($actual_vt); ?></b>/<?php echo e($total_vt); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_vt = ($actual_vt/$total_vt)*100; ?> <?php echo e($total_vt); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Professional Training</span>
                      <span class="float-right"><b><?php echo e($actual_prof); ?></b>/<?php echo e($total_prof); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_prof = ($actual_prof/$total_prof)*100; ?> <?php echo e($total_prof); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Job Placement
                      <span class="float-right"><b><?php echo e($actual_jobs); ?></b>/<?php echo e($total_jobs); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php $total_jobs = ($actual_jobs/$total_jobs)*100; ?> <?php echo e($total_jobs); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                </div>
              </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">M and E Reports</h3>
                  </div>
                  <div class="card-body">
                      <table id="example3" class="table row-border table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report</th>
                            <th>Branch</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $no=1; ?>
                        <?php $__currentLoopData = $total_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total_report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="task">
                            <td><?php echo e($no++); ?></td>
                            <td>
                              <?php $string = $total_report->auditable_type;
                                    $replaced = str_replace("_", " ", $string);?>
                              <?php echo e(ucwords($replaced)); ?>

                            </td>
                            <td><?php echo e($total_report->branch_name); ?></td>
                            <td><?php echo e($total_report->created_at); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tbody>
                </table>
                  </div>
              </div>
            </div>
          </div>

        </div>
    </section>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('management-dashboard')): ?>
<section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-default elevation-1"><i class="far fa-address-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Baselines</span>
                <span class="info-box-number">
                 <?php echo e(number_format($total_youths)); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total CG Youths</span>
                <span class="info-box-number">
                 <?php echo e(number_format($actual_cg)); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-door-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Gvt. Directed Youths</span>
                <span class="info-box-number">
                  <?php if(Auth::check()): ?>
                    <?php echo e(number_format($course_supports)); ?>

                  <?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-laptop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Soft Skills Youths</span>
                <span class="info-box-number">
                  <?php if(Auth::check()): ?>
                    <?php echo e(number_format($actual_soft_skills)); ?>

                  <?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-funnel-dollar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Financial Assistance</span>
                <span class="info-box-number">
                  <?php if(Auth::check()): ?>
                    <?php echo e(number_format($actual_vt+$actual_prof)); ?>

                  <?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Job Placements</span>
                <span class="info-box-number">
                  <?php if(Auth::check()): ?>
                    <?php echo e(number_format($actual_jobs)); ?>

                  <?php endif; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Progress Recap Report</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div id="columnchart_material" style="height: 350px;"></div>
                  </div>
                  <!-- /.col -->
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
            <!-- /.row -->
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">


          <div class="col-12 col-sm-6 col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Goal Completion    <a href="<?php echo e(Route('youth_progress')); ?>"><span  class="badge badge-warning float-right" id="row_count">View Report</span></a></h3>
                  <div class="card-tools">

                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="progress-group">
                      Career Guidance
                      <span class="float-right"><b><?php echo e($actual_cg); ?></b>/<?php echo e($total_cg); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php $total_cg = ($actual_cg/$total_cg)*100; ?> <?php echo e($total_cg); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Soft Skills
                      <span class="float-right"><b><?php echo e($actual_soft_skills); ?></b>/<?php echo e($total_soft); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width:  <?php $total_soft = ($actual_soft_skills/$total_soft)*100; ?> <?php echo e($total_soft); ?>%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      <span class="progress-text">GVT Course Supports</span>
                      <span class="float-right"><b><?php echo e($course_supports); ?></b>/<?php echo e($total_gvt); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: <?php $total_gvtt = ($course_supports/$total_vt)*100; ?> <?php echo e($total_gvtt); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Vocational Training</span>
                      <span class="float-right"><b><?php echo e($actual_vt); ?></b>/<?php echo e($total_vt); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_vt = ($actual_vt/$total_vt)*100; ?> <?php echo e($total_vt); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Professional Training</span>
                      <span class="float-right"><b><?php echo e($actual_prof); ?></b>/<?php echo e($total_prof); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_prof = ($actual_prof/$total_prof)*100; ?> <?php echo e($total_prof); ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Job Placement
                      <span class="float-right"><b><?php echo e($actual_jobs); ?></b>/<?php echo e($total_jobs); ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php $total_jobs = ($actual_jobs/$total_jobs)*100; ?> <?php echo e($total_jobs); ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                </div>
              </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Course Following Details</h3>
                  </div>
                  <div class="card-body">
                      <table class="table row-border table-hover">
                        <thead>
                          <tr>
                          <td></td>
                          <td>Total Youths</td>
                          <td>Ongoing</td>
                          <td>Dropouts</td>
                          </tr>

                        </thead>
                    <tbody>
                          <tr tabindex="0" onmousedown="window.location='<?php echo e(Route('reports-me/skill/gvt-support')); ?>';">
                          <td>Directed to Government VT</td>
                          <td align="center"><span class="badge badge-pill badge-primary"><?php echo e($course_supports); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($gvt_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($gvt_ongoing->gvt_drop); ?></span></td>
                        </tr>
                        <tr tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/soft-skill')); ?>';">
                          <td>Soft Skills</td>
                          <td align="center"> <span class="badge badge-pill badge-primary"><?php echo e($actual_soft_skills); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($soft_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($soft_ongoing->soft_drop); ?></span></td>
                        </tr>
                        <tr tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially Assisted - VT</td>
                          <td align="center"><span class="badge badge-pill badge-primary"><?php echo e($actual_vt); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($vt_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($vt_ongoing->vt_drop); ?></span></td>
                        </tr>
                         <tr tabindex="0" onmousedown="window.location='<?php echo e(url('reports-me/skill/financial')); ?>';">
                          <td>Financially assisted - Prof</td>
                          <td align="center"><span class="badge badge-pill badge-primary"><?php echo e($actual_prof); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-warning"><?php echo e($prof_ongoing->status); ?></span></td>
                          <td align="center"><span class="badge badge-pill badge-danger"><?php echo e($prof_ongoing->prof_drop); ?></span></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td align="center"><?php echo e($actual_prof+$actual_vt+$actual_soft_skills+$course_supports); ?></td>
                          <td align="center"><?php echo e($prof_ongoing->status+$vt_ongoing->status+$soft_ongoing->status+$gvt_ongoing->status); ?></td>
                          <td align="center"><?php echo e($prof_ongoing->prof_drop+$vt_ongoing->vt_drop+$soft_ongoing->soft_drop+$gvt_ongoing->gvt_drop); ?></td>
                        </tr>
                    <tbody>
                </table>
                  </div>
              </div>
            </div>
          </div>

        </div>
    </section>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
	<?php if(session('success')): ?>
	toastr.info('<?php echo e(session('success')); ?>')
	<?php endif; ?>

</script>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-dashboard')): ?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Branch',  'CG','Soft Skills','VT','Prof','Jobs','BSS'],
          ['Nuwara Eliya', <?php echo e($count_NE_cg); ?>, <?php echo e($count_NE_soft_skills); ?>, <?php echo e($count_NE_vt); ?>,  <?php echo e($count_NE_prof); ?>, <?php echo e($count_NE_jobs); ?>,<?php echo e($count_NE_bss); ?>],
          ['Trincomalee',  <?php echo e($count_TRIN_cg); ?>, <?php echo e($count_TRIN_soft_skills); ?> , <?php echo e($count_TRIN_vt); ?>,  <?php echo e($count_TRIN_prof); ?>, <?php echo e($count_TRIN_jobs); ?>,<?php echo e($count_TRIN_bss); ?>],
          ['Kegalle',  <?php echo e($count_KEG_cg); ?>, <?php echo e($count_KEG_soft_skills); ?>, <?php echo e($count_KEG_vt); ?>, <?php echo e($count_KEG_prof); ?>, <?php echo e($count_KEG_jobs); ?>,<?php echo e($count_KEG_bss); ?>],
          ['Ginigathhena',  <?php echo e($count_GINI_cg); ?>, <?php echo e($count_GINI_soft_skills); ?>, <?php echo e($count_GINI_vt); ?>,  <?php echo e($count_GINI_prof); ?>, <?php echo e($count_GINI_jobs); ?>,<?php echo e($count_GINI_bss); ?>],
          ['Battacalao',  <?php echo e($count_BAT_cg); ?>, <?php echo e($count_BAT_soft_skills); ?>, <?php echo e($count_BAT_vt); ?>,  <?php echo e($count_BAT_prof); ?>, <?php echo e($count_BAT_jobs); ?>,<?php echo e($count_BAT_bss); ?>],
          ['Anuradhapura',  <?php echo e($count_ANU_cg); ?>, <?php echo e($count_ANU_soft_skills); ?>, <?php echo e($count_ANU_vt); ?>, <?php echo e($count_ANU_prof); ?>, <?php echo e($count_ANU_jobs); ?>,<?php echo e($count_ANU_bss); ?>],
          ['Mullaitivu',  <?php echo e($count_MUL_cg); ?>, <?php echo e($count_MUL_soft_skills); ?>, <?php echo e($count_MUL_vt); ?>,  <?php echo e($count_MUL_prof); ?>, <?php echo e($count_MUL_jobs); ?>,<?php echo e($count_MUL_bss); ?>],

        ]);


        var options = {
          chart: {

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      $(document).ready(function() {

        $('#example3').DataTable( {
            dom: 'Bfrtip',
            buttons: [

            ],

            bFilter: false


        } );
      } );


    </script>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('me-dashboard')): ?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Branch', 'Youths', 'CG','Soft Skills','VT','Prof','Jobs','BSS'],
          ['Nuwara Eliya', <?php echo e($count_NE_youth); ?>, <?php echo e($count_NE_cg); ?>, <?php echo e($count_NE_soft_skills); ?>, <?php echo e($count_NE_vt); ?>,  <?php echo e($count_NE_prof); ?>, <?php echo e($count_NE_jobs); ?>,<?php echo e($count_NE_bss); ?>],
          ['Trincomalee', <?php echo e($count_TRIN_youth); ?>, <?php echo e($count_TRIN_cg); ?>, <?php echo e($count_TRIN_soft_skills); ?> , <?php echo e($count_TRIN_vt); ?>,  <?php echo e($count_TRIN_prof); ?>, <?php echo e($count_TRIN_jobs); ?>,<?php echo e($count_TRIN_bss); ?>],
          ['Kegalle', <?php echo e($count_KEG_youth); ?>, <?php echo e($count_KEG_cg); ?>, <?php echo e($count_KEG_soft_skills); ?>, <?php echo e($count_KEG_vt); ?>, <?php echo e($count_KEG_prof); ?>, <?php echo e($count_KEG_jobs); ?>,<?php echo e($count_KEG_bss); ?>],
          ['Ginigathhena', <?php echo e($count_GINI_youth); ?>, <?php echo e($count_GINI_cg); ?>, <?php echo e($count_GINI_soft_skills); ?>, <?php echo e($count_GINI_vt); ?>,  <?php echo e($count_GINI_prof); ?>, <?php echo e($count_GINI_jobs); ?>,<?php echo e($count_GINI_bss); ?>],
          ['Battacalao', <?php echo e($count_BAT_youth); ?>, <?php echo e($count_BAT_cg); ?>, <?php echo e($count_BAT_soft_skills); ?>, <?php echo e($count_BAT_vt); ?>,  <?php echo e($count_BAT_prof); ?>, <?php echo e($count_BAT_jobs); ?>,<?php echo e($count_BAT_bss); ?>],
          ['Anuradhapura', <?php echo e($count_ANU_youth); ?>, <?php echo e($count_ANU_cg); ?>, <?php echo e($count_ANU_soft_skills); ?>, <?php echo e($count_ANU_vt); ?>, <?php echo e($count_ANU_prof); ?>, <?php echo e($count_ANU_jobs); ?>,<?php echo e($count_ANU_bss); ?>],
          ['Mullaitivu', <?php echo e($count_MUL_youth); ?>, <?php echo e($count_MUL_cg); ?>, <?php echo e($count_MUL_soft_skills); ?>, <?php echo e($count_MUL_vt); ?>,  <?php echo e($count_MUL_prof); ?>, <?php echo e($count_MUL_jobs); ?>,<?php echo e($count_MUL_bss); ?>],

        ]);


        var options = {
          chart: {

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

       $(document).ready(function() {

        $('#example3').DataTable( {
            dom: 'Bfrtip',
            buttons: [

            ],

            bFilter: false


        } );
      } );
    </script>

    <style>
  th { font-size: 15px; }
  td { font-size: 14px; }

  .zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  z-index: 5000;
  transition: all .2s ease-in-out;
}
</style>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('management-dashboard')): ?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Branch',  'CG','Soft Skills','VT','Prof','Jobs','BSS'],
          ['Nuwara Eliya', <?php echo e($count_NE_cg); ?>, <?php echo e($count_NE_soft_skills); ?>, <?php echo e($count_NE_vt); ?>,  <?php echo e($count_NE_prof); ?>, <?php echo e($count_NE_jobs); ?>,<?php echo e($count_NE_bss); ?>],
          ['Trincomalee',  <?php echo e($count_TRIN_cg); ?>, <?php echo e($count_TRIN_soft_skills); ?> , <?php echo e($count_TRIN_vt); ?>,  <?php echo e($count_TRIN_prof); ?>, <?php echo e($count_TRIN_jobs); ?>,<?php echo e($count_TRIN_bss); ?>],
          ['Kegalle',  <?php echo e($count_KEG_cg); ?>, <?php echo e($count_KEG_soft_skills); ?>, <?php echo e($count_KEG_vt); ?>, <?php echo e($count_KEG_prof); ?>, <?php echo e($count_KEG_jobs); ?>,<?php echo e($count_KEG_bss); ?>],
          ['Ginigathhena',  <?php echo e($count_GINI_cg); ?>, <?php echo e($count_GINI_soft_skills); ?>, <?php echo e($count_GINI_vt); ?>,  <?php echo e($count_GINI_prof); ?>, <?php echo e($count_GINI_jobs); ?>,<?php echo e($count_GINI_bss); ?>],
          ['Battacalao',  <?php echo e($count_BAT_cg); ?>, <?php echo e($count_BAT_soft_skills); ?>, <?php echo e($count_BAT_vt); ?>,  <?php echo e($count_BAT_prof); ?>, <?php echo e($count_BAT_jobs); ?>,<?php echo e($count_BAT_bss); ?>],
          ['Anuradhapura',  <?php echo e($count_ANU_cg); ?>, <?php echo e($count_ANU_soft_skills); ?>, <?php echo e($count_ANU_vt); ?>, <?php echo e($count_ANU_prof); ?>, <?php echo e($count_ANU_jobs); ?>,<?php echo e($count_ANU_bss); ?>],
          ['Mullaitivu',  <?php echo e($count_MUL_cg); ?>, <?php echo e($count_MUL_soft_skills); ?>, <?php echo e($count_MUL_vt); ?>,  <?php echo e($count_MUL_prof); ?>, <?php echo e($count_MUL_jobs); ?>,<?php echo e($count_MUL_bss); ?>],

        ]);


        var options = {
          chart: {

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

       $(document).ready(function() {

        $('#example3').DataTable( {
            dom: 'Bfrtip',
            buttons: [

            ],

            bFilter: false


        } );
      } );
    </script>

    <style>
  th { font-size: 15px; }
  td { font-size: 14px; }

  .zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  z-index: 5000;
  transition: all .2s ease-in-out;
}
</style>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('branch-dashboard')): ?>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Activity', 'Progress', { role: 'style' }],
          ['CG', <?php echo e($count_cg); ?>,'silver'],
          ['Soft Skills', <?php echo e($count_soft_skills); ?>,'silver'],
          ['VT', <?php echo e($count_vt); ?>,'silver'],
          ['Prof', <?php echo e($count_prof); ?>,'silver'],
          ['Jobs', <?php echo e($count_jobs); ?>,'silver'],
          ['BSS', <?php echo e($count_bss); ?>,'silver'],
        ]);

        var options = {
          chart: {

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      $(document).ready(function() {

        $('#example3').DataTable( {
            dom: 'Bfrtip',
            buttons: [

            ],

            bFilter: false


        } );
      } );
    </script>


<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('youth-dashboard')): ?>
<script>
    $(document).ready(function(){
     $(document).on('click' , '#apply-vacancy' ,function (){
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: SITE_URL + '/vacancy/apply',

            data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
            beforeSend: function(){
              $('#loading').show();
            },
            complete: function(){
              $('#loading').hide();
            },
            success: function(data) {
              if($.isEmptyObject(data.error)){
              toastr.success('Succesfully apply for the vacancy ! ', 'Congratulations', {timeOut: 5000});
            }
            else{
            toastr.error('Error !', ""+data.error+"");

            }
        },

            error: function (jqXHR, exception) {
                console.log(jqXHR);
                toastr.error('Error !', 'Something Error')
            },
        });
    });
  });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>