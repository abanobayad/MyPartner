<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Image;

class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = Category::select()->orderBy('id', 'desc')->get();
        return view('Admin.cat.index')->with($data);
    }


    public function create()
    {
        return view('Admin.cat.addCat');
    }


    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'admin_id' => 'required|exists:admins,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('image')) {
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Categories/' . $newImgName));
            $data['image'] = $newImgName;
        }


        Category::create($data);
        return redirect(route('admin.cat.index'));
    }

    public function edit($id)
    {
        $data['cat'] = Category::findOrfail($id);
        return view('Admin.cat.editCat')->with($data);
    }


    public function doEdit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'admin_id' => 'required|exists:admins,id',
            'id' => 'required|exists:categories,id',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $OldImg = Category::find($request->id);
        if ($OldImg == null) {
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Categories/' . $newImgName));
            $data['image'] = $newImgName;
        } else {
            $OldImgName = Category::find($request->id)->image;
                if ($request->hasFile('image')) {
                    Storage::disk('uploads')->delete('Categories/' . $OldImgName);
                    $newImgName = $request->image->hashName();
                    Image::make($data['image'])->save(public_path('uploads/Categories/' . $newImgName));
                    $data['image'] = $newImgName;
                }
                else
                {
                    $data['image'] = $OldImgName;
                }
        }

        Category::findOrFail($request->id)->update($data);
        return back();
        // return redirect(route('admin.cat.index'));
    }


    public function delete($id)
    {
        Category::findOrfail($id)->delete();
        return redirect(route('admin.cat.index'));
    }
}
