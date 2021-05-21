<?php $__env->startSection('title',' Mobile App Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Overview</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-users"></i></span>
                                <p>
                                    <span class="number"><?php echo e($userCount); ?></span>
                                    <span class="title">Total Users</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-motorcycle"></i></span>
                                <p>
                                    <span class="number"><?php echo e($session_count); ?></span>
                                    <span class="title">Total Visits</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-eye"></i></span>
                                <p>
                                    <span class="number">
                                        <?php
                                            $today_count = 0;
                                        ?>
                                        <?php $__currentLoopData = $snapshot_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item['date']==date('Y-m-d')): ?>
                                                <?php
                                                $today_count =  $today_count+1;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($today_count); ?>

                                    </span>
                                    <span class="title">Today Visits</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-calendar"></i></span>
                                <p>
                                    <span class="number">
                                        <?php
                                            $FirstDay = date("Y-m-d", strtotime('sunday last week'));
                                            $LastDay = date("Y-m-d", strtotime('sunday this week'));
                                            $week_count = 0;
                                        ?>
                                        <?php $__currentLoopData = $snapshot_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item['date'] > $FirstDay && $item['date']< $LastDay): ?>
                                                <?php
                                                $week_count =  $week_count+1;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($week_count); ?>

                                    </span>
                                    <span class="title">This Week Visits</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-9">
                            <div id="headline-chart" class="ct-chart"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="weekly-summary text-right">
                                <span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
                                <span class="info-label">Total Sales</span>
                            </div>
                            <div class="weekly-summary text-right">
                                <span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
                                <span class="info-label">Monthly Income</span>
                            </div>
                            <div class="weekly-summary text-right">
                                <span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
                                <span class="info-label">Total Income</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.firebase', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>