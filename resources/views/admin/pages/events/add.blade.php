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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الفعاليات</a></li>
                        <li class="breadcrumb-item active">التحكم بالفعاليات</li>
                    </ol>
                    <h4 class="page-title">التحكم بالفعاليات</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">إضافة فعالية</h5>
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

                                    <div class="col-md-12">
                                        <label class="control-label">االعنوان (AR)</label>
                                        <div>
                                            <input class="form-control" type="text" name="name_ar" value="{{old('name_ar')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="control-label">االعنوان (EN)</label>
                                        <div>
                                            <input class="form-control" type="text" name="name_en" value="{{old('name_en')}}">
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
                                    <input type="file" id="input-file-max-fs" name="image" class="dropify" data-max-file-size="2M" data-default-file="" value="">
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin-bottom: 20px">
                            <div class="card-body">
                                <h5 class="card-title">التفعيل</h5>
                                <div class="switchery-demo">
                                    <input type="checkbox" name="active" data-plugin="switchery" data-color="#039cfd">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5>إضافة</h5>
                                <input class="btn btn-primary form-control" type="submit" name="" value="إضافة" />
                                <br><br>
                                <a class="btn btn-danger btn-block" href="{{url('/')}}/admin/events">رجوع</a>
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
