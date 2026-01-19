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
                            <input type="checkbox" class="row-checkbox" value="${val.id}" onchange="toggleBulkButton()">
                        </td>
                        <td class="text-center">
                                             ${index + 1}
                                            </td>
                                    <td style="color: ${val.gender === 'female' ? 'red' : '#085d9e'}; font-weight: bold; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${val.username}">${val.username}</td>
                        <td>${val.gender === 'male' ? 'ذكر' : 'أنثى'}</td>
                        <td>${val.identify}</td>
                        <td><a href="https://wa.me/${val.mobile}" target="_blank">${val.mobile}</a></td>
                        <td class="text-center">${val.name_ar}</td>
                        <td class="text-center" style="white-space: nowrap;">${val.created_at ? val.created_at.split(' ')[0] : '-'}</td>
                        <td class="text-center">${val.date}</td>
                        <td class="text-center">${val.number ?? '-'}</td>
                        <td class="text-center" style="white-space: nowrap;">${val.participation_date || '-'}</td>
                        <td class="text-center">${val.level}</td>
                        <td class="text-center">${val.degree}</td>
                        <td class="text-center">
                            <input type="date" class="form-control form-control-sm" style="font-size: 12px;" 
                                   onchange="assignSingleDate(${val.id}, this.value)">
                        </td>
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
                            <style>
                                .form-control::placeholder {
                                    font-weight: bold !important;
                                    color: #000 !important;
                                }
                                .form-control option {
                                    font-weight: bold;
                                    color: #000;
                                }
                                .form-control {
                                    font-weight: bold;
                                    color: #000;
                                }
                            </style>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                        <input class="form-control" type="number" name="id"
                                            value="{{ request('id') }}" placeholder="الرقم المدني" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <input class="form-control" type="number" placeholder="السنة" name="date"
                                            value="{{ request('date') }}" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <input class="form-control" type="text" name="username"
                                            value="{{ request('username') }}" placeholder="اسم المستخدم" style="font-weight: bold;">
                                    </div>
                                    <!-- <div class="col-md-3 mt-3">
                                            <input class="form-control" type="email" name="email" value="{{ request('email') }}" placeholder="البريد الالكتروني">
                                        </div> -->
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="nationality_id" style="font-weight: bold;">
                                            <option value="">اختر الجنسية</option>
                                            @foreach (\App\Nationality::get() as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ request('nationality_id') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="name_id" style="font-weight: bold;">
                                            <option value="">اختر الفئة</option>
                                            @foreach (\App\SubscriptionsName::get() as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ request('name_id') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="type" style="font-weight: bold;">
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
                                        <select class="form-control" name="winner" style="font-weight: bold;">
                                            <option value="">اختر نوع الفائزون</option>
                                            <option value="1" {{ request('winner') == '1' ? 'selected' : '' }}>
                                                الفائزون</option>
                                            <option value="2" {{ request('winner') == '2' ? 'selected' : '' }}>الغير
                                                فائزون</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3 pt-2">
                                        <input name='subscrition' type='checkbox' {{!empty(request('subscrition')) ? 'checked' : ''}} />
                                        <span style="font-weight: bold;">المشاركون</span>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="gender" style="font-weight: bold;">
                                            <option value="">اخترا الجنس</option>
                                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>ذكر
                                            </option>
                                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>
                                                أنثى</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select class="form-control" name="city_id" style="font-weight: bold;">
                                            <option value="">اخترا المحافظة</option>
                                            @foreach (\App\City::get() as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ request('city_id') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <select class="form-control" name="order_type" style="font-weight: bold;">
                                            <option value="">طريقة الترتيب</option>
                                            <option value="asc" {{ request('order_type') == 'asc' ? 'selected' : '' }}>
                                                تصاعدي</option>
                                            <option value="desc" {{ request('order_type') == 'desc' ? 'selected' : '' }}>
                                                تنازلي</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <input type="text" class="form-control" name="number" placeholder="رقم المسابقة"
                                            value="{{ request('number') }}" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <input class="form-control" type="date" name="participation_date"
                                            value="{{ request('participation_date') }}" placeholder="تاريخ المشاركة" title="تاريخ المشاركة" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <select class="form-control" name="date_status" style="font-weight: bold;">
                                            <option value="">حالة التاريخ</option>
                                            <option value="assigned" {{ request('date_status') == 'assigned' ? 'selected' : '' }}>معين</option>
                                            <option value="not_assigned" {{ request('date_status') == 'not_assigned' ? 'selected' : '' }}>غير معين</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <div>
                                                <a href="{{ url('admin/subscriptions/excel/import') }}" class="btn btn-sm" style="background: #10b981; color: white; border: none; padding: 8px 20px; margin-right: 5px;">
                                                    <i class="mdi mdi-plus"></i> استيراد
                                                </a>
                                                <a href="{{ url('admin/subscriptions/excel/export?' . $_SERVER['QUERY_STRING']) }}" class="btn btn-sm" style="background: #3b82f6; color: white; border: none; padding: 8px 20px;">
                                                    <i class="fas fa-print"></i> تصدير
                                                </a>
                                            </div>
                                            <div>
                                                <input class="btn btn-sm" type="submit" value="فلترة" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 8px 40px;">
                                            </div>
                                            <div style="width: 200px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card-box">

                            <div class="row" style="margin-bottom: 15px; align-items: center;">
                                <div class="col-md-4">
                                    <h4 class="header-title">عرض الاشتراكات (<span id="subscriptionCount">{{ $count }}</span>)</h4>
                                </div>
                                <div class="col-md-8 text-right" style="position: relative;">
                                    <input type="date" id="bulkDateInput" style="position: absolute; opacity: 0; pointer-events: none;">
                                    <span id="selectedCount" style="display:none; margin-left: 10px; font-weight: bold; color: #333;"></span>
                                    <button type="button" class="btn btn-sm btn-primary" id="bulkDateBtn" onclick="openBulkCalendar()" style="display:none; border-radius: 20px; padding: 6px 15px; font-size: 12px; margin-left: 5px;">
                                        <i class="mdi mdi-calendar-multiple"></i> <span id="dateLabel">تاريخ المشاركة</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success" id="applyBulkDateBtn" onclick="applyBulkDate()" style="display:none; border-radius: 20px; padding: 6px 15px; font-size: 12px; margin-left: 5px;">
                                        <i class="mdi mdi-check"></i> تعيين
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" id="clearBulkDateBtn" onclick="clearBulkDate()" style="display:none; border-radius: 20px; padding: 6px 15px; font-size: 12px; margin-left: 5px;">
                                        <i class="mdi mdi-close"></i> حذف ت.المشاركة
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: visible;">
                                <table class="table table-sm" id="dataTable" style="font-size: 13px;">
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
    <tr class="text-center" style="font-size: 13px;">
        <th style="border: none; color:white; padding: 6px;">مسلسل</th>
        <th class="text-center" style="white-space: nowrap; border: none;color:white; cursor: pointer; padding: 6px;" onclick="toggleSort('username')">
            <span style="color:white;">اسم المستخدم</span>
        </th>
        <th style="border: none;color:white; padding: 6px; width: 80px;">الجنسية</th>
        <th style="border: none;color:white; padding: 6px; width: 100px;">الرقم المدني</th>
        <th style="border: none;color:white; padding: 6px; width: 100px;">رقم الهاتف</th>
        <th class="text-center" style="font-size: 13px; border: none;color:white; padding: 6px; width: 80px;">فئة</th>
        
        <th class="text-center" style="white-space: nowrap; border: none;color:white; cursor: pointer; padding: 6px;" onclick="toggleSort('created_at')">
            <span style="color:white;">تاريخ التسجيل</span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white; cursor: pointer;" onclick="toggleSort('date')">
            <span style="color:white;">السنة</span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white; cursor: pointer;" onclick="toggleSort('number')">
            <span style="color:white;">المسابقة</span>
        </th>

        <th style="border: none; color:white; padding: 6px;">
            <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)">
        </th>

        <th class="text-center" style="border: none; color:white;white-space: nowrap; cursor: pointer; background: {{ request('type') == 'participation_date' ? '#5a6268' : 'transparent' }};" onclick="toggleSort('participation_date')">
            <span style="color:white;">تاريخ المشاركة @if(request('type') == 'participation_date'){{ request('order_type') == 'asc' ? '↑' : '↓' }}@endif</span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white; cursor: pointer;" onclick="toggleSort('level')">
            <span style="color:white;">المركز</span>
        </th>

        <th class="text-center" style="white-space: nowrap; border: none;color:white; cursor: pointer;" onclick="toggleSort('degree')">
            <span style="color:white;">الدرجة</span>
        </th>
    </tr>
</thead>

                                    <tbody id="subscriptionsTableBody">

                                        @foreach ($data as $key => $val)
                                            @if (!empty($val->user->username))
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $key + 1 }}
                                                    </td>
