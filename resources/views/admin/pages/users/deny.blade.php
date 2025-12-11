@extends('admin.index')
@section('content')
<style>
    hr {
        border-top: 3px solid #ccc
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الممنوعات للحجز</a></li>
                        <li class="breadcrumb-item active">التحكم بالممنوعات للحجز</li>
                    </ol>
                    <h4 class="page-title">التحكم بالممنوعات للحجز</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">تعديل </h5>
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
                                        <div class="row">
                                            @foreach($data as $key => $val)
                                            @if($val->type == 'part') 
                                            <div class="col-md-3 mt-3">
                                                <h5 class="card-title">الجزء {{$val->options}}</h5>
                                                <div class="switchery-demo">
                                                    <input type="checkbox" @if($val->active == 'active') checked @endif name="part{{$val->options}}" data-plugin="switchery" data-color="#039cfd">
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-3 mt-3">
                                                <h5 class="card-title">الحزب {{$val->options}}</h5>
                                                <div class="switchery-demo">
                                                    <input type="checkbox" @if($val->active == 'active') checked @endif name="hizb{{$val->options}}" data-plugin="switchery" data-color="#039cfd">
                                                </div>
                                            </div> 
                                            @endif

                                        @endforeach
                                    </div>
                                    <hr>
                                </div>

                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5>تعديل</h5>
                                    <input type="hidden" name="action" value="" />
                                    <input class="btn btn-primary form-control" type="submit" name="" value="تعديل" />
                                    <br><br>
                                    <a class="btn btn-danger btn-block" href="{{url('admin/users')}}">رجوع</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                </div>

        </div><!-- end row -->
        </form>
    </div><!-- end container-fluid-->
</div><!-- end contant-->
</div><!-- End Page Content-->
@endsection