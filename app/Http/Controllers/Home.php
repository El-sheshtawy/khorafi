<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Subscription;
use App\User;
use App\Gallery;
use App\Location;
use App\Contact;
use App\Selection;
use App\UsersPrevent;

class Home extends Controller
{
    public function index()
    {
        return view("pages.home");
    }

    public function posts()
    {

        $data = \App\Post::where('active', 'active')->where('type', 0);

        if (!empty(request('date'))) {
            $data = $data->where('created_at', 'LIKE', '%' . request('date') . '%');
        }

        $data = $data->orderBy('id', 'desc')->paginate(9);

        return view("pages.posts", ['data' => $data]);
    }

    public function post($id)
    {

        $data = \App\Post::where('active', 'active')->where('id', $id)->first();

        if (empty($data)) {
            return redirect('posts')->with('error', trans('web.post_not_found'));
        }

        return view("pages.post", ['data' => $data]);
    }

    public function gallery()
    {

        $data = Gallery::where('active', 'active');

        if (!empty(request('date'))) {
            $data = $data->where('created_at', 'LIKE', '%' . request('date') . '%');
        }

        $data = $data->orderBy('id', 'desc')->paginate(9);

        return view("pages.gallery", ['data' => $data]);
    }

    public function locations()
    {

        $data = new Location();

        if (!empty(request('name'))) {
            $data = $data->where('name_ar', 'LIKE', '%' . request('name') . '%')->where('active', 'active')->orWhere('name_ar', 'LIKE', '%' . request('name') . '%')->where('active', 'active');
        }


        $data = $data->orderBy('id', 'desc')->paginate(9);

        return view("pages.locations", ['data' => $data]);
    }

    public function opinions()
    {

        $data = \App\Post::where('active', 'active')->where('type', 1);

        if (!empty(request('date'))) {
            $data = $data->where('created_at', 'LIKE', '%' . request('date') . '%');
        }

        $data = $data->orderBy('id', 'desc')->paginate(9);

        return view("pages.opinions", ['data' => $data]);
    }

    public function results()
    {

        $config = DB::table('config')->first();

        $data = new Subscription();

        if (!empty(request('identify'))) {
            $users = User::where('identify', 'LIKE', '%' . request('identify') . '%')->get();
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
            $data = $data->where('date', 'LIKE', '%' . $config->year . '%');
        }

        if (empty(request('winner'))) {
            $data = $data->where('winner', 1);
        } else if (request('winner') == 1) {
            $data = $data->where('winner', 1);
        }

        $data = $data->orderBy('level', 'asc')->paginate();

        return view("pages.results", ['data' => $data]);
    }

    public function subscription()
    {
        $config = DB::table('config')->first();
        if (!empty(request('identify'))) {
            $user = User::where('identify', request('identify'))->where('active', 'active')->first();
            if (!empty($user)) {
                return view('pages.subscription-user', ['user' => $user, 'config' => $config]);
            } else {
                return view('pages.subscription-register', ['config' => $config]);
            }
        }
        return view('pages.subscription', ['config' => $config]);
    }

    public function GetSubscription($id)
    {
        if (!empty(request('identify'))) {
            $user = User::where('identify', request('identify'))->first();
            if (empty($user)) {
                return 0;
            }
            return view('pages.get-subscription-user', ['id' => $id, 'user' => $user]);
        }
        return view('pages.get-subscription', ['id' => $id]);
    }
    //here i will make the updating on the usersubcription to add nationaltiy and also city and also region selection
    public function UserSubscription(Request $request)
    {
        $user = User::where('identify', request('identify'))->first();
        if (empty($user)) {
            return back()->with('error', trans('web.empty_user'));
        }

        $config = DB::table('config')->first();
        $check = Subscription::where('user_id', $user->id)->where('number', $config->number)->first();
        if (!empty($check)) {
            return back()->with('error', trans('web.registerd_bedore'));
        }

        if (!in_array(request('subscription_type'), [1, 2, 3, 4])) {
            return back()->withInput()->with('error', trans('web.error_select_subscription'));
        }



        if (request('subscription_type') == 1) {

            if (empty(\App\Nationality::where('status', 1)->where('active', 'active')->where('code', $user->nationality)->first())) {
                return back()->withInput()->with('error', trans('web.error_select_subscription_nationality'));
            }

            if (User::age($user->birthday) >= 9) {
                return back()->withInput()->with('error', trans('web.error_in_your_age_1'));
            }

            if (request('hizb_number') < 1 or request('hizb_number') > 60) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (!empty(\App\UsersPrevent::where('user_id', $user->id)->where('options', request('hizb_number'))->where('active', 'active')->first())) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (request('subscription_type') == 2) {

            if (User::age($user->birthday) >= 15) {
                return back()->withInput()->with('error', trans('web.error_in_your_age_2'));
            }

            if (request('part_number') < 1 or request('part_number') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (!empty(\App\UsersPrevent::where('user_id', $user->id)->where('options', request('part_number'))->where('active', 'active')->first())) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (request('subscription_type') == 3) {

            if (User::age($user->birthday) >= 25) {
                return back()->withInput()->with('error', trans('web.error_in_your_age_3'));
            }

            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number2') < 1 or request('part_number2') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number3') < 1 or request('part_number3') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }

            if (!empty(\App\UsersPrevent::where('user_id', $user->id)->whereIn('options', [request('part_number1'), request('part_number2'), request('part_number3')])->where('active', 'active')->first())) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }

            $size = sizeof(array_unique([request('part_number1'), request('part_number2'), request('part_number3')]));
            if ($size < 3) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (request('subscription_type') == 4) {
            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number2') < 1 or request('part_number2') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number3') < 1 or request('part_number3') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number4') < 1 or request('part_number4') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number5') < 1 or request('part_number5') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }

