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
            <h3 class="text-center mb-4">{{trans('web.total')}}: {{\App\Subscription::where('number', $number)->count()}}</h3>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #6c757d; color: white;">
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
                            <td><strong>{{\App\Subscription::where('name_id', $val->id)->where('number', $number)->count()}}</strong></td>
                            <td style="color: #085d9e; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'male')->count()}}</td>
                            <td style="color: red; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('subscriptions.name_id', $val->id)->where('subscriptions.number', $number)->where('users.gender', 'female')->count()}}</td>
                        </tr>
                        @endforeach
                        <tr style="background-color: #369bdd;">
                            <th style="color: white;">{{trans('web.grand_total')}}</th>
                            <td style="color: white; font-weight: bold;">{{\App\Subscription::where('number', $number)->count()}}</td>
                            <td style="color: white; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'male')->where('subscriptions.number', $number)->count()}}</td>
                            <td style="color: white; font-weight: bold;">{{\App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')->where('users.gender', 'female')->where('subscriptions.number', $number)->count()}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


</main>
@endsection