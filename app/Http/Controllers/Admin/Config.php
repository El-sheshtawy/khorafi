<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

class Config extends Controller
{
    public function index()
    {
        $config = DB::table('config')->get();
        return view("admin.pages.config.view", ["data" => $config]);
    }

    public function edit($id)
    {
        $config = DB::table('config')->where('id', $id)->first();
        return view('admin.pages.config.edit', ['data' => $config]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'mobile2' => 'required|numeric',
            'year' => 'required|numeric',
            'number' => 'required|numeric',
            'fb' => 'url',
            'tw' => 'url',
            'ig' => 'url',
            'image' => 'image|mimes:jpg,jpeg,png',
            'header_image' => 'image|mimes:jpg,jpeg,png',
        ]);

        if (!empty(request()->file('image'))) {
            $file = request()->file('image');
            $ext = $file->getClientOriginalExtension();
            $image = Str::Random(40) . "." . $ext;
            $file->move(public_path('images'), $image);
        } else {
            $image = request('old_image');
        }

        if (!empty(request()->file('header_image'))) {
            $file = request()->file('header_image');
            $ext = $file->getClientOriginalExtension();
            $header_image = Str::Random(40) . "." . $ext;
            $file->move(public_path('images'), $header_image);
        } else {
            $header_image = request('old_header_image');
        }

        DB::table('config')->where('id', $id)->update([
            "name" => request('name'),
            "email" => request('email'),
            "mobile" => request('mobile'),
            "mobile2" => request('mobile2'),
            "fb" => request('fb'),
            "ig" => request('ig'),
            "tw" => request('tw'),
            "year" => request('year'),
            "number" => request('number'),
            "image" => $image,
            "header_image" => $header_image,
        ]);

        return back()->with("success", "تم التعديل بنجاح.");
    }
}
