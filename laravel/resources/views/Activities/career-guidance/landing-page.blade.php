@extends('layouts.main')
@section('title','Career Guidance |')
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
    			<div class="col-md-6">
                    <div class="card card-success card-outline">
              			<div class="card-header">
                			<h3 class="card-title">Output 2.1</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				
                				<li class="nav-item">
            						<a href="{{Route('activities/career-guidance/stake-holder-meeting')}}" class="nav-link">
	              						<p>
	              							Stakeholder meetings 
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
                      <li class="nav-item">
                        <a href="{{Route('activities/career-guidance/kick-off')}}" class="nav-link">
                            <p>
                              Kick of events  
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{Route('activities/career-guidance/households')}}" class="nav-link">
                            <p>
                              House Hold Surveys  
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{Route('activities/career-guidance/tot-cg')}}" class="nav-link">
                            <p>
                              ToT on Career guidance 
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{Route('activities/cg/view')}}" class="nav-link">
                            <p>
                              Career Guidance & Career fair workshop
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
                			<h3 class="card-title">Output 2.2</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				<li class="nav-item">
                        <a href="{{Route('activities/career-guidance/pes')}}" class="nav-link">
                            <p>
                              Gap identification of PES unit
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                        </li>
          						  <li class="nav-item">
                        <a href="{{Route('activities/career-guidance/pes-support')}}" class="nav-link">
                            <p>
                              Material support for PES units
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{Route('activities/career-guidance/cg-training')}}" class="nav-link">
                            <p>
                              Training on Career counselling for GND level officers 
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