<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\Region;

class Regions extends Controller
{



    public function index()
    {
        $data = Region::orderBy("id", "desc")->paginate();
        return view("admin.pages.regions.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.regions.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'city_id' => 'required|numeric',
        ]);

        $active = request('active') ? "active" : "deactive";


        $id = Region::insertGetId([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "city_id" => request('city_id'),
            "active" => $active,
        ]);

        return redirect("/admin/regions")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $regions = Region::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($regions)) {
            return redirect("/admin/regions")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.regions.edit', ['data' => $regions]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'city_id' => 'required|numeric',
        ]);

        $active = request('active') ? "active" : "deactive";


        $id = DB::table('regions')->where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "city_id" => request('city_id'),
            "active" => $active,
        ]);

        return redirect("/admin/regions")->with("success", "تم التعديل بنجاح.");
    }




    public function delete($id)
    {
        Region::where('id', $id)->delete();
        return 1;
    }
}
