<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::orderBy("id", 'desc')->paginate();
        return view("admin.pages.contact.index", ['data' => $contact]);
    }

    public function reply($id)
    {
        $contact = Contact::where('id', $id)->orderBy("id", 'desc')->first();
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

        Contact::where('id', $id)->update([
            "reply" => request('reply'),
            "active" => "active"
        ]);

        $contact = Contact::where('id', $id)->orderBy("id", 'desc')->first();

        \App\User::send_email($contact->email, 'الرد على تواصل معنا', request('reply'));

        return back()->with("success", "تم الرد بنجاح.");
    }


    public function delete($id)
    {
        Contact::where('id', $id)->delete();
        return 1;
    }
}
