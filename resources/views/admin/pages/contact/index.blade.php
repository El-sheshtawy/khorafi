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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">تواصل معنا</a></li>
                        <li class="breadcrumb-item active">عرض تواصل معنا</li>
                    </ol>
                    <h4 class="page-title">عرض تواصل معنا</h4>
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
                                <h4 class="header-title col-md-8">عرض تواصل معنا</h4>
                                <div class="col-md-4 mr-auto text-right">
                                    
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="" class="table table-bordered nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>
                                                #
                                            </th>
                                            <th>اسم المستخدم</th>
                                            <th>الايميل</th>
                                            <th>التاريخ</th>
                                            <th>الحالة</th>
                                            <th class="text-center">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($data as $key => $val)

                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td>{{$val->name}}</td>
                                            <td>{{$val->email}}</td>
                                            <td>{{$val->created_at}}</td>
                                            <td>

                                                <span class="badge badge-success" @if ($val->active == 'pending') style="display:none" @endif>تم الرد</span>
                                                <span class="badge badge-warning" @if ($val->active == 'active') style="display:none" @endif>رسالة جديدة</span>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{url('/')}}/admin/contact/reply/{{$val->id}}" class="btn btn-icon btn-info">
                                                    <i class="dripicons-reply"></i>
                                                </a>

                                                <button data-action="{{url('/')}}/admin/contact/delete/{{$val->id}}" type="submit" class="btn btn-icon btn-danger btn-delete">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- end card-box -->
                    </div>
                    <!-- end col -->
                </div><!-- end row -->
            </form>
        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من عملية الحذف
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger delete-yes">حذف</button>
            </div>
        </div>
    </div>
</div>

@endsection