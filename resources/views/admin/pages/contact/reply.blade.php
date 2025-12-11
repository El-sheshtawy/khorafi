@extends('admin.index')
@section('content')
<!-- Page Content Start -->
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Page title box -->
            <form class="" method="post" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">تواصل معنا</a></li>
                        <li class="breadcrumb-item active">التحكم بتواصل معنا</li>
                    </ol>
                    <h4 class="page-title">التحكم بتواصل معنا</h4>
                </div><!-- End page title box -->

                <div class="row">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">تواصل معنا</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
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
                                    <table class="table table-bordered">
                                        <thead></thead>
                                        <tbody>
                                            <tr>
                                                <td>الاسم</td>
                                                <td>{{$data->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>الايميل</td>
                                                <td>{{$data->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>الرسالة</td>
                                                <td>{{$data->message}}</td>
                                            </tr>
                                            @if($data->active == "active")
                                            <tr>
                                                <td>الرد</td>
                                                <td>
                                                    <div><?=$data->reply?></div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        @if($data->active == "pending")
                        <div class="card" style="margin-top: 20px">
                            <div class="card-body">
                                <h5 class="card-title">تواصل معنا</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="cke" class="cke" name="reply">{{$data->reply}}</textarea>
                                        <input type="hidden" name="email" value="{{$data->email}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-body">
                                <h5>الرد</h5>
                                @if($data->active == "pending")
                                <input class="btn btn-primary form-control" type="submit" name="" value="الرد" />
                                @endif
                                <br><br>
                                <a class="btn btn-danger btn-block" href="{{url('/')}}/admin/contact">رجوع</a>
                            </div>
                        </div>

                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->
@endsection