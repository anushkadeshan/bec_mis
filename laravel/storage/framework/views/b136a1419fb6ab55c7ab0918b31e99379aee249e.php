<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="userId" content="<?php echo e(Auth::check() ? Auth::user()->id : ''); ?>">
    <title><?php echo $__env->yieldContent('title'); ?>  BEC MIS</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap -->
    <link href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.css"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-select.min.css')); ?>" rel="stylesheet">

    <!-- Theme style -->
    <link href="<?php echo e(asset('vendors/adminLTE/css/adminlte.min.css')); ?>" rel="stylesheet">
    <!-- Data Tables -->
    <link href="<?php echo e(asset('vendors/datatables/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="<?php echo e(asset('vendors/iCheck/skins/all.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendors/iCheck/skins/square/green.css')); ?>">
    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link href="<?php echo e(asset('vendors/font-awesome-animation/dist/font-awesome-animation.min.css')); ?>" rel="stylesheet">

    <style>
      /*----------------------- Preloader -----------------------*/
      body.preloader-site {
          overflow: hidden;
      }

      .preloader-wrapper {
          height: 100%;
          width: 100%;
          background: #FFF;
          position: fixed;
          top: 0;
          left: 0;
          z-index: 9999999;
      }

      .preloader-wrapper .preloader {
          position: absolute;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
          width: 120px;



      }

        th { font-size: 15px; }
        td { font-size: 14px; }

    </style>
    </head>
    <body class="hold-transition sidebar-mini">
    <div class="preloader-wrapper">
      <div class="preloader">
          <img src="<?php echo e(URL::asset('images/preloader.svg')); ?>">
      </div>
    </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <?php $hour = date('H');
                if ($hour >= 20) {
                    $greetings = "Good Night";
                } elseif ($hour > 17) {
                    $greetings = "Good Evening";
                } elseif ($hour > 11) {
                    $greetings = "Good Afternoon";
                } elseif ($hour < 12) {
                  $greetings = "Good Morning";
                }
                    echo $greetings;  ?>!  <strong class="text-primary">  <?php echo e(Auth::user()->name); ?> </strong> </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo e(Route('home')); ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <?php if(Auth::check()): ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-lg faa-ring animated"></i>
                <span class="badge badge-danger navbar-badge"><?php echo e(Auth::user()->unreadNotifications->count()); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php if(Auth::user()->unreadNotifications->count()): ?>
                <?php $__currentLoopData = auth()->user()->unreadNotifications()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php switch($notification->type):
                case ('App\Notifications\notifyAdmin'): ?>
                <a href="#" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/user.png')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['user']['name']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">User registered with us</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['user']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\EmployerAdd'): ?>
                <a href="<?php echo e(Route('employers')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/employer.png')); ?>" alt="User Avatar" class="img-size-50 mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['employer']['name']); ?>

                        <span class="float-right text-sm text-success"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Employer registered with us</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['employer']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\vacancyAdd'): ?>
                <a href="<?php echo e(Route('vacancies')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/job.png')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['vacancy']['title']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A vacancy was added.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['vacancy']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\instituteAdd'): ?>
                <a href="<?php echo e(Route('institutes/view')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/institute.png')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['institute']['institute']['name']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A Training Institute was added.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['institute']['institute']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\courseAdd'): ?>
                <a href="<?php echo e(Route('courses/view')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/institute.png')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['course']['name']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A course was added by <?php echo e($notification->data['course']['added_by']); ?>.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['course']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\youthAdd'): ?>
                <a href="<?php echo e(Route('youth/view')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/young.png')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['youth']['name']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A youth profile was added by <?php echo e($notification->data['youth']['added_by']); ?>.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['youth']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\applyVacancy'): ?>
                <a href="<?php echo e(Route('youth/applications')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/application.png')); ?>" alt="User Avatar" class="img-size-50 mr-3">
                    <div class="media-body">
                      <p class="text-sm">Application recived for</p>
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['vacancy']['title']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>

                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['vacancy']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php break; ?>
                <?php case ('App\Notifications\FollowYouth'): ?>
                <a href="<?php echo e(Route('youth/applications')); ?>" id="read" class="dropdown-item" data-id="<?php echo e($notification->id); ?>">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="<?php echo e(URL::asset('images/Feed-icon.png')); ?>" alt="User Avatar" class="img-size-50 mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        <?php echo e($notification->data['employer']['name']); ?>

                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Selected a youth to hire.</p>

                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> <?php echo e($notification->data['employer']['created_at']); ?></p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                <?php endswitch; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a style="background-color: #D6DBDF" id="all" href="<?php echo e(route('unreadNotifications')); ?>" class="dropdown-item dropdown-footer">ALL Notifications</a>
                <form>

                  <?php echo e(csrf_field()); ?>

                <a href="<?php echo e(route('markAllAsRead')); ?>" id="read"  class="dropdown-item dropdown-footer">Mark all as Read</a>
                </form>
                <?php else: ?>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">No Notifications</a>
                <?php endif; ?>
                </div>
            </li>
            <?php endif; ?>
            <!-- Notifications Dropdown Menu -->


            
            <li>
                <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa-lg fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                </form>
            </li>
            </ul>
        </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- REQUIRED SCRIPTS -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    <!-- jquery -->
    <script src="<?php echo e(asset('vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo e(asset('vendors/iCheck/icheck.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="<?php echo e(asset('vendors/bootstrap/dist/js/bootstrap-validate.js')); ?>"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="<?php echo e(asset('js/bootstrap-select.min.js')); ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/adminlte.js')); ?>"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/demo.js')); ?>"></script>
    <!-- Data Tables -->
    <script src="<?php echo e(asset('vendors/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/datatables/dataTables.bootstrap4.js')); ?>"></script>
    <!-- PAGE PLUGINS -->
    <!-- SparkLine -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/jquery.sparkline.min.js')); ?>"></script>
    <!-- Fastclick -->
    <script src="<?php echo e(asset('vendors/fastclick/fastclick.min.js')); ?>"></script>
    <!-- jVectorMap -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/adminLTE/js/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/jquery.slimscroll.min.js')); ?>"></script>
    <!-- ChartJS 1.0.2 -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/Chart.min.js')); ?>"></script>
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- PAGE SCRIPTS -->
    <script src="<?php echo e(asset('vendors/adminLTE/js/dashboard2.js')); ?>"></script>
    <script type="text/javascript"  src="<?php echo e(asset('js/popover.js')); ?>"></script>
    <script type="text/javascript"  src="<?php echo e(asset('js/bootstrap-confirmation.min.js')); ?>"></script>

    <script>

      $(document).ready(function() {
        $('#example1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],

            fixedHeader: {
            header: true,
            }
        } );
       } );


        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        });
