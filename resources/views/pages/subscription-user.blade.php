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
        .container { max-width: 1400px !important; padding: 0 15px !important; }
        .form-container { background: transparent !important; padding: 0 !important; border-radius: 0 !important; box-shadow: none !important; width: 100% !important; margin: 0 !important; max-width: none !important; }
        .user { background: white; padding: 0; border-radius: 16px; border: none; margin-bottom: 30px; width: 100% !important; max-width: none !important; box-shadow: 0 4px 20px rgba(0,0,0,0.1); overflow: hidden; }
        .user h2 { color: white; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); font-weight: 700; margin: 0; padding: 20px; text-align: center; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); }
        .user-table { width: 100%; border-collapse: collapse; }
        .user-table tr { border-bottom: 1px solid #e8eef5; transition: all 0.3s; }
        .user-table tr:last-child { border-bottom: none; }
        .user-table tr:hover { background: #f8f9fa; }
        .user-table td { padding: 16px 20px; font-weight: bold; }
        .user-table td:first-child { color: #667eea; font-size: 15px; width: 35%; background: #f8f9fa; font-weight: bold; }
        .user-table td:last-child { color: #1e293b; font-size: 16px; text-align: right; padding-right: 30px; font-weight: bold; }
        .sign__input-wrapper h5 { color: white; font-weight: 700; margin-bottom: 8px; font-size: 16px; text-align: center; }
        .form-select, .form-control { border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; font-size: 15px; background: #fef3c7; height: 50px; width: 100%; color: #2563eb; font-weight: 700; transition: all 0.3s; }
        textarea.form-control { height: auto; min-height: 100px; }
        .form-select:focus, .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 4px rgba(102,126,234,0.1); background: white; outline: none; }
        .e-btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 18px 60px; border-radius: 12px; font-weight: 700; font-size: 18px; transition: all 0.3s; color: white; box-shadow: 0 10px 25px rgba(102,126,234,0.3); display: inline-flex; align-items: center; justify-content: center; }
        .e-btn:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(102,126,234,0.4); }
        .e-btn span { display: none; }
        .alert { border-radius: 12px; border: none; padding: 18px 24px; margin-bottom: 30px; }
        @media (max-width: 768px) {
            .form-container { padding: 10px; }
            .user { border-radius: 12px; }
            .user h2 { font-size: 18px; padding: 16px; }
            .user-table td { padding: 12px 10px; font-size: 14px; font-weight: bold; }
            .user-table td:first-child { font-size: 13px; width: 40%; font-weight: bold; }
            .user-table td:last-child { font-size: 14px; font-weight: bold; text-align: center; }
            .signup__area { padding: 20px 0; }
            .section__title { font-size: 22px; }
            .user { padding: 25px 20px; }
            .user h2 { font-size: 20px; }
            .user p { font-size: 14px; padding: 10px; }
            .sign__input-wrapper h5 { font-size: 15px; }
            .form-select, .form-control { padding: 12px 14px; font-size: 14px; height: 46px; }
            .e-btn { padding: 14px 40px; font-size: 16px; width: 100%; }
        }
    </style>
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="circle" src="{{url('web/')}}/img/icon/sign/circle.png" alt="">
            <img class="dot" src="{{url('web/')}}/img/icon/sign/dot.png" alt="">
            <img class="bg" src="{{url('web/')}}/img/icon/sign/sign-up.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">بيانات المشارك</h2>
                        @php
                            $config = DB::table('config')->first();
                            $subscription = \App\Subscription::where('user_id', $user->id)->where('number', $config->number)->first();
                        @endphp
                        @if($subscription && $subscription->participation_date)
                            <p style="color: white; font-size: 24px; margin-top: 20px; font-weight: bold;">
                                موعد التسميع:
                            </p>
                            <p style="color: #fbbf24; font-size: 28px; font-weight: bold; margin-top: 10px;">
                                {{ $subscription->participation_date }}
                            </p>
                        @else
                            <p style="color: white; font-size: 24px; margin-top: 20px; font-weight: bold;">
                                موعد التسميع:
                            </p>
                            <p style="color: #fbbf24; font-size: 28px; font-weight: bold; margin-top: 10px;">
                                لم يتم التعيين بعد
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-container">
                <div class="user">
                        <h2>{{$user->username}}</h2>
                        <table class="user-table">
                            <tr>
                                <td>{{trans('web.email')}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('web.identify')}}</td>
                                <td>{{$user->identify}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('web.gender')}}</td>
                                <td>{{$user->gender == 'male' ? trans('web.male') : trans('web.female')}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('web.nationality')}}</td>
                                <td>{{ $user->nationality_id ? (\App\Nationality::find($user->nationality_id)->name_ar ?? $user->nationality) : $user->nationality }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('web.birthday')}}</td>
                                <td>{{$user->birthday}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('web.address')}}</td>
                                <td>{{$user->address}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('web.mobile')}}</td>
                                <td>{{$user->mobile}}</td>
                            </tr>
                            <tr>
                                <td>أجزاء التسميع</td>
                                <td>
                                    @php
                                        $selections = \App\Selection::where('subscription_id', $subscription->id ?? 0)->pluck('options')->toArray();
                                        $selectionsText = !empty($selections) ? implode(', ', $selections) : '-';
                                    @endphp
                                    {{ $selectionsText }}
                                </td>
                            </tr>
                        </table>
                </div>
                @if(isset($config) && !empty($config->telegram))
                <div class="text-center mb-4" style="background: rgba(0, 136, 204, 0.1); padding: 20px; border-radius: 12px;">
                    <p style="color: white; font-size: 16px; font-weight: 600; margin: 0; line-height: 1.8;">
                        للاستفسار ومعرفة موعد تسميعك<br>
                        انضم لجروب <a href="{{ $config->telegram }}" target="_blank" style="color: #0088cc; text-decoration: underline; font-weight: 700;">التليجرام</a>
                    </p>
                </div>
                @endif
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
                        <option value="{{ $val->id }}" {{ ($user->nationality_id == $val->id) ? 'selected' : '' }}>
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
                        <option value="{{ $val->id }}" {{ ($user->city_id == $val->id) ? 'selected' : '' }}>
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
                    @foreach (\App\Region::where('city_id', $user->city_id)->get() as $val)
                        <option value="{{ $val->id }}" {{ ($user->region_id == $val->id) ? 'selected' : '' }}>
                            {{ $val->$name }}
                        </option>
                    @endforeach
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
                        <option value="{{ $val->id }}" {{ ($subscription && $subscription->name_id == $val->id) ? 'selected' : '' }}>{{ $val->$name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="result-select-subscription-type1"></div>
        <div class="sign__input-wrapper mb-10">
            <h5>{{ trans('web.subscription_notes') }}</h5>
            <div class="sign__input">
                <textarea class="form-control" name="subscription_notes" cols="30" rows="7">{{ $subscription ? $subscription->notes : '' }}</textarea>
            </div>
        </div>
                    <div class="text-center mt-4">
                        <button class="e-btn"> <span></span> {{ trans('web.subscription') }}</button>
                    </div>
                </form>
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