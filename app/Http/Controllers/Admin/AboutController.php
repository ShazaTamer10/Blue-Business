<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()


    {

        $about = About::first();
        return view('admin.about.index',compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title'=> ['required', 'max:200'],
            'description'=> ['required', 'max:200'],
            'image'=>['required', 'image'],
            // 'profile'=>['mimes:pds,csv,txt', 'max: 10000']
        ]);



// Ensure $about exists before accessing its properties


        $about = About::first();

        if (!$about) {
            $about = new About();
        }

        $imagePath =handleUpload('image',$about);
       // $profilePath= handleUpload('profile',$about);

        About::updateOrCreate(
            ['id' => $id],
            [
                    'title'=>$request->title,
                    'description'=> $request->description,
                    'image'=>(!empty($imagePath) ? $imagePath : $about->image??null),
                    // 'profile'=>(!empty($profilePath) ? $profilePath : $about->profile??null)
            ]);
            toastr()->success('Updated Successfully!', 'Congrats');
            return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
