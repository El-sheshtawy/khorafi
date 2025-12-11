@if($id == 1)
<div class="sign__input-wrapper mb-10">
    <h5>{{trans('web.select_hizb')}}</h5>
    <div class="sign__input">
        <select name="hizb_number" class="form-control">
            <option value="">{{trans('web.select_hizb')}}</option>
            <option value="59">59</option>
            <option value="60">60</option>
        </select>
    </div>
</div>
@elseif($id == 2)
<div class="sign__input-wrapper mb-10">
    <h5>{{trans('web.select_part')}}</h5>
    <div class="sign__input">
        <select name="part_number1" class="form-control">
            <option value="">{{trans('web.select_part')}}</option>
            <?php
            for ($i = 1; $i <= 30; $i++) {
            ?>
                <option value="{{$i}}">{{$i}}</option>
            <?php
            }
            ?>
        </select>
    </div>
</div>
@elseif($id == 3)
<div class="row">
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number1" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number2" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number3" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
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
                <select name="part_number1" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number2" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number3" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number4" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sign__input-wrapper mb-10">
            <h5>{{trans('web.select_part')}}</h5>
            <div class="sign__input">
                <select name="part_number5" class="form-control ">
                    <option value="">{{trans('web.select_part')}}</option>
                    <?php
                    for ($i = 1; $i <= 30; $i++) {
                    ?>
                        <option value="{{$i}}">{{$i}}</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger">{{trans('web.error_select_subscription')}}</div>
@endif