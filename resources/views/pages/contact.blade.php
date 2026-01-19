@extends('index')
@section('web')
<?php
if (!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
    $name = "name_en";
    $body = "body_en";
} else {
    $name = "name_ar";
    $body = "body_ar";
}
?>

<style>
    .contact__social ul li a.ig:hover {
        color: #ffffff;
        background: #ed09b1;
    }

    .contact__social ul li a.ig {
        color: #ed09b1;
        background: rgb(233 30 99 / 22%);
    }

    .contact__social ul li a.tg:hover {
        color: #ffffff;
        background: #0088cc;
    }
</style>
<main>

    <!-- page title area start -->
    <section class="page__title-area pt-120">
        <div class="page__title-shape">
            <img class="page-title-shape-5 d-none d-sm-block" src="{{url('web/')}}/img/page-title/page-title-shape-1.png" alt="">
            <img class="page-title-shape-6" src="{{url('web/')}}/img/page-title/page-title-shape-2.png" alt="">
            <img class="page-title-shape-7" src="{{url('web/')}}/img/page-title/page-title-shape-4.png" alt="">
            <img class="page-title-shape-8" src="{{url('web/')}}/img/page-title/page-title-shape-5.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-8">
                    <div class="page__title-content mb-25 pr-40">
                        <div class="page__title-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('web.home')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('web.contact')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <h5 class="page__title-3">{{trans('web.contact')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->

    <!-- contact area start -->
    <section class="contact__area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-7 col-xl-7 col-lg-6">
                    <div class="contact__wrapper">
                        <div class="section__title-wrapper mb-40">
                            <h2 class="section__title">{{trans('web.keep_in')}}<span class="yellow-bg yellow-bg-big"> {{trans('web.touch')}}<img src="{{url('web/')}}/img/shape/yellow-bg.png" alt=""></span></h2>
                        </div>
                        <div class="contact__form">
                            <form action="" method="POST">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-md-6">
                                        <div class="contact__form-input">
                                            <input type="text" placeholder="{{trans('web.your_name')}}" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-md-6">
                                        <div class="contact__form-input">
                                            <input type="email" placeholder="{{trans('web.your_email')}}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="contact__form-input">
                                            <textarea placeholder="{{trans('web.your_message')}}" name="message"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xxl-12">
                                        <div class="contact__btn">
                                            <button type="submit" class="e-btn">{{trans('web.send')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 offset-xxl-1 col-xl-4 offset-xl-1 col-lg-5 offset-lg-1">
                    <div class="contact__info white-bg p-relative z-index-1">
                        <div class="contact__shape">
                            <img class="contact-shape-1" src="{{url('web/')}}/img/contact/contact-shape-1.png" alt="">
                            <img class="contact-shape-2" src="{{url('web/')}}/img/contact/contact-shape-2.png" alt="">
                            <img class="contact-shape-3" src="{{url('web/')}}/img/contact/contact-shape-3.png" alt="">
                        </div>
                        <div class="contact__info-inner white-bg">
                            <ul>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <svg class="mail" viewBox="0 0 24 24">
                                                <path class="st0" d="M4,4h16c1.1,0,2,0.9,2,2v12c0,1.1-0.9,2-2,2H4c-1.1,0-2-0.9-2-2V6C2,4.9,2.9,4,4,4z" />
                                                <polyline class="st0" points="22,6 12,13 2,6 " />
                                            </svg>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>{{trans('web.email')}}</h4>
                                            <p><a href="https://themepure.net/cdn-cgi/l/email-protection#8bf8fefbfbe4f9ffcbeeeffee8eae7a5e8e4e6"><span class="__cf_email__" data-cfemail="25565055554a5751654041504644490b464a48">{{$config->email}}</span></a></p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <svg class="call" viewBox="0 0 24 24">
                                                <path class="st0" d="M22,16.9v3c0,1.1-0.9,2-2,2c-0.1,0-0.1,0-0.2,0c-3.1-0.3-6-1.4-8.6-3.1c-2.4-1.5-4.5-3.6-6-6  c-1.7-2.6-2.7-5.6-3.1-8.7C2,3.1,2.8,2.1,3.9,2C4,2,4.1,2,4.1,2h3c1,0,1.9,0.7,2,1.7c0.1,1,0.4,1.9,0.7,2.8c0.3,0.7,0.1,1.6-0.4,2.1  L8.1,9.9c1.4,2.5,3.5,4.6,6,6l1.3-1.3c0.6-0.5,1.4-0.7,2.1-0.4c0.9,0.3,1.8,0.6,2.8,0.7C21.3,15,22,15.9,22,16.9z" />
                                            </svg>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>{{trans('web.mobile')}}</h4>
                                            <p><a href="tel:{{$config->mobile}}">{{$config->mobile}}</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <svg class="call" viewBox="0 0 24 24">
                                                <path class="st0" d="M22,16.9v3c0,1.1-0.9,2-2,2c-0.1,0-0.1,0-0.2,0c-3.1-0.3-6-1.4-8.6-3.1c-2.4-1.5-4.5-3.6-6-6  c-1.7-2.6-2.7-5.6-3.1-8.7C2,3.1,2.8,2.1,3.9,2C4,2,4.1,2,4.1,2h3c1,0,1.9,0.7,2,1.7c0.1,1,0.4,1.9,0.7,2.8c0.3,0.7,0.1,1.6-0.4,2.1  L8.1,9.9c1.4,2.5,3.5,4.6,6,6l1.3-1.3c0.6-0.5,1.4-0.7,2.1-0.4c0.9,0.3,1.8,0.6,2.8,0.7C21.3,15,22,15.9,22,16.9z" />
                                            </svg>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>{{trans('web.mobile2')}}</h4>
                                            <p><a href="tel:{{$config->mobile}}">{{$config->mobile2}}</a></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="contact__social pl-30">
                                <h4>{{trans('web.follow_us')}}</h4>
                                <ul>
                                    <li><a href="{{$config->fb}}" class="fb"><i class="social_facebook"></i></a></li>
                                    <li><a href="{{$config->tw}}" class="tw"><i class="social_twitter"></i></a></li>
                                    <li><a href="{{$config->ig}}" class="ig"><i class="social_instagram"></i></a></li>
                                    @if(!empty($config->telegram))
                                    <li><a href="{{$config->telegram}}" class="tg" style="color: #0088cc; background: rgb(0 136 204 / 22%);"><i class="fab fa-telegram"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="mt-4 text-center">
                                <img src="{{url('/')}}/images/QRCode.jpg" alt="QR Code" style="max-width: 200px; width: 100%; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact area end -->


</main>
@endsection