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
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('web.participants_stats')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <h5 class="page__title-3">{{trans('web.participants_stats')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->

    <section class="blog__area pt-115 pb-150">
        <div class="container">
            <?php
            $config = DB::table('config')->first();
            $number = $config->filter_number ?? $config->number;
            ?>
            <style>
                .table thead th { background-color: #6c757d; color: white; }
                .table-wrapper:nth-of-type(1) .table tbody td:nth-child(4) { color: #085d9e; font-weight: bold; }
                .table-wrapper:nth-of-type(1) .table tbody td:nth-child(5) { color: red; font-weight: bold; }
                .table-wrapper:nth-of-type(1) .table tbody td:nth-child(3) { font-weight: bold; }
                .table-wrapper:nth-of-type(2) .table tbody td:nth-child(3) { color: #085d9e; font-weight: bold; }
                .table-wrapper:nth-of-type(2) .table tbody td:nth-child(4) { color: red; font-weight: bold; }
                .table-wrapper:nth-of-type(2) .table tbody td:nth-child(2) { font-weight: bold; }
                .table-wrapper:nth-of-type(3) .table tbody td:nth-child(3) { color: #085d9e; font-weight: bold; }
                .table-wrapper:nth-of-type(3) .table tbody td:nth-child(4) { color: red; font-weight: bold; }
                .table-wrapper:nth-of-type(3) .table tbody td:nth-child(2) { font-weight: bold; }
                .table-wrapper { overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 15px; }
            </style>
            
            <h3 class="text-center mb-4">{{trans('web.total')}}: {{\App\Subscription::where('number', $number)->count()}}</h3>
            
            <div class="table-wrapper">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{trans('web.category')}}</th>
                            <th>المحافظة</th>
                            <th>{{trans('web.subscriber')}}</th>
                            <th>{{trans('web.male_short')}} <span style="font-size: 11px; color: #28a745;">(ك/غ)</span></th>
                            <th>{{trans('web.female_short')}} <span style="font-size: 11px; color: #28a745;">(ك/غ)</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalSubscribers = 0; $totalMales = 0; $totalFemales = 0; $totalKuwaitiMales = 0; $totalNonKuwaitiMales = 0; $totalKuwaitiFemales = 0; $totalNonKuwaitiFemales = 0; $rowCount = 0; ?>
                        @foreach(\App\SubscriptionsName::get() as $val)
                            @foreach(\App\City::get() as $city)
                                <?php
                                $subscribersCount = \App\Subscription::where('city_id', $city->id)->where('name_id', $val->id)->where('number', $number)->count();
                                $maleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->count();
                                $femaleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->count();
                                $kuwaitiMales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', 1)->count();
                                $nonKuwaitiMales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', '!=', 1)->count();
                                $kuwaitiFemales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', 1)->count();
                                $nonKuwaitiFemales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', '!=', 1)->count();
                                $totalSubscribers += $subscribersCount; $totalMales += $maleCount; $totalFemales += $femaleCount; $totalKuwaitiMales += $kuwaitiMales; $totalNonKuwaitiMales += $nonKuwaitiMales; $totalKuwaitiFemales += $kuwaitiFemales; $totalNonKuwaitiFemales += $nonKuwaitiFemales; $rowCount++;
                                ?>
                                <tr>
                                    <td>{{$val->name_ar}}</td>
                                    <td>{{$city->name_ar}}</td>
                                    <td>{{$subscribersCount}}</td>
                                    <td>
                                        <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                            <span style="color: #28a745; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', '!=', 1)->count()}}</span>
                                            <strong>{{$maleCount}}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                            <span style="color: #28a745; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', '!=', 1)->count()}}</span>
                                            <strong>{{$femaleCount}}</strong>
                                        </div>
                                    </td>
                                </tr>
                                @if($rowCount % 6 == 0)
                                    <tr style="color:white;background-color:#369bdd">
                                        <th style="color:white;background-color:#369bdd">الاجمالي</th>
                                        <td></td>
                                        <td><strong style="color:white">{{$totalSubscribers}}</strong></td>
                                        <td>
                                            <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                                <span style="color: white; font-size: 11px;">{{$totalKuwaitiMales}}/{{$totalNonKuwaitiMales}}</span>
                                                <strong style="color:white">{{$totalMales}}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                                <span style="color: white; font-size: 11px;">{{$totalKuwaitiFemales}}/{{$totalNonKuwaitiFemales}}</span>
                                                <strong style="color:white">{{$totalFemales}}</strong>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $totalSubscribers = 0; $totalMales = 0; $totalFemales = 0; $totalKuwaitiMales = 0; $totalNonKuwaitiMales = 0; $totalKuwaitiFemales = 0; $totalNonKuwaitiFemales = 0; ?>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3 style="padding-right: 5px;">الاجمالي مسابقة {{$number}}</h3>
            <div class="table-wrapper">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{trans('web.category')}}</th>
                            <th>{{trans('web.subscriber')}}</th>
                            <th>{{trans('web.male_short')}} <span style="font-size: 11px; color: #28a745;">(ك/غ)</span></th>
                            <th>{{trans('web.female_short')}} <span style="font-size: 11px; color: #28a745;">(ك/غ)</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\SubscriptionsName::get() as $val)
                        <tr>
                            <td>{{$val->name_ar}}</td>
                            <td>{{\App\Subscription::where('name_id', $val->id)->where('number', $number)->count()}}</td>
                            <td>
                                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                    <span style="color: #28a745; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', '!=', 1)->count()}}</span>
                                    <strong style="color: #085d9e;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->count()}}</strong>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                    <span style="color: #28a745; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', '!=', 1)->count()}}</span>
                                    <strong style="color: red;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->count()}}</strong>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr style="background-color:#369bdd">
                            <th style="color:white">{{trans('web.grand_total')}}</th>
                            <td style="color:white">{{\App\Subscription::where('number', $number)->count()}}</td>
                            <td>
                                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                    <span style="color: white; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->where('users.nationality_id', '!=', 1)->count()}}</span>
                                    <strong style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->count()}}</strong>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                    <span style="color: white; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->where('users.nationality_id', '!=', 1)->count()}}</span>
                                    <strong style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->count()}}</strong>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 style="padding-right: 5px;">كويتي مسابقة {{$number}}</h3>
            <div class="table-wrapper">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{trans('web.category')}}</th>
                            <th>{{trans('web.subscriber')}}</th>
                            <th>{{trans('web.male_short')}}</th>
                            <th>{{trans('web.female_short')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\SubscriptionsName::get() as $val)
                        <tr>
                            <td>{{$val->name_ar}}</td>
                            <td>{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('users.nationality_id', 1)->where('subscriptions.number', $number)->count()}}</td>
                            <td>{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('users.nationality_id', 1)->where('subscriptions.number', $number)->where('users.gender', 'male')->count()}}</td>
                            <td>{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('users.nationality_id', 1)->where('subscriptions.number', $number)->where('users.gender', 'female')->count()}}</td>
                        </tr>
                        @endforeach
                        <tr style="background-color:#369bdd">
                            <th style="color:white">الاجمالي</th>
                            <td style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.nationality_id', 1)->where('subscriptions.number', $number)->count()}}</td>
                            <td style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.nationality_id', 1)->where('subscriptions.number', $number)->where('users.gender', 'male')->count()}}</td>
                            <td style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.nationality_id', 1)->where('subscriptions.number', $number)->where('users.gender', 'female')->count()}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 style="padding-right: 5px;">محافظات مسابقة {{$number}}</h3>
            <div class="table-wrapper">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>المحافظة</th>
                            <th>{{trans('web.category')}}</th>
                            <th>{{trans('web.male_short')}} <span style="font-size: 11px; color: #28a745;">(ك/غ)</span></th>
                            <th>{{trans('web.female_short')}} <span style="font-size: 11px; color: #28a745;">(ك/غ)</span></th>
                            <th>{{trans('web.subscriber')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalSubscribers = 0; $totalMales = 0; $totalFemales = 0; $totalKuwaitiMales = 0; $totalNonKuwaitiMales = 0; $totalKuwaitiFemales = 0; $totalNonKuwaitiFemales = 0; $rowCount = 0; $previousCity = ''; ?>
                        @foreach(\App\City::get() as $city)
                            @foreach(\App\SubscriptionsName::get() as $category)
                                <?php
                                $subscribersCount = \App\Subscription::where('city_id', $city->id)->where('name_id', $category->id)->where('number', $number)->count();
                                $maleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->count();
                                $femaleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->count();
                                $kuwaitiMales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', 1)->count();
                                $nonKuwaitiMales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', '!=', 1)->count();
                                $kuwaitiFemales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', 1)->count();
                                $nonKuwaitiFemales = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', '!=', 1)->count();
                                $totalSubscribers += $subscribersCount; $totalMales += $maleCount; $totalFemales += $femaleCount; $totalKuwaitiMales += $kuwaitiMales; $totalNonKuwaitiMales += $nonKuwaitiMales; $totalKuwaitiFemales += $kuwaitiFemales; $totalNonKuwaitiFemales += $nonKuwaitiFemales;
                                ?>
                                <tr>
                                    <td>@if($city->name_ar != $previousCity){{$city->name_ar}}@endif</td>
                                    <td>{{$category->name_ar}}</td>
                                    <td>
                                        <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                            <span style="color: #28a745; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->where('users.nationality_id', '!=', 1)->count()}}</span>
                                            <strong style="color: #085d9e;">{{$maleCount}}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                            <span style="color: #28a745; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.city_id', $city->id)->where('subscriptions.name_id', $category->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->where('users.nationality_id', '!=', 1)->count()}}</span>
                                            <strong style="color: red;">{{$femaleCount}}</strong>
                                        </div>
                                    </td>
                                    <td><strong>{{$subscribersCount}}</strong></td>
                                </tr>
                                <?php $previousCity = $city->name_ar; $rowCount++; if($rowCount % 4 == 0) { echo '<tr style="border-bottom: 2px solid black;background-color:#369bdd"><th style="color:white">الاجمالي</th><td style="color:white"></td><td><div style="display: flex; flex-direction: row-reverse; justify-content: space-between;"><span style="color: white; font-size: 11px;">' . $totalKuwaitiMales . '/' . $totalNonKuwaitiMales . '</span><strong style="color:white">' . $totalMales . '</strong></div></td><td><div style="display: flex; flex-direction: row-reverse; justify-content: space-between;"><span style="color: white; font-size: 11px;">' . $totalKuwaitiFemales . '/' . $totalNonKuwaitiFemales . '</span><strong style="color:white">' . $totalFemales . '</strong></div></td><td><strong style="color:white">' . $totalSubscribers . '</strong></td></tr>'; $totalSubscribers = 0; $totalMales = 0; $totalFemales = 0; $totalKuwaitiMales = 0; $totalNonKuwaitiMales = 0; $totalKuwaitiFemales = 0; $totalNonKuwaitiFemales = 0; } ?>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color:#0cc15d">
                            <th style="color:white">الاجمالي العام</th>
                            <td></td>
                            <td>
                                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                    <span style="color: white; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->where('users.nationality_id', '!=', 1)->count()}}</span>
                                    <strong style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->count()}}</strong>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between; align-items: center;">
                                    <span style="color: white; font-size: 11px; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->where('users.nationality_id', 1)->count()}}/{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->where('users.nationality_id', '!=', 1)->count()}}</span>
                                    <strong style="color:white">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->count()}}</strong>
                                </div>
                            </td>
                            <td><strong style="color:white">{{\App\Subscription::where('number', $number)->count()}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>


</main>
@endsection