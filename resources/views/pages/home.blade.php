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
<main>

    <!-- slider area start -->
    <section class="slider__area p-relative">
        <div class="slider__wrapper swiper-container">
            <div class="swiper-wrapper">
                @foreach(\App\Slider::where('active', 'active')->orderBy('id', 'desc')->paginate(15) as $key => $val)
                <div class="single-slider swiper-slide slider__height slider__overlay d-flex align-items-center" data-background="{{url('website/public/images/' . $val->image)}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-7 col-xl-8 col-lg-9 col-md-9 col-sm-10">
                                <div class="slider__content">
                                    <a href="{{url('subscription')}}" class="e-btn slider__btn">{{trans('web.subscription')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- slider area end -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.slider__wrapper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                speed: 1000,
            });
        }
    });
    </script>

    <section class="breaking-news wow animate__fadeInUp" data-wow-duration="2s" dir="ltr">
        <div class="container-fluid">
            <div class='marquee' data-gap='10' data-duplicated='true' style="width: 100%; position: relative; overflow: hidden; text-align: right;">
                @foreach(\App\Post::where('active', 'active')->paginate(9) as $key => $val)
                <a href="javascript:;" rel="prefetch">{{$val->$name}}</a> |
                @endforeach
            </div>
        </div>
    </section>


    <section class="cta__area gallerySec pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3">
                    <div class="section__title-wrapper text-center mb-60">
                        <h2 class="section__title">{{trans('web.gallery')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Gallery::where('active', 'active')->orderBy('id', 'desc')->paginate(6) as $key => $val)
                <a href="{{url('website/public/images/' . $val->image)}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                    <img src="{{url('website/public/images/' . $val->image)}}" class="img-fluid rounded">
                </a>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{url('gallery')}}" class="e-btn e-btn-border">{{trans('web.read_more')}}</a>
            </div>
        </div>
    </section>

    <!-- blog area start -->
    <section class="blog__area pt-115 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3">
                    <div class="section__title-wrapper text-center mb-60">
                        <h2 class="section__title">{{trans('web.news1')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Post::where('active', 'active')->orderBy('id', 'desc')->paginate(3) as $key => $val)
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="blog__item white-bg mb-30 transition-3 fix">
                        <div class="blog__thumb w-img fix">
                            <a href="{{url('post/' . $val->id)}}">
                                <img src="{{url('website/public/images/' . $val->image)}}" alt="">
                            </a>
                        </div>
                        <div class="blog__content">

                            <h3 class="blog__title"><a href="{{url('post/' . $val->id)}}">{{$val->$name}}</a></h3>

                            <div class="blog__meta d-flex align-items-center justify-content-between">
                                <div class="blog__date d-flex align-items-center">
                                    <i class="fal fa-clock"></i>
                                    <span>{{$val->created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{url('posts')}}" class="e-btn e-btn-border">{{trans('web.read_more')}}</a>
            </div>
        </div>
    </section>
    <!-- blog area end -->

    <section class="contact__area grey-bg-2 pt-120 pb-90 p-relative fix">
        <div class="contact__shape">
            <img class="contact-shape-5" src="assets/img/contact/contact-shape-5.png" alt="">
            <img class="contact-shape-4" src="assets/img/contact/contact-shape-4.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3">
                    <div class="section__title-wrapper text-center mb-60">
                        <h2 class="section__title">{{trans('web.locations')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Location::where('active', 'active')->orderBy('id', 'desc')->get() as $key => $val)
                <div class="col-md-4">
                    <div class="contact__item text-center mb-30 transition-3 white-bg">
                        <div class="contact__content">
                            <a href="{{$val->$body}}" target="_blank"><img width="100%" src="{{url('website/public/images/' . $val->image)}}" alt=""></a>
                            <h3 class="contact__title mt-3 mb-3"><a href="{{$val->$body}}" target="_blank">{{$val->$name}}</a></h3>
                            <a href="{{$val->$body}}" target="_blank" class="e-btn e-btn-border">{{trans('web.view_on_map')}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{url('locations')}}" class="e-btn e-btn-border">{{trans('web.read_more')}}</a>
            </div>
        </div>
    </section>

</main>
@endsection