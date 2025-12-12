<?php

use Illuminate\Support\Facades\DB;

?>
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('admin.index')
@section('content')
    <!-- Page Content Start -->
    <div class="content-page">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

//  document.addEventListener('DOMContentLoaded', function () {
//             const sortButtons = document.querySelectorAll('#sortAsc, #sortDesc');

//             // Checkboxes for each row
//             const deleteSelectedButton = document.getElementById('deleteSelectedButton');
//             const checkboxes = document.querySelectorAll('.rowCheckbox');
            
//             // Show/hide delete button based on checkbox selection
//             checkboxes.forEach(checkbox => {
//                 checkbox.addEventListener('change', () => {
//                     const anySelected = Array.from(checkboxes).some(checkbox => checkbox.checked);
                   
//                 });
//             });

//             deleteSelectedButton.addEventListener('click', function() {
//                 const selectedIds = Array.from(checkboxes)
//                     .filter(checkbox => checkbox.checked)
//                     .map(checkbox => checkbox.dataset.id);
                 
//                 // Make AJAX request to remove the selected subscriptions
//                 $.ajax({
//                     url: '/admin/subscriptions/delete-selected',
//                     type: 'POST',
//                     data: {
//                         ids: selectedIds,
//                         _token: $('meta[name="csrf-token"]').attr('content')
//                     },
//                     success: function(response) {
//                         if (response.success) {
//                             alert(response.message);
//                             // Reload the page to reflect the changes
//                             location.reload();
//                         } else {
//                             alert(response.message);
//                         }
//                     },
//                     error: function() {
//                         alert('Error deleting selected rows. Please try again.');
//                     }
//                 });
//             });
//         });




  document.addEventListener('DOMContentLoaded', function () {
    const sortButtons = document.querySelectorAll('#sortAsc, #sortDesc');

    if (sortButtons.length === 0) {
        console.error("Sort buttons not found.");
        return;
    }

    sortButtons.forEach(button => {
        button.addEventListener('click', function () {
            const order = this.getAttribute('data-order');
            const url = new URL(window.location.href);
            url.searchParams.set('type', 'created_at');
            url.searchParams.set('order_type', order);
            window.location.href = url.toString();
        });
    });
});
// Assuming you're using jQuery for simplicity
document.addEventListener('DOMContentLoaded', function () {
    const usernameSortAscButton = document.getElementById('sortUsernameAsc');
    const usernameSortDescButton = document.getElementById('sortUsernameDesc');

    if (!usernameSortAscButton || !usernameSortDescButton) {
        console.error("Username sort buttons not found.");
        return;
    }

    usernameSortAscButton.addEventListener('click', function () {
        sortTableByUsername('asc');
    });

    usernameSortDescButton.addEventListener('click', function () {
        sortTableByUsername('desc');
    });

    function sortTableByUsername(order) {
        const table = document.getElementById('dataTable');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        if (!rows.length) {
            console.warn("No rows found to sort.");
            return;
        }

        // Sort rows based on the "اسم المستخدم" column
        rows.sort((rowA, rowB) => {
            const usernameA = rowA.querySelector('td:nth-child(2)').textContent.trim();
            const usernameB = rowB.querySelector('td:nth-child(2)').textContent.trim();

            if (order === 'asc') {
                return usernameA.localeCompare(usernameB);
            } else {
                return usernameB.localeCompare(usernameA);
            }
        });

        // Clear existing rows and append sorted rows
        tbody.innerHTML = '';
        rows.forEach(row => tbody.appendChild(row));
    }
});