</script>
      <script>
        var SITE_URL = "<?php echo e(URL::to('/')); ?>";
      </script>
      <script type="text/javascript"  src="<?php echo e(asset('js/ajax.js')); ?>"></script>

      <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
      </script>
  <script type="text/javascript">

        window.onload = function () {
      $('.preloader-wrapper').fadeOut(500, function(){ $('.preloader-wrapper').hide(); } );
    }

</script>
<script type="text/javascript"  src="<?php echo e(asset('js/validator.js')); ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-50704959-3"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-50704959-3');
</script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
  $(document).ready(function() {
 $("#youths_table").DataTable({
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
    });
  });
    // push notify
  var userId = $('meta[name="userId"]').attr('content');
    Echo.private('App.User.' + userId)
    .notification((notification) => {
        var today = new Date();
      var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      switch(notification.type) {
        case "broadcast.TaskCreated":
            toastr.info('on or before '+notification.due, notification.title,  {closeButton: true, timeOut: 5000000});
        break;

        case "broadcast.FamilyAdd":
          toastr.info(notification.added_by+' at '+time,'Family Details added by ', {closeButton: true, timeOut: 5000000});
        break;

        case "broadcast.YouthCount":
          toastr.info('added by '+notification.data.added_by+ ' at '+time, notification.data.youth_count+' '+notification.data.type+' Youth/s' , {closeButton: true, timeOut: 5000000});
        break;

        case "broadcast.instituteAdd":
          toastr.success('added by '+notification.data.added_by+' at '+time, 'Institute '+notification.data.institute.name, {closeButton: true, timeOut: 5000000});
        break;

        default:
        toastr.info(notification.youth.name+'at '+time, 'New Baseline Form Added ' , {closeButton: true, timeOut: 5000000});
      }

    });

  </script>
<?php echo $__env->yieldContent('scripts'); ?>
@livewireScripts
</body>
</html>
