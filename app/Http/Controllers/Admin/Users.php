<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;
use App\Subscription;

use App\User;
use App\UsersPrevent;

class Users extends Controller
{
    public function login()
    {
        if (auth()->guard("admin")->check()) {
            return redirect("/admin");
        }
        return view("admin.login");
    }

    public function doLogin()
    {

        $user = User::where('email', request('email'))->where('active', 'active')->where('type', 'admin')->first();

        if (empty($user)) {
            return back()->withInput()->with('error', "الرجاء ادخال بريد الكتروني صحيح.");
        }

        if ($user->password != request('password')) {
            return back()->withInput()->with('error', "الرجاء التأكد من كلمة المرور.");
        }

        if (auth()->guard("admin")->loginUsingId($user->id)) {
            return redirect("/admin");
        } else {
            return back()->with("error", "فشلت العملة الرجاء المحاولة مرة أخرى.");
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/');
    }
    
    public function updateSubscriptionNumber(Request $request)
{
    // Validate the input
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'number' => 'nullable|numeric',
    ]);

    // Retrieve the subscription based on the user_id
    $subscription = Subscription::where('user_id', $request->user_id)->first();

    // If no subscription exists, return an error
    if (!$subscription) {
        return response()->json(['success' => false, 'message' => 'Subscription not found']);
    }

    // Update the subscription number
    $subscription->number = $request->number ?? null; // Handle nullable field
    $subscription->save();