            if (!empty(\App\UsersPrevent::where('user_id', $user->id)->whereIn('options', [request('part_number1'), request('part_number2'), request('part_number3'), request('part_number4'), request('part_number5')])->where('active', 'active')->first())) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }

            $size = sizeof(array_unique([request('part_number1'), request('part_number2'), request('part_number4'), request('part_number5'), request('part_number3')]));
            if ($size < 5) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }


        $notes = !empty(request('notes')) ? filter_var(request('notes'), FILTER_SANITIZE_STRING) : '';

        
        
        try {
            $subscription_id = Subscription::insertGetId([
                'user_id' => $user->id,
                'city_id' => $user->city_id,
                'name_id' => request('subscription_type'),
                'number' => $config->number,
                'active' => 'active',
                'notes' => $notes,
                'date' => date('Y'),
            ]);
        } catch(\Illuminate\Database\QueryException $e){
            
        }

        $subscription = Subscription::where('user_id', $user->id)->orderBy('id', 'desc')->first();


        if (request('subscription_type') == 1) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('hizb_number'),
            ]);
        }

        if (request('subscription_type') == 2) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number'),
            ]);
        }

        if (request('subscription_type') == 3) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number1'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number2'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number3'),
            ]);
        }

        if (request('subscription_type') == 4) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number1'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number2'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number3'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number4'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number5'),
            ]);
        }

        return redirect('subscription')->with('success', trans('web.subscription_done'));
    }
// public function UserSubscription(Request $request)
// {
//     // Fetch the user
//     $user = User::where('identify', $request->input('identify'))->first();
//     if (empty($user)) {
//         return back()->with('error', trans('web.empty_user'));
//     }

//     // Fetch configuration
//     $config = DB::table('config')->first();

//     // Check for existing subscription
//     $check = Subscription::where('user_id', $user->id)->where('number', $config->number)->first();
//     if (!empty($check)) {
//         return back()->with('error', trans('web.registerd_bedore'));
//     }

//     // Validate the inputs
//     $request->validate([
//         'subscription_type' => 'required|in:1,2,3,4',
//         'nationality' => 'required|exists:nationalities,code', // Assuming nationality is stored in a nationalities table
//         'city' => 'required|exists:cities,id', // Assuming cities are stored in a cities table
//         'region' => 'required|exists:regions,id', // Assuming regions are stored in a regions table
//     ]);

//     // Additional subscription type validations
//     if ($request->input('subscription_type') == 1) {
//         if (User::age($user->birthday) >= 9) {
//             return back()->withInput()->with('error', trans('web.error_in_your_age_1'));
//         }

//         if ($request->input('hizb_number') < 1 || $request->input('hizb_number') > 60) {
//             return back()->withInput()->with('error', trans('web.error_select_part'));
//         }
//     } elseif ($request->input('subscription_type') == 2) {
//         if (User::age($user->birthday) >= 15) {
//             return back()->withInput()->with('error', trans('web.error_in_your_age_2'));
//         }

//         if ($request->input('part_number') < 1 || $request->input('part_number') > 30) {
//             return back()->withInput()->with('error', trans('web.error_select_part'));
//         }
//     } elseif ($request->input('subscription_type') == 3) {
//         if (User::age($user->birthday) >= 25) {
//             return back()->withInput()->with('error', trans('web.error_in_your_age_3'));
//         }

