@extends('layouts.main')
@section('content')
<div class="container"	>
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
    			<div class="col-md-6">
                    <div class="card card-success card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Output 3.1</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				
                				<li class="nav-item">
            						<a href="{{Route('reports/personal')}}" class="nav-link">
	              						<p>
	              							Support for course enrollment 
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
                              Financial assistance to follow VT/Professional courses  
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{Route('reports/personal')}}" class="nav-link">
                            <p>
                              Directing to follow VT/Professional courses at govt. institutions
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
                			</ul>
                		</div>
                	</div>
              </div>
    			<div class="col-md-6">
    				<div class="card card-warning card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Output 3.3</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                              Incorporation of soft skill component
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

    		</div>
    	</div>
    </section>		
</div>	
@endsection
@section('scripts')
@endsection