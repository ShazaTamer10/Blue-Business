<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseApplication;

class CourseApplicationController extends Controller
{
    public function index()
    {
        $applications = CourseApplication::with('course')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.application.index', compact('applications'));
    }

    public function show($id)
    {
        $application = CourseApplication::with('course')->findOrFail($id);
        return view('admin.application.show', compact('application'));
    }
}
