
<?php $__env->startSection('title','View Completion Reports |'); ?>
<?php $__env->startSection('content'); ?>
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
							<a href="<?php echo e(Route('reports-me/education/regional-meeting')); ?>" class="nav-link">
	      						<p>
	      							Attending BMIC regional meeting  <?php if(Auth::user()->branch== null): ?> <?php $regional = DB::table('regional_meetings')->count(); ?> <?php else: ?> <?php $regional = DB::table('regional_meetings')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>    <small class="badge badge-success"><?php echo e($regional); ?>  </small>
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
			                <a href="<?php echo e(Route('reports-me/education/mentoring')); ?>" class="nav-link">
			                    <p>
			                      Mentoring program <?php if(Auth::user()->branch== null): ?> <?php  $mentoring = DB::table('mentoring')->count(); ?> <?php else: ?> <?php  $mentoring = DB::table('mentoring')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($mentoring); ?>  </small>
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
							<a href="<?php echo e(url('/reports-me/cg/stake-holder-meeting')); ?>" class="nav-link">
	      						<p>
	              					Stakeholder meetings <?php if(Auth::user()->branch== null): ?> <?php $stake_holder_meetings = DB::table('stake_holder_meetings')->count(); ?> <?php else: ?> <?php $stake_holder_meetings = DB::table('stake_holder_meetings')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>   <small class="badge badge-success"><?php echo e($stake_holder_meetings); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(Route('reports-me/cg/kick-off-meeting')); ?>" class="nav-link">
	      						<p>
	              					Kick of events <?php if(Auth::user()->branch== null): ?> <?php $kickoffs = DB::table('kickoffs')->count(); $households = DB::table('households')->count();?> <?php else: ?> <?php $kickoffs = DB::table('kickoffs')->where('branch_id',Auth::user()->branch)->count(); $households = DB::table('households')->where('branch_id',Auth::user()->branch)->count();?> <?php endif; ?>   <small class="badge badge-success"><?php echo e($kickoffs +$households); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(url('/reports-me/cg/tot')); ?>" class="nav-link">
	      						<p>
	              					ToT on Career guidance <?php if(Auth::user()->branch== null): ?> <?php $tot_cg = DB::table('tot_cg')->count(); ?> <?php else: ?> <?php $tot_cg = DB::table('tot_cg')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>   <small class="badge badge-success"><?php echo e($tot_cg); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(url('/reports-me/cg/cg')); ?>" class="nav-link">
	      						<p>
	              					CG & Career fair workshop <?php if(Auth::user()->branch== null): ?> <?php $career_guidances = DB::table('career_guidances')->count(); ?> <?php else: ?> <?php $career_guidances = DB::table('career_guidances')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?> <small class="badge badge-success"><?php echo e($career_guidances); ?></small>
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
			                <a href="<?php echo e(url('/reports-me/cg/pes')); ?>" class="nav-link">
			                    <p>
			                      Gap identification of PES unit <?php if(Auth::user()->branch== null): ?> <?php $pes_units = DB::table('pes_units')->count(); ?> <?php else: ?> <?php $pes_units = DB::table('pes_units')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($pes_units); ?>  </small>
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
						<li class="nav-item">
			                <a href="<?php echo e(url('/reports-me/cg/pes-support')); ?>" class="nav-link">
			                    <p>
			                       Material support for PES units <?php if(Auth::user()->branch== null): ?> <?php $pes_unit_supports = DB::table('pes_unit_supports')->count(); ?>  <?php else: ?> <?php $pes_unit_supports = DB::table('pes_unit_supports')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?> <small class="badge badge-success"><?php echo e($pes_unit_supports); ?>  </small>
			                      <i class="fa fa-angle-right right"></i>
			                    </p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="<?php echo e(url('/reports-me/cg/cg-training')); ?>" class="nav-link">
			                    <p>
			                      Training on Career counselling <br>	 for GND level officers <?php if(Auth::user()->branch== null): ?> <?php $cg_trainings = DB::table('cg_trainings')->count(); ?> <?php else: ?> <?php $cg_trainings = DB::table('cg_trainings')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($cg_trainings); ?>  </small>
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
							<a href="<?php echo e(Route('reports-me/skill/gvt-support')); ?>" class="nav-link">
	      						<p>
	              					Support for course enrollment & <br> Directing to follow VT/Professional <br> courses at govt. institutions <?php if(Auth::user()->branch== null): ?> <?php $course_supports = DB::table('course_supports')->count(); ?> <?php else: ?> <?php $course_supports = DB::table('course_supports')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($course_supports); ?>  </small> 
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(url('reports-me/skill/soft-skill')); ?>" class="nav-link">
	      						<p>
	              					Soft Skill training <?php if(Auth::user()->branch== null): ?> <?php $provide_soft_skills = DB::table('provide_soft_skills')->count(); ?> <?php else: ?> <?php $provide_soft_skills = DB::table('provide_soft_skills')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($provide_soft_skills); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(url('reports-me/skill/financial')); ?>" class="nav-link">
	      						<p>
	              					Financial assistance to follow <br>	 VT/Professional courses <?php if(Auth::user()->branch== null): ?><?php $finacial_supports = DB::table('finacial_supports')->count(); ?> <?php else: ?> <?php $finacial_supports = DB::table('finacial_supports')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($finacial_supports); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(url('reports-me/skill/partnership')); ?>" class="nav-link">
	      						<p>
	              					Partnership Training <?php if(Auth::user()->branch== null): ?> <?php $partner_trainings = DB::table('partner_trainings')->count(); ?> <?php else: ?> <?php $partner_trainings = DB::table('partner_trainings')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($partner_trainings); ?>  </small>
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
							<a href="<?php echo e(Route('reports-me/skill/institute-review')); ?>" class="nav-link">
	      						<p>
	              					Review of institutions <?php if(Auth::user()->branch== null): ?> <?php $institute_reviews = DB::table('institute_reviews')->count(); ?> <?php else: ?> <?php $institute_reviews = DB::table('institute_reviews')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($institute_reviews); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(Route('reports-me/skill/incoperate-soft-skills')); ?>" class="nav-link">
	      						<p>
	              					Incorporation of soft skill <br>component <?php if(Auth::user()->branch== null): ?> <?php $incoperation_soft_skills = DB::table('incoperation_soft_skills')->count(); ?> <?php else: ?> <?php $incoperation_soft_skills = DB::table('incoperation_soft_skills')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($incoperation_soft_skills); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(Route('reports-me/skill/tvec-meeting')); ?>" class="nav-link">
	      						<p>
	              					Meetings between TVEC &<br>	 Institutes <?php if(Auth::user()->branch== null): ?> <?php $tvec_meetings = DB::table('tvec_meetings')->count(); ?> <?php else: ?> <?php $tvec_meetings = DB::table('tvec_meetings')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($tvec_meetings); ?>  </small>
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
							<a href="<?php echo e(url('reports-me/job/assesment')); ?>" class="nav-link">
	      						<p>
	              					Work place assessment <?php if(Auth::user()->branch== null): ?> <?php $assesments = DB::table('assesments')->count(); ?> <?php else: ?> <?php $assesments = DB::table('assesments')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>   <small class="badge badge-success"><?php echo e($assesments); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(url('reports-me/job/awareness')); ?>" class="nav-link">
	      						<p>
	              					Awareness on work place <br>	conditions <?php if(Auth::user()->branch== null): ?> <?php $awareness = DB::table('awareness')->count(); ?> <?php else: ?> <?php $awareness = DB::table('awareness')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?>  <small class="badge badge-success"><?php echo e($awareness); ?>  </small>
	      							<i class="fa fa-angle-right right"></i>
	      						</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo e(Route('reports-me/job/placements')); ?>" class="nav-link">
	      						<p>
	              					Job Interviews <?php if(Auth::user()->branch== null): ?> <?php $placements = DB::table('placements')->count(); $placement_individual = DB::table('placement_individual')->count(); ?>  <?php else: ?> <?php $placements = DB::table('placements')->count(); $placement_individual = DB::table('placement_individual')->where('branch_id',Auth::user()->branch)->count(); ?> <?php endif; ?> <small class="badge badge-success"><?php echo e($placements+$placement_individual); ?>  </small>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('reports'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.reports', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>