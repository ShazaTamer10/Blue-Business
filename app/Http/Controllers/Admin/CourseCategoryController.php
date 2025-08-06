<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.course-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course-category.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required','max:200']
        ]);

        $category= new CourseCategory();
        $category->name=$request->name;
        $category->slug= \Str::slug($request->name);
        $category->save();

        toastr()->success('Created Successfully!', 'Success');
        return redirect()->route('admin.course-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category= CourseCategory::findOrFail($id);
        return view('admin.course-category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=> ['required','max:200']
        ]);

        $category= CourseCategory::findOrFail($id);
        $category->name=$request->name;
        $category->slug= \Str::slug($request->name);
        $category->save();

        toastr()->success('Updated Successfully!', 'Success');
        return redirect()->route('admin.course-category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CourseCategory::findOrFail($id);
        $category->delete();
    }
}
