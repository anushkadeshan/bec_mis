
<?php $__env->startSection('title','Job Linking |'); ?>
<?php $__env->startSection('content'); ?>
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
              <li class="breadcrumb-item"><a href="<?php echo e(Route('home')); ?>">Dashboard</a></li>
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
                			<h3 class="card-title">Output 4.2</h3>
                		</div>
                		<div class="card-body">
                			<ul	class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                				
                				<li class="nav-item">
            						<a href="<?php echo e(URL::to('activities/job-linking/assesment')); ?>" class="nav-link">
	              						<p>
	              							Work place assessment 
	                						<i class="fa fa-angle-right right"></i>
	              						</p>
            						</a>
          						</li>
                      <li class="nav-item">
                        <a href="<?php echo e(URL::to('activities/job-linking/awareness')); ?>" class="nav-link">
                            <p>
                              Awareness on work place conditions
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(URL::to('activities/job-linking/placements')); ?>" class="nav-link">
                            <p>
                              Job Placements  
                              <i class="fa fa-angle-right right"></i>
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(URL::to('activities/job-linking/individual')); ?>" class="nav-link">
                            <p>
                              Individual Placement  
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>