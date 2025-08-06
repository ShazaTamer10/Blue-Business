<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogSectionSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\PortfolioSectionSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TyperTitleController;
use App\Http\Controllers\CourseSectionSetting;
use App\Http\Controllers\Frontend\HomeController;


use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route:: get('/',[HomeController:: class,'index']) ->name( ' home' ) ;

// Route::get('/', function () {
//     return view('frontend.home');
// });

Route::get('/blog', function () {
    return view('frontend.blog');
});
Route::get('/blog-details', function () {
    return view('frontend.blog-details');
});

Route::get('/portfolio-details', function () {
    return view('frontend.portfolio-details');
});

Route::get('/portfolio', function () {
    return view('frontend.portfolio');
});

Route::get('/404', function () {
    return view('frontend.404');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('portfolio-details/{id}', [HomeController::class, 'showPortfolio'])->name('show.portfolio');
Route::get('blog-details/{id}', [HomeController::class, 'showBlog'])->name('show.blog');
Route::get('blogs', [HomeController::class, 'blog'])->name('blog');
Route::post('contact', action: [HomeController::class, 'contact'])->name('contact');
Route::get('courses', [HomeController::class, 'course'])->name('course');
Route::get('course-details/{id}', [HomeController::class, 'showCourse'])->name('show.course');

Route::get('course/{id}/contents', [CourseController::class, 'showCourseContents'])
    ->name('course.contents');




Route::group(['middleware' => ['auth'], 'prefix' => 'admin','as' => 'admin.'], function(){
    Route::resource('hero',HeroController::class);
    Route::resource('typer-title',TyperTitleController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('service',ServiceController::class);
    Route::resource('about',AboutController::class);
    Route::resource('portfolio-item', PortfolioItemController::class);
    Route::resource('portfolio-section-setting', PortfolioSectionSettingController::class);
    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('blog-section-setting', BlogSectionSettingController::class);
    Route::resource('course-category', CourseCategoryController::class);
    Route::resource('course', CourseController::class);
    Route::resource('course-content', CourseContentController::class);
    Route::resource('course-section-setting', CourseSectionSetting::class);
});

