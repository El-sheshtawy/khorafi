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
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('web.opinions')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <h5 class="page__title-3">{{trans('web.opinions')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->

    <div class="container">
        <form action="">
            <div class="row">

                <div class="col-md-3 mt-3">
                    <input class="form-control" type="date" name="date" placeholder="{{trans('web.date')}}" value="{{request('date')}}">
                </div>

                <div class="col-md-3 mt-3">
                    <input class="btn btn-info" type="submit" value="{{trans('web.filter')}}">
                </div>
            </div>
        </form>
    </div>

    <!-- blog area start -->
    <section class="blog__area pt-115 pb-150">
        <div class="container">
            <div class="row">
                @foreach($data as $key => $val)
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
            {{$data->links()}}
        </div>
    </section>
    <!-- blog area end -->


</main>
@endsection