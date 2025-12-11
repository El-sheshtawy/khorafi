<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use App\Post;

class Posts extends Controller
{
    public function index()
    {
        $data = Post::orderBy("id", "desc")->paginate();
        return view("admin.pages.posts.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.posts.add",);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
            'type' => 'required|numeric|in:1,0',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if (!empty(request('url'))) {
            $request->validate([
                'url' => "url"
            ]);
        }

        $active = request('active') ? "active" : "deactive";

        $file = request()->file('image');
        $ext = $file->getClientOriginalExtension();
        $image = Str::Random(40) . "." . $ext;
        $file->move(public_path('images'), $image);


        $id = Post::insertGetId([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "body_ar" => request('body_ar'),
            "body_en" => request('body_en'),
            "type" => request('type'),
            "url" => request('url'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/posts")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $data = Post::where('id', $id)->orderBy("id", 'desc')->first();
        if (empty($data)) {
            return redirect("/admin/posts")->with("errro", "فشلت العملية.");
        }
        return view('admin.pages.posts.edit', ['data' => $data]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
            'type' => 'required|numeric|in:1,0',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);

        if (!empty(request('url'))) {
            $request->validate([
                'url' => "url"
            ]);
        }

        $active = request('active') ? "active" : "deactive";

        if (!empty(request()->file('image'))) {
            $file = request()->file('image');
            $ext = $file->getClientOriginalExtension();
            $image = Str::Random(40) . "." . $ext;
            $file->move(public_path('images'), $image);
        } else {
            $image = request('old_image');
        }

        Post::where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "body_ar" => request('body_ar'),
            "body_en" => request('body_en'),
            "type" => request('type'),
            "url" => request('url'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/posts")->with("success", "تم التعديل بنجاح.");
    }


    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return 1;
    }
}
