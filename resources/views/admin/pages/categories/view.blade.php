<?php

use Illuminate\Support\Facades\DB;
?>
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">التصنيفات</a></li>
                        <li class="breadcrumb-item active">عرض التصنيفات</li>
                    </ol>
                    <h4 class="page-title">عرض التصنيفات</h4>
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
                                <h4 class="header-title col-md-8">عرض التصنيفات</h4>
                                <div class="col-md-4 mr-auto text-right">
                                    <a href="{{url('/')}}/admin/categories/add" class="btn btn-icon btn-info">
                                        <i class="mdi mdi-plus"></i>
                                    </a>
                                    <button type="submit" name="box_delete" class="btn btn-icon btn-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>
                                                <div class="checkbox mb-2 checkbox-primary">
                                                    <input id="checkbox01" name="check_box" type="checkbox">
                                                    <label for="checkbox01">.</label>
                                                </div>
                                            </th>
                                            <th>اسم التصنيف</th>
                                            <th>التاريخ</th>
                                            <th>الحالة</th>
                                            <th class="text-center">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($data as $key => $val)
                                        <tr>
                                            <td class="text-center">
                                                <div class="checkbox mb-2 checkbox-primary">
                                                    <input class='custom-control-input' id="checkbox{{$key}}" type="checkbox" name="id[]" value="{{$val->id}}">
                                                    <label for="checkbox{{$key}}">.</label>
                                                </div>
                                            </td>

                                            <td>{{$val->name}}</td>
                                            <td>{{$val->date}}</td>

                                            <td>
                                                <span class="badge badge-success" @if ($val->active == "DEACTIVE") style="display:none" @endif>مفعل</span>
                                                <span class="badge badge-danger" @if ($val->active == "ACTIVE") style="display:none" @endif>غير مفعل</span>
                                            </td>

                                            <td class="text-center">

                                                <a href="{{url('/')}}/admin/categories/edit/{{$val->id}}" class="btn btn-icon btn-info">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <button data-action="{{url('/')}}/admin/categories/deactive/{{$val->id}}" type="submit" class="btn btn-icon btn-warning btn-deactive" @if($val->active == "DEACTIVE") style='display: none;' @endif>
                                                    <i class="mdi mdi-bell-off"></i>
                                                </button>

                                                <button type="submit" @if($val->active == "ACTIVE") style='display: none;' @endif data-action="{{url('/')}}/admin/categories/active/{{$val->id}}" class="btn btn-icon btn-success btn-active" >
                                                    <i class="mdi mdi-bell"></i>
                                                </button>

                                                <button id="btn-delete" data-action="{{url('/')}}/admin/categories/delete/{{$val->id}}" type="submit" class="btn btn-icon btn-danger btn-delete">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{$data->links()}}

                        </div><!-- end card-box -->
                    </div>
                    <!-- end col -->
                </div><!-- end row -->
            </form>


        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div>
<!-- End Page Content-->


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