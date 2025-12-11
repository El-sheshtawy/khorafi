<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

class Categories extends Controller
{



    public function index()
    {
        $data = DB::table("categories")->where([["active", "!=", "DELETED"]])->orderBy("id", "desc")->paginate();
        return view("admin.pages.categories.view", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.categories.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'icon' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $active = request('active') ? "ACTIVE" : "DEACTIVE";

        $file = request()->file('image');
        $ext = $file->getClientOriginalExtension();
        $name = Str::Random(40) . "." . $ext;
        $path = $file->getRealPath();
        $file->move(public_path('images'), $name);

        $file = request()->file('icon');
        $ext = $file->getClientOriginalExtension();
        $icon = Str::Random(40) . "." . $ext;
        $path = $file->getRealPath();
        $file->move(public_path('images'), $icon);

        $id = DB::table("categories")->insertGetId([
            "name" => request('name'),
            "active" => $active,
            "image" => $name,
            "icon" => $icon,
            "date" => date("Y-m-d h:i:sa"),
        ]);

        return redirect("/admin/categories")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->where([['active', '!=', "DELETED"], ['id', $id]])->orderBy("id", 'desc')->first();
        if (empty($categories)) {
            return redirect("/admin/categories")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.categories.edit', ['data' => $categories]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png',
            'icon' => 'image|mimes:jpg,jpeg,png',
        ]);

        $active = request('active') ? "ACTIVE" : "DEACTIVE";

        if (!empty(request()->file('image'))) {
            $file = request()->file('image');
            $ext = $file->getClientOriginalExtension();
            $name = Str::Random(40) . "." . $ext;
            $path = $file->getRealPath();
            $file->move(public_path('images'), $name);
        } else {
            $name = request('old_image');
        }

        if (!empty(request()->file('icon'))) {
            $file = request()->file('icon');
            $ext = $file->getClientOriginalExtension();
            $icon = Str::Random(40) . "." . $ext;
            $path = $file->getRealPath();
            $file->move(public_path('images'), $icon);
        } else {
            $icon = request('old_icon');
        }

        $id = DB::table('categories')->where("id", $id)->update([
            "name" => request('name'),
            "active" => $active,
            "image" => $name,
            "icon" => $icon,
        ]);

        return redirect("/admin/categories")->with("success", "تم التعديل بنجاح.");
    }




    public function delete($id)
    {
        DB::table('categories')->where('id', $id)->update(["active" => "DELETED"]);
        return 1;
    }

    public function active($id)
    {
        DB::table('categories')->where('id', $id)->update(["active" => "ACTIVE"]);
        return 1;
    }

    public function deactive($id)
    {
        DB::table('categories')->where('id', $id)->update(["active" => "DEACTIVE"]);
        return 1;
    }

    public function deleteAll()
    {
        if (!empty(request('id'))) {
            foreach (request('id') as $id) {
                DB::table('categories')->where('id', $id)->update(["active" => "DELETED"]);
            }
            return back()->with("success", "تم الحذف المتعدد بنجاح.");
        } else {
            return back()->with("error", "الرجاء قم باختيار حقل واحد على الأقل.");
        }
    }
}
