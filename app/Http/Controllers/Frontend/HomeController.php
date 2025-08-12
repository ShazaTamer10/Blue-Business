<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\BlogSectionSetting;
use App\Models\Category;
use App\Models\Hero;
use App\Models\PortfolioItem;
use App\Models\PortfolioSectionSetting;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Course;
use App\Models\CourseContent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $services=Service::all();
        $about=About::first();
        $portfolioTitle=PortfolioSectionSetting::first();
        $portfolioCategories=Category::all();
        $portfolioItems=PortfolioItem::all();
        $blogs= Blog::latest()->take(5)->get();
        $blogTitle= BlogSectionSetting::first();
        $courses=Course::all();

        return view( 'frontend.home' ,compact(
            'hero',
        'services',
        'about',
        'portfolioTitle',
        'portfolioCategories',
        'portfolioItems',
        'blogs',
        'blogTitle',
        'courses'

    ));
    }
    
    public function portfolio()
{
    $portfolioItems = PortfolioItem::all();
    $portfolioCategories = Category::all();

    return view('frontend.portfolio', compact('portfolioItems', 'portfolioCategories'));
}


    public function showPortfolio($id){
        $portfolio= PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details',compact('portfolio'));
    }

    public function showBlog($id)
    {
        $blog= Blog::findOrFail($id);
        $previousPost=Blog::where('id','<',$blog->id)->orderBy('id','desc')->first();
        $nextPost=Blog::where('id','>',$blog->id)->orderBy('id','asc')->first();
        return view('frontend.blog-details',compact('blog','previousPost','nextPost'));
    }

    public function blog()
    {
        $blogs= Blog::latest()->paginate(3);
        return view('frontend.blog',compact('blogs'));
    }

     public function showCourse($id)
    {
        $course= Course::findOrFail($id);
        $previousPost=Course::where('id','<',$course->id)->orderBy('id','desc')->first();
        $nextPost=Course::where('id','>',$course->id)->orderBy('id','asc')->first();
        return view('frontend.course-details',compact('course','previousPost','nextPost'));
    }

     public function showCourseContents($courseId)
{
    $course = Course::findOrFail($courseId);
    $contents = CourseContent::where('course_id', $courseId)->paginate(9);

    return view('frontend.course-content', compact('course', 'contents'));
}

   


    public function course()
    {
        $courses = Course::paginate(10); 
        return view('frontend.course', compact('courses'));
    }

    public function contact(Request $request)
    {
        dd($request->all());
    }
        // $request->validate([
        //     'name'=>['required','max:100'],
        //     'subject'=>['required','max:500'],
        //     'email'=>['required','email'],
        //     'message'=>['required','max:1000'],
        // ]);

        // Mail::send(new ContactMail($request->all()));
        // return response(['status'=> 'success','message' => 'Mail Sended Successfully!']);
    

}
