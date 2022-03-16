<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAController extends Controller
{
    public function index()
    {
        $data['cats'] = User::select('id','name','email')->orderBy('id','desc')->get();
        return view('Admin.user.index')->with($data);
    }


    public function create()
    {
        return view('Admin.user.addUser');
    }


    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20'
                    ]);
        User::create($data);
        return redirect(route('admin.user.index'));
    }

    public function edit($id)
    {
        $data['cat'] = User::findOrfail($id);
        return view('Admin.user.editUser')->with($data);
    }


    public function doEdit(Request $request )
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'id' => 'required|exists:users,id'
                    ]);
        User::findOrFail($request->id)->update($data);
        return back();
        // return redirect(route('admin.user.index'));
    }


    public function delete($id)
    {

        User::findOrfail($id)->delete();
        return redirect(route('admin.user.index'));
    }
}
