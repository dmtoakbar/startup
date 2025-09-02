<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Equa&nbsp;&#9998;&nbsp;Study</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/admin_assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/admin_assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="/admin_assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/admin_assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="/admin_assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="/admin_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="/admin_assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="/admin_assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="/admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet"
        type="text/css" />
    <!-- DATA TABLES -->
    <link href="/admin_assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Summernote css -->
    <link rel="stylesheet" href="/admin_assets/plugins/summernote/summernote.css" />
</head>

<body class="skin-blue">
    <div class="wrapper">
        <?php
        $profile_fill =  DB::table('admindetails')->where('email', Auth::user()->email)->first();
        ?>
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('office-admin') }}" class="logo"><b>Equa <i class="fa fa-pencil"></i> Study</b></a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/admin_assets/dist/img/user2-160x160.jpg"
                                                        class="img-circle" alt="User Image" />
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/admin_assets/dist/img/user3-128x128.jpg"
                                                        class="img-circle" alt="user image" />
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/admin_assets/dist/img/user4-128x128.jpg"
                                                        class="img-circle" alt="user image" />
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/admin_assets/dist/img/user3-128x128.jpg"
                                                        class="img-circle" alt="user image" />
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/admin_assets/dist/img/user4-128x128.jpg"
                                                        class="img-circle" alt="user image" />
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here
                                                that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    @if ($profile_fill->profile_img != null)
                                    <img src="/admin_profile_img/{{$profile_fill->profile_img}}" class="user-image"
                                    alt="User Image" />
                                    @else
                                    <img src="/admin_assets/dist/img/user2-160x160.jpg" class="user-image"
                                    alt="User Image" />
                                    @endif
                                <span class="hidden-xs">{{Auth::user()->name}}</span>
                            </a>
                         
                            <!-- user profile model --->
                            <!-- Modal -->
                            <div class="modal fade" id="userProfileModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="display: flex; justify-content: space-between;">
                                    <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight: bold;">User Profile</h5>
                                    <button type="button" data-dismiss="modal" style="border: none; background-color: transparent; margin-top: -25px; margin-right: -15px;">
                                        <span style="color: black; font-size: 18px;">&#x2715;</span>
                                    </button>
                                    </div>
                                    <form action="{{route('office-admin-fill-profile')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Mobile Number*:</label>
                                            <input type="text" class="form-control" style="border: 1px solid black;" name="mobile_number" value="{{$profile_fill->mobile_number}}" placeholder="Enter mobile number.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alternate Mobile Number:</label>
                                            <input type="text" class="form-control" style="border: 1px solid black;" name="alternate_mobile_number" value="{{$profile_fill->alternate_mobile_number}}" placeholder="Enter alternate mobile number..">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address*:</label>
                                            <textarea name="address" class="form-control" style="border: 1px solid black;" cols="30" rows="5" required placeholder="Enter detail address...">{{$profile_fill->address}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Your Pics*:</label>
                                            <input type="file" class="form-control" style="border: 1px solid black;" name='img' @if ($profile_fill->profile_img == null)
                                                required
                                            @endif>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <!-- end user profile model --->

                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    @if ($profile_fill->profile_img != null)
                                        <img src="/admin_profile_img/{{$profile_fill->profile_img}}" class="img-circle"
                                        alt="User Image" />
                                    @else
                                        <img src="/admin_assets/dist/img/user2-160x160.jpg" class="img-circle"
                                        alt="User Image" />
                                    @endif
                                    <p>
                                          {{Auth::user()->name}}
                                        <small>{{$profile_fill->created_at}}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <a href="#">Department:</a>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="#">{{$profile_fill->department}}</a>
                                    </div>
                                </li>
                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <a href="#">Admin Type:</a>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="#">{{$profile_fill->user_type}}</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat show-profile-model">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{route('office-admin-logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        @if ($profile_fill->profile_img != null)
                        <img src="/admin_profile_img/{{$profile_fill->profile_img}}" class="img-circle" alt="User Image" />
                        @else
                        <img src="/admin_assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{Auth::user()->name}}</p>

                        <a href="#"><i class="fa fa-tag" style="color: white"></i> {{$profile_fill->department}}</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                                    class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="active treeview">
                        <a href="{{ route('office-admin') }}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span>Site Home Page</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('office-site-home-page-content-name') }}"><i class="fa fa-circle-o"></i>Content Name</a>
                            </li>
                            <li><a href="{{ route('office-site-home-page') }}"><i class="fa fa-circle-o"></i>Home Page</a>
                            </li>
                            <li><a href="{{ route('office-site-home-page-carousel') }}"><i class="fa fa-circle-o"></i>Carousel</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Services</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('office-services') }}"><i class="fa fa-circle-o"></i>Service</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Exams</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-pie-chart"></i>
                                    <span>Tests</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('office-tests') }}"><i class="fa fa-circle-o"></i> Test</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-book"></i>
                                    <span>Subjects</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('office-subjects') }}"><i class="fa fa-circle-o"></i>
                                            Subjects</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-copy"></i>
                                    <span>Question Papers</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('office-questionpaper') }}"><i class="fa fa-circle-o"></i>
                                            Question Papers</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span>Course</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Tags</a></li>
                            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Digest</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span>Job</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('office-job-tag')}}"><i class="fa fa-circle-o"></i> Tags</a></li>
                            <li><a href="{{route('office-job-content')}}"><i class="fa fa-circle-o"></i> Job Contents</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span>Daily Digest</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('office-digest-tag')}}"><i class="fa fa-circle-o"></i> Tags</a></li>
                            <li><a href="{{route('office-digest-sub-tag')}}"><i class="fa fa-circle-o"></i>Sub Tags</a></li>
                            <li><a href="{{route('office-digest-content')}}"><i class="fa fa-circle-o"></i> Digest Content</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dollar"></i> <span>Payment Setup</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('office-payment')}}"><i class="fa fa-circle-o text-danger"></i> Payment Setup</a></li>
                        </ul>
                    </li>
                    <li class="header">Users</li>
                    <li><a href="{{route('office-student')}}"><i class="fa fa-users text-warning"></i> Student Users</a></li>
                    <li><a href="{{ route('office-admin-user') }}"><i class="fa fa-user text-info"></i> Admin Users</a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        {{-- body content --}}
        @yield('body-content')
        {{-- end body  content --}}

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All
            rights reserved.
        </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="/admin_assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/admin_assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/admin_assets/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="/admin_assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="/admin_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="/admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="/admin_assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="/admin_assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="/admin_assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/admin_assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="/admin_assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/admin_assets/plugins/fastclick/fastclick.min.js'></script>

    <!--Summernote js-->
    <script src="/admin_assets/plugins/summernote/summernote.min.js"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="/admin_assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/admin_assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="/admin_assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/admin_assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/admin_assets/dist/js/app.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function() {
            $("#example1").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });
    </script>

    <?php
    if(request()->get('delete') != null) {
    ?>
    <script>
        $(document).ready(function() {
            var cat_id  = {{ Js::from(request()->get('delete')) }};
            $('.delete_id').val(cat_id);
            $('#DeleteModal').modal('show');  
        });
    </script>
    <?php
    }
    ?>

    <?php
    if(request()->get('status') != null) {
    ?>
    <script>
        $(document).ready(function() {
            var status_id  = {{ Js::from(request()->get('status')) }};
            $('.status_id').val(status_id);
            $('#StatusModal').modal('show');  
        });
    </script>
    <?php
    }
    ?>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 240,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.question').summernote({
                height: 100,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            $('.option').summernote({
                height: 60,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            $('.description').summernote({
                height: 60,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>
    <?php
    if($profile_fill->mobile_number == null || $profile_fill->profile_img == null || $profile_fill->address == null) {
    ?>  
        <script>
        $(document).ready(function () {
        $('#userProfileModel').modal('show');
        });
    </script>
    <?php
        }
    ?>
    <script>
        $(document).ready(function() {
         $('.show-profile-model').click(function() {
            $('#userProfileModel').modal('show');
         })
        });
    </script>
    @yield('footer-scripts')
</body>

</html>
