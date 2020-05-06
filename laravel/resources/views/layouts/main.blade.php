<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <title>Dashboard - BEC MIS</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.css"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">

    <!-- Theme style -->
    <link href="{{asset('vendors/adminLTE/css/adminlte.min.css')}}" rel="stylesheet">
    <!-- Data Tables -->
    <link href="{{asset('vendors/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/skins/square/green.css') }}">
    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link href="{{asset('vendors/font-awesome-animation/dist/font-awesome-animation.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="{{asset('css/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.css" />
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
    <div id="app">
        
    </div>
    <div class="preloader-wrapper">
      <div class="preloader">
          <img src="{{ URL::asset('images/preloader.svg')}}">
      </div>
    </div>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
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
                    echo $greetings;  ?>!  <strong class="text-primary">  {{ Auth::user()->name }} </strong> </a> 
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ROUTE('home')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-lg faa-ring animated"></i>
                <span class="badge badge-danger navbar-badge">{{Auth::user()->unreadNotifications->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if(Auth::user()->unreadNotifications->count())
                @foreach(auth()->user()->unreadNotifications()->take(4)->get() as $notification)
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
                <a href="{{Route('employers')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

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
                <a href="{{Route('vacancies')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

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
                @break
                @case('App\Notifications\instituteAdd')
                <a href="{{Route('institutes/view')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/institute.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['institute']['name'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A Training Institute was added.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['institute']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @break
                @case('App\Notifications\courseAdd')
                <a href="{{Route('courses/view')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/institute.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['course']['name'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A course was added.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['course']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @break
                @case('App\Notifications\youthAdd')
                <a href="{{ URL::to('youth/' . $notification->data['youth']['id'] . '/view') }}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/young.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['youth']['name'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">A youth profile was added.</p>
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['youth']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @break
                @case('App\Notifications\applyVacancy')
                <a href="{{Route('youth/applications')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/application.png')}}" alt="User Avatar" class="img-size-50 mr-3">
                    <div class="media-body">
                      <p class="text-sm">Application recived for</p>
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['vacancy']['title'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['vacancy']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @break
                @case('App\Notifications\FollowYouth')
                <a href="{{Route('youth/applications')}}" id="read" class="dropdown-item" data-id="{{ $notification->id }}">

                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ URL::asset('images/Feed-icon.png')}}" alt="User Avatar" class="img-size-50 mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{ $notification->data['employer']['name'] }}
                        <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Selected a youth to hire.</p>
                        
                        <p class="text-sm text-muted"><i class="fas fa-clock"></i> {{ $notification->data['employer']['created_at'] }}</p>
                    </div>
                    </div>
                    <!-- Message End -->
                </a>
                @endswitch
                @endforeach
                <a style="background-color: #D6DBDF" id="all" href="{{ route('unreadNotifications') }}" class="dropdown-item dropdown-footer">ALL Notifications</a>
                <form>

                  {{csrf_field()}}
                <a href="{{ route('markAllAsRead') }}" id="read"  class="dropdown-item dropdown-footer">Mark all as Read</a>
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
            <li>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa-lg fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                </form>
            </li>
            </ul>
        </nav>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href="{{ROUTE('home')}}" class="brand-link">
      <img src="{{ URL::asset('images/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Welcome to BEC MIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
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
          <li class="nav-item">
            <a href="{{Route('tasks')}}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Tasks
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('audits')}}" class="nav-link">
             <i class=" nav-icon fas fa-passport"></i>
              <p>
                Audit Reports
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('log-viewer')}}" class="nav-link" target="_blank">
             <i class="nav-icon fas fa-exclamation-triangle text-warning"></i>
              <p>
                Error Logs
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          @endcan
          
         
          @can('view-M&E-reports')
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Completion Reports
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('add-M&E-reports')
              <li class="nav-item">
                <a href="{{url('/completion-reports')}}" class="nav-link">
                  <i class="fas fa-plus-square nav-icon text-primary"></i>
                  <p class="text-primary">Add Reports</p>
                </a>
              </li>
              @endcan
              @if( Gate::check('management') || Gate::check('me-dashboard') )
              <li class="nav-item">
                <a href="{{url('completion-reports')}}" class="nav-link">
                 <i class="nav-icon fas fa-exclamation-triangle text-warning"></i>
                  <p>
                    Reports Updation 
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
              </li>
              @endif
              @can('admin')
              <li class="nav-item">
                <a href="{{url('/completion_targets')}}" class="nav-link">
                  <i class="fas fa-plus-square nav-icon text-primary"></i>
                  <p class="text-primary">Add Completion Targets</p>
                </a>
              </li>
              @endcan
              @can('view-M&E-reports')
              
              <li class="nav-item">
                <a href="{{url('m&e-reports')}}" class="nav-link">
                 <i class="fas fa-file-contract nav-icon text-warning"></i>
                  <p class="text-warning"> View M & E Reports</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{url('resource-people')}}" class="nav-link">
                 <i class="fas fa-user nav-icon text-success"></i>
                  <p class="text-success">Resourse People Pool</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{url('stake-holders')}}" class="nav-link">
                 <i class="fas fa-user nav-icon text-danger"></i>
                  <p class="text-danger">Stake Holders Pool</p>
                </a>
              </li>
              @endcan
              
            </ul>
          </li>
          @endcan
          @can('view-youth-profile')
          <li class="nav-header">Profile Details</li>
          <li class="nav-item">
            <a href="{{Route('youth/profile-add')}}" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Create Profile
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{Route('youth/profile-view')}}" class="nav-link">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                View Profile
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{Route('youth/profile-edit')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Edit Profile
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
          @can('view-youth-followers')  
              <li class="nav-item">
                <a href="{{Route('youth/followers')}}" class="nav-link">
                    <i class="fas fa-rss-square nav-icon"></i>
                  <p>View Youth Followers</p>
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
          @can('apply-vacancy')
          <li class="nav-header">Employment</li>
          @endcan
          @can('view-vacancies')
          <li class="nav-item">
            <a href="{{Route('vacancies')}}" class="nav-link">
             <i class="nav-icon fas fa-briefcase"></i>
              <p> View Vacancies</p>
            </a>
          </li>
          @endcan
          @can('view-applications')
          <li class="nav-header">Youth</li>
            @can('view-youth')
            <li class="nav-item">
                <a href="{{Route('youth/add')}}" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add Youth</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{Route('youth/view')}}" class="nav-link">
                  <i class="fas fa-child nav-icon"></i>
                  <p>View Youths</p>
                </a>
            </li>
            @endcan
            @can('search-youth')
            <li class="nav-item">
                <a href="{{Route('youth/view')}}" class="nav-link">
                  <i class="fas fa-child nav-icon"></i>
                  <p>Search Youths</p>
                </a>
            </li>
            @endcan
          @endcan
          @can('view-applications')
            <li class="nav-item">
                <a href="{{Route('youth/applications')}}" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Job Applications</p>
                </a>
            </li>
          @endcan
          @cannot('youth')
          @can('view-institute')
          <li class="nav-header">Skill Developments</li>
          <li class="nav-item">
                <a href="{{Route('institutes/view')}}" class="nav-link">
                  <i class="fas fa-school nav-icon"></i>
                  <p>Institutes</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{Route('courses/view')}}" class="nav-link">
                  <i class="fas fa-graduation-cap nav-icon"></i>
                  <p>Courses</p>
                </a>
            </li>
          @endcan 
          @endcan
          @can('view-reports')
          <li class="nav-header">Progress Analysis Reports</li>

            <li class="nav-item">
                <a href="{{Route('analysis-job')}}" class="nav-link active">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Placement Analysis</p>
                </a>
            </li>
          
          @endcan
          @can('view-reports')
          <li class="nav-header">Base Line Reports</li>

            <li class="nav-item">
                <a href="{{Route('reports/index')}}" class="nav-link active">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>View Reports</p>
                </a>
            </li>
          
          @endcan
           @if( Gate::check('me-dashboard') || Gate::check('admin') ) ) 
            <li class="nav-item">
                <a href="{{url('baselines')}}" class="nav-link active">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Base Line Entering </p>
                </a>
            </li>
            @endif 
          @can('youth-search-menu')
          <li class="nav-header">Skill Developments</li>
          <li class="nav-item">
                <a href="{{Route('reports/institutes')}}" class="nav-link">
                  <i class="fas fa-school nav-icon"></i>
                  <p>Search Training Institutes</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{URL::to('reports/training_courses')}}" class="nav-link">
                  <i class="fas fa-graduation-cap nav-icon"></i>
                  <p>Search Courses</p>
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
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jquery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('vendors/iCheck/icheck.js') }}"></script>
    <!-- Bootstrap 4 --> 
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap-validate.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    
    <!-- AdminLTE App -->
    <script src="{{ asset('vendors/adminLTE/js/adminlte.js') }}"></script>
    
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
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <script src="{{ asset('vendors/adminLTE/js/dashboard2.js') }}"></script>
   <!-- PAGE SCRIPTS <script type="text/javascript"   src="{{ asset('js/popover.js') }}"></script> -->
    <script type="text/javascript"  src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
      
      $(document).ready(function() {
        
        $('#example1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],

        
        } );
      } );


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
  <script type="text/javascript">

        window.onload = function () {
      $('.preloader-wrapper').fadeOut(500, function(){ $('.preloader-wrapper').hide(); } );
    }

</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-50704959-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-50704959-3');
</script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
   var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
      cluster: '{{env("PUSHER_APP_CLUSTER")}}',
      encrypted: true
    });
    var channel = pusher.subscribe('user-channel');
    channel.bind('App\\Events\\userLogin', function(data) {
        toastr.error(data.name, data.message, {closeButton: true, timeOut: 5000000});
      //alert(data.message);
    });


  </script>
  <script>
  var userId = $('meta[name="userId"]').attr('content');
    Echo.private('App.User.' + userId)
    .notification((notification) => {
        console.log(notification.title);
        toastr.warning(notification.title, notification.title, {closeButton: true, timeOut: 5000000});
    });

  </script>
@yield('scripts')

</body>
</html>
