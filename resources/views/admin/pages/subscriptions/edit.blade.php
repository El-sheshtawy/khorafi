@extends('admin.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Page Content Start -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <!-- Page title box -->
                <form class="" method="post" action="" enctype="multipart/form-data">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الاشتراكات</a></li>
                            <li class="breadcrumb-item active">التحكم بالاشتراكات</li>
                        </ol>
                        <h4 class="page-title">التحكم بالاشتراكات</h4>
                    </div><!-- End page title box -->

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">تعديل اشتراك</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            {{ csrf_field() }}
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

                                        <div class="col-md-12">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">اسم المستخدم</th>
                                                        <td style="color: blue;">{{ $data->user->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">الجنس</th>
                                                        <td>{{ $data->user->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">الجنسية</th>
                                                        <td>
    {{ optional(\App\Nationality::where('code', $data->user->nationality)->first())->name_ar ?? 'لا يوجد' }}
</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">العمر</th>
                                                        <td>{{ \App\User::age_ago($data->user->birthday) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">الفئة</th>
                                                        <td>{{ $data->s_name->name_ar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">سنة الاشتراك</th>
                                                        <td>{{ $data->date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">المسابقة</th>
                                                        <td>{{ $data->number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">الاختيارات</th>
                                                        <td>
                                                            <ul>
                                                                @foreach (\App\Selection::where('subscription_id', $data->id)->get() as $val)
                                                                    <li>{{ $val->options <= 30 ? 'الجزء ' : 'الحزب ' }}
                                                                        {{ $val->options }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">ملاحظات المستخدم</th>
                                                        <td>{{ $data->notes }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label">الدرجة</label>
                                            <div>
                                                <input class="form-control" type="text" name="degree"
                                                    value="{{ $data->degree }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label">المركز</label>
                                            <div>
                                                <input class="form-control" type="number" name="level"
                                                    value="{{ $data->level }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label">المركز (AR)</label>
                                            <div>
                                                <input class="form-control" type="text" name="level_ar"
                                                    value="{{ $data->level_ar }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label">المركز (EN)</label>
                                            <div>
                                                <input class="form-control" type="text" name="level_en"
                                                    value="{{ $data->level_en }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label">سنة الاشتراك</label>
                                            <div>
                                                <input class="form-control" type="number" name="date"
                                                    value="{{ $data->date }}">
                                            </div>
                                        </div>
<div class="col-md-6">
                                            <label class="control-label">رقم المسابقة</label>
                                            <div>
                                                <input class="form-control" type="number" name="number"
                                                    value="{{ $data->number}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="control-label">ملاحطات للآدمن</label>
                                            <div>
                                                <textarea class="form-control" name="admin_notes" cols="30" rows="7">{{ $data->admin_notes }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label class="control-label">ملاحطات للمستخدم</label>
                                            <div>
                                                <textarea class="form-control" name="user_notes" cols="30" rows="7">{{ $data->user_notes }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label class="control-label">الفئة</label>
                                            <div>
                                                <select class="form-control change-select-subscription-type" name="type">
                                                    @foreach (\App\SubscriptionsName::get() as $val)
                                                        <option value="{{ $val->id }}"
                                                            {{ $val->id == $data->name_id ? 'selected' : '' }}>
                                                            {{ $val->name_ar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <input class="user-identify" type="hidden" value="{{ $data->user_id }}">

                                        <div class="col-md-12">
                                            <div class="result-select-subscription-type">
                                                @if ($data->name_id == 1)
                                                    <div class="sign__input-wrapper mb-10">
                                                        <h5>اختر الحزب</h5>
                                                        <div class="sign__input">
                                                            <select name="hizb_number" class="form-control">
                                                                <option value="">اختر الحزب</option>
                                                                <option value="59"
                                                                    {{ \App\Selection::where('subscription_id', $data->id)->first()->options == 59 ? 'selected' : '' }}>
                                                                    59</option>
                                                                <option value="60"
                                                                    {{ \App\Selection::where('subscription_id', $data->id)->first()->options == 60 ? 'selected' : '' }}>
                                                                    60</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @elseif($data->name_id == 2)
                                                    <div class="sign__input-wrapper mb-10">
                                                        <h5>اختر الجزء</h5>
                                                        <div class="sign__input">
                                                            <select name="part_number1" class="form-control">
                                                                <option value="">اختر الجزء</option>
                                                                <?php
                                                        for ($i = 1; $i <= 30; $i++) {
                                                        ?>
                                                                <option value="{{ $i }}"
                                                                    {{ \App\Selection::where('subscription_id', $data->id)->first()->options == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                                <?php
                                                        }
                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach (\App\Selection::where('subscription_id', $data->id)->get() as $key => $val)
                                                        <div class="sign__input-wrapper mb-10">
                                                            <h5>اختر الجزء</h5>
                                                            <div class="sign__input">
                                                                <select name="part_number{{ $key + 1 }}"
                                                                    class="form-control">
                                                                    <option value="">اختر الجزء</option>
                                                                    <?php
                                                        for ($i = 1; $i <= 30; $i++) {
                                                        ?>
                                                                    <option value="{{ $i }}"
                                                                        {{ $val->options == $i ? 'selected' : '' }}>
                                                                        {{ $i }}</option>
                                                                    <?php
                                                        }
                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                        <div class="col-md-4">

                            <div class="card" style="margin-bottom: 20px">
                                <div class="card-body">
                                    <h5 class="card-title">فائز</h5>
                                    <div class="switchery-demo">
                                        <input type="checkbox"
                                            @if ($data->winner == 1) {{ 'checked' }} @endif name="winner"
                                            data-plugin="switchery" data-color="#039cfd">
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="margin-bottom: 20px">
                                <div class="card-body">
                                    <h5 class="card-title">التفعيل</h5>
                                    <div class="switchery-demo">
                                        <input type="checkbox"
                                            @if ($data->active == 'active') {{ 'checked' }} @endif name="active"
                                            data-plugin="switchery" data-color="#039cfd">
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5>تعديل</h5>
                                    <input class="btn btn-primary form-control" type="submit" name=""
                                        value="تعديل" />
                                    <br><br>
                                    <button type="button" class="btn btn-danger btn-block" onclick="deleteSubscription({{ $data->id }})">حذف الاشتراك</button>
                                    <br>
                                    <a class="btn btn-secondary btn-block"
                                        href="{{ url('/') }}/admin/subscriptions">رجوع</a>
                                </div>
                            </div>

                        </div>
                    </div><!-- end row -->
                </form>
            </div><!-- end container-fluid-->
        </div><!-- end contant-->
    </div><!-- End Page Content-->

<script>
function deleteSubscription(id) {
    if (!confirm('هل أنت متأكد من حذف هذا الاشتراك؟')) return;
    
    $.ajax({
        url: '{{ url("/admin/subscriptions/delete") }}/' + id,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                window.location.href = '{{ url("/admin/subscriptions") }}';
            }
        },
        error: function(xhr) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}
</script>
@endsection
