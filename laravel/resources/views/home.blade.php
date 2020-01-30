@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

{{-- Admin Dashboard --}}
@can('admin-dashboard')
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
	                <h3 class="card-title">Goal Completion    <a href="{{Route('view_completion')}}"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h3>
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

@endcan
{{--finish admin dashboard--}}
{{--start youth dashboard--}}
@can('youth-dashboard')
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

              <div class="col-12 col-sm-6 col-md-4">
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
              <div class="col-12 col-sm-6 col-md-4">
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
                  @foreach($vacancies as $vacancy) 
                  <li class="nav-item">
                    <a class="nav-link">
                      {{$vacancy->title}} <span class="badge badge-danger">closing date: {{ $vacancy->dedline}} </span>
                      <span class="float-right">
                        <div class="form-group">
                        
                        {{csrf_field()}}
                        <i style="display:none" id="loading" class="fa fa-spinner fa-lg faa-spin animated"></i>
                        <button type="button"  data-id="{{$vacancy->id}}" class="btn btn-primary btn-flat btn-sm" id="apply-vacancy">Apply</button>

                        </div>
                        </span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="{{Route('vacancies')}}" title="">See More</a></span>
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
                  @foreach($courses as $course) 
                  <li class="nav-item">
                    <a class="nav-link">
                      {{$course->name}}   (@foreach($course->institutes as $ins) {{ $ins->name }}, @endforeach)
                      <span class="float-right">
                        <div class="form-group">
                         <button type="button"  data-id="{{$course->id}}" onclick="window.location='{{ URL::to('courses/' . $course->id . '/view') }}'" class="btn btn-primary btn-flat btn-sm">See Details</button>
                        </div>
                        </span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="{{Route('reports/courses')}}" title="">See More</a></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </div>
        </div>
    </section>
@endcan
@can('branch-dashboard')
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
		        <div class="row">
		        	<div class="col-md-8">
		        		<div class="card">
			              <div class="card-header">
			                <h5 class="card-title">Progress Recap Report</h5>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<div id="columnchart_material" style="height: 300px;"></div>
			              </div>
			        	</div>
		        	</div>
		        	<div class="col-md-4">
		        		<div class="card">
			              <div class="card-header">
			                <h5 class="card-title">Goal Completion <a href="{{Route('view_completion')}}"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h5>

			                
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<div class="progress-group">
			                      Career Guidance
			                      <span class="float-right"><b>{{$count_cg}}</b>/{{$targets->cg}}</span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-primary" style="width: <?php $total_cg = ($count_cg/$targets->cg)*100; ?> {{$total_cg}}%"></div>
			                      </div>
			                    </div>
			                    <!-- /.progress-group -->

			                    <div class="progress-group">
			                      Soft Skills
			                      <span class="float-right"><b>{{$count_soft_skills}}</b>/{{$targets->soft}}</span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-danger" style="width: <?php $total_soft = ($count_soft_skills/$targets->soft)*100; ?> {{$total_soft}}%"></div>
			                      </div>
			                    </div>

			                    <!-- /.progress-group -->
			                    <div class="progress-group">
			                      <span class="progress-text">VT Training</span>
			                      <span class="float-right"><b>{{$count_vt}}</b>/{{$targets->vt}}</span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-success" style="width: <?php $total_vt = ($count_vt/$targets->vt)*100; ?> {{$total_vt}}%"></div>
			                      </div>
			                    </div>

			                    <!-- /.progress-group -->
			                    <div class="progress-group">
			                      <span class="progress-text">Professional Training</span>
			                      <span class="float-right"><b>{{$count_prof}}</b>/{{$targets->prof}}</span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-success" style="width: <?php $total_prof = ($count_prof/$targets->prof)*100; ?> {{$total_prof}}%"></div>
			                      </div>
			                    </div>
			                    <!-- /.progress-group -->
			                    <div class="progress-group">
			                      Job Placement
			                      <span class="float-right"><b>{{$count_jobs}}</b>/{{$targets->jobs}}</span>
			                      <div class="progress progress-sm">
			                        <div class="progress-bar bg-warning" style="width: <?php $total_jobs = ($count_jobs/$targets->jobs)*100; ?> {{$total_jobs}}%"></div>
			                      </div>
			                    </div>
			                    <!-- /.progress-group -->
			              </div>
			        	</div>
		        	</div>
		        </div>
             <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Tasks</h3>
                      <div class="card-tools">
                        <span class="badge badge-success"></span>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-responsive">
                        <tr>
                          <th>Task</th>
                          <th>Due Date</th>
                          <th>Task Created at</th>
                        </tr>
                        @foreach($tasks as $task)
                        <tr>
                          <td>{{$task->task}}</td>
                          <?php $current_date =  date('Y-m-d'); ?>
                          
                          <td style="color: @if($current_date>$task->due_date) red @else green @endif">{{$task->due_date}}</td>

                          <td >{{date('Y-m-d',strtotime($task->created_at))}}</td>
                        </tr>  
                        @endforeach
                        </table>
                    </div>
                    <!-- /.card-body -->
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
@endcan
@can('employer-dashboard')
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

              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Job Applications</span>
                    <span class="info-box-number">{{$applications->count()}}</span>
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
                    <span class="info-box-number">{{$followers}}</span>
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
                  @foreach($applications as $application) 
                  <li class="nav-item">
                    <a class="nav-link">
                      {{$application->name}} <span class="text-muted">applies to</span>  {{$application->title}}
                      <span class="float-right">
                        <div class="form-group">
                         <button type="button"  onclick="window.location='{{Route('youth/applications')}}'" class="btn btn-primary btn-flat btn-sm">See Details</button>
                        </div>
                        </span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="{{Route('youth/applications')}}" title="">See More</a></span>
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
                  @foreach($vacancies as $vacancy) 
                  <li class="nav-item">
                    <a class="nav-link">
                      {{$vacancy->title}} 
                      <span class="float-right">
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="card-footer">
                <span class="float-right"><a href="{{Route('vacancies')}}" title="">See More</a></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </div>
        </div>
    </section>
