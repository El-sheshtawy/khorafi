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
    <style>
        .signup__area { background: #2c5282; min-height: 100vh; padding: 40px 0; }
        .section__title { color: white !important; font-weight: 800; font-size: 28px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        .sign__wrapper { background: white; padding: 50px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); max-width: 600px; margin: 0 auto; }
        .sign__input-wrapper h5 { color: #2d3748; font-weight: 700; margin-bottom: 8px; font-size: 16px; text-align: center; }
        .sign__input input { border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 50px 14px 18px; font-size: 15px; background: #fef3c7; height: 50px; width: 100%; color: #2563eb; font-weight: 700; transition: all 0.3s; }
        .sign__input { position: relative; }
        .sign__input i { position: absolute; right: 18px; top: 50%; transform: translateY(-50%); color: #667eea; font-size: 18px; }
        .sign__input input:focus { border-color: #667eea; box-shadow: 0 0 0 4px rgba(102,126,234,0.1); background: white; outline: none; }
        .e-btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 18px 60px; border-radius: 12px; font-weight: 700; font-size: 18px; transition: all 0.3s; color: white; box-shadow: 0 10px 25px rgba(102,126,234,0.3); display: inline-flex; align-items: center; justify-content: center; }
        .e-btn:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(102,126,234,0.4); }
        .e-btn span { display: none; }
        .alert { border-radius: 12px; border: none; padding: 18px 24px; margin-bottom: 30px; }
        @media (max-width: 768px) {
            .signup__area { padding: 20px 0; }
            .section__title { font-size: 22px; }
            .sign__wrapper { padding: 30px 20px; border-radius: 16px; }
            .sign__input-wrapper h5 { font-size: 15px; }
            .sign__input input { padding: 12px 45px 12px 14px; font-size: 14px; height: 46px; }
            .e-btn { padding: 14px 40px; font-size: 16px; width: 100%; }
        }
    </style>
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