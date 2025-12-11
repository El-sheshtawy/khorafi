<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\Slider;

class Sliders extends Controller
{



    public function index()
    {
        $data = Slider::orderBy("id", "desc")->paginate();
        return view("admin.pages.sliders.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.sliders.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $active = request('active') ? "active" : "deactive";

        $file = request()->file('image');
        $ext = $file->getClientOriginalExtension();
        $image = Str::Random(40) . "." . $ext;
        $file->move(public_path('images'), $image);


        $id = Slider::insertGetId([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "body_ar" => request('body_ar'),
            "body_en" => request('body_en'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/sliders")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $sliders = Slider::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($sliders)) {
            return redirect("/admin/sliders")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.sliders.edit', ['data' => $sliders]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
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

        $id = DB::table('sliders')->where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "body_ar" => request('body_ar'),
            "body_en" => request('body_en'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/sliders")->with("success", "تم التعديل بنجاح.");
    }




    public function delete($id)
    {
        Slider::where('id', $id)->delete();
        return 1;
    }
}
