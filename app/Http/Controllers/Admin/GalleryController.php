<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\Gallery;

class GalleryController extends Controller
{



    public function index()
    {
        $data = Gallery::orderBy("id", "desc")->paginate();
        return view("admin.pages.gallery.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.gallery.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $active = request('active') ? "active" : "deactive";

        $file = request()->file('image');
        $ext = $file->getClientOriginalExtension();
        $image = Str::Random(40) . "." . $ext;
        $file->move(public_path('images'), $image);


        $id = Gallery::insertGetId([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/gallery")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $gallery = Gallery::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($gallery)) {
            return redirect("/admin/gallery")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.gallery.edit', ['data' => $gallery]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
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

        $id = DB::table('gallery')->where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/gallery")->with("success", "تم التعديل بنجاح.");
    }


    public function delete($id)
    {
        Gallery::where('id', $id)->delete();
        return 1;
    }
}