//         $parts = [
//             $request->input('part_number1'),
//             $request->input('part_number2'),
//             $request->input('part_number3'),
//         ];

//         if (count(array_unique($parts)) < 3) {
//             return back()->withInput()->with('error', trans('web.error_select_part'));
//         }
//     } elseif ($request->input('subscription_type') == 4) {
//         $parts = [
//             $request->input('part_number1'),
//             $request->input('part_number2'),
//             $request->input('part_number3'),
//             $request->input('part_number4'),
//             $request->input('part_number5'),
//         ];

//         if (count(array_unique($parts)) < 5) {
//             return back()->withInput()->with('error', trans('web.error_select_part'));
//         }
//     }

//     try {
//         // Update or create subscription
//         $subscription_id = Subscription::updateOrCreate(
//             [
//                 'user_id' => $user->id,
//                 'number' => $config->number,
//             ],
//             [
//                 'name_id' => $request->input('subscription_type'),
//                 'city_id' => $request->input('city'),
//                 'region_id' => $request->input('region'),
//                 'active' => 'active',
//                 'notes' => filter_var($request->input('notes'), FILTER_SANITIZE_STRING),
//                 'date' => date('Y'),
//             ]
//         )->id;

//         // Update selections for subscription
//         if ($request->input('subscription_type') == 1) {
//             Selection::updateOrCreate([
//                 'subscription_id' => $subscription_id,
//                 'options' => $request->input('hizb_number'),
//             ]);
//         } elseif (in_array($request->input('subscription_type'), [2, 3, 4])) {
//             $parts = array_filter($request->only([
//                 'part_number1', 'part_number2', 'part_number3', 'part_number4', 'part_number5',
//             ]));

//             foreach ($parts as $part) {
//                 Selection::updateOrCreate([
//                     'subscription_id' => $subscription_id,
//                     'options' => $part,
//                 ]);
//             }
//         }
//     } catch (\Exception $e) {
//         return back()->with('error', trans('web.error_occurred'));
//     }

