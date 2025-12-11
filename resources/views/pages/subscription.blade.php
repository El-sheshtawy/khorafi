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

    <!-- sign up area start -->
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="circle" src="{{url('web/')}}/img/icon/sign/circle.png" alt="">
            <img class="zigzag" src="{{url('web/')}}/img/icon/sign/zigzag.png" alt="">
            <img class="dot" src="{{url('web/')}}/img/icon/sign/dot.png" alt="">
            <img class="bg" src="{{url('web/')}}/img/icon/sign/sign-up.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">{{trans('web.enter_identify')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="sign__wrapper white-bg">
                        <div class="sign__form">
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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
                            <form action=""">
                                <div class=" row">
                                <div class="col-md-12">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{trans('web.identify')}}</h5>
                                        <div class="sign__input">
                                            <input type="text" name="identify" placeholder="{{trans('web.identify')}}">
                                            <i class="fal fa-hashtag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="e-btn  w-100"> <span></span> {{trans('web.confirm')}}</button>
                                </div>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!--  <div class="user">
                <h2>محمد حسن</h2>
                <p>
                    <strong>الوظيفة او الإشي: </strong> القيمة
                </p>
                <p>
                    <strong>الوظيفة او الإشي: </strong> القيمة
                </p>
                <p>
                    <strong>الوظيفة او الإشي: </strong> القيمة
                </p>
                <p>
                    <strong>الوظيفة او الإشي: </strong> القيمة
                </p>
                <p>
                    <strong>الوظيفة او الإشي: </strong> القيمة
                </p>
            </div> -->
        </div>
    </section>
    <!-- sign up area end -->

</main>

@endsection