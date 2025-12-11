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
            <img class="dot" src="{{url('web/')}}/img/icon/sign/dot.png" alt="">
            <img class="bg" src="{{url('web/')}}/img/icon/sign/sign-up.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">{{trans('web.year')}} {{$config->number}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="user">
                        <h2>{{$user->username}}</h2>
                        <p>
                            <strong>{{trans('web.email')}}: </strong> <span style="color: blue;"> {{$user->email}}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.identify')}}: </strong> <span style="color: blue;"> {{$user->identify}}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.gender')}}: </strong> <span style="color: blue;"> {{$user->gender == 'male' ? trans('web.male') : trans('web.female') }}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.nationality')}}: </strong> <span style="color: blue;"> {{$user->nationality}}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.birthday')}}: </strong> <span style="color: blue;"> {{$user->birthday}}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.address')}}: </strong> <span style="color: blue;"> {{$user->address}}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.mobile')}}: </strong> <span style="color: blue;"> {{$user->mobile}}</span>
                        </p>
                        <p>
                            <strong>{{trans('web.mobile2')}}: </strong> <span style="color: blue;"> {{$user->mobile2}}</span>
                        </p>

                    </div>
                </div>
                <div class="col-md-12"></div>
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
                <div class="col-md-12"></div>
                <div class="col-md-6">
    <form action="{{url('subscription/user')}}" method="POST">
        {{csrf_field()}}
        <input class="user-identify" type="hidden" name="identify" value="{{request('identify')}}">

        <!-- Nationality Field -->
        <div class="sign__input-wrapper mb-10">
            <h5>{{ trans('web.nationality') }}</h5>
            <div class="sign__input">
                <select name="nationality" class="form-select">
                    <option value="">{{ trans('web.nationality') }}</option>
                    @foreach (\App\Nationality::where('active', 'active')->get() as $val)
                        <option value="{{ $val->id }}" {{ old('nationality') == $val->id ? 'selected' : '' }}>
                            {{ $val->$name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- City Field -->
        <div class="sign__input-wrapper mb-10">
            <h5>{{ trans('web.city') }}</h5>
            <div class="sign__input">
                <select name="city" id="change-city-register-page" class="form-select">
                    <option value="0">{{ trans('web.city') }}</option>
                    @foreach (\App\City::where('active', 'active')->get() as $val)
                        <option value="{{ $val->id }}" {{ old('city') == $val->id ? 'selected' : '' }}>
                            {{ $val->$name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Region Field -->
        <div class="sign__input-wrapper mb-10">
            <h5>{{ trans('web.state') }}</h5>
            <div class="sign__input">
                <select name="region" id="result-change-city-register-page" class="form-select">
                    <option value="">{{ trans('web.state') }}</option>
                    <!-- Populate dynamically based on city selection -->
                </select>
            </div>
        </div>

        <!-- Subscription Type Dropdown -->
        <div class="sign__input-wrapper mb-10">
            <h5>{{ trans('web.subscription_type') }}</h5>
            <div class="sign__input">
                <select name="subscription_type" class="form-select change-select-subscription-type1">
                    <option value="0">{{ trans('web.select_subscription_type') }}</option>
                    @foreach(\App\SubscriptionsName::get() as $val)
                        <option value="{{ $val->id }}">{{ $val->$name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="result-select-subscription-type1"></div>
        <div class="sign__input-wrapper mb-10">
            <h5>{{ trans('web.subscription_notes') }}</h5>
            <div class="sign__input">
                <textarea class="form-control" name="subscription_notes" cols="30" rows="7"></textarea>
            </div>
        </div>
        <button class="e-btn w-100"> <span></span> {{ trans('web.subscription') }}</button>
    </form>
</div>
                <!--<div class="col-md-6">-->
                <!--    <form action="{{url('subscription/user')}}" method="POST">-->
                <!--        {{csrf_field()}}-->
                <!--        <input class="user-identify" type="hidden" name="identify" value="{{request('identify')}}">-->
                <!--        <div class="sign__input-wrapper mb-10">-->
                <!--            <h5>{{trans('web.subscription_type')}}</h5>-->
                <!--            <div class="sign__input">-->
                <!--                <select name="subscription_type" class="form-select change-select-subscription-type1">-->
                <!--                    <option value="0">{{trans('web.select_subscription_type')}}</option>-->
                <!--                    @foreach(\App\SubscriptionsName::get() as $val)-->
                <!--                    <option value="{{$val->id}}">{{$val->$name}}</option>-->
                <!--                    @endforeach-->
                <!--                </select>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="result-select-subscription-type1"></div>-->
                <!--        <div class="sign__input-wrapper mb-10">-->
                <!--            <h5>{{trans('web.subscription_notes')}}</h5>-->
                <!--            <div class="sign__input">-->
                <!--                <textarea class="form-control" name="subscription_notes" cols="30" rows="7"></textarea>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <button class="e-btn  w-100"> <span></span> {{trans('web.subscription')}}</button>-->
                <!--    </form>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <!-- sign up area end -->

</main>

@endsection