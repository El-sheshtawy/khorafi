@extends('admin.index')
@section('content')
<?php
$number = request('number', 27);
$from_date = request('from_date');
$to_date = request('to_date');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('exportPDF').addEventListener('click', function () {
            const element = document.getElementById('pdfContent');
            const options = {
                margin: 0.5,
                filename: 'احصائيات المسابقات.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(options).from(element).save();
        });
    });
</script>

<style>
   .table-wrapper:first-of-type table tbody tr:nth-child(7n) td {
        border-bottom: 2px solid black;
    }

    .table-wrapper:first-of-type table tbody tr:nth-child(7n) th {
        border-bottom: 2px solid black;
    }

    /* General header styles for all tables */
    .table thead th {
        background-color: #6c757d; /* Background color for header */
        color: white; /* Text color for header */
    }

    /* Styles for the first table */
    .table-wrapper:nth-of-type(1) .table tbody td:nth-child(4) {
        color: #085d9e; /* Text color for ذكر column */
        font-weight: bold; /* Make text bold */
    }

    .table-wrapper:nth-of-type(1) .table tbody td:nth-child(5) {
        color: red; /* Text color for انثى column */
        font-weight: bold; /* Make text bold */
    }

    .table-wrapper:nth-of-type(1) .table tbody td:nth-child(3) {
        font-weight: bold; /* Make text bold for مشترك column */
    }

    /* Styles for the second table */
    .table-wrapper:nth-of-type(2) .table tbody td:nth-child(3) {
        color: #085d9e; /* Text color for ذكر column */
        font-weight: bold; /* Make text bold */
    }

    .table-wrapper:nth-of-type(2) .table tbody td:nth-child(4) {
        color: red; /* Text color for انثى column */
        font-weight: bold; /* Make text bold */
    }

    .table-wrapper:nth-of-type(2) .table tbody td:nth-child(2) {
        font-weight: bold; /* Make text bold for مشترك column */
    }

    /* Third table */
    .table-wrapper:nth-of-type(3) .table tbody td:nth-child(3) {
        color: #085d9e; /* Text color for ذكر column */
        font-weight: bold; /* Make text bold */
    }

    .table-wrapper:nth-of-type(3) .table tbody td:nth-child(4) {
        color: red; /* Text color for انثى column */
        font-weight: bold; /* Make text bold */
    }

    .table-wrapper:nth-of-type(3) .table tbody td:nth-child(2) {
        font-weight: bold; /* Make text bold for مشترك column */
    }

    .ribbon-box {
        height: 150px;
    }

    .ribbon-box p {
        position: relative;
        top: -80px;
    }

    .ribbon-box i {
        font-size: 50px;
    }

    /* Table wrapper to make the table scrollable on mobile */
    .table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* For smooth scrolling on iOS */
        margin-bottom: 15px;
    }
</style>

