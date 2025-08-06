<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('admin.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=CourseCategory::all();
        return view('admin.course.create',compact('categories'));
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

        $course= new Course();
        $course->image=$imagePath;
        $course->title=$request->title;
        $course->description=$request->description;
        $course->category_id=$request->category_id;

        $course->save();
        toastr()->success('Course Created Successfully!', 'Success');
        return redirect()->route('admin.course.index');

    }

    /**
     * Display the specified resource.
     */
//      public function showCourse($id)
// {
//     $blog = Course::findOrFail($id);
//     $previousPost = Course::where('id', '<', $id)->orderBy('id', 'desc')->first();
//     $nextPost = Course::where('id', '>', $id)->orderBy('id')->first();

//     return view('frontend.course-details', compact('course', 'previousPost', 'nextPost'));
// }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=CourseCategory::all();
        $course= Course::findOrFail($id);
        return view('admin.course.edit',compact('categories','course'));
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
        $course= Course::findOrFail($id);
        $imagePath = handleUpload('image',$course);

        $course->image=(!empty($imagePath) ? $imagePath:$course->image);
        $course->title=$request->title;
        $course->description=$request->description;
        $course->category_id=$request->category_id;
        // $blog->client=$request->client;
        // $blog->website=$request->website;
        $course->save();
        toastr()->success('Course Updated Successfully!', 'Success');
        return redirect()->route('admin.course.index');


    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course= Course::findOrFail($id);
        deleteFileItExist($course->image);
        $course->delete();
    }
}
