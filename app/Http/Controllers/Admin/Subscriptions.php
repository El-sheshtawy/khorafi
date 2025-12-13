<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Selection;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\Subscription;
use App\User;
use Mpdf\Tag\Select;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Subscriptions extends Controller
{

//  public function fetchSubscriptions(Request $request)
// {
//     // Fetch repeated user_ids for the number (e.g., 26)
//     $repeatedUserIds = DB::table('subscriptions')
//         ->select('user_id')
//         ->where('subscriptions.number', 26)
//         ->groupBy('user_id')
//         ->havingRaw('COUNT(*) > 1')
//         ->pluck('user_id'); // This will return a collection of user_ids

//     // Now fetch the subscriptions and user details for those repeated user_ids
//     $query = DB::table('subscriptions')
//                 ->join('users', 'subscriptions.user_id', '=', 'users.id')
//                 ->join('subscriptions_names', 'subscriptions.name_id', '=', 'subscriptions_names.id')
//                 ->select('subscriptions.*', 'users.username', 'users.gender', 'subscriptions_names.name_ar')
//                 ->whereIn('subscriptions.user_id', $repeatedUserIds); // Only select users with repeated subscriptions
    
//     // Apply additional filters if provided in the request
//     if ($request->has('id')) {
//         $query->where('users.identify', $request->id);
//     }
//     if ($request->has('username')) {
//         $query->where('users.username', 'like', '%' . $request->username . '%');
//     }
//     if ($request->has('nationality_id')) {
//         $query->where('users.nationality_id', $request->nationality_id);
//     }
//     if ($request->has('name_id')) {
//         $query->where('subscriptions.name_id', $request->name_id);
//     }
//     if ($request->has('gender')) {
//         $query->where('users.gender', $request->gender);
//     }
//     if ($request->has('city_id')) {
//         $query->where('users.city_id', $request->city_id);
//     }
//     if ($request->has('date')) {
//         $query->whereYear('subscriptions.created_at', $request->date);
//     }
//     if ($request->has('number')) {
//         $query->where('subscriptions.number', $request->number);
//     }

//     // Apply ordering if specified
//     if ($request->has('order_type')) {
//         $query->orderBy('subscriptions.created_at', $request->order_type);
//     }

//     $data = $query->get();

//     return response()->json(['data' => $data]);
// }
// public function fetchSubscriptions(Request $request)
// {
//     // Fetch repeated user_ids for the number (26) and within the date range (from 2024-12-01 to today)
//     $repeatedUserIds = DB::table('subscriptions')
//         ->select('user_id')
//         ->where('subscriptions.number', 26) // Set the number to 26
//         ->whereBetween('subscriptions.created_at', ['2024-12-01', now()])
//         ->groupBy('user_id')
//         ->havingRaw('COUNT(*) > 1')
//         ->pluck('user_id'); // This will return a collection of user_ids

//     // Now fetch the subscriptions and user details for those repeated user_ids
//     $query = DB::table('subscriptions')
//                 ->join('users', 'subscriptions.user_id', '=', 'users.id')
//                 ->join('subscriptions_names', 'subscriptions.name_id', '=', 'subscriptions_names.id')
//                 ->select('subscriptions.*', 'users.username', 'users.gender', 'subscriptions_names.name_ar')
//                 ->whereIn('subscriptions.user_id', $repeatedUserIds) // Only select users with repeated subscriptions
//                 ->where('subscriptions.number', 26) // Ensure the number is 26
//                 ->whereBetween('subscriptions.created_at', ['2024-12-01', now()]); // Filter by the date range
    
//     // Apply additional filters if provided in the request
//     if ($request->has('id')) {
//         $query->where('users.identify', $request->id);
//     }
//     if ($request->has('username')) {
//         $query->where('users.username', 'like', '%' . $request->username . '%');
//     }
//     if ($request->has('nationality_id')) {
//         $query->where('users.nationality_id', $request->nationality_id);
//     }
//     if ($request->has('name_id')) {
//         $query->where('subscriptions.name_id', $request->name_id);
//     }
//     if ($request->has('gender')) {
//         $query->where('users.gender', $request->gender);
//     }
//     if ($request->has('city_id')) {
//         $query->where('users.city_id', $request->city_id);
//     }
//     if ($request->has('date')) {
//         $query->whereYear('subscriptions.created_at', $request->date);
//     }

//     // Apply ordering if specified
//     if ($request->has('order_type')) {
//         $query->orderBy('subscriptions.created_at', $request->order_type);
//     }

//     $data = $query->get();

//     // return response()->json(['data' => $data]);
//      $rowCount = $data->count();

//     return response()->json([
//         'data' => $data,
//         'count' => $rowCount, // Add the count to the response
//     ]);
// }
public function fetchSubscriptions(Request $request)
{
    // Fetch repeated user_ids for the number (26) and within the date range (from 2024-12-01 to today)
    $repeatedUserIds = DB::table('subscriptions')
        ->select('user_id')
        ->where('subscriptions.number', 26) // Set the number to 26
        ->whereBetween('subscriptions.created_at', ['2024-12-01', now()])
        ->groupBy('user_id')
        ->havingRaw('COUNT(*) > 1')
        ->pluck('user_id'); // This will return a collection of user_ids

    // Now fetch the subscriptions and user details for those repeated user_ids
    $query = DB::table('subscriptions')
                ->join('users', 'subscriptions.user_id', '=', 'users.id')
                ->join('subscriptions_names', 'subscriptions.name_id', '=', 'subscriptions_names.id')
                ->select(
                    'subscriptions.*', 
                    'users.username', 
                    'users.gender', 
                    'users.identify',  // Add the national_id field here
                    'users.mobile',    // Add the phone number field here
                    'subscriptions_names.name_ar'
                )
                ->whereIn('subscriptions.user_id', $repeatedUserIds) // Only select users with repeated subscriptions
                ->where('subscriptions.number', 26) // Ensure the number is 26
                ->whereBetween('subscriptions.created_at', ['2024-12-01', now()]); // Filter by the date range
    
    // Apply additional filters if provided in the request
    if ($request->has('id')) {
        $query->where('users.identify', $request->id);
    }
    if ($request->has('username')) {
        $query->where('users.username', 'like', '%' . $request->username . '%');
    }
    if ($request->has('nationality_id')) {
        $query->where('users.nationality_id', $request->nationality_id);
    }
    if ($request->has('name_id')) {
        $query->where('subscriptions.name_id', $request->name_id);
    }
    if ($request->has('gender')) {
        $query->where('users.gender', $request->gender);
    }
    if ($request->has('city_id')) {
        $query->where('users.city_id', $request->city_id);
    }
    if ($request->has('date')) {
        $query->whereYear('subscriptions.created_at', $request->date);
    }

    // Apply ordering if specified
    if ($request->has('order_type')) {
        $query->orderBy('subscriptions.created_at', $request->order_type);
    }

    $data = $query->get();

    // return response()->json(['data' => $data]);
    $rowCount = $data->count();

    return response()->json([
        'data' => $data,
        'count' => $rowCount, // Add the count to the response
    ]);
}

public function deleteSubscription($id)
{
    // Find the subscription by ID
    $subscription = DB::table('subscriptions')->where('id', $id)->first();

    // Check if the subscription exists
    if (!$subscription) {
        return response()->json(['success' => false, 'message' => 'Subscription not found.'], 404);
    }

    // Delete the subscription
    $deleted = DB::table('subscriptions')->where('id', $id)->delete();

    // Return success or failure response
    // if ($deleted) {
    //     return response()->json(['success' => true, 'message' => 'Subscription deleted successfully.']);
    // } else {
    //     return response()->json(['success' => false, 'message' => 'Failed to delete subscription.'], 500);
    // }
     if ($deleted) {
        return response()->json(['success' => true, 'message' => 'تم حذف الاشتراك بنجاح.']);
    } else {
        return response()->json(['success' => false, 'message' => 'فشل في حذف الاشتراك.'], 500);
    }
}
public function deleteSubscriptiontotal(Request $request) {
    $ids = $request->input('ids');
    
    // Delete subscriptions by IDs
    $deleted = Subscription::whereIn('id', $ids)->delete();
    
    if ($deleted) {
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
    } else {
        return response()->json(['success' => false, 'message' => 'حدث خطأ. الرجاء المحاولة مرة أخرى']);
    }
}
public function index()
    {
        $config = DB::table('config')->first();
        
        // Save filter_number if provided
        if (request()->has('number')) {
            DB::table('config')->where('id', 1)->update([
                'filter_number' => request('number'),
            ]);
        }
        
        // Redirect with saved number if no number parameter
        if (!request()->has('number') && empty(request()->except(['_token']))) {
            $filterNumber = $config->filter_number ?? $config->number;
            return redirect()->to('/admin/subscriptions?number=' . $filterNumber);
        }
        
        $data = new Subscription;

        if (!empty(request('username'))) {
            $users = User::where('username', 'LIKE', '%' . request('username') . '%')->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }
        if (!empty(request('number'))) {
        $data = $data->where('number', 'LIKE', '%' . request('number') . '%');
    }
        if (!empty(request('subscrition'))) {
        $data = $data->where('degree', '>', 0);
    }

        if (!empty(request('id'))) {
            $users = User::where('identify', 'LIKE', '%' . request('id') . '%')->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('email'))) {
            $users = User::where('email', 'LIKE', '%' . request('email') . '%')->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('gender'))) {
            $users = User::where('gender', request('gender'))->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('city_id'))) {
            $users = User::where('city_id', request('city_id'))->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('nationality_id'))) {
            $users = User::where('nationality_id', request('nationality_id'))->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('name_id'))) {
            $data = $data->where('name_id', request('name_id'));
        }

        if (!empty(request('date'))) {
            $data = $data->where('date', 'LIKE', '%' . request('date') . '%');
        } else {
            //$data = $data->where('date', 'LIKE', '%' . $config->year . '%');
            $data = $data->where(function($query) use ($config) {
    $query->where('date', 'LIKE', '%' . $config->year . '%')
          ->orWhere('date', 'LIKE', '%' . ($config->year - 1) . '%');
});

        }

        if (!empty(request('winner'))) {
            $winner = request('winner') == 2 ? 0 : request('winner');
            $data = $data->where('winner', $winner);
        }

        // Apply ordering
        if (!empty(request('type')) and in_array(request('type'), ['winner', 'name_id', 'degree', 'level', 'created_at']) and !empty(request('order_type')) and in_array(request('order_type'), ['asc', 'desc'])) {
            $data = $data->orderBy(request('type'), request('order_type'));
        } elseif (empty(request('type')) && empty(request('order_type'))) {
            $data = $data->orderBy('created_at', 'desc');
        }

        // Get data
        if (!empty(request('username')) or !empty(request('number')) or !empty(request('id')) or !empty(request('email')) or !empty(request('gender')) or !empty(request('city_id')) or !empty(request('nationality_id')) or !empty(request('name_id')) or !empty(request('date')) or !empty(request('type')) or !empty(request('order_type'))) {
            $data = $data->get();
        } else {
            $filterNumber = $config->filter_number ?? $config->number;
            $data = $data->where('number', $filterNumber)->get(); 
        }
        
        $count = $data->count();
   
        return view("admin.pages.subscriptions.index", ['data' => $data, 'count' => $count]);
    }


    public function edit($id)
    {
        $subscriptions = Subscription::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($subscriptions)) {
            return redirect("/admin/subscriptions")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.subscriptions.edit', ['data' => $subscriptions]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'degree' => 'required|numeric',
            'level' => 'required|numeric',
            //'level_ar' => 'required|string',
            //'level_en' => 'required|string',
            'date' => 'required|numeric',
            //'admin_notes' => 'required|string',
            //'user_notes' => 'required|string',
            'type' => 'required|in:1,2,3,4',
        ]);

        $data = Subscription::where('id', $id)->first();

        if (empty($data)) {
            return back()->withInput()->with('error', "فشلت العملية.");
        }
        $configNumber = DB::table('config')->value('number');

        if (request('type') == 1) {
            if (!in_array(request('hizb_number'), [1, 60])) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
        }

        if (request('type') == 2) {
            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
        }

        if (request('type') == 3) {
            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
            if (request('part_number2') < 1 or request('part_number2') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
            if (request('part_number3') < 1 or request('part_number3') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }

            $size = sizeof(array_unique([request('part_number1'), request('part_number2'), request('part_number3')]));
            if ($size < 3) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
        }

        if (request('type') == 4) {
            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
            if (request('part_number2') < 1 or request('part_number2') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
            if (request('part_number3') < 1 or request('part_number3') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
            if (request('part_number4') < 1 or request('part_number4') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
            if (request('part_number5') < 1 or request('part_number5') > 30) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }

            $size = sizeof(array_unique([request('part_number1'), request('part_number2'), request('part_number4'), request('part_number5'), request('part_number3')]));
            if ($size < 5) {
                return back()->withInput()->with('error', "الرجاء اختيار اشتراك صحيح");
            }
        }

        Selection::where('subscription_id', $id)->delete();

        if (request('type') == 1) {
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('hizb_number'),
            ]);
        }

        if (request('type') == 2) {
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number1'),
            ]);
        }

        if (request('type') == 3) {
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number1'),
            ]);
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number2'),
            ]);
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number3'),
            ]);
        }

        if (request('type') == 4) {
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number1'),
            ]);
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number2'),
            ]);
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number3'),
            ]);
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number4'),
            ]);
            Selection::insert([
                'subscription_id' => $id,
                'options' => request('part_number5'),
            ]);
        }

        $active = request('active') ? "active" : "deactive";
        $winner = request('winner') ? 1 : 0;

        $id = Subscription::where("id", $id)->update([
            "degree" => request('degree'),
            "level" => request('level'),
            "level_ar" => request('level_ar'),
            "level_en" => request('level_en'),
            "date" => request('date'),
            "name_id" => request('type'),
            "admin_notes" => request('admin_notes'),
            "user_notes" => request('user_notes'),
            "active" => $active,
            "winner" => $winner,
            "number" => $configNumber,
        ]);



        return back()->with("success", "تم التعديل بنجاح.");
    }

    public function ExportExcel()
    {
        $config = DB::table('config')->first();
        $data = new Subscription;

        if (!empty(request('username'))) {
            $users = User::where('username', 'LIKE', '%' . request('username') . '%')->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('id'))) {
            $users = User::where('identify', 'LIKE', '%' . request('id') . '%')->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('email'))) {
            $users = User::where('email', 'LIKE', '%' . request('email') . '%')->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }
        
        

        if (!empty(request('gender'))) {
            $users = User::where('gender', request('gender'))->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('city_id'))) {
            $users = User::where('city_id', request('city_id'))->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('nationality_id'))) {
            $users = User::where('nationality_id', request('nationality_id'))->get();
            $id = [];
            foreach ($users as $val) {
                $id[] = $val->id;
            }
            $data = $data->whereIn('user_id', $id);
        }

        if (!empty(request('name_id'))) {
            $data = $data->where('name_id', request('name_id'));
        }
  if (!empty(request('number'))) {
            $data = $data->where('number', request('number'));
        }
        if (!empty(request('date'))) {
            $data = $data->where('date', 'LIKE', '%' . request('date') . '%');
        } else {
            $data = $data->where('number', 'LIKE', '%' . $config->number . '%');
        }

        if (!empty(request('winner'))) {
            $winner = request('winner') == 2 ? 0 : request('winner');
            $data = $data->where('winner', $winner);
        }

        if (!empty(request('type')) and in_array(request('type'), ['winner', 'name_id', 'degree', 'level']) and !empty(request('order_type')) and in_array(request('order_type'), ['asc', 'desc'])) {
            $data = $data->orderBy(request('type'), request('order_type'));
        } else {
            $data->orderBy('degree', 'desc')->orderBy('level', 'asc');
        }

        $count = $data->count();

        if (!empty(request('username')) or !empty(request('winner')) or !empty(request('id')) or !empty(request('email')) or !empty(request('gender')) or !empty(request('city_id')) or !empty(request('nationality_id')) or !empty(request('name_id')) or !empty(request('date')) or !empty(request('type'))) {
            $data = $data->get();
        } else {
            $data = $data->get();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'الاسم الاول');
        $sheet->setCellValue('B1', 'الاسم الثاني');
        $sheet->setCellValue('C1', 'الاسم الثالث');
        $sheet->setCellValue('D1', 'اسم العائلة');
        $sheet->setCellValue('E1', 'البريد الالكتروني');
        $sheet->setCellValue('F1', 'رقم الهوية');
        $sheet->setCellValue('G1', 'الجنس');
        $sheet->setCellValue('H1', 'الجنسية');
        $sheet->setCellValue('I1', 'تاريخ الميلاد');
        $sheet->setCellValue('J1', 'العنوان');
        $sheet->setCellValue('K1', 'رقم الجوال');
        $sheet->setCellValue('L1', 'رقم الجوال الثاني');
        $sheet->setCellValue('M1', 'الفئة');
        $sheet->setCellValue('N1', 'رقم الفئة');
        $sheet->setCellValue('O1', 'فائز');
        $sheet->setCellValue('P1', 'الدرجة');
        $sheet->setCellValue('Q1', 'المركز');
        $sheet->setCellValue('R1', 'ملاحظات المستخدم');
        $sheet->setCellValue('S1', 'ملاحظات للآدمن');
        $sheet->setCellValue('T1', 'ملاحظات للمستخدم');
        $sheet->setCellValue('U1', 'الاختيار الأول');
        $sheet->setCellValue('V1', 'الاختيار الثاني');
        $sheet->setCellValue('W1', 'الاختيار الثالث');
        $sheet->setCellValue('X1', 'الاختيار الرابع');
        $sheet->setCellValue('Y1', 'الاختيار الخامس');
        $sheet->setCellValue('Z1', 'سنة المسابقة');
        $sheet->setCellValue('AA1', 'المحافظة');
        $sheet->setCellValue('AB1', 'المنطقة');
        $sheet->setCellValue('AC1', 'الرقم');
        $sheet->setCellValue('AD1', 'تاريخ التسجيل');  // New column fcreated_at
        foreach ($data as $key => $val) {
            if (!empty($val->user->first_name)) {
                $gender1 = $val->user->gender == 'male' ? "ذكر" : "أنثى";
                $nationality1 = !empty(\App\Nationality::where('code', $val->user->nationality)->first()) ? \App\Nationality::where('code', $val->user->nationality)->first()->name_ar : '';
                $sheet->setCellValue('A' . $key + 2, $val->user->first_name);
                $sheet->setCellValue('B' . $key + 2, $val->user->second_name);
                $sheet->setCellValue('C' . $key + 2, $val->user->third_name);
                $sheet->setCellValue('D' . $key + 2, $val->user->last_name);
                $sheet->setCellValue('E' . $key + 2, $val->user->email);
                $sheet->setCellValue('F' . $key + 2, $val->user->identify);
                $sheet->setCellValue('G' . $key + 2, $gender1);
                $sheet->setCellValue('H' . $key + 2, $nationality1);
                $sheet->setCellValue('I' . $key + 2, $val->user->birthday);
                $sheet->setCellValue('J' . $key + 2, $val->user->address);
                $sheet->setCellValue('K' . $key + 2, $val->user->mobile);
                $sheet->setCellValue('L' . $key + 2, $val->user->mobile2);
                $sheet->setCellValue('M' . $key + 2, $val->s_name->name_ar);
                $sheet->setCellValue('N' . $key + 2, $val->s_name->id);
                $sheet->setCellValue('O' . $key + 2, $val->winner);
                $sheet->setCellValue('P' . $key + 2, $val->degree);
                $sheet->setCellValue('Q' . $key + 2, $val->level);
                $sheet->setCellValue('R' . $key + 2, $val->notes);
                $sheet->setCellValue('S' . $key + 2, $val->admin_notes);
                $sheet->setCellValue('T' . $key + 2, $val->user_notes);
                $sheet->setCellValue('AD' . ($key + 2), $val->created_at);
                $selections = \App\Selection::where('subscription_id', $val->id)->get();

                $cells = ['U' . $key + 2, 'V' . $key + 2, 'W' . $key + 2, 'X' . $key + 2, 'Y' . $key + 2];

                foreach ($selections as $k => $v) {
                    if ($k > 4) {
                        break;
                    }
                    $sheet->setCellValue($cells[$k], $v->options);
                }

                $sheet->setCellValue('Z' . $key + 2, $val->date);
                // $sheet->setCellValue('AA' . $key + 2, explode('-', $val->user->address)[0]);
                // $sheet->setCellValue('AB' . $key + 2, explode('-', $val->user->address)[1]);
                $addressParts = explode('-', $val->user->address);

// Use ternary operators to check if each part exists
$sheet->setCellValue('AA' . ($key + 2), $addressParts[0] ?? ''); // City
$sheet->setCellValue('AB' . ($key + 2), $addressParts[1] ?? '');
                $sheet->setCellValue('AC' . $key + 2, $val->number);
            }
        }


        $writer = new Xlsx($spreadsheet);
        $name = 'subscriptions';
        $writer->save($name . '.xlsx');
        return redirect($name . '.xlsx');
    }

    public function ImportExcel()
    {
        return view('admin.pages.subscriptions.excel');
    }
    public function DoImportExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $path = request()->file('file')->getRealPath();
        $spreadsheet = IOFactory::load($path);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $key => $val) {
            if ($key > 1) {
                $user = User::where('identify', $val['C'])->first();
                if (empty($user)) {
                    User::insert([
                        'username' => $val['A'] . ' ' . $val['B'] . ' ' . $val['C'] . $val['D'],
                        'first_name' => $val['A'],
                        'second_name' => $val['B'],
                        'third_name' => $val['C'],
                        'last_name' => $val['D'],
                        'email' => $val['E'],
                        'identify' => $val['F'],
                        'gender' => $val['G'],
                        'nationality' => $val['H'],
                        'birthday' => $val['I'],
                        'address' => $val['J'],
                        'mobile' => $val['K'],
                        'mobile2' => $val['L'],
                        'active' => 'active',
                    ]);
                }
                $user = User::where('identify', $val['F'])->first();

                $check_subscription = Subscription::where('user_id', $user->id)->where('date', $val['Z'])->first();

                if (empty($check_subscription)) {
                    $id = Subscription::insertGetId([
                        'user_id' => $user->id,
                        'name_id' => $val['N'],
                        'winner' => $val['O'],
                        'degree' => $val['P'],
                        'level' => $val['Q'],
                        'notes' => $val['R'],
                        'admin_notes' => $val['S'],
                        'user_notes' => $val['T'],
                        'date' => $val['Z'],
                        'active' => 'active',
                    ]);
                } else {
                    Subscription::where('id', $check_subscription->id)->update([
                        'user_id' => $user->id,
                        'name_id' => $val['N'],
                        'winner' => $val['O'],
                        'degree' => $val['P'],
                        'level' => $val['Q'],
                        'notes' => $val['R'],
                        'admin_notes' => $val['S'],
                        'user_notes' => $val['T'],
                        'date' => $val['Z'],
                        'active' => 'active',
                    ]);
                    $id = $check_subscription->id;
                    Selection::where('subscription_id', $check_subscription->id)->delete();
                }

                $cells = ['U', 'V', 'W', 'X', 'Y'];

                for ($i = 0; $i < 5; $i++) {
                    if (!empty($val[$cells[$i]]) and is_numeric($val[$cells[$i]])) {
                        Selection::insert([
                            'subscription_id' => $id,
                            'options' => $val[$cells[$i]],
                        ]);
                    }
                }

                return redirect('admin/subscriptions')->with('success', 'تم استيراد الملف بنجاح');
            }
        }
    }

    public function GetSubscription($id)
    {
        $user = User::where('id', request('user_id'))->first();
        if (empty($user)) {
            return 0;
        }
        return view('admin.pages.subscriptions.get-subscription', ['id' => $id, 'user' => $user]);
    }
  

}