<!-- Page Content Start -->
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="page-title-box">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">الرئيسية</a></li>
                </ol>
                <h4 class="page-title">رقم المسابقة {{$number}}</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <input class="form-control" type="number" name="number" placeholder="الرقم" value="{{ request('number', 27) }}" required>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <span class="me-2">من</span>
                                <input 
                                    class="form-control" 
                                    type="date" 
                                    name="from_date" 
                                    id="from_date" 
                                    value="{{ $from_date }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <span class="me-2">إلى</span>
                                <input 
                                    class="form-control" 
                                    type="date" 
                                    name="to_date" 
                                    id="to_date" 
                                    value="{{ $to_date }}">
                            </div>
                            <div class="col-md-1">
                                <input class="btn btn-info" type="submit" value="فلترة">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success" id="exportPDF" type="button">تصدير PDF</button>
                            </div>
                        </div>
                    </form>

                    <br>
                    <h3 class="text-center">الإجمالي: {{
                        \App\Subscription::where('number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('created_at', '<=', $to_date);
                        })
                        ->count()
                    }}</h3>
                    <br>
            <div id="pdfContent">
                <div class="table-wrapper">
   
    <table class="table">
    <thead>
        <tr>
            <th scope="col">فئة</th>
            <th scope="col">محافظة</th>
            <th scope="col">مشترك</th>
            <th scope="col">ذكر</th>
            <th scope="col">انثى</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalSubscribers = 0; 
        $totalMales = 0; 
        $totalFemales = 0; 
        $rowCount = 0;  // Counter to track rows
        ?>
        @foreach(\App\SubscriptionsName::get() as $key => $val)
            @foreach(\App\City::get() as $city)
                <?php
                $subscribersCount = \App\Subscription::where('city_id', $city->id)
                    ->where('name_id', $val->id)
                    ->where('number', $number)
                    ->when($from_date, function ($query) use ($from_date) {
                        return $query->whereDate('created_at', '>=', $from_date);
                    })
                    ->when($to_date, function ($query) use ($to_date) {
                        return $query->whereDate('created_at', '<=', $to_date);
                    })
                    ->count();

                $maleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                    ->where('subscriptions.city_id', $city->id)
                    ->where('subscriptions.name_id', $val->id)
                    ->where('subscriptions.number', $number)
                    ->where('users.gender', 'male')
                    ->when($from_date, function ($query) use ($from_date) {
                        return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                    })
                    ->when($to_date, function ($query) use ($to_date) {
                        return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                    })
                    ->count();

                $femaleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                    ->where('subscriptions.city_id', $city->id)
                    ->where('subscriptions.name_id', $val->id)
                    ->where('subscriptions.number', $number)
                    ->where('users.gender', 'female')
                    ->when($from_date, function ($query) use ($from_date) {
                        return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                    })
                    ->when($to_date, function ($query) use ($to_date) {
                        return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                    })
                    ->count();

                // Add to totals
                $totalSubscribers += $subscribersCount;
                $totalMales += $maleCount;
                $totalFemales += $femaleCount;
                $rowCount++;
                ?>
                <tr>
                    <td>{{ $val->name_ar }}</td>
                    <td>{{ $city->name_ar }}</td>
                    <td>{{ $subscribersCount }}</td>
                    <td>{{ $maleCount }}</td>
                    <td>{{ $femaleCount }}</td>
                </tr>

                @if ($rowCount % 6 == 0)
                    <!-- Add the "الاجمالي" row after every 6 rows -->
                    <tr style="color:white;background-color:#369bdd">
                        <th scope="row" style="color:white;background-color:#369bdd">الاجمالي</th>
                        <td></td>
                        <td><strong style="color:white">{{ $totalSubscribers }}</strong></td>
                        <td><strong style="color:white">{{ $totalMales }}</strong></td>
                        <td><strong style="color:white">{{ $totalFemales }}</strong></td>
                    </tr>
                    <?php
                    // Reset the totals for the next 6 rows
                    $totalSubscribers = 0;
                    $totalMales = 0;
                    $totalFemales = 0;
                    ?>
                @endif
            @endforeach
        @endforeach
    </tbody>
        

</table>

</div>

                    <h3 style="padding-right: 5px;">الاجمالي مسابقة {{$number}}</h3>

                    <!-- Second Table Wrapper -->
                    <div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
             
                <th scope="col">فئة</th>
                <th scope="col">مشترك</th>
                <th scope="col">ذكر</th>
                <th scope="col">أنثى</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\SubscriptionsName::get() as $key => $val)
                <tr>
                    
                    <td>{{ $val->name_ar }}</td>
                    <td>
                        {{
                            \App\Subscription::where('name_id', $val->id)
                            ->where('number', $number)
                            ->when($from_date, function ($query) use ($from_date) {
                                return $query->whereDate('created_at', '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date) {
                                return $query->whereDate('created_at', '<=', $to_date);
                            })
                            ->count()
                        }}
                    </td>
                    <td>
                        {{
                            \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.name_id', $val->id)
                            ->where('subscriptions.number', $number)
                            ->where('users.gender', 'male')
                            ->when($from_date, function ($query) use ($from_date) {
                                return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date) {
                                return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                            })
                            ->count()
                        }}
                    </td>
                    <td>
                        {{
                            \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.name_id', $val->id)
                            ->where('subscriptions.number', $number)
                            ->where('users.gender', 'female')
                            ->when($from_date, function ($query) use ($from_date) {
                                return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date) {
                                return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                            })
                            ->count()
                        }}
                    </td>
                </tr>
            @endforeach
            <tr style =" background-color:#369bdd">
                <th scope="row" style="color:white">الاجمالي العام</th>
                
                <td style="color:white">
                    {{
                        \App\Subscription::where('number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('created_at', '<=', $to_date);
                        })
                        ->count()
                    }}
                </td>
                <td style="color:white">
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.gender', 'male')
                        ->where('subscriptions.number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                        })
                        ->count()
                    }}
                </td>
                <td style="color:white">
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.gender', 'female')
                        ->where('subscriptions.number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                        })
                        ->count()
                    }}
                </td>
            </tr>
        </tbody>
    </table>
