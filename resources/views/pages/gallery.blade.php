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
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('web.gallery')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <h5 class="page__title-3">{{trans('web.gallery')}}</h5>
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
                <a href="{{url('website/public/images/' . $val->image)}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mt-3">
                    <img src="{{url('website/public/images/' . $val->image)}}" class="img-fluid rounded">
                </a>
                @endforeach
            </div>
            {{$data->links()}}
        </div>
    </section>
    <!-- blog area end -->


</main>
@endsection