@php
    $config = DB::table('config')->first();
    $subscription = \App\Subscription::where('user_id', $user->id)->where('number', $config->number)->first();
    $selections = $subscription ? \App\Selection::where('subscription_id', $subscription->id)->pluck('options')->toArray() : [];
@endphp

@if($id == 1)
<div class="sign__input-wrapper mb-10">
    <h5>{{trans('web.select_hizb')}}</h5>
    <div class="sign__input">
        <select name="hizb_number" class="form-select change-select-subscription-type">
            <option value="">{{trans('web.select_hizb')}}</option>
            @for($i = 1; $i <= 60; $i++)
            @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'hizb')->where('options', $i)->where('active', 'active')->first()))
            <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
            @endif
            @endfor
        </select>
    </div>
</div>
@elseif($id == 2)
<div class="sign__input-wrapper mb-10">
    <h5>{{trans('web.select_part')}}</h5>
    <div class="sign__input">
        <select name="part_number" class="form-select change-select-subscription-type">
            <option value="">{{trans('web.select_part')}}</option>
            @for($i = 1; $i <= 30; $i++)
                @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                @endif
            @endfor
        </select>
    </div>
</div>
@elseif($id == 3)
<div class="row">
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number1" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number2" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number3" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
</div>
@elseif($id == 4)
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number1" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number2" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number3" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number4" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number5" class="form-select change-select-subscription-type">
                    <option value="">{{trans('web.select_part')}}</option>
                    @for($i = 1; $i <= 30; $i++)
                        @if(empty(\App\UsersPrevent::where('user_id', $user->id)->where('type', 'part')->where('options', $i)->where('active', 'active')->first()))
                        <option value="{{$i}}" {{ in_array($i, $selections) ? 'selected' : '' }}>{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger">{{trans('web.error_select_subscription')}}</div>
@endif