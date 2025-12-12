<!DOCTYPE html>
<html lang="en">

<head>

    <meta htztp-equiv="Content-Type" content="text/html; charset=utf-8">

    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- App favicon -->

    <link href="{{url('/admin-design')}}/assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('/admin-design')}}/assets/images/favicon.ico">
    <!-- jvectormap -->
    <!-- <link href="{{url('/admin-design')}}/assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet"> -->
    <!-- DataTables -->
    <link href="{{url('/admin-design')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/admin-design')}}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!--    <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet">
-->
    <!-- Icons css -->
    <link href="{{url('/admin-design')}}/assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/admin-design')}}/assets/libs/dripicons/webfont/webfont.css" rel="stylesheet" type="text/css">
    <!--
        <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet">
    -->
    <link href="{{url('/admin-design')}}/assets/libs/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <!-- App css -->

    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>


    <link rel="stylesheet" href="{{url('/admin-design')}}/assets/css/tagsinput.css">
    <link rel="stylesheet" href="{{url('/admin-design')}}/assets/css/app.min.css">
    <link rel="stylesheet" href="{{url('/admin-design')}}/assets/css/dropify.css">
    <link rel="stylesheet" href="{{url('/admin-design')}}/assets/css/style.css?{{strtotime(date('Y-m-d h:i:sa'))}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />


    <style>
        * {
            font-family: 'Cairo', sans-serif;
            color: black;
        }

        .btn i {
            color: white !important;
        }

        .nav-user span {
            color: white;
        }

        .nav-user i {
            color: white;
        }

        .new-notification {
            /* border: 1px solid red;
            border-radius: 50%; */
            padding: 2px 10px;
            margin-right: 20px;
            color: red
        }
    </style>

</head>

<body>



    <input class="ajax-refresh" type="hidden" value="{{url('/')}}/admin/count/refresh">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Navigation Bar-->
        <header id="topnav">
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-right-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            @if(!empty(auth()->guard('admin')->user()->image))
                            <img src="{{url('/')}}/website/public/images/{{auth()->guard('admin')->user()->image}}" alt="user" class="rounded-circle">
                            @endif
                            <span class="mr-1">{{auth()->guard("admin")->user()->username}}
                                <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h6 class="text-overflow m-0">مرحبا !</h6>
                            </div>
                            <!-- item--><a href="{{url('/')}}/admin/profile" class="dropdown-item notify-item"> <i class="dripicons-checklist"></i><span>تعديل بياناتي</span> </a>

                            <!-- item--><a href="{{url('/')}}/admin/logout" class="dropdown-item notify-item"> <i class="dripicons-power"></i><span>تسجيل الخروج</span></a>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled menu-left mb-0">
                    <li class="float-left">
                        <a href="{{url('/')}}/admin" class="logo">
                            <span class="logo-lg">
                                <img src="{{url('/website/public/images/' . $config->image)}}" alt="" height="50">
                            </span>
                            <span class="logo-sm">
                                <img src="{{url('/website/public/images/' . $config->image)}}" alt="" height="28">
                            </span>
                        </a>
                    </li>
                    <li class="float-left">
                        <a class="button-menu-mobile open-left navbar-toggle">
                            <div class="lines">
                                <span></span> <span></span> <span></span>
                            </div>
                        </a>
                    </li>

                </ul>
            </nav><!-- end navbar-custom -->
        </header>

        <!-- End Navigation Bar-->

        <!-- ========== Left Sidebar Start ========== -->

        <div class="left-side-menu">
            <div class="slimscroll-menu">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">
                        <li>
                            <a href="{{url('/admin')}}">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span>
                                    الرئيسية
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);"><i class="mdi mdi-atom"></i> <span>المستخدمون</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{url('/admin/users')}}">عرض المستخدمون</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="{{url('/admin/sliders')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    السلايدر
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/nationalities')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    الجنسيات
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/cities')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    المحافظات
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/regions')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    المناطق
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/posts')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    الأخبار
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/gallery')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    الأنشطة
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/events')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    الفعاليات
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/subscriptionsnames')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    فئات المسابقة
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/subscriptions')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    المسجلون
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/locations')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    مقرات المسابقة
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="{{url('/admin/contact')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    تواصل معنا
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/admin/config')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    اللإعدادات
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/')}}">
                                <i class="mdi mdi-atom"></i>
                                <span>
                                    العودة للموقع
                                </span>
                            </a>
                        </li>


                    </ul>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>
            </div><!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->


        @yield('content')



        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">Line Soft &copy; {{date("Y")}}</div>
                </div>
            </div>
        </footer><!-- End Footer -->
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">الملف الشخصي</h5>
            </div>
            <div class="slimscroll-menu">
                <!-- User box -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                        <a href="" class="user-edit"><i class="mdi mdi-pencil"></i></a>
                    </div>
                    <h5><a href=""></a></h5>
                    <br>
                    <br>
                    <a href="">تسجيل خروج</a>

                </div>
            </div><!-- end slimscroll-menu-->
        </div><!-- /Right-bar -->
    </div><!-- End #wrapper -->

    <!-- jQuery  -->

    <script src="{{url('/admin-design')}}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/libs/metismenu/metisMenu.min.js"></script>

    <!-- KNOB JS -->
    <script src="{{url('/admin-design')}}/assets/libs/jquery-knob/jquery.knob.min.js"></script><!-- Chart JS -->
    <script src="{{url('/admin-design')}}/assets/libs/chart.js/Chart.bundle.min.js"></script><!-- Jvector map -->
    <!-- <script src="{{url('/admin-design')}}/assets/libs/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- Datatable js -->
    <script src="{{url('/admin-design')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{url('/admin-design')}}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
    </script>
    <!-- Dashboard Init JS -->

    <script src="{{url('/admin-design')}}/assets/libs/mohithg-switchery/switchery.min.js"></script>

    <!-- <script src="{{url('/admin-design')}}/assets/js/jquery.dashboard.js"></script> -->
    <!-- App js -->

    <!--<script src="assets/libs/summernote/summernote-bs4.min.js"></script>
