<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - BEC MIS</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.css"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Theme style -->
    <link href="{{asset('vendors/adminLTE/css/adminlte.min.css')}}" rel="stylesheet">
    <!-- Data Tables -->
    <link href="{{asset('vendors/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/skins/all.css') }}">
    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    </head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
                </div>
            </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-danger navbar-badge">{{Auth::user()->unreadNotifications->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if(Auth::user()->unreadNotifications->count())
                @foreach(auth()->user()->unreadNotifications as $notification)
                @switch($notification->type)
                @case('App\Notifications\notifyAdmin')
                <a href="#" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/user.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['user']['name'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">User registered with us</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['user']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @break
                @case('App\Notifications\EmployerAdd')
                <a href="{{Route('vacancies')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/employer.png')}}" alt="User Avatar" class="img-size-50 mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['employer']['name'] }}
                        <span class="float-right text-sm text-success"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Employer registered with us</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['employer']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @break
                @case('App\Notifications\vacancyAdd')
                <a href="" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/job.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['vacancy']['title'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A vacancy was added.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['vacancy']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @endswitch
                @endforeach
                <form>
                  {{csrf_field()}}
                <a href="{{ route('markAllAsRead') }}"  class="dropdown-item dropdown-footer">Mark all as Read</a>
                </form>
                @else
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">No Notifications</a>
                @endif
                </div>
            </li>
            @endif
            <!-- Notifications Dropdown Menu -->
           
            
            {{-- Notification finish--}}
            <li></li>
            <li>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                </form>
            </li>
            </ul>
        </nav>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ URL::asset('images/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Welcome to BEC MIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <n av class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('userList',Auth::User())
          <li class="nav-header">System</li>
          <li class="nav-item">
            <a href="{{Route('users')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          @endcan
          
          @can('view-Employer')
          <li class="nav-header">Employment</li>
          @endcan
          @can('view-Employer')  
              <li class="nav-item">
                <a href="{{Route('employers')}}" class="nav-link">
                  <i class="fas fa-building nav-icon"></i>
                  <p>View Employers</p>
                </a>
              </li>
      
          @endcan
          @can('view-Employer-Profile')
          <li class="nav-item">
            <a href="{{Route('e-profile')}}" class="nav-link">
              <i class="fas fa-user-alt nav-icon"></i>
              <p> Employer Profile</p>
            </a>
          </li>
          @endcan
          @can('view-vacancies')
          <li class="nav-item">
            <a href="{{Route('vacancies')}}" class="nav-link">
             <i class="nav-icon fas fa-briefcase"></i>
              <p> All vacancies</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{Route('new-vacancy')}}" class="nav-link">
             <i class="nav-icon fas fa-plus"></i>
              <p> Add New vacancy</p>
            </a>
          </li>
          @endcan
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    @yield('content')    
  </div>
</div>
    <!-- REQUIRED SCRIPTS -->
    <!-- jquery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap-validate.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    
    
    <!-- AdminLTE App -->
    <script src="{{ asset('vendors/adminLTE/js/adminlte.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('vendors/adminLTE/js/demo.js') }}"></script>
    <!-- Data Tables -->
    <script src="{{ asset('vendors/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- PAGE PLUGINS -->
    <!-- SparkLine -->
    <script src="{{ asset('vendors/adminLTE/js/jquery.sparkline.min.js') }}"></script>
    <!-- Fastclick -->
    <script src="{{ asset('vendors/fastclick/fastclick.min.js') }}"></script>
    <!-- jVectorMap -->
    <script src="{{ asset('vendors/adminLTE/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('vendors/adminLTE/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('vendors/adminLTE/js/jquery.slimscroll.min.js') }}"></script>
    <!-- ChartJS 1.0.2 -->
    <script src="{{ asset('vendors/adminLTE/js/Chart.min.js') }}"></script>
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- PAGE SCRIPTS -->
    <script src="{{ asset('vendors/adminLTE/js/dashboard2.js') }}"></script>
    <script>
      $(document).ready(function (){
         var table = $('#example1').DataTable({
           "scrollX": true,
         });
      });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        });
      </script>
      <script>
        var SITE_URL = "{{URL::to('/')}}";
      </script>
      <script type="text/javascript"  src="{{ asset('js/ajax.js') }}"></script>
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
    
      <script type="text/javascript"  src="{{ asset('js/validator.js') }}"></script>
@yield('scripts')
</body>
</html>