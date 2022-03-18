<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Tag;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function index()
    {
        $data['groups'] = Group::select()->orderBy('id', 'desc')->get();
        return view('Admin.group.index')->with($data);
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('Admin.group.addGroup', compact('categories', 'tags'));
    }


    public function doCreate(Request $request)
    {

        $data = $request->all();

        $s = Validator::make($data , [
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'tag' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'admin_id' => 'required|exists:admins,id',
        ]);

        if($s ->fails()){return back()->withErrors($s->errors())->withInput();}

        $new_name =  $data['image']->hashName();
        Image::make($data['image'])->save(public_path('uploads/Groups/' . $new_name)); //To store Image on the server
        //  dd($new_name);

        $group = Group::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'image'         => $new_name,
            'admin_id' =>       $request->admin_id,
        ]);
        $group->tags()->attach($request->tag);
        return redirect(route('admin.group.index'));
    }

    public function edit($id)
    {

        $group = Group::findOrfail($id);
        $selected_tags = $group->tags()->select()->get();
        $tags_array = [];
        foreach ($selected_tags as $tag) {
            array_push($tags_array, $tag->name);
        }
        // dd($tags_array);
        $categories = Category::all();
        $tags = Tag::all();
        return view('Admin.group.editGroup', compact('group', 'categories', 'tags', 'tags_array'));
    }


    public function doEdit(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|max:50',
            'id' => 'required|exists:groups,id',
            'description' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'tag' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'admin_id' => 'required|exists:admins,id',
        ]);
        $group = Group::whereId($request->id)->first();


        $OldImgName = Group::findOrfail($request->id)->image;
        // dd($OldImgName);

        if ($request->hasFile('image')) {
            Storage::disk('uploads')->delete('Groups/' . $OldImgName);
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Groups/' . $newImgName));
            $data['image'] = $newImgName;
        } else    $data['image'] = $OldImgName;

        $group->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'image'         => $data['image'],
            'admin_id' =>      $data ['admin_id'],
        ]);
        $group->tags()->sync($request->tag);
        return back();
        // return redirect(route('admin.group.index'));
    }


    public function delete($id)
    {
        $imgName = Group::findOrfail($id)->image;
        Storage::disk('uploads')->delete('Groups/'. $imgName);
        Group::findOrfail($id)->delete();
        return redirect(route('admin.group.index'));
    }
}