</div>

                    <!-- End Second Table Wrapper -->
                    
                <h3 style="padding-right: 5px;">كويتي مسابقة {{$number}}</h3>

<!-- Second Table Wrapper -->
<div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                
                <th scope="col">فئة</th>
                <th scope="col">مشترك</th>
                <th scope="col">ذكر</th>
                <th scope="col">أنثى</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\SubscriptionsName::get() as $key => $val)
                <tr>
                  
                    <td>{{ $val->name_ar }}</td>
                    <td>
                        {{ 
                            \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.name_id', $val->id)
                            ->where('users.nationality_id', 1) /* Filter for كويتي */
                            ->where('subscriptions.number', $number)
                            ->when($from_date, fn($query) => $query->whereDate('subscriptions.created_at', '>=', $from_date))
                            ->when($to_date, fn($query) => $query->whereDate('subscriptions.created_at', '<=', $to_date))
                            ->count() 
                        }}
                    </td>
                    <td>
                        {{ 
                            \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.name_id', $val->id)
                            ->where('users.nationality_id', 1) /* Filter for كويتي */
                            ->where('subscriptions.number', $number)
                            ->where('users.gender', 'male')
                            ->when($from_date, fn($query) => $query->whereDate('subscriptions.created_at', '>=', $from_date))
                            ->when($to_date, fn($query) => $query->whereDate('subscriptions.created_at', '<=', $to_date))
                            ->count() 
                        }}
                    </td>
                    <td>
                        {{ 
                            \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.name_id', $val->id)
                            ->where('users.nationality_id', 1) /* Filter for كويتي */
                            ->where('subscriptions.number', $number)
                            ->where('users.gender', 'female')
                            ->when($from_date, fn($query) => $query->whereDate('subscriptions.created_at', '>=', $from_date))
                            ->when($to_date, fn($query) => $query->whereDate('subscriptions.created_at', '<=', $to_date))
                            ->count() 
                        }}
                    </td>
                </tr>
            @endforeach
            <tr style="background-color:#369bdd ">
                <th scope="row" style="color:white">الاجمالي</th>
                <td style="color:white">
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.nationality_id', 1) /* Filter for كويتي */
                        ->where('subscriptions.number', $number)
                        ->when($from_date, fn($query) => $query->whereDate('subscriptions.created_at', '>=', $from_date))
                        ->when($to_date, fn($query) => $query->whereDate('subscriptions.created_at', '<=', $to_date))
                        ->count() 
                    }}
                </td>
                <td style="color:white">
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.nationality_id', 1) /* Filter for كويتي */
                        ->where('subscriptions.number', $number)
                        ->where('users.gender', 'male')
                        ->when($from_date, fn($query) => $query->whereDate('subscriptions.created_at', '>=', $from_date))
                        ->when($to_date, fn($query) => $query->whereDate('subscriptions.created_at', '<=', $to_date))
                        ->count() 
                    }}
                </td>
                <td style="color:white">
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.nationality_id', 1) /* Filter for كويتي */
                        ->where('subscriptions.number', $number)
                        ->where('users.gender', 'female')
                        ->when($from_date, fn($query) => $query->whereDate('subscriptions.created_at', '>=', $from_date))
                        ->when($to_date, fn($query) => $query->whereDate('subscriptions.created_at', '<=', $to_date))
                        ->count() 
                    }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
