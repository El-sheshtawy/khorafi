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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">استيراد اكسل</a></li>
                        <li class="breadcrumb-item active">التحكم باستيراد اكسل</li>
                    </ol>
                    <h4 class="page-title">التحكم باستيراد اكسل</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">استيراد اكسل</h5>
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
                                        <label class="control-label">الملف</label>
                                        <div>
                                            <input class="form-control" type="file" name="file">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-body">
                                <h5>استيراد</h5>
                                <input class="btn btn-primary form-control" type="submit" name="" value="استيراد" />
                                <br><br>
                                <a class="btn btn-danger btn-block" href="{{url('/')}}/admin/subscriptions">رجوع</a>
                            </div>
                        </div>

                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->
@endsection