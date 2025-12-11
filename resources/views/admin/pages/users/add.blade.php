@extends('admin.index')
@section('content')
<style>
    .d-hidden {
        display: none;
    }
</style>
<!-- Page Content Start -->
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Page title box -->
            <form class="" method="post" action="" enctype="multipart/form-data">
                <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">المستخدمون</a></li>
                        <li class="breadcrumb-item active">التحكم بالمستخدمون</li>
                    </ol>
                    <h4 class="page-title">التحكم بالمستخدمون</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">إضافة مستخدم</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
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

                                    <div class="col-md-6">
                                        <label class="control-label">البريد الالكتروني</label>
                                        <div>
                                            <input class="form-control" type="email" name="email" value="{{old('email')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الاسم الأول</label>
                                        <div>
                                            <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الاسم الثاني</label>
                                        <div>
                                            <input class="form-control" type="text" name="second_name" value="{{old('second_name')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الاسم الثالث</label>
                                        <div>
                                            <input class="form-control" type="text" name="third_name" value="{{old('third_name')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">اسم العائلة</label>
                                        <div>
                                            <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">كلمة المرور</label>
                                        <div>
                                            <input class="form-control" type="text" name="password" placeholder="كلمة المرور" value="" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">نوع الحساب</label>
                                        <div>
                                            <select class="form-control" name="type">
                                                <option value="admin">إداري</option>
                                                <option value="user">مستخدم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الجنس</label>
                                        <div>
                                            <select class="form-control" name="gender">
                                                <option value="male">ذكر</option>
                                                <option value="female">أنثى</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الرقم المدني</label>
                                        <div>
                                            <input class="form-control" type="number" name="identify" value="{{old('identify')}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">رقم الهاتف</label>
                                        <div>
                                            <input class="form-control" type="number" name="mobile" value="{{old('mobile') ? old('mobile') : 0}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">رقم الهاتف الثاني</label>
                                        <div>
                                            <input class="form-control" type="number" name="mobile2" value="{{old('mobile2') ? old('mobile2') : 0}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الجنسية</label>
                                        <div>
                                            <select class="form-control" name="nationality">
                                                <option value="">...</option>
                                                @foreach(\App\Nationality::where('active', 'active')->get() as $val)
                                                <option value="{{$val->id}}" {{old('nationality') == $val->id ? 'selected' : ''}}>{{$val->name_ar}}</option>
                                                @endforeach
                                            </select>
                                            <?php /*
                                            <input class="form-control" type="text" name="nationality" value="{{old('nationality')}}" />
                                            */ ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">المحافظة</label>
                                        <div>
                                            <select class="form-control" name="city" id="change-city-register-page">
                                                <option value="0">...</option>
                                                @foreach(\App\City::where('active', 'active')->get() as $val)
                                                <option value="{{$val->id}}" {{old('city') == $val->id ? 'selected' : ''}}>{{$val->name_ar}}</option>
                                                @endforeach
                                            </select>
                                            <?php /*
                                            <input class="form-control" type="text" name="address" value="{{old('address')}}" />
                                            */ ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">المنطقة</label>
                                        <div class="" id="result-change-city-register-page">
                                            <select class="form-control" name="region">
                                                <option value="">...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">تاريخ الميلاد</label>
                                        <div>
                                            <input class="form-control" type="date" name="birthday" value="{{old('birthday')}}" />
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
                                <h5 class="card-title">الصورة</h5>
                                <div>
                                    <input type="file" id="input-file-max-fs" name="image" class="dropify" data-max-file-size="2M" data-default-file="../files/images/" value="">
                                    <input type="hidden" name="old_image" value="">
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin-bottom: 20px">
                            <div class="card-body">
                                <h5 class="card-title">التفعيل</h5>
                                <div class="switchery-demo">
                                    <input type="checkbox" name="active" {{old('active') ? 'checked' : ''}} data-plugin="switchery" data-color="#039cfd">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5>إضافة</h5>
                                <input class="btn btn-primary form-control" type="submit" value="إضافة" />
                                <br><br>
                                <a class="btn btn-danger btn-block" href="{{url('/')}}/admin/users">رجوع</a>
                            </div>
                        </div>

                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div>
<!-- End Page Content-->
@endsection