<?php
$date = request('date') ? request('date') : $config->year;
?>
<div style="direction: rtl; text-align: center;">
    <h3>الاحصائيات</h3>
    <table style="direction: rtl; text-align: center; border-collapse: collapse; border: 2px solid #ccc; width: 100%;">
        <thead>
            <tr style="border: 2px solid #ccc;">
                <th scope="col">#</th>
                <th scope="col">اسم الفئة</th>
                <th scope="col">اسم المحافظة</th>
                <th scope="col">عدد الاشتراكات</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            ?>
            @foreach(\App\SubscriptionsName::get() as $val)
            @foreach(\App\City::get() as $city)
            <tr style="border: 2px solid #ccc;">
                <th scope="row">{{$i++}}</th>
                <td>{{$val->name_ar}}</td>
                <td>{{$city->name_ar}}</td>
                <td>{{\App\Subscription::where('city_id', $city->id)->where('name_id', $val->id)->where('date', $date)->count()}}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    <h3>الاجمالي</h3>
    <table style="direction: rtl; text-align: center; border-collapse: collapse; border: 2px solid #ccc; width: 100%;">
        <thead>
            <tr style="border: 2px solid #ccc;">
                <th scope="col">#</th>
                <th scope="col">اسم الفئة</th>
                <th scope="col">عدد الاشتراكات</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\SubscriptionsName::get() as $key => $val)
            <tr style="border: 2px solid #ccc;">
                <th scope="row">{{$key + 1}}</th>
                <td>{{$val->name_ar}}</td>
                <td>{{\App\Subscription::where('name_id', $val->id)->where('date', $date)->count()}}</td>
            </tr>
            @endforeach
            <tr style="border: 2px solid #ccc;">
                <th scope="row">الاجمالي</th>
                <td></td>
                <td scope="row">{{\App\Subscription::where('date', $date)->count()}}</td>
            </tr>
        </tbody>
    </table>
</div>