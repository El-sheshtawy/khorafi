@extends('admin.index')
@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="card">
                <div class="card-body">
                    <br><br><br><br>
                    <h1 class="text-center" style="color: red;">أنت لا تمتلك الصلاحية</h1>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{url('/')}}/admin">العودة إلى الصفحة الرئيسية</a>
                    </div>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection