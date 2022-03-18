<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Image;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function index()
    {
        $data['tags'] = Tag::select()->orderBy('id', 'desc')->get();
        return view('Admin.tag.index')->with($data);
    }


    public function create()
    {
        return view('Admin.tag.addTag');
    }


    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'admin_id' => 'required|exists:admins,id',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Tags/' . $newImgName));
            $data['image'] = $newImgName;
        }
        Tag::create($data);
        return redirect(route('admin.tag.index'));
    }

    public function edit($id)
    {
        $data['tag'] = Tag::findOrfail($id);
        return view('Admin.tag.editTag')->with($data);
    }


    public function doEdit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'id' => 'required|exists:tags,id',
            'admin_id' => 'required|exists:admins,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);


        $OldImg = Tag::find($request->id);
        if ($OldImg == null) {
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Tags/' . $newImgName));
            $data['image'] = $newImgName;
        } else {
            $OldImgName = Tag::find($request->id)->image;
                if ($request->hasFile('image')) {
                    Storage::disk('uploads')->delete('Tags/' . $OldImgName);
                    $newImgName = $request->image->hashName();
                    Image::make($data['image'])->save(public_path('uploads/Tags/' . $newImgName));
                    $data['image'] = $newImgName;
                }
                else
                {
                    $data['image'] = $OldImgName;
                }
        }

        Tag::findOrFail($request->id)->update($data);
        return back();
        // return redirect(route('admin.tag.index'));
    }


    public function delete($id)
    {

        Tag::findOrfail($id)->delete();
        return redirect(route('admin.tag.index'));
    }
}
