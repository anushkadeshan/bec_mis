@extends('layouts.reports')
@section('title','View Completion Reports |')
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
	      							Attending BMIC regional meeting  @if(Auth::user()->branch== null) <?php $regional = DB::table('regional_meetings')->count(); ?> @else <?php $regional = DB::table('regional_meetings')->where('branch_id',Auth::user()->branch)->count(); ?> @endif    <small class="badge badge-success">{{$regional}}  </small>
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
			                      Mentoring program @if(Auth::user()->branch== null) <?php  $mentoring = DB::table('mentoring')->count(); ?> @else <?php  $mentoring = DB::table('mentoring')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$mentoring}}  </small>
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
							<a href="{{url('/reports-me/cg/stake-holder-meeting')}}" class="nav-link">
	      						<p>
	              					Stakeholder meetings @if(Auth::user()->branch== null) <?php $stake_holder_meetings = DB::table('stake_holder_meetings')->count(); ?> @else <?php $stake_holder_meetings = DB::table('stake_holder_meetings')->where('branch_id',Auth::user()->branch)->count(); ?> @endif   <small class="badge badge-success">{{$stake_holder_meetings}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports-me/cg/kick-off-meeting')}}" class="nav-link">
	      						<p>
	              					Kick of events @if(Auth::user()->branch== null) <?php $kickoffs = DB::table('kickoffs')->count(); $households = DB::table('households')->count();?> @else <?php $kickoffs = DB::table('kickoffs')->where('branch_id',Auth::user()->branch)->count(); $households = DB::table('households')->where('branch_id',Auth::user()->branch)->count();?> @endif   <small class="badge badge-success">{{$kickoffs +$households}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('/reports-me/cg/tot')}}" class="nav-link">
	      						<p>
	              					ToT on Career guidance @if(Auth::user()->branch== null) <?php $tot_cg = DB::table('tot_cg')->count(); ?> @else <?php $tot_cg = DB::table('tot_cg')->where('branch_id',Auth::user()->branch)->count(); ?> @endif   <small class="badge badge-success">{{$tot_cg}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('/reports-me/cg/cg')}}" class="nav-link">
	      						<p>
	              					CG & Career fair workshop @if(Auth::user()->branch== null) <?php $career_guidances = DB::table('career_guidances')->count(); ?> @else <?php $career_guidances = DB::table('career_guidances')->where('branch_id',Auth::user()->branch)->count(); ?> @endif <small class="badge badge-success">{{$career_guidances}}</small>
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
			                <a href="{{url('/reports-me/cg/pes')}}" class="nav-link">
			                    <p>
			                      Gap identification of PES unit @if(Auth::user()->branch== null) <?php $pes_units = DB::table('pes_units')->count(); ?> @else <?php $pes_units = DB::table('pes_units')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$pes_units}}  </small>
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
						<li class="nav-item">
			                <a href="{{url('/reports-me/cg/pes-support')}}" class="nav-link">
			                    <p>
			                       Material support for PES units @if(Auth::user()->branch== null) <?php $pes_unit_supports = DB::table('pes_unit_supports')->count(); ?>  @else <?php $pes_unit_supports = DB::table('pes_unit_supports')->where('branch_id',Auth::user()->branch)->count(); ?> @endif <small class="badge badge-success">{{$pes_unit_supports}}  </small>
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="{{url('/reports-me/cg/cg-training')}}" class="nav-link">
			                    <p>
			                      Training on Career counselling <br>	 for GND level officers @if(Auth::user()->branch== null) <?php $cg_trainings = DB::table('cg_trainings')->count(); ?> @else <?php $cg_trainings = DB::table('cg_trainings')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$cg_trainings}}  </small>
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
							<a href="{{Route('reports-me/skill/gvt-support')}}" class="nav-link">
	      						<p>
	              					Support for course enrollment & <br> Directing to follow VT/Professional <br> courses at govt. institutions @if(Auth::user()->branch== null) <?php $course_supports = DB::table('course_supports')->count(); ?> @else <?php $course_supports = DB::table('course_supports')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$course_supports}}  </small> 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('reports-me/skill/soft-skill')}}" class="nav-link">
	      						<p>
	              					Soft Skill training @if(Auth::user()->branch== null) <?php $provide_soft_skills = DB::table('provide_soft_skills')->count(); ?> @else <?php $provide_soft_skills = DB::table('provide_soft_skills')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$provide_soft_skills}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('reports-me/skill/financial')}}" class="nav-link">
	      						<p>
	              					Financial assistance to follow <br>	 VT/Professional courses @if(Auth::user()->branch== null)<?php $finacial_supports = DB::table('finacial_supports')->count(); ?> @else <?php $finacial_supports = DB::table('finacial_supports')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$finacial_supports}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('reports-me/skill/partnership')}}" class="nav-link">
	      						<p>
	              					Partnership Training @if(Auth::user()->branch== null) <?php $partner_trainings = DB::table('partner_trainings')->count(); ?> @else <?php $partner_trainings = DB::table('partner_trainings')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$partner_trainings}}  </small>
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
							<a href="{{Route('reports-me/skill/institute-review')}}" class="nav-link">
	      						<p>
	              					Review of institutions @if(Auth::user()->branch== null) <?php $institute_reviews = DB::table('institute_reviews')->count(); ?> @else <?php $institute_reviews = DB::table('institute_reviews')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$institute_reviews}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports-me/skill/incoperate-soft-skills')}}" class="nav-link">
	      						<p>
	              					Incorporation of soft skill <br>component @if(Auth::user()->branch== null) <?php $incoperation_soft_skills = DB::table('incoperation_soft_skills')->count(); ?> @else <?php $incoperation_soft_skills = DB::table('incoperation_soft_skills')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$incoperation_soft_skills}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports-me/skill/tvec-meeting')}}" class="nav-link">
	      						<p>
	              					Meetings between TVEC &<br>	 Institutes @if(Auth::user()->branch== null) <?php $tvec_meetings = DB::table('tvec_meetings')->count(); ?> @else <?php $tvec_meetings = DB::table('tvec_meetings')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$tvec_meetings}}  </small>
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
							<a href="{{url('reports-me/job/assesment')}}" class="nav-link">
	      						<p>
	              					Work place assessment @if(Auth::user()->branch== null) <?php $assesments = DB::table('assesments')->count(); ?> @else <?php $assesments = DB::table('assesments')->where('branch_id',Auth::user()->branch)->count(); ?> @endif   <small class="badge badge-success">{{$assesments}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('reports-me/job/awareness')}}" class="nav-link">
	      						<p>
	              					Awareness on work place <br>	conditions @if(Auth::user()->branch== null) <?php $awareness = DB::table('awareness')->count(); ?> @else <?php $awareness = DB::table('awareness')->where('branch_id',Auth::user()->branch)->count(); ?> @endif  <small class="badge badge-success">{{$awareness}}  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{Route('reports-me/job/placements')}}" class="nav-link">
	      						<p>
	              					Job Interviews @if(Auth::user()->branch== null) <?php $placements = DB::table('placements')->count(); $placement_individual = DB::table('placement_individual')->count(); ?>  @else <?php $placements = DB::table('placements')->count(); $placement_individual = DB::table('placement_individual')->where('branch_id',Auth::user()->branch)->count(); ?> @endif <small class="badge badge-success">{{$placements+$placement_individual}}  </small>
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