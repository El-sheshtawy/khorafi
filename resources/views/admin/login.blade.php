<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{trans('admin.login')}}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Icons css -->
    <link href="{{url('/')}}/admin-design/assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/admin-design/assets/libs/dripicons/webfont/webfont.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/admin-design/assets/libs/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <!-- App css -->
    <link rel="stylesheet" href="{{url('/')}}/admin-design/assets/css/app.min.css">
</head>

<body class="bg-account-pages">
    <!-- Login -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box">
                                <!-- Logo box-->
                                <div class="account-logo-box">
                                    <h2 class="text-uppercase text-center"><a href="javascript:;" class="text-success"><span><img src="../files/images/" alt="" height="28"></span></a></h2>
                                </div>
                                <div class="account-content">
                                    <div class="col-md-12">
                                        @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                        @endif
                                    </div>
                                    <form action="" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group mb-3">
                                            <label class="font-weight-medium">البريد الاكتروني</label>
                                            <input class="form-control" name="email" type="email" required="" placeholder="اسم المستخدم" value="{{old('email')}}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="font-weight-medium">كلمة المرور</label>
                                            <input class="form-control" type="password" name="password" required="" placeholder="كلمة المرور">
                                        </div>

                                        <div class="form-group row text-center">
                                            <div class="col-12">
                                                <button class="btn btn-block btn-success waves-effect waves-light" type="submit" name="login">تسجيل دخول</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end form -->

                                    <!-- end row-->
                                </div>
                                <!-- end account-content -->
                            </div>
                            <!-- end account-box -->
                        </div>
                        <!-- end account-page-->
                    </div>
                    <!-- end wrapper-page -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- END HOME -->
    <!-- jQuery  -->
    <script src="{{ url('/') }}/admin-design/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('/') }}/admin-design/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/admin-design/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ url('/') }}/admin-design/assets/libs/metismenu/metisMenu.min.js"></script>
    <!-- App js -->
    <script src="{{ url('/') }}/admin-design/assets/js/jquery.core.js"></script>
    <script src="{{ url('/') }}/admin-design/assets/js/jquery.app.js"></script>
</body>
<!-- Mirrored from coderthemes.com/greeva/vertical/rtl/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Aug 2018 13:27:26 GMT -->

</html>