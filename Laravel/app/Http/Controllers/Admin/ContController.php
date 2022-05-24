<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contact;
use App\Notifications\ContactReplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
        $contacts = Contact::select()->where('user_id',$user->id)->get();
        return view('Admin.contact.show', compact('contacts'));
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


    public function Replay(Request $request , $cont_id)
    {

        $s = Validator::make($request->all(), [
            'content' => 'required',
        ]);
        if ($s->fails()) {
            return back()->withErrors($s->errors())->withInput();
        }

        $contact = Contact::find($cont_id);
        $details = [
            'title' =>'MyPartner Team Answer Your Contact',
            'body' => $request->content,
        ];
        $user = User::find($contact->user()->first()->id); //Contact Owner
        // dd($user);
        $user->notify(new ContactReplay($details));
        Alert::info('Replay Sent');
        return back();
    }
}
