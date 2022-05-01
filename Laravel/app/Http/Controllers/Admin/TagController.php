<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tag;
use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    public function index()
    {
        $data['tags'] = Tag::select()->orderBy('id', 'desc')->get();
        return view('Admin.tag.index')->with($data);
    }


    public function show($id)
    {
        $tag = Tag::find($id);
        return view('Admin.tag.showTag' , compact('tag'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.tag.addTag' , compact('categories'));
    }


    public function doCreate(Request $request)
    {
        $data = $request->all();
        $data = $request->validate(['name' => 'required|unique:tags,name']);
        try{
            for($i = 0 ; $i < count($request->name);$i++ )
            {
                // dd($request->image[$i]);
                $tag = new Tag();
                $tag->admin_id = $request->admin_id;
                $tag->cat_id = $request->category_id;
                $tag->name = $request->name[$i];
                $newImgName = $request->image[$i]->hashName();
                    Image::make($request->image[$i])->save(public_path('uploads/Tags/' . $newImgName));
                $tag->image = $newImgName;
                $tag->save();
            }
            Alert::success('Add Completed' , 'Tags Added Successfully');
            return redirect(route('admin.tag.index'));
        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $categories  = Category::all();
        $data['tag'] = Tag::findOrfail($id);
        return view('Admin.tag.editTag' , compact('categories'))->with($data);
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

        $data['cat_id'] = $data['category_id'];
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
