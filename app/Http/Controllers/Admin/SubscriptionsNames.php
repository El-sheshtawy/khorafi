<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\SubscriptionsName;

class SubscriptionsNames extends Controller
{



    public function index()
    {
        $data = SubscriptionsName::paginate();
        return view("admin.pages.subscriptionsnames.index", ['data' => $data]);
    }


    public function edit($id)
    {
        $subscriptionsnames = SubscriptionsName::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($subscriptionsnames)) {
            return redirect("/admin/subscriptionsnames")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.subscriptionsnames.edit', ['data' => $subscriptionsnames]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);


        $id = SubscriptionsName::where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
        ]);

        return redirect("/admin/subscriptionsnames")->with("success", "تم التعديل بنجاح.");
    }
}
