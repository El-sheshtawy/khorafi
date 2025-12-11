<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Mail;

class Contact extends Controller
{
    public function index()
    {
        $contact = DB::table('contact')->where('active', '!=', "DELETED")->orderBy("id", 'desc')->paginate();
        return view("admin.pages.contact.view", ['data' => $contact]);
    }

    public function reply($id)
    {
        $contact = DB::table('contact')->where([['active', '!=', "DELETED"], ['id', $id]])->orderBy("id", 'desc')->first();
        if (empty($contact)) {
            return redirect("/admin/contact")->with("error", "فشلت العملية.");
        }
        return view('admin.pages.contact.reply', ['data' => $contact]);
    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'reply' => 'required|string',
        ]);

        DB::table('contact')->where('id', $id)->update([
            "reply" => request('reply'),
            "active" => "ACTIVE"
        ]);

        return back()->with("success", "تم الرد بنجاح.");
    }


    public function delete($id)
    {
        DB::table('contact')->where('id', $id)->update(["active" => "DELETED"]);
        return 1;
    }

    public function deleteAll()
    {
        if (!empty(request('id'))) {
            foreach (request('id') as $id) {
                DB::table('contact')->where('id', $id)->update(["active" => "DELETED"]);
            }
            return back()->with("success", "تم الحذف المتعدد بنجاح.");
        } else {
            return back()->with("error", "الرجاء قم باختيار حقل واحد على الأقل.");
        }
    }
}
