@extends('index')
@section('web')
    <?php
    if (!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
        $name = 'name_en';
        $body = 'body_en';
    } else {
        $name = 'name_ar';
        $body = 'body_ar';
    }
    ?>

    <main>

        <!-- sign up area start -->
        <section class="signup__area po-rel-z1 pt-100 pb-145">
            <div class="sign__shape">
                <img class="circle" src="{{ url('web/') }}/img/icon/sign/circle.png" alt="">
                <img class="dot" src="{{ url('web/') }}/img/icon/sign/dot.png" alt="">
                <img class="bg" src="{{ url('web/') }}/img/icon/sign/sign-up.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center mb-55">
                            <h2 class="section__title">{{ trans('web.year') }} {{ $config->year }}</h2>
                        </div>
                    </div>
                </div>
                <form action="{{ url('subscription/register') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row justify-content-center">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-8">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.identify') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="number" name="identify"
                                                placeholder="{{ trans('web.identify') }}"
                                                value="{{ old('identify') ? old('identify') : request('identify') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-3">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.first_name') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="text" name="first_name"
                                                placeholder="{{ trans('web.first_name') }}"
                                                value="{{ old('first_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.second_name') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="text" name="second_name"
                                                placeholder="{{ trans('web.second_name') }}"
                                                value="{{ old('second_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.third_name') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="text" name="third_name"
                                                placeholder="{{ trans('web.third_name') }}"
                                                value="{{ old('third_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.last_name') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="text" name="last_name"
                                                placeholder="{{ trans('web.last_name') }}" value="{{ old('last_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.gender') }}</h5>
                                        <div class="">
                                            <select class="form-control" name="gender">
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                    {{ trans('web.male') }}</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    {{ trans('web.female') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.nationality') }}</h5>
                                        <div class="">
                                            <select class="form-control" name="nationality">
                                                <option value="">...</option>
                                                @foreach (\App\Nationality::where('active', 'active')->get() as $val)
                                                    <option value="{{ $val->id }}"
                                                        {{ old('nationality') == $val->id ? 'selected' : '' }}>
                                                        {{ $val->$name }}</option>
                                                @endforeach
                                            </select>
                                            <?php /* 
                                        <!-- <input class="form-control" type="text" name="nationality" placeholder="{{trans('web.nationality')}}" value="{{old('nationality')}}"> -->
                                        */
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.birthday') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="date" name="birthday"
                                                placeholder="{{ trans('web.birthday') }}" value="{{ old('birthday') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.email') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="email" name="email"
                                                placeholder="{{ trans('web.email') }}" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.city') }}</h5>
                                        <div class="">
                                            <select class="form-control" name="city" id="change-city-register-page">
                                                <option value="0">...</option>
                                                @foreach (\App\City::where('active', 'active')->get() as $val)
                                                    <option value="{{ $val->id }}"
                                                        {{ old('city') == $val->id ? 'selected' : '' }}>
                                                        {{ $val->$name }}</option>
                                                @endforeach
                                            </select>
                                            <?php /*
                                        <!-- <input class="form-control" type="text" name="city" placeholder="{{trans('web.city')}}" value="{{old('city')}}"> -->
                                        */
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.state') }}</h5>
                                        <div class="" id="result-change-city-register-page">
                                            <select class="form-control" name="region">
                                                <option value="">...</option>
                                            </select>
                                            <?php /*
                                        <input class="form-control" type="text" name="state" placeholder="{{trans('web.state')}}" value="{{old('state')}}">
                                        */
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.mobile') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="number" name="mobile"
                                                placeholder="{{ trans('web.mobile') }}" value="{{ old('mobile') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>{{ trans('web.mobile2') }}</h5>
                                        <div class="">
                                            <input class="form-control" type="number" name="mobile2"
                                                placeholder="{{ trans('web.mobile2') }}" value="{{ old('mobile2') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="sign__input-wrapper mb-10">
                                <h5>{{ trans('web.subscription_type') }}</h5>
                                <div class="sign__input">
                                    <select name="subscription_type" class="form-select change-select-subscription-type">
                                        <option value="0">{{ trans('web.select_subscription_type') }}</option>
                                        @foreach (\App\SubscriptionsName::get() as $val)
                                            <option value="{{ $val->id }}">{{ $val->$name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="result-select-subscription-type"></div>
                            <div class="sign__input-wrapper mb-10">
                                <h5>{{ trans('web.subscription_notes') }}</h5>
                                <div class="sign__input">
                                    <textarea class="form-control" name="subscription_notes" cols="30" rows="7"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sign__input-wrapper mb-25">
                                <h5>المسابقة</h5>
                                <div class="">
                                    <input type="text" class="form-control" value="{{ $config->number ?? ''}}" readonly>
                                    <input type="hidden" name="number" value="{{ $config->number  ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-2">
                            <button class="e-btn  w-100"> <span></span> {{ trans('web.subscription') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
        <!-- sign up area end -->

    </main>

@endsection
