<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
use App\Http\Controllers\{
    ServiceController,
    ActivitySectorController,
    ClientController,
    ProjectController,
    ProjectImageController,
    FaqController,
    TestimonialController,
    ContactMessageController,
    ProductController,
    CompanyController
};

// Admin
Route::resource('admin/services', ServiceController::class);
Route::resource('admin/sectors', ActivitySectorController::class);
Route::resource('admin/clients', ClientController::class);
Route::resource('admin/projects', ProjectController::class);
Route::resource('admin/project-images', ProjectImageController::class);
Route::resource('admin/faq', FaqController::class);
Route::resource('admin/testimonials', TestimonialController::class);
Route::resource('admin/contact-messages', ContactMessageController::class)->only(['index','show','destroy']);
Route::resource('admin/products', ProductController::class);
Route::resource('admin/company', CompanyController::class)->only(['index','edit','update']);

// Front contact form
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Home front
Route::get('/', function () {
    return view('home', [
        'company'      => \App\Models\Company::first(),
        'services'     => \App\Models\Service::where('is_active', true)->orderBy('display_order')->get(),
        'sectors'      => \App\Models\ActivitySector::where('is_active', true)->orderBy('display_order')->get(),
        'clients'      => \App\Models\Client::all(),
        'projects'     => \App\Models\Project::with('client','sector')->latest()->get(),
        'testimonials' => \App\Models\Testimonial::where('is_active', true)->orderBy('display_order')->get(),
        'faqs'         => \App\Models\Faq::where('is_active', true)->orderBy('display_order')->get(),
        'products'     => \App\Models\Product::where('is_active', true)->get(),
    ]);
})->name('home');




