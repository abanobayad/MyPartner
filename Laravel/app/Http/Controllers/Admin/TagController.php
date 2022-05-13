<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    public function index()
    {
        $data['tags'] = Tag::select()->orderBy('id', 'desc')->paginate(10);
        return view('Admin.tag.index')->with($data);
    }


    public function show($id)
    {
        $tag = Tag::find($id);
        return view('Admin.tag.showTag', compact('tag'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.tag.addTag', compact('categories'));
    }


    public function doCreate(Request $request)
    {
        $data = $request->all();
        // dd($data);

        // $data = $request->validate(['name' => 'required|unique:tags,name']);
        $validator = Validator::make($request->all(), ['name' => 'required|unique:tags,name']);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        try {
            for ($i = 0; $i < count($request->name); $i++) {
                // dd($request->image[$i]);
                $tag = new Tag();
                $tag->admin_id = $request->admin_id;
                $tag->cat_id = $request->category_id[$i];
                $tag->name = $request->name[$i];
                $newImgName = $request->image[$i]->hashName();
                $request->file('image')[$i]->move('uploads/Tags/', $newImgName);
                // Image::make($request->image[$i])->save(public_path('uploads/Tags/' . $newImgName));
                $tag->image = $newImgName;
                $tag->save();
            }
            Alert::success('Add Completed', 'Tags Added Successfully');
            return redirect(route('admin.tag.index'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $categories  = Category::all();
        $data['tag'] = Tag::findOrfail($id);
        return view('Admin.tag.editTag', compact('categories'))->with($data);
    }


    public function doEdit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'id' => 'required|exists:tags,id',
            'admin_id' => 'required|exists:admins,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('image')) {

            //check old image
            $OldImg = Tag::find($request->id)->image;

            //has no old image
            if ($OldImg == null) {
                $newImgName = $request->image->hashName();
                $request->file('image')->move('uploads/Tags/', $newImgName);
                $data['image'] = $newImgName;
            }
            //has old image
            else {
                $tag = Tag::find($request->id);
                $dest = 'uploads/Tags/' . $tag->image;
                if (File::exists($dest)) {
                    File::delete($dest);
                }
                $newImgName = $request->image->hashName();
                $request->file('image')->move('uploads/Tags/', $newImgName);
                $data['image'] = $newImgName;
            }
        }

        $data['cat_id'] = $data['category_id'];
        $tag = Tag::findOrFail($request->id)->update($data);
        $tag = Tag::findOrFail($request->id);
        Alert::success('Edit Completed', 'Tag ' . $tag->name . ' Edit Successfully');

        return back();
        // return redirect(route('admin.tag.index'));
    }


    public function delete($id)
    {
        $tag = Tag::find($id);
        $tag_name = $tag->name;
        $dest = 'uploads/Tags/' . $tag->image;
        if (File::exists($dest)) {
            File::delete($dest);
        }
        $tag->delete();
        Alert::success('Delete Completed', 'Tag ' . $tag_name . ' Deleted Successfully');

        return redirect(route('admin.tag.index'));
    }
}