//     return redirect('subscription')->with('success', trans('web.subscription_done'));
// }

    public function RegisterSubscription(Request $request)
    {   //here i try to make nationality is required 
        // $request->validate([
        //     'identify' => 'required|numeric|digits:12',
        //     'first_name' => 'required|string',
        //     'second_name' => 'required|string',
        //     'third_name' => 'required|string',
        //     'last_name' => 'required|string',
        //     'gender' => 'required|in:male,female',
        //     'nationality' => 'required|numeric',
        //     'birthday' => 'required|string',
        //     'city' => 'required|numeric',
        //     'mobile' => 'required|numeric',
        // ]);
        $request ->validate(
            [
                 'identify' => 'required|numeric|digits:12',
    'first_name' => 'required|string',
    'second_name' => 'required|string',
    'third_name' => 'required|string',
    'last_name' => 'required|string',
    'gender' => 'required|in:male,female',
    'nationality' => 'required|numeric|exists:nationalities,id', // nationality required and must exist in the nationality table
    'birthday' => 'required|string',
    'city' => 'required|numeric|exists:cities,id', // city required and must exist in the cities table
    'mobile' => 'required|numeric',
                ]
            );
        if (!empty(User::where('identify', request('identify'))->first())) {
            return redirect('subscription?identify=' . request('identify'));
        }

        if (empty(\App\Nationality::where('id', request('nationality'))->first())) {
            return back()->withInput()->with('error', trans("web.nationality_not_exist"));
        }

        if (empty(\App\City::where('id', request('city'))->first())) {
            return back()->withInput()->with('error', trans("web.city_not_exist"));
        }

        if (!empty(request('email'))) {
            $request->validate([
                'email' => 'email',
            ]);
        }

        if (!empty(request('mobile2'))) {
            $request->validate([
                'mobile2' => 'numeric',
            ]);
        }


        if (!empty(request('state'))) {
            $request->validate([
                'state' => 'numeric',
            ]);
            if (empty(\App\Region::where('id', request('region'))->first())) {
                return back()->withInput()->with('error', trans("web.region_not_exist"));
            }
        }


        if (!in_array(request('subscription_type'), [1, 2, 3, 4])) {
            return back()->withInput()->with('error', trans('web.error_select_subscription'));
        }

        if (request('subscription_type') == 1) {

            $nationality = \App\Nationality::where('id', request('nationality'))->first()->code;
            if (empty(\App\Nationality::where('status', 1)->where('active', 'active')->where('code', $nationality)->first())) {
                return back()->withInput()->with('error', trans('web.error_select_subscription_nationality'));
            }

            if (User::age(request('birthday')) >= 9) {
                return back()->withInput()->with('error', trans('web.error_in_your_age_1'));
            }

            if (request('hizb_number') < 1 or request('hizb_number') > 60) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (request('subscription_type') == 2) {

            if (User::age(request('birthday')) >= 15) {
                return back()->withInput()->with('error', trans('web.error_in_your_age_2'));
            }

            if (request('part_number') < 1 or request('part_number') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (request('subscription_type') == 3) {

            if (User::age(request('birthday')) >= 25) {
                return back()->withInput()->with('error', trans('web.error_in_your_age_3'));
            }

            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number2') < 1 or request('part_number2') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number3') < 1 or request('part_number3') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }

            $size = sizeof(array_unique([request('part_number1'), request('part_number2'), request('part_number3')]));
            if ($size < 3) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (request('subscription_type') == 4) {
            if (request('part_number1') < 1 or request('part_number1') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number2') < 1 or request('part_number2') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number3') < 1 or request('part_number3') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number4') < 1 or request('part_number4') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
            if (request('part_number5') < 1 or request('part_number5') > 30) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }

            $size = sizeof(array_unique([request('part_number1'), request('part_number2'), request('part_number4'), request('part_number5'), request('part_number3')]));
            if ($size < 5) {
                return back()->withInput()->with('error', trans('web.error_select_part'));
            }
        }

        if (!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
            $name = "name_en";
            $body = "body_en";
        } else {
            $name = "name_ar";
            $body = "body_ar";
        }
        $nationality = \App\Nationality::where('id', request('nationality'))->first()->code;
        $city = \App\City::where('id', request('city'))->first()->$name;
        $region = !empty(\App\Region::where('id', request('region'))->first()) ? \App\Region::where('id', request('region'))->first()->$name : 0;
        $region1 = !empty(\App\Region::where('id', request('region'))->first()) ? \App\Region::where('id', request('region'))->first()->id : 0;


        $id = User::insert([
            'identify' => request('identify'),
            'email' => request('email'),
            'username' => request('first_name') . ' ' . request('second_name') . ' ' . request('third_name') . ' ' . request('last_name'),
            'first_name' => request('first_name'),
            'second_name' => request('second_name'),
            'third_name' => request('third_name'),
            'last_name' => request('last_name'),
            'type' => 'user',
            'gender' => request('gender'),
            'nationality' => $nationality,
            'nationality_id' => request('nationality'),
            'birthday' => request('birthday'),
            'city_id' => request('city'),
            'region_id' => $region1,
            'address' => $city . ' - ' . $region,
            'mobile' => request('mobile'),
            'mobile2' => request('mobile2'),
            'active' => 'active',
        ]);

        $user = User::where('identify', request('identify'))->first();


        $notes = !empty(request('notes')) ? filter_var(request('notes'), FILTER_SANITIZE_STRING) : '';
        
        $config = DB::table('config')->first();

        try {
            $subscription_id = Subscription::insertGetId([
                'user_id' => $user->id,
                'name_id' => request('subscription_type'),
                'number' => $config->number,
                'city_id' => request('city'),
                'active' => 'active',
                'notes' => $notes,
                'date' => date('Y'),
            ]);
        } catch(\Illuminate\Database\QueryException $e){
            
        }
        

        $subscription = Subscription::where('user_id', $user->id)->orderBy('id', 'desc')->first();


        if (request('subscription_type') == 1) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('hizb_number'),
            ]);
        }

        if (request('subscription_type') == 2) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number'),
            ]);
        }

        if (request('subscription_type') == 3) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number1'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number2'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number3'),
            ]);
        }

        if (request('subscription_type') == 4) {
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number1'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number2'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number3'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number4'),
            ]);
            Selection::insert([
                'subscription_id' => $subscription->id,
                'options' => request('part_number5'),
            ]);
        }

        return redirect('subscription')->with('success', trans('web.subscription_done'));
    }

    public function contact()
    {
        return view('pages.contact');
    }


    public function DoContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::insert([
            'name' => request('name'),
            'email' => request('email'),
            'message' => request('message'),
            'active' => 'pending',
        ]);

        return back()->with('success', trans('web.contact_done'));
    }

    public function GetRegions($id)
    {
        $data = \App\Region::where('city_id', $id)->where('active', 'active')->get();
        return view('pages.get-regions', ['data' => $data]);
    }
}
