@extends('index')
@section('web')
<?php
if (!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
    $name = "name_en";
    $body = "body_en";
    $level = "level_en";
} else {
    $name = "name_ar";
    $body = "body_ar";
    $level = "level_ar";
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
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('web.results_tests')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <h5 class="page__title-3">{{trans('web.results_tests')}}</h5>
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
                    <input class="form-control" type="number" name="identify" value="{{request('identify')}}" placeholder="{{trans('web.username')}}">
                </div>
                <div class="col-md-2 mt-3">
                    <input class="form-control" type="number" name="date" placeholder="{{trans('web.subscription_date')}}" value="{{request('date')}}">
                </div>
                <div class="col-md-2 mt-3">
                    <select class="form-control" name="name_id">
                        <option value="">{{trans(('web.select_class'))}}</option>
                        @foreach(\App\SubscriptionsName::get() as $val)
                        <option value="{{$val->id}}" {{request('name_id') == $val->id ? 'selected' : ''}}>{{$val->$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mt-3">
                    <select class="form-control" name="winner">
                        <option value="">{{trans(('web.search_type'))}}</option>
                        <option value="1" {{request('winner') == 1 ? 'selected' : ''}}>{{trans('web.winners')}}</option>
                        <option value="2" {{request('winner') == 2 ? 'selected' : ''}}>{{trans('web.all')}}</option>
                    </select>
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{trans('web.username')}}</th>
                            <th scope="col">{{trans('web.class_name')}}</th>
                            <th scope="col">{{trans('web.subscription_date')}}</th>
                            <th scope="col">{{trans('web.degree')}}</th>
                            <th scope="col">{{trans('web.level')}}</th>
                            <th scope="col">{{trans('web.winners')}}</th>
                            <th scope="col">{{trans('web.notes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $val)
                        @if(!empty($val->user->username))
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td style="color: blue;">{{$val->user->username}}</td>
                            <td>{{$val->s_name->$name}}</td>
                            <td>{{$val->date}}</td>
                            <td>{{$val->degree}}</td>
                            <td>{{$val->$level}}</td>
                            <td>
                                @if($val->winner == 1)
                                <span class="btn btn-success">{{trans('web.winner')}}</span>
                                @else
                                <span class="btn btn-danger">{{trans('web.no_winner')}}</span>
                                @endif
                            </td>
                            <td>{{$val->user_notes}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$data->links()}}
        </div>
    </section>
    <!-- blog area end -->


</main>
@endsection