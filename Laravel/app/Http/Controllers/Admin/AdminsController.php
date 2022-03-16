<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminsController extends Controller
{
    public function edit()
    {
        $id = auth()->guard('admin')->id();
        $admin = Admin::findOrfail($id);
        return view('Admin.admin.edit', compact('admin'));
    }

    public function doEdit(Request $request)
    {
        $id = auth()->guard('admin')->id();
        $admin = Admin::findOrfail($id);
        // dd($admin);
        $data = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'image' => 'nullable',
            'password' => 'min:6|nullable|same:password_confirmation',
            'password_confirmation' => 'min:6|nullable'
        ]);

        if (!is_null($request->password)) {
            $OldImgName = Admin::findOrfail($id)->image;
            // dd($OldImgName);
            if ($request->hasFile('image')) {
                Storage::disk('uploads')->delete('Admins/' . $OldImgName);
                $newImgName = $request->image->hashName();
                Image::make($data['image'])->save(public_path('uploads/Admins/' . $newImgName));
                $data['image'] = $newImgName;
            } else    $data['image'] = $OldImgName;
            $admin->update([
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => bcrypt($request->password),
                'image'          => $data['image'],
            ]);
        return back()->with('message' , 'Data Changed Successfully...');
        } else {
            $OldImgName = Admin::findOrfail($id)->image;
            // dd($OldImgName);
            if ($request->hasFile('image')) {
                Storage::disk('uploads')->delete('Admins/' . $OldImgName);
                $newImgName = $request->image->hashName();
                Image::make($data['image'])->save(public_path('uploads/Admins/' . $newImgName));
                $data['image'] = $newImgName;
            } else    $data['image'] = $OldImgName;
            $admin->update([
                'name'           => $request->name,
                'email'          => $request->email,
                'image'          => $data['image'],
            ]);
            return back()->with('message' , 'Data Changed Successfully with The Same Password...');
        }
    }
}
