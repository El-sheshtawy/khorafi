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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الأخبار</a></li>
                        <li class="breadcrumb-item active">التحكم بالأخبار</li>
                    </ol>
                    <h4 class="page-title">التحكم بالأخبار</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">تعديل خبر</h5>
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
                                        <label class="control-label">الخبر (AR)</label>
                                        <div>
                                            <input class="form-control" type="text" name="name_ar" value="{{$data->name_ar}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="control-label">الخبر (EN)</label>
                                        <div>
                                            <input class="form-control" type="text" name="name_en" value="{{$data->name_en}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="control-label">النوع</label>
                                        <div>
                                            <select class="form-control" name="type">
                                                <option value="0" {{$data->type == 0 ? 'selected' : ''}}>أخبار المسابقة</option>
                                                <option value="1" {{$data->type == 1 ? 'selected' : ''}}>قالو عن المسابقة</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="control-label">الرابط</label>
                                        <div>
                                            <input class="form-control" type="url" name="url" value="{{$data->url}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="control-label">االتفاصيل (AR)</label>
                                        <div>
                                            <textarea class="form-control" name="body_ar" cols="30" rows="7">{{$data->body_ar}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="control-label">االتفاصيل (EN)</label>
                                        <div>
                                            <textarea class="form-control" name="body_en" cols="30" rows="7">{{$data->body_en}}</textarea>
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
                                <a class="btn btn-danger btn-block" href="{{url('/')}}/admin/posts">رجوع</a>
                            </div>
                        </div>

                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->
@endsection