<td style="color: {{ $val->user->gender == 'female' ? 'red' : '#085d9e' }}; font-weight: bold; cursor: pointer; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
    onclick="window.location='{{ url('/') }}/admin/subscriptions/edit/{{ $val->id }}'" title="{{ $val->user->username }}">
    {{ $val->user->username }}
</td>

                                                      <td>  
                                                       {{ DB::table('nationalities')->where('id', $val->user->nationality_id)->value('name_ar') ?? '-' }}
                                             </td>
                                                    <td>{{ $val->user->identify }}</td>
                                                    <td>
                                                    <a href="https://wa.me/{{ $val->user->mobile }}" target="_blank">
                                                    {{ $val->user->mobile }}
                                                     </a>
                                                    </td>
                                                    <td class="text-center" style="  font-size: 13px;">{{ $val->s_name->name_ar }}</td>
                                                    <td class="created-at text-center" style="white-space: nowrap;">{{ \Carbon\Carbon::parse($val->created_at)->format('Y-m-d') }}</td>
                                                    <td class="text-center">{{ $val->date }}</td>
                                                    <td class="text-center">{{ $val->number ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <input type="checkbox" class="row-checkbox" value="{{ $val->id }}" onchange="toggleBulkButton()">
                                                    </td>
                                                    <td class="text-center">
                                                        @if(!empty($val->participation_date))
                                                            <input type="date" class="form-control form-control-sm" 
                                                                   value="{{ $val->participation_date }}" 
                                                                   style="font-size: 12px;" 
                                                                   onchange="assignSingleDate({{ $val->id }}, this.value)">
                                                        @else
                                                            <div style="font-size: 11px; color: #999; cursor: pointer;" onclick="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                                لم يتم التعيين بعد
                                                            </div>
                                                            <input type="date" class="form-control form-control-sm" 
                                                                   style="font-size: 12px; display: none;" 
                                                                   onchange="assignSingleDate({{ $val->id }}, this.value)">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $val->level }}</td>
                                                    <td class="text-center">{{ $val->degree }}</td>
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

