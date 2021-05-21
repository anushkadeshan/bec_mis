<!doctype html>
<html lang="en">

<head>
    <title>Dashboard | Mobile App</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/linearicons/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/chartist/css/chartist-custom.css')); ?>">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/demo.css')); ?>">
      <link href="<?php echo e(asset('vendors/datatables/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="<?php echo e(asset('vendors/iCheck/skins/all.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendors/iCheck/skins/square/green.css')); ?>">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="">BDS Field App - Dashboard</a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span><?php echo e(Auth::user()->name); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="#"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                        <!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="<?php echo e(url('firebase')); ?>" ><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="<?php echo e(url('firebase-users')); ?>"  ><i class="lnr lnr-users"></i> <span>Users</span></a></li>
                        <li><a href="<?php echo e(url('firebase-staff')); ?>" ><i class="lnr lnr-smile"></i> <span>Staff</span></a></li>
                        <li><a href="<?php echo e(url('firebase-sessions')); ?>" class=""><i class="lnr lnr-chart-bars"></i> <span>Sessions</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="<?php echo e(asset('assets/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo e(asset('vendors/iCheck/icheck.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/chartist/js/chartist.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/scripts/klorofil-common.js')); ?>"></script>
        <!-- Data Tables -->
    <script src="<?php echo e(asset('vendors/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/datatables/dataTables.bootstrap4.js')); ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],

            fixedHeader: {
            header: true,
            },
        });
    });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
