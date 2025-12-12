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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الإعدادات</a></li>
                            <li class="breadcrumb-item active">التحكم بالإعدادات</li>
                        </ol>
                        <h4 class="page-title">التحكم بالإعدادات</h4>
                    </div><!-- End page title box -->

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">تعديل الإعدادات</h5>
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

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card-box">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item"><a href="#home" data-toggle="tab"
                                                                aria-expanded="false" class="nav-link active"> الإعدادات
                                                                العامة</a></li>
                                                        <li class="nav-item"><a href="#profile" data-toggle="tab"
                                                                aria-expanded="true" class="nav-link">بيانات الاتصال</a>
                                                        </li>
                                                        <li class="nav-item"><a href="#messages" data-toggle="tab"
                                                                aria-expanded="false" class="nav-link">بيانات التواصل
                                                                الاجتماعي</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane show active" id="home">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">اسم الموقع</label>
                                                                    <input class="form-control" type="text"
                                                                        name="name" placeholder="اسم الموقع"
                                                                        value="{{ $data->name }}" />
                                                                    <br>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="control-label">السنة</label>
                                                                    <input class="form-control" type="numeric"
                                                                        name="year" placeholder="السنة"
                                                                        value="{{ $data->year }}" />
                                                                    <br>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="control-label">رقم المسابقة</label>
                                                                    <input class="form-control" type="numeric"
                                                                        name="number" placeholder="رقم المسابقة"
                                                                        value="{{ $data->number ?? '' }}" />
                                                                    <br>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="profile">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">ايميل الموقع</label>
                                                                    <input class="form-control" type="text"
                                                                        name="email" placeholder="ايميل الموقع"
                                                                        value="{{ $data->email }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="control-label">رقم الهاتف</label>
                                                                    <input class="form-control" type="number"
                                                                        name="mobile" placeholder="رقم الهاتف"
                                                                        value="{{ $data->mobile }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="control-label">رقم الهاتف 2</label>
                                                                    <input class="form-control" type="number"
                                                                        name="mobile2" placeholder="رقم الهاتف 2"
                                                                        value="{{ $data->mobile2 }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="messages">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Facebook</label>
                                                                    <input class="form-control" type="text"
                                                                        name="fb" placeholder="Facebook"
                                                                        value="{{ $data->fb }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Twitter</label>
                                                                    <input class="form-control" type="text"
                                                                        name="tw" placeholder="Twitter"
                                                                        value="{{ $data->tw }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Instagram</label>
                                                                    <input class="form-control" type="text"
                                                                        name="ig" placeholder="ig"
                                                                        value="{{ $data->ig }}" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- end card-box-->
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
                                        <input type="file" id="input-file-max-fs" name="image" class="dropify"
                                            data-max-file-size="2M"
                                            data-default-file="{{ url('/') }}/website/public/images/{{ $data->image }}"
                                            value="">
                                        <input type="hidden" name="old_image" value="{{ $data->image }}">
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="margin-bottom: 20px">
                                <div class="card-body">
                                    <h5 class="card-title">صورة الهيدر</h5>
                                    <div>
                                        <input type="file" id="input-file-max-fs" name="header_image" class="dropify"
                                            data-max-file-size="2M"
                                            data-default-file="{{ url('/') }}/website/public/images/{{ $data->header_image }}"
                                            value="">
                                        <input type="hidden" name="old_header_image" value="{{ $data->header_image }}">
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="margin-bottom: 20px">
                                <div class="card-body">
                                    <h5 class="card-title">فيديو السلايدر</h5>
                                    <div>
                                        <input type="file" name="slider_video" class="form-control" accept="video/*">
                                        <input type="hidden" name="old_slider_video" value="{{ $data->slider_video ?? '' }}">
                                        @if(!empty($data->slider_video))
                                        <video width="100%" controls style="margin-top: 10px;">
                                            <source src="{{ url('website/public/videos/' . $data->slider_video) }}" type="video/mp4">
                                        </video>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5>تعديل</h5>
                                    <input type="hidden" name="action" value="" />
                                    <input class="btn btn-primary form-control" type="submit" name=""
                                        value="تعديل" />
                                    <br><br>
                                    <a class="btn btn-danger btn-block" href="{{ url('/') }}/admin/config">رجوع</a>
                                </div>
                            </div>

                        </div>
                    </div><!-- end row -->
                </form>
            </div><!-- end container-fluid-->
        </div><!-- end contant-->
    </div><!-- End Page Content-->
@endsection