@endcan
@can('me-dashboard')
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
                  <h3 class="card-title">Goal Completion    <a href="{{Route('view_completion')}}"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h3>
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

        </div>
    </section>
@endcan
@can('management-dashboard')
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
                  <h3 class="card-title">Goal Completion    <a href="{{Route('view_completion')}}"><span  class="badge badge-success float-right" id="row_count">View Report</span></a></h3>
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

        </div>
    </section>
@endcan
@endsection
@section('scripts')
<script>
	@if (session('success'))
	toastr.info('{{session('success')}}')
	@endif

</script>
@can('admin-dashboard')
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Branch', 'Youths', 'CG','Soft Skills','VT','Prof','Jobs','BSS'],
          ['Nuwara Eliya', {{$count_NE_youth}}, {{$count_NE_cg}}, {{$count_NE_soft_skills}}, {{$count_NE_vt}},  {{$count_NE_prof}}, {{$count_NE_jobs}},{{$count_NE_bss}}],
          ['Trincomalee', {{$count_TRIN_youth}}, {{$count_TRIN_cg}}, {{$count_TRIN_soft_skills}} , {{$count_TRIN_vt}},  {{$count_TRIN_prof}}, {{$count_TRIN_jobs}},{{$count_TRIN_bss}}],
          ['Kegalle', {{$count_KEG_youth}}, {{$count_KEG_cg}}, {{$count_KEG_soft_skills}}, {{$count_KEG_vt}}, {{$count_KEG_prof}}, {{$count_KEG_jobs}},{{$count_KEG_bss}}],
          ['Ginigathhena', {{$count_GINI_youth}}, {{$count_GINI_cg}}, {{$count_GINI_soft_skills}}, {{$count_GINI_vt}},  {{$count_GINI_prof}}, {{$count_GINI_jobs}},{{$count_GINI_bss}}],
          ['Battacalao', {{$count_BAT_youth}}, {{$count_BAT_cg}}, {{$count_BAT_soft_skills}}, {{$count_BAT_vt}},  {{$count_BAT_prof}}, {{$count_BAT_jobs}},{{$count_BAT_bss}}],
          ['Anuradhapura', {{$count_ANU_youth}}, {{$count_ANU_cg}}, {{$count_ANU_soft_skills}}, {{$count_ANU_vt}}, {{$count_ANU_prof}}, {{$count_ANU_jobs}},{{$count_ANU_bss}}],
          ['Mullaitivu', {{$count_MUL_youth}}, {{$count_MUL_cg}}, {{$count_MUL_soft_skills}}, {{$count_MUL_vt}},  {{$count_MUL_prof}}, {{$count_MUL_jobs}},{{$count_MUL_bss}}],

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
@endcan
@can('me-dashboard')
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Branch', 'Youths', 'CG','Soft Skills','VT','Prof','Jobs','BSS'],
          ['Nuwara Eliya', {{$count_NE_youth}}, {{$count_NE_cg}}, {{$count_NE_soft_skills}}, {{$count_NE_vt}},  {{$count_NE_prof}}, {{$count_NE_jobs}},{{$count_NE_bss}}],
          ['Trincomalee', {{$count_TRIN_youth}}, {{$count_TRIN_cg}}, {{$count_TRIN_soft_skills}} , {{$count_TRIN_vt}},  {{$count_TRIN_prof}}, {{$count_TRIN_jobs}},{{$count_TRIN_bss}}],
          ['Kegalle', {{$count_KEG_youth}}, {{$count_KEG_cg}}, {{$count_KEG_soft_skills}}, {{$count_KEG_vt}}, {{$count_KEG_prof}}, {{$count_KEG_jobs}},{{$count_KEG_bss}}],
          ['Ginigathhena', {{$count_GINI_youth}}, {{$count_GINI_cg}}, {{$count_GINI_soft_skills}}, {{$count_GINI_vt}},  {{$count_GINI_prof}}, {{$count_GINI_jobs}},{{$count_GINI_bss}}],
          ['Battacalao', {{$count_BAT_youth}}, {{$count_BAT_cg}}, {{$count_BAT_soft_skills}}, {{$count_BAT_vt}},  {{$count_BAT_prof}}, {{$count_BAT_jobs}},{{$count_BAT_bss}}],
          ['Anuradhapura', {{$count_ANU_youth}}, {{$count_ANU_cg}}, {{$count_ANU_soft_skills}}, {{$count_ANU_vt}}, {{$count_ANU_prof}}, {{$count_ANU_jobs}},{{$count_ANU_bss}}],
          ['Mullaitivu', {{$count_MUL_youth}}, {{$count_MUL_cg}}, {{$count_MUL_soft_skills}}, {{$count_MUL_vt}},  {{$count_MUL_prof}}, {{$count_MUL_jobs}},{{$count_MUL_bss}}],

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
@endcan
@can('management-dashboard')
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Branch', 'Youths', 'CG','Soft Skills','VT','Prof','Jobs','BSS'],
          ['Nuwara Eliya', {{$count_NE_youth}}, {{$count_NE_cg}}, {{$count_NE_soft_skills}}, {{$count_NE_vt}},  {{$count_NE_prof}}, {{$count_NE_jobs}},{{$count_NE_bss}}],
          ['Trincomalee', {{$count_TRIN_youth}}, {{$count_TRIN_cg}}, {{$count_TRIN_soft_skills}} , {{$count_TRIN_vt}},  {{$count_TRIN_prof}}, {{$count_TRIN_jobs}},{{$count_TRIN_bss}}],
          ['Kegalle', {{$count_KEG_youth}}, {{$count_KEG_cg}}, {{$count_KEG_soft_skills}}, {{$count_KEG_vt}}, {{$count_KEG_prof}}, {{$count_KEG_jobs}},{{$count_KEG_bss}}],
          ['Ginigathhena', {{$count_GINI_youth}}, {{$count_GINI_cg}}, {{$count_GINI_soft_skills}}, {{$count_GINI_vt}},  {{$count_GINI_prof}}, {{$count_GINI_jobs}},{{$count_GINI_bss}}],
          ['Battacalao', {{$count_BAT_youth}}, {{$count_BAT_cg}}, {{$count_BAT_soft_skills}}, {{$count_BAT_vt}},  {{$count_BAT_prof}}, {{$count_BAT_jobs}},{{$count_BAT_bss}}],
          ['Anuradhapura', {{$count_ANU_youth}}, {{$count_ANU_cg}}, {{$count_ANU_soft_skills}}, {{$count_ANU_vt}}, {{$count_ANU_prof}}, {{$count_ANU_jobs}},{{$count_ANU_bss}}],
          ['Mullaitivu', {{$count_MUL_youth}}, {{$count_MUL_cg}}, {{$count_MUL_soft_skills}}, {{$count_MUL_vt}},  {{$count_MUL_prof}}, {{$count_MUL_jobs}},{{$count_MUL_bss}}],

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
@endcan
@can('branch-dashboard')
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Activity', 'Progress', { role: 'style' }],
          ['No of Youths', {{$count_youth}},'#b87333'],
          ['CG', {{$count_cg}},'silver'],
          ['Soft Skills', {{$count_soft_skills}},'silver'],
          ['VT', {{$count_vt}},'silver'],
          ['Prof', {{$count_prof}},'silver'],
          ['Jobs', {{$count_jobs}},'silver'],
          ['BSS', {{$count_bss}},'silver'],
        ]);

        var options = {
          chart: {
          
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


@endcan
@can('youth-dashboard')
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
@endcan
@endsection