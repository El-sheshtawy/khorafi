<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\Nationality;

class Nationalities extends Controller
{



    public function index()
    {
        $data = Nationality::orderBy("id", "desc")->paginate();
        return view("admin.pages.nationalities.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.nationalities.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|string',
        ]);

        $active = request('active') ? "active" : "deactive";
        $status = request('status') ? 1 : 0;


        $id = Nationality::insertGetId([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "code" => request('code'),
            "active" => $active,
            "status" => $status,
        ]);

        return redirect("/admin/nationalities")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $nationalities = Nationality::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($nationalities)) {
            return redirect("/admin/nationalities")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.nationalities.edit', ['data' => $nationalities]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|string',
        ]);

        $active = request('active') ? "active" : "deactive";
        $status = request('status') ? 1 : 0;


        $id = DB::table('nationalities')->where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "code" => request('code'),
            "active" => $active,
            "status" => $status,
        ]);

        return redirect("/admin/nationalities")->with("success", "تم التعديل بنجاح.");
    }




    public function delete($id)
    {
        Nationality::where('id', $id)->delete();
        return 1;
    }
}
