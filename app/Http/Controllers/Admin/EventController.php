<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Str;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::orderBy("id", "desc")->paginate();
        return view("admin.pages.events.index", ['data' => $data]);
    }

    public function add()
    {
        return view("admin.pages.events.add");
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

        Event::create([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/events")->with("success", "تم الإضافة بنجاح.");
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->first();
        if (empty($event)) {
            return redirect("/admin/events")->with("error", "فشلت العملية.");
        }
        return view('admin.pages.events.edit', ['data' => $event]);
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

        DB::table('events')->where("id", $id)->update([
            "name_ar" => request('name_ar'),
            "name_en" => request('name_en'),
            "image" => $image,
            "active" => $active,
        ]);

        return redirect("/admin/events")->with("success", "تم التعديل بنجاح.");
    }

    public function delete($id)
    {
        Event::where('id', $id)->delete();
        return 1;
    }
}