function deleteSubscription(subscriptionId) {
    $.ajax({
        url: '/admin/subscriptions/delete/' + subscriptionId,
        type: 'DELETE',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function(response) {
            if (response.success) {
                alert(response.message); // Show success message
                document.getElementById('fetchSubscriptionsBtn').click();
               // location.reload(); // Reload the page
            } else {
                alert(response.message); // Show error message
            }
        },
        error: function(xhr, status, error) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fetchSubscriptionsBtn').addEventListener('click', function() {
        const filters = new URLSearchParams(window.location.search);

        // Send the AJAX request
        fetch(`{{ url('/') }}/admin/subscriptions/fetch`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('subscriptionsTableBody');
                const subscriptionCount = document.getElementById('subscriptionCount');
                subscriptionCount.textContent = data.count;
                tableBody.innerHTML = ''; // Clear the existing rows

                data.data.forEach((val, index) => {
                    
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        
                        <td class="text-center">
                                             ${index + 1}
                                            </td>
                        <td style="color: ${val.gender === 'female' ? 'red' : '#085d9e'}; font-weight: bold;">${val.username}</td>
                        <td>${val.gender === 'male' ? 'ذكر' : 'أنثى'}</td>
                        <td>${val.identify}</td>
                        <td><a href="https://wa.me/${val.mobile}" target="_blank">${val.mobile}</a></td>
                        <td class="text-center">${val.name_ar}</td>
                        <td class="text-center">${val.created_at}</td>
                        <td class="text-center">${val.date}</td>
                        <td class="text-center">${val.number ?? '-'}</td>
                        <td class="text-center">${val.level}</td>
                        <td class="text-center">${val.degree}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="deleteSubscription(${val.id})" class="btn btn-icon btn-danger" title="حذف الاشتراك">
                            <i class="mdi mdi-delete"></i>
                            </a>

                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching subscriptions:', error));
    });
});

$(document).ready(function() {
    // Sorting for السنة
    $('#sortYearAsc').click(function() {
        sortTable(7, 'asc');  // 7 is the index for "السنة"
    });
    $('#sortYearDesc').click(function() {
        sortTable(7, 'desc');
    });

    // Sorting for المسابقة
    $('#sortCompetitionAsc').click(function() {
        sortTable(8, 'asc');  // 8 is the index for "المسابقة"
    });
    $('#sortCompetitionDesc').click(function() {
        sortTable(8, 'desc');
    });

    // Sorting for المركز
    $('#sortRankAsc').click(function() {
        sortTable(9, 'asc');  // 9 is the index for "المركز"
    });
    $('#sortRankDesc').click(function() {
        sortTable(9, 'desc');
    });

    // Sorting for الدرجة
    $('#sortGradeAsc').click(function() {
        sortTable(10, 'asc');  // 10 is the index for "الدرجة"
    });
    $('#sortGradeDesc').click(function() {
        sortTable(10, 'desc');
    });

    function sortTable(columnIndex, order) {
        var table = $('table'); // Assuming the table element
        var rows = table.find('tr:gt(0)').toArray(); // Get all table rows except the header

        rows.sort(function(a, b) {
            var cellA = $(a).find('td').eq(columnIndex).text().trim();
            var cellB = $(b).find('td').eq(columnIndex).text().trim();

            // Handle sorting by numeric or text values
            if ($.isNumeric(cellA) && $.isNumeric(cellB)) {
                return (order === 'asc') ? cellA - cellB : cellB - cellA;
            } else {
                return (order === 'asc') ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
            }
        });

        $.each(rows, function(index, row) {
            table.append(row); // Re-append the rows in the sorted order
        });
    }
});

</script>

        <div class="content">
            <div class="container-fluid">
                <!-- Page title box -->
                <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">الاشتراكات</a></li>
                        <li class="breadcrumb-item active">عرض الاشتراكات</li>
                    </ol>
                   <button id="fetchSubscriptionsBtn" style="background: none; border: none; cursor: pointer;">عرض الاشتراكات</button>

                    <!--<h4 class="page-title">عرض الاشتراكات</h4>-->
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
                                        <input class="form-control" type="number" name="id"
                                            value="{{ request('id') }}" placeholder="الرقم المدني">
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input class="form-control" type="text" name="username"
                                            value="{{ request('username') }}" placeholder="اسم المستخدم">
                                    </div>
                                    <!-- <div class="col-md-3 mt-3">
                                            <input class="form-control" type="email" name="email" value="{{ request('email') }}" placeholder="البريد الالكتروني">
                                        </div> -->
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="nationality_id">
                                            <option value="">اختر الجنسية</option>
                                            @foreach (\App\Nationality::get() as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ request('nationality_id') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="name_id">
                                            <option value="">اختر الفئة</option>
                                            @foreach (\App\SubscriptionsName::get() as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ request('name_id') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="type">
                                            <option value="">نوع الترتيب</option>
                                            <option value="winner" {{ request('type') == 'winner' ? 'selected' : '' }}>
                                                الفائزون</option>
                                            <option value="name_id" {{ request('type') == 'name_id' ? 'selected' : '' }}>
                                                الفئة</option>
                                            <option value="level" {{ request('type') == 'level' ? 'selected' : '' }}>
                                                المركز</option>
                                            <option value="degree" {{ request('type') == 'degree' ? 'selected' : '' }}>
                                                الدرجة</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="winner">
                                            <option value="">اختر نوع الفائزون</option>
                                            <option value="1" {{ request('winner') == '1' ? 'selected' : '' }}>
                                                الفائزون</option>
                                            <option value="2" {{ request('winner') == '2' ? 'selected' : '' }}>الغير
                                                فائزون</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3 pt-2">
                                        <input name='subscrition' type='checkbox' {{!empty(request('subscrition')) ? 'checked' : ''}} />
                                        المشاركون
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="gender">
                                            <option value="">اخترا الجنس</option>
                                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>ذكر
                                            </option>
                                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>
                                                أنثى</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="city_id">
                                            <option value="">اخترا المحافظة</option>
                                            @foreach (\App\City::get() as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ request('city_id') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="order_type">
                                            <option value="">طريقة الترتيب</option>
                                            <option value="asc" {{ request('order_type') == 'asc' ? 'selected' : '' }}>
                                                تصاعدي</option>
                                            <option value="desc" {{ request('order_type') == 'desc' ? 'selected' : '' }}>
                                                تنازلي</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input class="form-control" type="number" placeholder="السنة" name="date"
                                            value="{{ request('date') }}">
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input type="text" class="form-control" name="number" placeholder="رقم المسابقة"
                                            value="{{ request('number') }}">
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
                                <!--<h4 class="header-title col-md-8">عرض الاشتراكات ({{ $count }})</h4>-->
                                <h4 class="header-title col-md-8">
    عرض الاشتراكات (<span id="subscriptionCount">{{ $count }}</span>)
</h4>

                                <div class="col-md-4 mr-auto text-right">
                                    <a href="{{ url('admin/subscriptions/excel/export?' . $_SERVER['QUERY_STRING']) }}"
                                        class="btn btn-icon btn-info">
                                        <i class="fas fa-print"></i> تصدير اكسل
                                    </a>
                                    <a href="{{ url('admin/subscriptions/excel/import') }}"
                                        class="btn btn-icon btn-success">
                                        <i class="mdi mdi-plus"></i> استيراد اكسل
                                    </a>
                                </div>
                            </div>
<div>
                        <button id="deleteSelectedButton" style="display:none;" class="btn btn-danger">حذف المحدد</button>
                    </div>
                            <div class="table-responsive">
                                <table class="table "id="dataTable">
<!--                                    <thead>-->
<!--                                        <tr class="text-center">-->
<!--                                            <th>-->
<!--                                                مسلسل-->
<!--                                            </th>-->
                                            <!--<th>اسم المستخدم</th>-->
<!--                                            <th class="text-center"style="white-space: nowrap;">-->
<!--    <span style="display: flex; align-items: center;">-->
<!--        <button id="sortUsernameAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--            <i class="fas fa-arrow-up"></i>-->
<!--        </button>-->
<!--        <button id="sortUsernameDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--            <i class="fas fa-arrow-down"></i>-->
<!--        </button>-->
<!--        <span>اسم المستخدم</span>-->
<!--    </span>-->
<!--</th>-->
<!--                                            <th>الجنس</th>-->
<!--                                            <th>الرقم المدني</th>-->
<!--                                            <th>رقم الهاتف</th>-->
                                            <!--<th>رقم الهاتف 2</th>-->
<!--                                            <th class="text-center" style="  font-size: 14px;">اسم الفئة</th>-->
                                            <!--<th class="text-center">تاريخ التسجيل</th>-->
<!--                                        <th class="text-center">-->
<!--    تاريخ التسجيل-->
<!--    <button id="sortAsc" data-order="asc" style="border: none; background: none; cursor: pointer;">-->
<!--        <i class="fas fa-arrow-up"></i>-->
<!--    </button>-->
<!--    <button id="sortDesc" data-order="desc" style="border: none; background: none; cursor: pointer;">-->
<!--        <i class="fas fa-arrow-down"></i>-->
<!--    </button>-->
<!--</th>-->
<!--<th class="text-center">-->
<!--    <span>تاريخ التسجيل</span>-->
<!--    <button id="sortAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 10px;">-->
<!--        <i class="fas fa-arrow-up"></i>-->
<!--    </button>-->
<!--    <button id="sortDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 10px;">-->
<!--        <i class="fas fa-arrow-down"></i>-->
<!--    </button>-->
<!--</th>-->
<!--<th class="text-center"style="white-space: nowrap;">-->
<!--    <span style="display: flex; align-items: center;">-->
<!--        <button id="sortAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--            <i class="fas fa-arrow-up"></i>-->
<!--        </button>-->
<!--        <button id="sortDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--            <i class="fas fa-arrow-down"></i>-->
<!--        </button>-->
<!--        <span>تاريخ التسجيل</span>-->
        
<!--    </span>-->
<!--</th>-->



<!--                                            <th class="text-center">السنة</th>-->
<!--                                            <th class="text-center">المسابقة</th>-->
<!--                                            <th class="text-center">المركز</th>-->
<!--                                            <th class="text-center">الدرجة</th>-->
<!--                                            <th class="text-center">التحكم</th>-->
<!--                                        </tr>-->
<!--                                    </thead>-->
<!--<thead style='background-color:#6c757d-->
<!--'>-->
<!--    <tr class="text-center">-->
<!--        <th>مسلسل</th>-->
<!--        <th class="text-center" style="white-space: nowrap;">-->
<!--            <span style="display: flex; align-items: center;">-->
<!--                <button id="sortUsernameAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-up"></i>-->
<!--                </button>-->
<!--                <button id="sortUsernameDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-down"></i>-->
<!--                </button>-->
<!--                <span>اسم المستخدم</span>-->
<!--            </span>-->
<!--        </th>-->
<!--        <th>الجنسية</th>-->
<!--        <th>الرقم المدني</th>-->
<!--        <th>رقم الهاتف</th>-->
<!--        <th class="text-center" style="font-size: 14px;">فئة</th>-->
<!--        <th class="text-center" style="white-space: nowrap;">-->
<!--            <span style="display: flex; align-items: center;">-->
<!--                <button id="sortAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-up"></i>-->
<!--                </button>-->
<!--                <button id="sortDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-down"></i>-->
<!--                </button>-->
<!--                <span>تاريخ التسجيل</span>-->
<!--            </span>-->
<!--        </th>-->

<!--        <th class="text-center" style="white-space: nowrap;">-->
<!--            <span style="display: flex; align-items: center;">-->
<!--                <button id="sortYearAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-up"></i>-->
<!--                </button>-->
<!--                <button id="sortYearDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-down"></i>-->
<!--                </button>-->
<!--                <span>السنة</span>-->
<!--            </span>-->
<!--        </th>-->

<!--        <th class="text-center" style="white-space: nowrap;">-->
<!--            <span style="display: flex; align-items: center;">-->
<!--                <button id="sortCompetitionAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-up"></i>-->
<!--                </button>-->
<!--                <button id="sortCompetitionDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-down"></i>-->
<!--                </button>-->
<!--                <span>المسابقة</span>-->
<!--            </span>-->
<!--        </th>-->

<!--        <th class="text-center" style="white-space: nowrap;">-->
<!--            <span style="display: flex; align-items: center;">-->
<!--                <button id="sortRankAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-up"></i>-->
<!--                </button>-->
<!--                <button id="sortRankDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-down"></i>-->
<!--                </button>-->
<!--                <span>المركز</span>-->
<!--            </span>-->
<!--        </th>-->

<!--        <th class="text-center" style="white-space: nowrap;">-->
<!--            <span style="display: flex; align-items: center;">-->
<!--                <button id="sortGradeAsc" data-order="asc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-up"></i>-->
<!--                </button>-->
<!--                <button id="sortGradeDesc" data-order="desc" style="border: none; background: none; cursor: pointer; font-size: 8px; margin-left: 0px;">-->
<!--                    <i class="fas fa-arrow-down"></i>-->
<!--                </button>-->
<!--                <span>الدرجة</span>-->
<!--            </span>-->
<!--        </th>-->

<!--        <th class="text-center">التحكم</th>-->
<!--    </tr>-->
<!--</thead>-->
<thead style="background-color: #6c757d; font-weight: bold;">
    <tr class="text-center">
        <th style="border: none; color:white;">مسلسل</th>
        <th class="text-center" style="white-space: nowrap; border: none;color:white;">
            <span style="display: flex; align-items: center; gap: 4px;color:white;">
                <button id="sortUsernameAsc" data-order="asc" class="sort-btn"><i class="fas fa-arrow-up"></i></button>
                <button id="sortUsernameDesc" data-order="desc" class="sort-btn"><i class="fas fa-arrow-down"></i></button>
                <span style="color:white;">اسم المستخدم</span>
            </span>
        </th>
        <th style="border: none;color:white;">الجنسية</th>
        <th style="border: none;color:white;">الرقم المدني</th>
        <th style="border: none;color:white;">رقم الهاتف</th>
        <th class="text-center" style="font-size: 14px; border: none;color:white;">فئة</th>
        
        <th class="text-center" style="white-space: nowrap; border: none;color:white;">
            <span style="display: flex; align-items: center; gap: 4px;color:white;">
                <button id="sortAsc" data-order="asc" class="sort-btn"><i class="fas fa-arrow-up"></i></button>
                <button id="sortDesc" data-order="desc" class="sort-btn"><i class="fas fa-arrow-down"></i></button>
                <span style="color:white;">تاريخ التسجيل</span>
            </span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white;">
            <span style="display: flex; align-items: center; gap: 4px;color:white;">
                <button id="sortYearAsc" data-order="asc" class="sort-btn"><i class="fas fa-arrow-up"></i></button>
                <button id="sortYearDesc" data-order="desc" class="sort-btn"><i class="fas fa-arrow-down"></i></button>
                <span style="color:white;">السنة</span>
            </span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white;">
            <span style="display: flex; align-items: center; gap: 4px;color:white;">
                <button id="sortCompetitionAsc" data-order="asc" class="sort-btn"><i class="fas fa-arrow-up"></i></button>
                <button id="sortCompetitionDesc" data-order="desc" class="sort-btn"><i class="fas fa-arrow-down"></i></button>
                <span style="color:white;">المسابقة</span>
            </span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white;">
            <span style="display: flex; align-items: center; gap: 4px;color:white;">
                <button id="sortRankAsc" data-order="asc" class="sort-btn"><i class="fas fa-arrow-up"></i></button>
                <button id="sortRankDesc" data-order="desc" class="sort-btn"><i class="fas fa-arrow-down"></i></button>
                <span style="color:white;">المركز</span>
            </span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white;">
            <span style="display: flex; align-items: center; gap: 4px;color:white;">
                <button id="sortGradeAsc" data-order="asc" class="sort-btn"><i class="fas fa-arrow-up"></i></button>
                <button id="sortGradeDesc" data-order="desc" class="sort-btn"><i class="fas fa-arrow-down"></i></button>
                <span style="color:white;">الدرجة</span>
            </span>
        </th>

        <th class="text-center" style="border: none;color:white;">التحكم</th>
    </tr>
</thead>

                                    <tbody id="subscriptionsTableBody">

                                        @foreach ($data as $key => $val)
                                            @if (!empty($val->user->username))
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $key + 1 }}
                                                    </td>
                                                        
                                                    <!--<td style="color: {{ $val->user->gender == 'female' ? 'red' : '#085d9e' }}; font-weight: bold;">-->
                                                        
                                                    <!--{{ $val->user->username }}-->
                                                    
                                                    <!--</td>-->
<!--                                                    <td style="color: {{ $val->user->gender == 'female' ? 'red' : '#085d9e' }}; font-weight: bold;" -->
<!--    onclick="window.location='{{ url('/') }}/admin/subscriptions/edit/{{ $val->id }}'">-->
<!--    {{ $val->user->username }}-->
<!--</td>-->
<td style="color: {{ $val->user->gender == 'female' ? 'red' : '#085d9e' }}; font-weight: bold; cursor: pointer;" 
    onclick="window.location='{{ url('/') }}/admin/subscriptions/edit/{{ $val->id }}'">
    {{ $val->user->username }}
</td>

                                                    <!--<td>{{ $val->user->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>-->
                                                        <!--<td>{{ $val->user->nationality->name_ar ?? '-' }}</td>-->
                                                      <td>  
                                                       {{ DB::table('nationalities')->where('id', $val->user->nationality_id)->value('name_ar') ?? '-' }}
                                             </td>
                                                    <td>{{ $val->user->identify }}</td>
                                                    <!--<td>{{ $val->user->mobile }}</td>-->
                                                    <td>
                                                    <a href="https://wa.me/{{ $val->user->mobile }}" target="_blank">
                                                    {{ $val->user->mobile }}
                                                     </a>
                                                    </td>
                                                    <!--<td>{{ $val->user->mobile2 }}</td>-->
                                                    <td class="text-center" style="  font-size: 13px;">{{ $val->s_name->name_ar }}</td>
                                                    <td class="created-at text-center">{{ $val->created_at }}</td>
                                                    <td class="text-center">{{ $val->date }}</td>
                                                    <td class="text-center">{{ $val->number ?? '-' }}</td>
                                                    <td class="text-center">{{ $val->level }}</td>
                                                    <td class="text-center">{{ $val->degree }}</td>


                                                    <td class="text-center">

                                                        <a href="{{ url('/') }}/admin/subscriptions/edit/{{ $val->id }}"
                                                            class="btn btn-icon btn-info" title="تعديل">
                                                            <i class="mdi mdi-square-edit-outline"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                           

                        </div><!-- end card-box -->
                    </div>
                    <!-- end col -->
                </div><!-- end row -->


            </div><!-- end container-fluid-->
        </div><!-- end contant-->
    </div>
    <!-- End Page Content-->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
