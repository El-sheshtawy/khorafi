@extends('admin.index')
@section('content')
<!-- Page Content Start -->
<div class="content-page">

    <div class="content">
        <div class="container-fluid">
            <!-- Page title box -->
            <form action="" method="post">
                {{csrf_field()}}
                <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">بيانات المستخدم</a></li>
                        <li class="breadcrumb-item active">عرض بيانات المستخدم</li>
                    </ol>
                    <h4 class="page-title">عرض بيانات المستخدم</h4>
                </div><!-- End page title box -->
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


                    <div class="col-12">
                        <div class="card-box">

                            <div class="row" style="margin-bottom: 15px">
                                <h4 class="header-title col-md-8">عرض بيانات المستخدم</h4>
                                <div class="col-md-4 mr-auto text-right">
                                </div>
                            </div>

                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>اسم المستخدم</th>
                                        <td style="color: blue;">{{$data->username}}</td>
                                    </tr>
                                    <tr>
                                        <th>البريد الاكتروني</th>
                                        <td>{{$data->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>كلمة المرور</th>
                                        <td>{{$data->password}}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم الهاتف</th>
                                        <td>{{$data->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم الهاتف الثاني</th>
                                        <td>{{$data->mobile2}}</td>
                                    </tr>

                                    <tr>
                                        <th>نوع الحساب</th>
                                        <td>
                                            @if($data->type == 'admin')
                                            إداري
                                            @else
                                            مستخدم عادي
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>الرقم المدني</th>
                                        <td>{{$data->identify}}</td>
                                    </tr>

                                    <tr>
                                        <th>الجنس</th>
                                        <td>{{$data->gender == 'male' ? 'ذكر' : 'أنثى'}}</td>
                                    </tr>

                                    <tr>
                                        <th>الجنسية</th>
                                        <td>{{$data->nationality}}</td>
                                    </tr>

                                    <tr>
                                        <th>تاريخ الميلاد</th>
                                        <td>{{$data->birthday}}</td>
                                    </tr>

                                    <tr>
                                        <th>العنوان</th>
                                        <td>{{$data->address}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="{{url('admin/users')}}" class="btn btn-danger btn-block">رجوع</a>

                        </div><!-- end card-box -->

                    </div>
                    <!-- end col -->
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->

@endsection