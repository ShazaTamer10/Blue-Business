<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable; 
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseApplication;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
   
    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('admin.course.index');
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:50000',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'content_description' => 'nullable|string',
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('courses/images', 'public') 
            : null;

        $videoPath = $request->hasFile('video') 
            ? $request->file('video')->store('courses/videos', 'public') 
            : null;

        $pdfPath = $request->hasFile('pdf') 
            ? $request->file('pdf')->store('courses/pdfs', 'public') 
            : null;

        $course = new Course();
        $course->title = $request->title;
        $course->category_id = $request->category_id;
        $course->description = $request->description;
        $course->content_description = $request->content_description;
        $course->image = $imagePath;
        $course->video_path = $videoPath;
        $course->pdf_path = $pdfPath;

        $course->save();

        toastr()->success('Course Created Successfully!', 'Success');
        return redirect()->route('admin.course.index');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('frontend.course-details', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.course.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:50000',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'content_description' => 'nullable|string',
        ]);

        $course = Course::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $course->image = $request->file('image')->store('courses/images', 'public');
        }

        if ($request->hasFile('video')) {
            if ($course->video_path) {
                Storage::disk('public')->delete($course->video_path);
            }
            $course->video_path = $request->file('video')->store('courses/videos', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($course->pdf_path) {
                Storage::disk('public')->delete($course->pdf_path);
            }
            $course->pdf_path = $request->file('pdf')->store('courses/pdfs', 'public');
        }

        $course->title = $request->title;
        $course->category_id = $request->category_id;
        $course->description = $request->description;
        $course->content_description = $request->content_description;

        $course->save();

        toastr()->success('Course Updated Successfully!', 'Success');
        return redirect()->route('admin.course.index');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        if ($course->video_path) {
            Storage::disk('public')->delete($course->video_path);
        }
        if ($course->pdf_path) {
            Storage::disk('public')->delete($course->pdf_path);
        }

        $course->delete();

        toastr()->success('Course Deleted Successfully!', 'Success');
        return redirect()->route('admin.course.index');
    }
    public function apply($id)
{
    $course = Course::findOrFail($id);
    return view('frontend.course-apply', compact('course'));
}

public function submitApplication(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'message' => 'nullable|string|max:1000'
    ]);

    CourseApplication::create([
        'course_id' => $course->id,
        'name'      => $request->name,
        'email'     => $request->email,
        'phone'     => $request->phone,
        'message'   => $request->message,
    ]);

    return redirect()->route('admin.course.show', $course->id)
                     ->with('success', 'Your application has been submitted successfully!');
}
}
