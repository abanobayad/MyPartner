<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GroupController extends Controller
{

    public function index()
    {
        $data['groups'] = Group::select()->orderBy('id', 'desc')->paginate(10);
        return view('Admin.group.index')->with($data);
    }


    public function show($id)
    {
        $group = Group::find($id);
        return view('Admin.group.showGroup', compact('group'));
    }

    public function showGroupPosts(Request $request , $id)
    {
        $group = Group::find($id);
        $selected_reps = $request->has('status') ? $request->get('status'):null;
        $posts = $group->posts()->orderBy('visible' , 'asc')->orderBy('updated_at' , 'desc')->paginate(10);

        if($selected_reps != null){
            if($selected_reps == 'yes')  {$posts = $group->posts()->where('visible' , 'yes')->paginate(10); }
            if($selected_reps == 'no')  {$posts = $group->posts()->where('visible' , 'no')->paginate(10); }
        }

        return view('Admin.group.showGroupPosts', compact('group','posts' , 'selected_reps'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('Admin.group.addGroup', compact('categories', 'tags'));
    }


    public function create1()
    {
        $cats = Category::all();

        //filter categories with no tags
        $categories = [];
        foreach ($cats as $cat) {
            if ($cat->tags()->first() != null)
                array_push($categories, $cat);
        }
        // dd($categories);
        return view('Admin.group.addGroup1', compact('categories'));
    }

    public function doCreate1($category_id)
    {
        $category = Category::find($category_id);
        $tags = $category->tags()->get();
        return view('Admin.group.addGroup2', compact('category', 'tags'));
    }




    public function doCreate(Request $request)
    {

        $data = $request->all();
        $search_tag = $request->has('tag') ? $request->get('tag') : [];
        // dd($search_tag);

        $string = app('profanityFilter')->filter($data['name']);
        // dd($string);

        $s = Validator::make(
            $data,
            [
                'name' => 'required|profanity|max:50',
                'description' => 'required|profanity|max:255',
                'category_id' => 'required|exists:categories,id',
                'tag' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png',
                'admin_id' => 'required|exists:admins,id',
            ],

            ['profanity' => 'the :attribute has illegal words']
        );
        if ($s->fails()) {
            Alert::error('Validation Failed');
            return back()->with('search_tag', $search_tag)->withErrors($s->errors())->withInput();
        }

        // $new_name =  $data['image']->hashName();
        // Image::make($data['image'])->save(public_path('uploads/Groups/' . $new_name)); //To store Image on the server


        //New Image code
        // $dest = 'uploads/Groups/' . $group->image;
        // if(File::exists($dest))
        // {
        // File::delete($dest);
        // }
        $file = $request->file('image');
        $file_name = time() . $file->getClientOriginalName();
        $file->move('uploads/Groups/', $file_name);
        $data['image'] = $file_name;



        $group = Group::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'image'         => $data['image'],
            'admin_id'      => $request->admin_id,
        ]);
        $group->tags()->attach($request->tag);
        Alert::success('Add Completed', 'Group ' . $group->name . ' Added Successfully');

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


        if ($request->hasFile('image')) {


            //check old image
            $OldImg = Group::find($request->id)->image;

            //has no old image
            if ($OldImg == null) {
                $newImgName = $request->image->hashName();
                $request->file('image')->move('uploads/Groups/', $newImgName);
                $data['image'] = $newImgName;
            }
            //has old image
            else {
                $group = Group::find($request->id);
                $dest = 'uploads/Groups/' . $group->image;
                if (File::exists($dest)) {
                    File::delete($dest);
                }
                $newImgName = $request->image->hashName();
                $request->file('image')->move('uploads/Groups/', $newImgName);
                $data['image'] = $newImgName;
                $group->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'category_id'   => $request->category_id,
                    'image'         => $data['image'],
                    'admin_id' =>      $data['admin_id'],
                ]);
            }
        }
        else
        {
            $group->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'category_id'   => $request->category_id,
                'admin_id' =>      $data['admin_id'],
            ]);
        }

        $group->tags()->sync($request->tag);
        Alert::success('Edit Completed', 'Group ' . $group->name . ' Changed Successfully');
        return back();
        // return redirect(route('admin.group.index'));
    }


    public function delete($id)
    {

        $group = Group::find($id);
        $group_name = $group->name;
        $dest = 'uploads/Groups/' . $group->image;
        if (File::exists($dest)) {
            File::delete($dest);
        }
        $group->delete();
        Alert::success('Delete Completed', 'Group ' . $group_name . ' Deleted Successfully');
        return redirect(route('admin.group.index'));
    }
}
