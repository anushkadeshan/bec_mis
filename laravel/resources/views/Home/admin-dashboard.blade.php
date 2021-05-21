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
                 {{$users_count}}
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
                	@if(Auth::check())
                		{{$active_users}}
                	@endif
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
                <span class="info-box-number">{{$users_to_active}}</span>
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
                <span class="info-box-number">{{$total_youths}}</span>
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
		                 {{$employers_count}}
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
		                	@if(Auth::check())
		                		{{$vacancies_count}}
		                	@endif
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
		                <span class="info-box-number">{{$institutes_count}}</span>
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
		                <span class="info-box-number">{{$courses_count}}</span>
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
                <h3 class="card-title">Last Hour Active Users</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  
                  @foreach($last_activities as $activity)	
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      {{$activity->user->name}}
                    </a>
                  </li>
                  @endforeach
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
                  
                  @foreach($recent_activities as $activity) 
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      {{$activity->user->name}}
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          
        	<div class="col-12 col-sm-6 col-md-6">
        		<div class="card">
	              <div class="card-header">
	                <h3 class="card-title">Goal Completion    <a href="{{Route('youth_progress')}}"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h3>
	                <div class="card-tools">
	                  
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">

                    <div class="progress-group">
                      Career Guidance
                      <span class="float-right"><b>{{$actual_cg}}</b>/{{$total_cg}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php $total_cg = ($actual_cg/$total_cg)*100; ?> {{$total_cg}}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Soft Skills
                      <span class="float-right"><b>{{$actual_soft_skills}}</b>/{{$total_soft}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width:  <?php $total_soft = ($actual_soft_skills/$total_soft)*100; ?> {{$total_soft}}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Vocational Training</span>
                      <span class="float-right"><b>{{$actual_vt}}</b>/{{$total_vt}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_vt = ($actual_vt/$total_vt)*100; ?> {{$total_vt}}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Professional Training</span>
                      <span class="float-right"><b>{{$actual_prof}}</b>/{{$total_prof}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php $total_prof = ($actual_prof/$total_prof)*100; ?> {{$total_prof}}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group"> 
                      Job Placement
                      <span class="float-right"><b>{{$actual_jobs}}</b>/{{$total_jobs}}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php $total_jobs = ($actual_jobs/$total_jobs)*100; ?> {{$total_jobs}}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
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
                 {{$total_reports->count()}}
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
                  @if(Auth::check())
                    {{$total_reports_day}}
                  @endif
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
                        @foreach ($total_reports as $total_report)
                        <tr class="task">
                            <td>{{ $no++ }}</td>
                            <td>
                              <?php $string = $total_report->auditable_type;
                                    $replaced = str_replace("_", " ", $string);?>
                              {{ ucwords($replaced) }}
                            </td>
                            <td>{{ $total_report->branch_name }}</td>
                            <td>{{ $total_report->created_at }}</td>
                       
                        </tr>
                        @endforeach
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
                  <span class="badge badge-success">New {{$new_application_count}}</span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  @foreach($applications as $application)	
                  <li class="nav-item">
                    <a href="{{Route('youth/applications')}}" class="nav-link">
                      {{$application->title}}
                      <span class="float-right @if($application->status=="Hired")text-success @else text-danger @endif">
                        {{$application->status}}
                        </span>
                    </a>
                  </li>
                  @endforeach
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
                  <span class="badge badge-success">New {{$new_follower_count}}</span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                  @foreach($followers as $follower)	
                  <li class="nav-item">
                    <a href="{{Route('youth/followers')}}" class="nav-link">
                      {{$follower->youth_name}}
                      <span class="float-right @if($follower->status=="Hired")text-success @else text-danger @endif">
                        {{$follower->status}}
                        </span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
        	</div>
        </div>
        </div>
    </section>