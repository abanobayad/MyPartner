<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContController extends Controller
{
    //to return all contacts exist in contacts table (admin)
    public function index(){
        $contacts = Contact::paginate(10);
        return view('Admin.contact.index', compact('contacts'));
    }


    // to get contacts of specific user (admin)
    public function GET($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('User not found');
        }
        $contact = Contact::select()->where('user_id',$user->id)->get();
        return view('Admin.contact.show', compact('contact'));
    }

    // to get details of specific contact
    public function show($id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->back()->with('contact not found');
        }else{
            return view('Admin.contact.display', compact('contact'));
        }
    }


    // admin
    public function DELETE($id)
    {
        $contact = Contact::find($id);
        if ( $contact == null) {
            return redirect()->back()->with('contact not found');
        }else{
                $contact = $contact->delete();
                return redirect()->back();
            }
    }
}
