<!doctype html>

@if(!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2)
<html class="no-js" lang="en" dir="ltr">
@else
<html class="no-js" lang="ar" dir="rtl">
@endif

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$config->name}} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('website/public/images/' . $config->image)}}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{url('web/')}}/css/preloader.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/meanmenu.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/animate.min.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/swiper-bundle.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/backToTop.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/jquery.fancybox.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"> -->
    <link rel="stylesheet" href="{{url('web/')}}/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/elegantFont.css">
    <link rel="stylesheet" href="{{url('web/')}}/css/default.css">
    @if(!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2)
    <link rel="stylesheet" href="{{url('web/')}}/css/style-en.css?1">
    @else
    <link rel="stylesheet" href="{{url('web/')}}/css/style.css?1">
    @endif
    <style>
    .slider__nav,
    .slider__nav-item,
    .slider__nav-content,
    .swiper-pagination,
    .swiper-pagination-bullet,
    .swiper-pagination-fraction {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        width: 0 !important;
        overflow: hidden !important;
    }
    </style>
</head>

<body>
  
    <div class="advs-hei" style="position: relative;">
        <img src="{{url('website/public/images/' . $config->header_image)}}" alt="">
        <h2 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: black; font-size: 40px; margin: 0;">{{$config->number}}</h2>
    </div>

    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-content">
                    <img class="loading-logo-text" src="{{url('website/public/images/' . $config->image)}}" width="150px" alt="">
                    <div class="loading-stroke">
                        <img class="loading-logo-icon" src="{{url('web/')}}/img/logo/logo-icon.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <!-- header area start -->
    <header>
        <div id="header-sticky" class="header__area header__transparent header__padding-2">
            <nav class="navbar navbar-expand-lg navbar-light bg-custom">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('website/public/images/' . $config->image)}}" width="100px" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li>
                                <a href="{{url('/')}}" class="nav-link">{{trans('web.home')}}</a>
                            </li>

                            <li>
                                <a href="{{url('/subscription')}}" class="nav-link">{{trans('web.subscription1')}}</a>
                            </li>

                            <li>
                                <a href="{{url('/posts')}}" class="nav-link">{{trans('web.posts_news')}}</a>
                            </li>

                            <li>
                                <a href="{{url('/results')}}" class="nav-link">{{trans('web.results_tests')}}</a>
                            </li>

                            <li>
                                <a href="{{url('/opinions')}}" class="nav-link">{{trans('web.opinions')}}</a>
                            </li>

                            <li>
                                <a href="{{url('/locations')}}" class="nav-link">{{trans('web.locations')}}</a>
                            </li>

                            <li>
                                <a href="{{url('/contact')}}" class="nav-link">{{trans('web.contact')}}</a>
                            </li>

                            @if(!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    En
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{url('/')}}?lang=1">Ar</a></li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ar
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{url('/')}}?lang=2">En</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                        <div class="header__right d-flex justify-content-end align-items-center">
                            <div class="header__btn header__btn-2 ml-30 d-sm-block">
                                @if(auth()->guard('admin')->check())
                                <a href="{{url('/admin')}}" class="e-btn">{{trans('web.dashboard')}}</a>
                                @else
                                <a href="{{url('/login')}}" class="e-btn">{{trans('web.login')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- <div class="container">
               <div class="row align-items-center">
                  <div class="col-auto">
                     <div class="header__left d-flex">
                        <div class="logo">
                           <a href="index.html">
                              <img class="logo-white" src="assets/img/logo/logo-2.png" alt="logo">
                              <img class="logo-black" src="assets/img/logo/logo.png" alt="logo">
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-8 col-xl-5 d-none d-xl-block">
                     <div class="main-menu main-menu-3">
                        <nav id="mobile-menu">
                           <ul>
                              <li>
                                 <a href="index.html">الرئيسية</a>
                              </li>
                              <li>
                                 <a href="course-grid.html">نموذج الاشتراك</a>
                              </li>
                              <li>
                                 <a href="blog.html">أخبار المسابقة</a>
                              </li>
                              <li>
                                 <a href="course-grid.html">نتائج المسابقة</a>
                              </li>
                              <li><a href="contact.html">قالو عن المسابقة</a></li>
                              <li><a href="contact.html">تواصل معنا</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
                  <div class="col-auto">
                     
                  </div>
               </div>
            </div> -->
        </div>
    </header>


    @yield('web')

    <!-- footer area start -->
    <footer>
        <div class="footer__area footer-bg">
            <div class="footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="footer__copyright text-center">
                                <p><?= trans('web.all_right') ?> &copy; {{date('Y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->
    <!-- JS here -->
    <script src="{{url('web/')}}/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{url('web/')}}/js/vendor/waypoints.min.js"></script>
    <script src="{{url('web/')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('web/')}}/js/jquery.meanmenu.js"></script>
    <script src="{{url('web/')}}/js/swiper-bundle.min.js"></script>
    <script src="{{url('web/')}}/js/owl.carousel.min.js"></script>
    <script src="{{url('web/')}}/js/jquery.fancybox.min.js"></script>
    <script src="{{url('web/')}}/js/isotope.pkgd.min.js"></script>
    <script src="{{url('web/')}}/js/parallax.min.js"></script>
    <script src="{{url('web/')}}/js/backToTop.js"></script>
    <script src="{{url('web/')}}/js/jquery.counterup.min.js"></script>
    <script src="{{url('web/')}}/js/ajax-form.js"></script>
    <script src="{{url('web/')}}/js/wow.min.js"></script>
    <script src="{{url('web/')}}/js/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.0/dist/index.bundle.min.js"></script>
    <script src="{{url('web/')}}/jQuery.Marquee-master/jquery.marquee.min.js"></script>
    <script src="{{url('web/')}}/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('.change-select-subscription-type').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "<?= url('subscription/get/') ?>/" + id,
                    success: function(result) {
                        $('.result-select-subscription-type').html(result);
                    }
                });
            });

            $('.change-select-subscription-type1').change(function() {
                var id = $(this).val();
                var identify = $('.user-identify').val();
                $.ajax({
                    type: 'get',
                    url: "<?= url('subscription/get/') ?>/" + id,
                    data: {
                        'identify': identify
                    },
                    success: function(result) {
                        $('.result-select-subscription-type1').html(result);
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
    <style>
    .slider__area .slider__nav,
    .slider__area .slider__nav *,
    .slider__nav-item,
    .slider__nav-content,
    .slider__nav-content h4,
    .slider__nav-content span,
    section .slider__nav {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        max-height: 0 !important;
        overflow: hidden !important;
        position: absolute !important;
        left: -9999px !important;
    }
    </style>

</body>

<!-- Mirrored from themepure.net/template/educal/educal/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Jun 2022 20:14:45 GMT -->

</html>