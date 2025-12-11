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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">تعديل بياناتي</a></li>
                        <li class="breadcrumb-item active">التحكم بتعديل بياناتي</li>
                    </ol>
                    <h4 class="page-title">التحكم بتعديل بياناتي</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">تعديل بياناتي</h5>
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
                                        <label class="control-label">الاسم الكامل</label>
                                        <div>
                                            <input class="form-control" type="text" name="username" placeholder="الاسم الكامل" value="{{auth()->guard('admin')->user()->username}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label">كلمة المرور</label>
                                        <div>
                                            <input class="form-control" type="text" name="password" placeholder="كلمة المرور" value="" />
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
                                    <input type="file" id="input-file-max-fs" name="image" class="dropify" data-max-file-size="2M" data-default-file="{{url('/')}}/images/{{auth()->guard('admin')->user()->image}}" value="{{auth()->guard('admin')->user()->image}}">
                                    <input type="hidden" name="old_image" value="{{auth()->guard('admin')->user()->image}}">
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h5>تعديل</h5>
                                <input type="hidden" name="action" value="" />
                                <input class="btn btn-primary form-control" type="submit" name="" value="تعديل" />
                            </div>
                        </div>

                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->
@endsection