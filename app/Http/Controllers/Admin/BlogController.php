<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=BlogCategory::all();
        return view('admin.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string', 


        ]);
        $imagePath =handleUpload('image');

        $blog= new Blog();
        $blog->image=$imagePath;
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->category_id;
        // $blog->client=$request->client;
        // $blog->website=$request->website;
        $blog->save();
        toastr()->success('Blog Created Successfully!', 'Success');
        return redirect()->route('admin.blog.index');


    }


    /**
     * Display the specified resource.
     */
//    public function showBlog($id)
// {
//     $blog = Blog::findOrFail($id);
//     $previousPost = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
//     $nextPost = Blog::where('id', '>', $id)->orderBy('id')->first();

//     return view('frontend.blog-details', compact('blog', 'previousPost', 'nextPost'));
// }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=BlogCategory::all();
        $blog= Blog::findOrFail($id);
        return view('admin.blog.edit',compact('categories','blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'=>['image', 'max:5000'],
            'title'=> ['required', 'max:200'],
            'description'=> ['required'],
            'category_id'=>['required','numeric'],
            // 'client'=>['max:200'],
            // 'website'=>['url']


        ]);
        $blog= Blog::findOrFail($id);
        $imagePath = handleUpload('image',$blog);

        $blog->image=(!empty($imagePath) ? $imagePath:$blog->image);
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->category_id;
        // $blog->client=$request->client;
        // $blog->website=$request->website;
        $blog->save();
        toastr()->success('Blog Updated Successfully!', 'Success');
        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog= Blog::findOrFail($id);
        deleteFileItExist($blog->image);
        $blog->delete();
    }

}
