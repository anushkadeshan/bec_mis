@extends('layouts.reports')
@section('content')
<div class="container-fluid">
	<br>
	<div class="row">
		<div class="col-md-3">
			<div class="card card-success card-outline">
      			<div class="card-header">
        			<h3 class="card-title">Education</h3>
        		</div>
        		<div class="card-body">
        			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        				<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 1.1</strong>
	        						
	      						</p>
							</a>
						</li>
	    				<li class="nav-item">
							<a href="{{Route('reports-me/education/regional-meeting')}}" class="nav-link">
	      						<p>
	      							Attending BMIC regional meeting
	        						<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 1.2</strong>
	      						</p>
							</a>
						</li>
			            <li class="nav-item">
			                <a href="{{Route('reports-me/education/mentoring')}}" class="nav-link">
			                    <p>
			                      Mentoring program 
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
						
        			</ul>
        		</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="card card-success card-outline">
      			<div class="card-header">
        			<h3 class="card-title">Career Guidance</h3>
        		</div>
        		<div class="card-body">
        			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        				<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 2.1</strong>
	        						
	      						</p>
							</a>
						</li>
	    				<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Stakeholder meetings 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Kick of events 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					ToT on Career guidance
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					CG & Career fair workshop 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 2.2</strong>
	        						
	      						</p>
							</a>
						</li>
			            <li class="nav-item">
			                <a href="{{Route('reports/location')}}" class="nav-link">
			                    <p>
			                      Gap identification of PES unit
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
						<li class="nav-item">
			                <a href="{{Route('reports/location')}}" class="nav-link">
			                    <p>
			                       Material support for PES units
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="{{Route('reports/location')}}" class="nav-link">
			                    <p>
			                      Training on Career counselling <br>	 for GND level officers 
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>

        			</ul>
        		</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="card card-success card-outline">
      			<div class="card-header">
        			<h3 class="card-title">Skills Development</h3>
        		</div>
        		<div class="card-body">
        			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        				<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 3.1</strong>
	        						
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Support for course enrollment & <br> Directing to follow VT/Professional <br> courses at govt. institutions 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Soft Skill training 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Financial assistance to follow <br>	 VT/Professional courses
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Partnership Training
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
        				<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 3.3</strong>
	        						
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Review of institutions 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Incorporation of soft skill <br>component 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Meetings between TVEC & Institutes
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>

        			</ul>
        		</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="card card-success card-outline">
      			<div class="card-header">
        			<h3 class="card-title">Job Linking and Placement</h3>
        		</div>
        		<div class="card-body">
        			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        				<li class="nav-item">
							<a href="" class="nav-link">
	      						<p>
	      							<strong>Output 4.2</strong>
	        						
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Work place assessment 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Awareness on work place <br>	conditions
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports/personal')}}" class="nav-link">
	      						<p>
	              					Job Interviews
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
@endsection
@section('reports')
@endsection