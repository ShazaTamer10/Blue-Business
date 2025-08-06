<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseContentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    public function index(CourseContentDataTable $dataTable, $courseId)
    {
        $course = Course::findOrFail($courseId);
        return $dataTable->with('course_id', $courseId)->render('admin.course_content.index', compact('course'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('admin.course_content.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video',
            'file' => 'required|file|max:20480', // 20MB limit
        ]);

        $path = $request->file('file')->store('course_contents', 'public');

        CourseContent::create([
            'course_id' => $courseId,
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
        ]);

        toastr()->success('Content uploaded successfully');
        return redirect()->route('admin.course.content.index', $courseId);
    }

    public function edit($courseId, $id)
    {
        $course = Course::findOrFail($courseId);
        $content = CourseContent::findOrFail($id);
        return view('admin.course_content.edit', compact('course', 'content'));
    }

    public function update(Request $request, $courseId, $id)
    {
        $content = CourseContent::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video',
            'file' => 'nullable|file|max:20480',
        ]);

        if ($request->hasFile('file')) {
            deleteFileItExist($content->file_path); // your helper
            $path = $request->file('file')->store('course_contents', 'public');
            $content->file_path = $path;
        }

        $content->title = $request->title;
        $content->type = $request->type;
        $content->save();

        toastr()->success('Content updated successfully');
        return redirect()->route('admin.course.content.index', $courseId);
    }


    public function showCourseContents($courseId)
    {
        // Get all contents (PDFs/videos) for this course, paginated (9 per page)
        $contents = CourseContent::where('course_id', $courseId)->paginate(9);

        // Return the frontend view with the contents data
        return view('frontend.course_contents', compact('contents'));
    }



    public function destroy($courseId, $id)
    {
        $content = CourseContent::findOrFail($id);
        deleteFileItExist($content->file_path);
        $content->delete();

        return response()->json(['success' => true]);
    }
}

