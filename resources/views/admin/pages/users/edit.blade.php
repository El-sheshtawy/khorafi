@extends('admin.index')
@section('content')

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
                                <h5 class="card-title">تعديل مستخدم</h5>
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
                                            <input class="form-control" type="email" name="email" value="{{$data->email}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الاسم الأول</label>
                                        <div>
                                            <input class="form-control" type="text" name="first_name" value="{{$data->first_name}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الاسم الثاني</label>
                                        <div>
                                            <input class="form-control" type="text" name="second_name" value="{{$data->second_name}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الاسم الثالث</label>
                                        <div>
                                            <input class="form-control" type="text" name="third_name" value="{{$data->third_name}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">اسم العائلة</label>
                                        <div>
                                            <input class="form-control" type="text" name="last_name" value="{{$data->last_name}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">كلمة المرور</label>
                                        <div>
                                            <input class="form-control" type="text" name="password" placeholder="كلمة المرور" value="{{$data->password}}" autocomplete="new-password" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">نوع الحساب</label>
                                        <div>
                                            <select class="form-control" name="type">
                                                <option value="admin" {{$data->type == 'admin' ? 'selected' : ''}}>إداري</option>
                                                <option value="user" {{$data->type == 'user' ? 'selected' : ''}}>مستخدم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الجنس</label>
                                        <div>
                                            <select class="form-control" name="gender">
                                                <option value="male" {{$data->gender == 'male' ? 'selected' : ''}}>ذكر</option>
                                                <option value="female" {{$data->gender == 'female' ? 'selected' : ''}}>أنثى</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الرقم المدني</label>
                                        <div>
                                            <input class="form-control" type="number" name="identify" value="{{$data->identify}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">رقم الهاتف</label>
                                        <div>
                                            <input class="form-control" type="number" name="mobile" value="{{$data->mobile ? $data->mobile : 0}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">رقم الهاتف الثاني</label>
                                        <div>
                                            <input class="form-control" type="number" name="mobile2" value="{{$data->mobile2 ? $data->mobile2 : 0}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">الجنسية</label>
                                        <div>
                                            <select class="form-control" name="nationality">
                                                <option value="">...</option>
                                                @foreach(\App\Nationality::where('active', 'active')->get() as $val)
                                                <option value="{{$val->id}}" {{$data->nationality_id == $val->id ? 'selected' : ''}}>{{$val->name_ar}}</option>
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
                                                <option value="{{$val->id}}" {{$data->city_id == $val->id ? 'selected' : ''}}>{{$val->name_ar}}</option>
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
                                                @foreach(\App\Region::get() as $val)
                                                <option value="{{$val->id}}" {{$data->region_id == $val->id ? 'selected' : ''}}>{{$val->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">تاريخ الميلاد</label>
                                        <div>
                                            <input class="form-control" type="date" name="birthday" value="{{$data->birthday}}" />
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
                                    <input type="file" id="input-file-max-fs" name="image" class="dropify" data-max-file-size="2M" data-default-file="{{url('/website/public/images/' . $data->image)}}" value="">
                                    <input type="hidden" name="old_image" value="{{$data->image}}">
                                </div>
                            </div>
                        </div>


                        <div class="card" style="margin-bottom: 20px">
                            <div class="card-body">
                                <h5 class="card-title">التفعيل</h5>
                                <div class="switchery-demo">
                                    <input type="checkbox" @if($data->active == "active") {{'checked'}} @endif name="active" data-plugin="switchery" data-color="#039cfd">
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h5>تعديل</h5>
                                <input type="hidden" name="action" value="" />
                                <input class="btn btn-primary form-control" type="submit" name="" value="تعديل" />
                                <br><br>
                                <a class="btn btn-danger btn-block" href="{{url('/')}}/admin/users">رجوع</a>
                            </div>
                        </div>

                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->
@endsection