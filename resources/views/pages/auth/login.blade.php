@extends('index')
@section('web')
<main>

    <!-- sign up area start -->
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="man-1" src="url('web/')/img/icon/sign/man-1.png" alt="">
            <img class="man-2" src="url('web/')/img/icon/sign/man-2.png" alt="">
            <img class="circle" src="url('web/')/img/icon/sign/circle.png" alt="">
            <img class="zigzag" src="url('web/')/img/icon/sign/zigzag.png" alt="">
            <img class="dot" src="url('web/')/img/icon/sign/dot.png" alt="">
            <img class="bg" src="url('web/')/img/icon/sign/sign-up.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">{{trans('web.login')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
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
                            <form method="POST" action="">
                                {{csrf_field()}}
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('web.username')}}</h5>
                                    <div class="sign__input">
                                        <input name="email" type="email" placeholder="{{trans('web.username')}}">
                                        <i class="fal fa-user"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-10">
                                    <h5>{{trans('web.password')}}</h5>
                                    <div class="sign__input">
                                        <input type="password" name="password" placeholder="{{trans('web.password')}}">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                </div>

                                <button class="e-btn  w-100"> <span></span> {{trans('web.login')}}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign up area end -->

</main>
@endsection