<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\City;

class Cities extends Controller
{



    public function index()
    {
        $data = City::orderBy("id", "desc")->paginate();
        return view("admin.pages.cities.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.cities.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);

        $active = request('active') ? "active" : "deactive";


        $id = City::insertGetId([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "active" => $active,
        ]);

        return redirect("/admin/cities")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $cities = City::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($cities)) {
            return redirect("/admin/cities")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.cities.edit', ['data' => $cities]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);

        $active = request('active') ? "active" : "deactive";


        $id = DB::table('cities')->where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "active" => $active,
        ]);

        return redirect("/admin/cities")->with("success", "تم التعديل بنجاح.");
    }




    public function delete($id)
    {
        City::where('id', $id)->delete();
        return 1;
    }
}