<h3 style="padding-right: 5px;"> محافظات مسابقة {{$number}}</h3
<div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">محافظة</th>
                <th scope="col">فئة</th>
                <th scope="col">مشترك</th>
                <th scope="col">ذكر</th>
                <th scope="col">انثى</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalSubscribers = 0;
            $totalMales = 0;
            $totalFemales = 0;
            $rowCount = 0; // To track rows for border
            $previousCity = ''; // To track the previous city for preventing repetition
            ?>
            @foreach(\App\City::get() as $city)
                @foreach(\App\SubscriptionsName::get() as $category)
                    <?php
                        // Get the subscription counts
                        $subscribersCount = \App\Subscription::where('city_id', $city->id)
                            ->where('name_id', $category->id)
                            ->where('number', $number)
                            ->when($from_date, function ($query) use ($from_date) {
                                return $query->whereDate('created_at', '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date) {
                                return $query->whereDate('created_at', '<=', $to_date);
                            })
                            ->count();

                        $maleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.city_id', $city->id)
                            ->where('subscriptions.name_id', $category->id)
                            ->where('subscriptions.number', $number)
                            ->where('users.gender', 'male')
                            ->when($from_date, function ($query) use ($from_date) {
                                return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date) {
                                return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                            })
                            ->count();

                        $femaleCount = \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                            ->where('subscriptions.city_id', $city->id)
                            ->where('subscriptions.name_id', $category->id)
                            ->where('subscriptions.number', $number)
                            ->where('users.gender', 'female')
                            ->when($from_date, function ($query) use ($from_date) {
                                return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date) {
                                return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                            })
                            ->count();

                        // Accumulate totals
                        $totalSubscribers += $subscribersCount;
                        $totalMales += $maleCount;
                        $totalFemales += $femaleCount;
                    ?>
                    
                        <!-- Display the city name only if it’s different from the previous city -->
                        <td>
                            @if($city->name_ar != $previousCity)
                                {{ $city->name_ar }}
                            @endif
                        </td>
                        <td>{{ $category->name_ar }}</td>
                        <td> <strong  >{{ $subscribersCount }}</strong></td>
                        <td ><strong style="color: #085d9e;">{{$maleCount}}</strong ></td>
                        <td ><strong style="color: red;" >{{ $femaleCount }}</strong></td>
                    </tr>
                    <?php 
                        // Update previous city
                        $previousCity = $city->name_ar;
                        $rowCount++;

                        // Add "الاجمالي" after every 4 rows
                        if ($rowCount % 4 == 0) {
                            echo '<tr style="border-bottom: 2px solid black;background-color:#369bdd">
                            <th scope="row" style="color:white">الاجمالي</th><td></td><td><strong style="color:white">' . $totalSubscribers . '</strong></td><td><strong style="color:white">' . $totalMales . '</strong></td><td><strong style="color:white";>' . $totalFemales . '</strong></td></tr>';

                            // Reset totals for the next 4 rows
                            $totalSubscribers = 0;
                            $totalMales = 0;
                            $totalFemales = 0;
                        }
                    ?>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color:#0cc15d ">
                <th scope="row" style="color:white;background-color:#0cc15d">الاجمالي العام</th>
                <td></td>
                <td> <strong style="color:white">
                    {{
                        \App\Subscription::where('number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('created_at', '<=', $to_date);
                        })
                        ->count()
                    }}
                    </strong>
                </td>
                <td> <strong style="color:white">
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.gender', 'male')
                        ->where('subscriptions.number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                        })
                        ->count()
                    }}
                    </strong>
                </td>
                <td> <strong style="color:white"> 
                    {{
                        \App\Subscription::join('users', 'users.id', '=', 'subscriptions.user_id')
                        ->where('users.gender', 'female')
                        ->where('subscriptions.number', $number)
                        ->when($from_date, function ($query) use ($from_date) {
                            return $query->whereDate('subscriptions.created_at', '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date) {
                            return $query->whereDate('subscriptions.created_at', '<=', $to_date);
                        })
                        ->count()
                    }}
                    </strong>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

</div>

                </div>
            </div>

        </div><!-- end container-fluid-->
    </div><!-- end contant-->
</div><!-- End Page Content-->
@endsection
