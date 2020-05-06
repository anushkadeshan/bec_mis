@extends('layouts.main')
@section('content')
<div class="container-fluid"	>
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h3>Reports Selection Menu</h3>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{Route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Reprots Selection</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-md-4">
                    <div class="card card-success card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Youth Reports</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				
                				<li class="nav-item">
            						<a href="{{Route('reports/personal')}}" class="nav-link">
	              						<p>
	              							Personal Details
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
                      <li class="nav-item">
                        <a href="{{Route('reports/location')}}" class="nav-link">
                            <p>
                              Location Details
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
          						<li class="nav-item">
            						<a href="{{Route('reports/status')}}" class="nav-link">
	              						<p>
	              							Current Status
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						<li class="nav-item">
            						<a href="{{Route('reports/courses')}}" class="nav-link">
	              						<p>
	              							Intresting Courses
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
                      <li class="nav-item">
                        <a href="{{Route('reports/jobs')}}" class="nav-link">
                            <p>
                              Intresting Job Industries
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
          						<li class="nav-item">
            						<a href="{{Route('reports/business')}}" class="nav-link">
	              						<p>
	              							Intresting Self Business
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						
          						<li class="nav-item">
            						<a href="{{Route('reports/common')}}" class="nav-link">
	              						<p>
	              							Common Details
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						<li class="nav-item">
            						<a href="{{Route('reports/youth_courses')}}" class="nav-link">
	              						<p>
	              							Courses Follow
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
                			</ul>
                		</div>
                	</div>
              </div>
    			<div class="col-md-4">
    				<div class="card card-warning card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Employer Related Reports</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				
                				<li class="nav-item">
            						<a href="{{Route('reports/employers')}}" class="nav-link">
	              						<p>
	              							Employers
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						<li class="nav-item">
            						<a href="{{Route('reports/vacancies')}}" class="nav-link">
	              						<p>
	              							Vacancies
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						
                			</ul>
                		</div>
                	</div>
    			</div>
    			<div class="col-md-4">
    				<div class="card card-info card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Training Institutes Reports</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				
                				<li class="nav-item">
            						<a href="{{Route('reports/institutes')}}" class="nav-link">
	              						<p>
	              							Training Institutes
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						<li class="nav-item">
            						<a href="{{url('reports/training_courses')}}" class="nav-link">
	              						<p>
	              							Courses
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
          						
                			</ul>
                		</div>
                	</div>
    			</div>
    		</div>
    	</div>
    </section>		
</div>	
@endsection
@section('scripts')
@endsection