<style>
#bigDateInput::-webkit-calendar-picker-indicator {
    font-size: 35px;
    cursor: pointer;
}
</style>

<script>
function openBulkCalendar() {
    document.getElementById('bulkDateInput').showPicker();
}

function toggleSelectAll(checkbox) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    toggleBulkButton();
}

function toggleBulkButton() {
    const selected = document.querySelectorAll('.row-checkbox:checked');
    const bulkBtn = document.getElementById('bulkDateBtn');
    const applyBtn = document.getElementById('applyBulkDateBtn');
    const clearBtn = document.getElementById('clearBulkDateBtn');
    const countSpan = document.getElementById('selectedCount');
    
    if (selected.length > 0) {
        countSpan.textContent = 'محدد: ' + selected.length;
        countSpan.style.display = 'inline-block';
        bulkBtn.style.display = 'inline-block';
        clearBtn.style.display = 'inline-block';
        const dateValue = document.getElementById('bulkDateInput').value;
        if (dateValue) {
            applyBtn.style.display = 'inline-block';
        }
    } else {
        countSpan.style.display = 'none';
        bulkBtn.style.display = 'none';
        applyBtn.style.display = 'none';
        clearBtn.style.display = 'none';
    }
}

function getSelectedIds() {
    const checkboxes = document.querySelectorAll('.row-checkbox:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

document.getElementById('bulkDateInput').addEventListener('change', function() {
    const date = this.value;
    if (date) {
        document.getElementById('dateLabel').textContent = date;
        document.getElementById('applyBulkDateBtn').style.display = 'inline-block';
    }
});

function applyBulkDate() {
    const date = document.getElementById('bulkDateInput').value;
    if (!date) {
        alert('الرجاء اختيار تاريخ');
        return;
    }
    
    const selectedIds = getSelectedIds();
    if (selectedIds.length === 0) {
        alert('الرجاء تحديد مشترك واحد على الأقل');
        return;
    }
    
    $.ajax({
        url: '{{ url("/admin/subscriptions/assign-date-multiple") }}',
        type: 'POST',
        data: {
            participation_date: date,
            ids: selectedIds
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            }
        },
        error: function(xhr) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}

function assignSingleDate(id, date) {
    if (!date) return;
    
    $.ajax({
        url: '{{ url("/admin/subscriptions/assign-date-single") }}/' + id,
        type: 'POST',
        data: {
            participation_date: date
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            }
        },
        error: function(xhr) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}

function clearSingleDate(id) {
    $.ajax({
        url: '{{ url("/admin/subscriptions/assign-date-single") }}/' + id,
        type: 'POST',
        data: {
            participation_date: null
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            }
        },
        error: function(xhr) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}

function clearBulkDate() {
    const selectedIds = getSelectedIds();
    if (selectedIds.length === 0) {
        alert('الرجاء تحديد مشترك واحد على الأقل');
        return;
    }
    
    $.ajax({
        url: '{{ url("/admin/subscriptions/assign-date-multiple") }}',
        type: 'POST',
        data: {
            participation_date: null,
            ids: selectedIds
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            }
        },
        error: function(xhr) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}

let sortOrders = {
    'participation_date': '{{ request("type") == "participation_date" ? request("order_type") : "desc" }}',
    'username': '{{ request("type") == "username" ? request("order_type") : "desc" }}',
    'created_at': '{{ request("type") == "created_at" ? request("order_type") : "desc" }}',
    'date': '{{ request("type") == "date" ? request("order_type") : "desc" }}',
    'number': '{{ request("type") == "number" ? request("order_type") : "desc" }}',
    'level': '{{ request("type") == "level" ? request("order_type") : "desc" }}',
    'degree': '{{ request("type") == "degree" ? request("order_type") : "desc" }}'  
};

function toggleSort(column) {
    const currentOrder = sortOrders[column] || 'desc';
    const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
    sortOrders[column] = newOrder;
    
    const url = new URL(window.location.href);
    url.searchParams.set('type', column);
    url.searchParams.set('order_type', newOrder);
    window.location.href = url.toString();
}
</script>
@endsection
