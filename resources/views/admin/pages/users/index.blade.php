@extends('admin.index')
@section('content')
<!-- Page Content Start -->
<div class="content-page">

    <div class="content">
        <div class="container-fluid">
            <!-- Page title box -->
            <div class="page-title-box">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">المستخدمون</a></li>
                    <li class="breadcrumb-item active">عرض المستخدمون</li>
                </ol>
                <h4 class="page-title">عرض المستخدمون</h4>
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

                <div class="col-md-12">
                    <div class="card-box">
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="number" name="id" value="{{request('id')}}" placeholder="الرقم المدني">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="text" name="username" value="{{request('username')}}" placeholder="اسم المستخدم">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="text" name="first_name" value="{{request('first_name')}}" placeholder="الاسم الاول">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="text" name="last_name" value="{{request('last_name')}}" placeholder="اسم العائلة">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="number" name="mobile" value="{{request('mobile')}}" placeholder="رقم الهاتف">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="text" name="address" value="{{request('address')}}" placeholder="المحافظة">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="email" name="email" value="{{request('email')}}" placeholder="البريد الالكتروني">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="form-control" type="number" name="date" value="{{request('date')}}" placeholder="السنة">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <select class="form-control" name="type">
                                        <option value="">اختر نوع المستخدم</option>
                                        <option value="admin" {{request('type') == 'admin' ? 'selected' : ''}}>مدراء</option>
                                        <option value="user" {{request('type') == 'user' ? 'selected' : ''}}>متسابقون</option>
                                    </select>
                                </div>
                                 <div class="col-md-3 mt-3">
                                           <input class="form-control" type="number" name="number" value="{{ request('number') }}" placeholder="رقم المسابقة">

                                </div>
                                <div class="col-md-3 mt-3">
                                    <input class="btn btn-info" type="submit" value="فلترة">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card-box">

                        <div class="row" style="margin-bottom: 15px">
                            <h4 class="header-title col-md-8"> عرض المستخدمون ({{ $totalUsers }})</h4>
                            <div class="col-md-4 mr-auto text-right">
                                <a href="{{url('/')}}/admin/users/add" class="btn btn-icon btn-info">
                                    <i class="mdi mdi-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>
                                            #
                                        </th>
                                        <th>الاسم</th>
                                        <th>السنة</th>
                                        <th>التاريخ</th>
                                        <th>الحالة</th>
                                        <th>المسابقة</th>
                                        <th class="text-center">التحكم</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($data as $key => $val)
                                    <tr>
                                        <td class="text-center">
                                            {{$key + 1}}
                                        </td>
                                        <!--<td><a href="{{url('/')}}/admin/users/show/{{$val->id}}">{{$val->username}}</a></td>-->
<td>
    <a href="{{ url('/') }}/admin/users/show/{{ $val->id }}" 
       style="color: {{ $val->gender == 'female' ? 'red' : '#085d9e' }};font-weight: bold;">
       {{ $val->username }}
    </a>
</td>
                                        <td>{{ $val->created_at > '2024-12-01' ? 2025 : 2024 }}</td>
                                        <td>{{$val->created_at}}</td>

                                        <td>
                                            <span class="badge badge-success" @if ($val->active == "deactive") style="display:none" @endif>مفعل</span>
                                            <span class="badge badge-danger" @if ($val->active == "active") style="display:none" @endif>غير مفعل</span>
                                        </td>
                                         <td>
                    <input type="number" 
                           class="form-control subscription-number" 
                           data-user-id="{{$val->id}}" 
                           value="{{$val->subscription->number ?? ''}}" 
                           placeholder="رقم المسابقة">
                </td>

                                        <td class="text-center">

                                            <a href="https://wa.me/{{$val->mobile}}" target="_blank" class="btn btn-icon btn-success" title="واتس">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>

                                            <a href="{{url('/')}}/admin/users/show/{{$val->id}}" class="btn btn-icon btn-primary" title="معاينة">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{url('/')}}/admin/users/deny/{{$val->id}}" class="btn btn-icon btn-warning" title="الأجزاء الممنوعة">
                                                <i class="fas fa-minus-circle"></i>
                                            </a>

                                            <a href="{{url('/')}}/admin/users/edit/{{$val->id}}" class="btn btn-icon btn-info" title="تحرير">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>

                                            <button id="btn-delete" data-action="{{url('/')}}/admin/users/delete/{{$val->id}}" type="submit" class="btn btn-icon btn-danger btn-delete" title="حذف">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{$data->links()}}
                        <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.subscription-number').forEach(input => {
            input.addEventListener('keyup', function () {
                const userId = this.dataset.userId;
                const value = this.value;
                fetch("{{ url('/admin/users/update-subscription-number') }}", {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ user_id: userId, number: value })
})

                // fetch("{{ url('/admin/users/update-subscription-number') }}", {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //     },
                //     body: JSON.stringify({ user_id: userId, number: value })
                // })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Updated successfully');
                    } else {
                        console.error('Failed to update');
                    }
                })
                .catch(err => console.error('Error:', err));
            });
        });
    });
</script>

                    </div><!-- end card-box -->
                </div>
                <!-- end col -->
            </div><!-- end row -->

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