    return response()->json(['success' => true, 'message' => 'Subscription number updated successfully']);
}


    public function index()
    {
        $data = User::where("id", "!=", 1);

        if (!empty(request('username'))) {
            $data = $data->where('username', 'LIKE', '%' . request('username') . '%');
        }

        if (!empty(request('id'))) {
            $data = $data->where('identify', 'LIKE', '%' . request('id') . '%');
        }

        if (!empty(request('type'))) {
            $data = $data->where('type', request('type'));
        }

        if (!empty(request('first_name'))) {
            $data = $data->where('first_name', 'LIKE', '%' . request('first_name') . '%');
        }

        if (!empty(request('last_name'))) {
            $data = $data->where('last_name', 'LIKE', '%' . request('last_name') . '%');
        }

        if (!empty(request('email'))) {
            $data = $data->where('email', 'LIKE', '%' . request('email') . '%');
        }

        if (!empty(request('mobile'))) {
            $data = $data->where('mobile', 'LIKE', '%' . request('mobile') . '%');
        }

        if (!empty(request('address'))) {
            $data = $data->where('address', 'LIKE', '%' . request('address') . '%');
        }

        if (!empty(request('date'))) {
            $data = $data->where('created_at', 'LIKE', '%' . request('date') . '%');
        }
                if (request('number')) {
        $data->whereHas('subscription', function ($query) {
            $query->where('number', 'LIKE', '%' . request('number') . '%');
        });
    }
//  if (!empty(request('subscription_number'))) {
//         $data = $data->whereHas('subscription', function ($query) {
//             $query->where('number', 'LIKE', '%' . request('subscription_number') . '%');
//         });
//     }
        //$data = $data->orderBy("id", "desc")->paginate();
        $data = $data->orderBy("id", "desc")->paginate(30);
        //$totalUsers = User::count();
        $totalUsers = $data->total();

    //return view('admin.users.index', compact('data', 'totalUsers'));
        return view("admin.pages.users.index", ['data' => $data,'totalUsers' => $totalUsers]);
    }

    public function show($id)
    {
        $data = User::where([["id", $id], ["id", "!=", 1]])->orderBy("id", "desc")->first();
        if (!empty($data)) {
            return view("admin.pages.users.show", ['data' => $data]);
        } else {
            return back()->with("error", "فشلت العملية");
        }
    }

    public function deny($id)
    {
        $data = User::where([["id", $id], ["id", "!=", 1]])->orderBy("id", "desc")->first();
        if (empty($data)) {
            return back()->with("error", "فشلت العملية");
        }
        $data_prevents = UsersPrevent::where('user_id', $id)->first();
        if (empty($data_prevents)) {
            for ($i = 1; $i <= 30; $i++) {
                UsersPrevent::insert([
                    'user_id' => $id,
                    'type' => 'part',
                    'options' => $i,
                    'active' => 'deactive',
                ]);
            }

            for ($i = 1; $i <= 60; $i++) {
                UsersPrevent::insert([
                    'user_id' => $id,
                    'type' => 'hizb',
                    'options' => $i,
                    'active' => 'deactive',
                ]);
            }

            /* UsersPrevent::insert([
                'user_id' => $id,
                'options' => 59,
                'active' => 'deactive',
            ]);

            UsersPrevent::insert([
                'user_id' => $id,
                'options' => 60,
                'active' => 'deactive',
            ]); */
        }
        $data_prevents = UsersPrevent::where('user_id', $id)->get();
        return view("admin.pages.users.deny", ['data' => $data_prevents]);
    }

    public function DoDeny($id)
    {

        $data = User::where([["id", $id], ["id", "!=", 1]])->orderBy("id", "desc")->first();
        if (empty($data)) {
            return back()->with("error", "فشلت العملية");
        }

        for ($i = 1; $i <= 30; $i++) {
            $part = request("part$i") ? "active" : "deactive";
            UsersPrevent::where('user_id', $id)->where('type', 'part')->where('options', $i)->update([
                'active' => $part,
            ]);
        }

        for ($i = 1; $i <= 60; $i++) {
            $part = request("hizb$i") ? "active" : "deactive";
            UsersPrevent::where('user_id', $id)->where('type', 'hizb')->where('options', $i)->update([
                'active' => $part,
            ]);
        }

        /* $part59 = request('part59') ? "active" : "deactive";
        $part60 = request('part60') ? "active" : "deactive";
        UsersPrevent::where('user_id', $id)->where('options', 59)->update([
            'active' => $part59,
        ]);
        UsersPrevent::where('user_id', $id)->where('options', 60)->update([
            'active' => $part60,
        ]); */

        return back()->with("success", "تم التعديل بنجاح.");
    }

    public function add()
    {
        return view("admin.pages.users.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'third_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string',
            'birthday' => 'required|string',
            'nationality' => 'required|numeric',
            'city' => 'required|numeric',
            'region' => 'required|numeric',
            'identify' => 'required|numeric',
            'mobile' => 'required|numeric',
            'mobile2' => 'numeric',
            'type' => 'required|in:admin,user',
            'gender' => 'required|in:male,female',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);

        $active = request('active') ? "active" : "deactive";

        $image = "";
        if (!empty(request()->file('image'))) {
            $file = request()->file('image');
            $ext = $file->getClientOriginalExtension();
            $image = Str::Random(40) . "." . $ext;
            $file->move(public_path('images'), $image);
        }

        $nationality = \App\Nationality::where('id', request('nationality'))->first()->code;
        $city = \App\City::where('id', request('city'))->first()->name_ar;
        $region = !empty(\App\Region::where('id', request('region'))->first()) ? \App\Region::where('id', request('region'))->first()->name_ar : 0;

        $id = User::insertGetId([
            "email" => request('email'),
            'username' => request('first_name') . ' ' . request('second_name') . ' ' . request('third_name') . ' ' . request('last_name'),
            'first_name' => request('first_name'),
            'second_name' => request('second_name'),
            'third_name' => request('third_name'),
            'last_name' => request('last_name'),
            "mobile" => request('mobile'),
            "mobile2" => request('mobile2'),
            "type" => request('type'),
            "nationality" => $nationality,
            'nationality_id' => request('nationality'),
            "birthday" => request('birthday'),
            "address" => $city . " - " . $region,
            'city_id' => request('city'),
            'region_id' => request('region'),
            "identify" => request('identify'),
            "gender" => request('gender'),
            "password" => request('password'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/users")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->where('id', '!=', 1)->orderBy("id", 'desc')->first();
        if (empty($data)) {
            return redirect("/admin/users")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.users.edit', ['data' => $data]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'third_name' => 'required|string',
            'last_name' => 'required|string',
            'birthday' => 'required|string',
            'nationality' => 'required|numeric',
            'city' => 'required|numeric',
            'region' => 'required|numeric',
            'identify' => 'required|numeric',
            'mobile' => 'required|numeric',
            'mobile2' => 'numeric',
            'type' => 'required|in:admin,user',
            'gender' => 'required|in:male,female',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);

        $active = request('active') ? "active" : "deactive";

        if (!empty(request()->file('image'))) {
            $file = request()->file('image');
            $ext = $file->getClientOriginalExtension();
            $image = Str::Random(40) . "." . $ext;
            $file->move(public_path('images'), $image);
        } else {
            $image = request('old_image');
        }

        $user = DB::table('users')->where(['id' => $id])->first();

        $password = empty(request('password')) ? $user->password : request('password');

        $nationality = \App\Nationality::where('id', request('nationality'))->first()->code;
        $city = \App\City::where('id', request('city'))->first()->name_ar;
        $region = !empty(\App\Region::where('id', request('region'))->first()) ? \App\Region::where('id', request('region'))->first()->name_ar : 0;

        User::where("id", $id)->update([
            "email" => request('email'),
            'username' => request('first_name') . ' ' . request('second_name') . ' ' . request('third_name') . ' ' . request('last_name'),
            'first_name' => request('first_name'),
            'second_name' => request('second_name'),
            'third_name' => request('third_name'),
            'last_name' => request('last_name'),
            "mobile" => request('mobile'),
            "mobile2" => request('mobile2'),
            "type" => request('type'),
            "nationality" => $nationality,
            'nationality_id' => request('nationality'),
            "birthday" => request('birthday'),
            "address" => $city . " - " . $region,
            'city_id' => request('city'),
            'region_id' => request('region'),
            "identify" => request('identify'),
            "gender" => request('gender'),
            "password" => request('password'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/users")->with("success", "تم التعديل بنجاح.");
    }

    public function profile()
    {
        return view("admin.pages.users.profile");
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
        ]);


        $password = empty(request('password')) ? auth()->guard('admin')->user()->password : request('password');

        DB::table('users')->where("id", auth()->guard('admin')->user()->id)->update([
            "username" => request('username'),
            "password" => $password,
        ]);

        return back()->with("success", "تم التعديل بنجاح.");
    }


    public function delete($id)
    {
        User::where('id', $id)->where('id', '!=', 1)->delete();
        return 1;
    }
}
