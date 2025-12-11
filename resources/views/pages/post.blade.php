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
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('web.posts_news')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <h5 class="page__title-3">{{$data->$name}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->


    <!-- blog area start -->
    <section class="blog__area pt-115 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="{{url('website/public/images/' . $data->image)}}" width="100%" alt="">
                    @if(!empty($data->url))
                    <h4 class="mt-4"><a href="{{$data->url}}">{{$data->$name}}</a></h4>
                    @else
                    <h4 class="mt-4">{{$data->$name}}</h4>
                    @endif
                    <p class="mt-3"><?= $data->$body ?></p>
                    <span style="font-size: 12px;"><i class="fas fa-clock"></i> {{$data->created_at}}</span>
                </div>

            </div>
        </div>
    </section>
    <!-- blog area end -->


</main>
@endsection