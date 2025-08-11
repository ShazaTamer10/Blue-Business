<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    public function index(Course $course)
    {
        $contents = $course->contents()->orderBy('order')->get();
        return view('admin.course-content.index', compact('course', 'contents'));
    }

    public function create(Course $course)
    {
        return view('admin.course-content.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'pdf_path' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only('title', 'description', 'video_url', 'order');
        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('course_pdfs', 'public');
        }

        $course->contents()->create($data);

        return redirect()->route('admin.courses.contents.index', $course->id)
            ->with('success', 'Content added successfully.');
    }

    public function edit(Course $course, CourseContent $content)
    {
        return view('admin.course-content.edit', compact('course', 'content'));
    }

    public function update(Request $request, Course $course, CourseContent $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'pdf_path' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only('title', 'description', 'video_url', 'order');
        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('course_pdfs', 'public');
        }

        $content->update($data);

        return redirect()->route('admin.course.content.index', $course->id)
            ->with('success', 'Content updated successfully.');
    }

    public function destroy(Course $course, CourseContent $content)
    {
        $content->delete();
        return redirect()->route('admin.courses.contents.index', $course->id)
            ->with('success', 'Content deleted successfully.');
    }
}