-->
    <script src="{{url('/admin-design')}}/assets/js/dropify.js"></script><!-- App js -->
    <script src="{{url('/admin-design')}}/assets/js/jquery.core.js"></script>
    <script src="{{url('/admin-design')}}/assets/js/jquery.app.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            $('.dropify').dropify();

            $('.cke').each(function() {
                CKEDITOR.replace(this.id, {
                    contentsLangDirection: 'rtl',
                    language: 'ar',
                });

            });

            $('.cke1').each(function() {
                CKEDITOR.replace(this.id, {
                    contentsLangDirection: 'rtl',
                    language: 'ar',
                });

            });

            // Default Datatable
            $('#datatable').DataTable({
                keys: true,
                "pageLength": 100
            });
            $('.datatable').DataTable({
                keys: true,
                "pageLength": 15
            });

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'print']
            });

            // Multi Selection Datatable
            $('#selection-datatable').DataTable({
                select: {
                    style: 'multi'
                }
            });

            $('.change-select-subscription-type').change(function() {
                var id = $(this).val();
                var user_id = $('.user-identify').val();
                $.ajax({
                    type: 'get',
                    url: "<?= url('admin/subscriptions/get/') ?>/" + id,
                    data: {
                        'user_id': user_id
                    },
                    success: function(result) {
                        $('.result-select-subscription-type').html(result);
                    }
                });
            });

            $('#change-city-register-page').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "<?= url('subscription/get/regions/') ?>/" + id,
                    success: function(result) {
                        $('#result-change-city-register-page').html(result);
                    }
                });
            });

        });
    </script>


    <!--<script>
    jQuery(document).ready(function() {
        $('.summernote-editor').summernote({
            height: 250, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote,
        });
        $('.summernote-inline').summernote({
            airMode: true
        });
    });
</script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="{{url('/admin-design')}}/assets/js/tagsinput.js"></script>

    <script src="{{url('/admin-design')}}/assets/js/custom.js?{{strtotime(date('Y-m-d h:i:sa'))}}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

</body>
<!-- Mirrored from coderthemes.com/greeva/vertical/rtl/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Aug 2018 13:24:44 GMT -->

</html>