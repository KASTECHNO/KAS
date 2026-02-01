<?php

use Illuminate\Support\Facades\Route;
;
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
    QuoteController,
    TestimonialController,
    ContactMessageController,
    ProductController,
    CompanyController,
    UserController,
    PageController,
};

// Admin
Route::resource('admin/services', ServiceController::class);
Route::resource('admin/sectors', ActivitySectorController::class);
Route::resource('admin/clients', ClientController::class);
Route::resource('admin/projects', ProjectController::class);
Route::resource('admin/project-images', ProjectImageController::class);
Route::resource('admin/quotes', QuoteController::class);
Route::resource('admin/testimonials', TestimonialController::class);
Route::resource('admin/contact-messages', ContactMessageController::class)->only(['index','show','destroy']);
Route::resource('admin/products', ProductController::class);
Route::resource('admin/company', CompanyController::class)->only(['index','edit','update']);

// Front contact form
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Admin explicit routes (index, create, edit)

// Services
Route::get('admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
Route::get('admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
Route::get('admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
Route::put('admin/services/{service}/update', [ServiceController::class, 'update'])->name('admin.services.update');
Route::post('admin/services/store', [ServiceController::class, 'store'])->name('admin.services.store');
Route::get('admin/services/destroy', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
Route::delete('admin/services/{service}/delete', [ServiceController::class, 'delete'])->name('admin.services.delete');


// Activity Sectors
Route::get('admin/sectors', [ActivitySectorController::class, 'index'])->name('admin.sectors.index');
Route::get('admin/sectors/create', [ActivitySectorController::class, 'create'])->name('admin.sectors.create');
Route::get('admin/sectors/{sector}/edit', [ActivitySectorController::class, 'edit'])->name('admin.sectors.edit');
Route::put('admin/sectors/{sector}/update', [ActivitySectorController::class, 'update'])->name('admin.sectors.update');
Route::post('admin/sectors/store', [ActivitySectorController::class, 'store'])->name('admin.sectors.store');
Route::get('admin/sectors/destroy', [ActivitySectorController::class, 'destroy'])->name('admin.sectors.destroy');
Route::delete('admin/sectors/{sector}/delete', [ActivitySectorController::class, 'delete'])->name('admin.sectors.delete');

// Clients
Route::get('admin/clients', [ClientController::class, 'index'])->name('admin.clients.index');
Route::get('admin/clients/create', [ClientController::class, 'create'])->name('admin.clients.create');
Route::get('admin/clients/{client}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');
Route::put('admin/clients/{client}/update', [ClientController::class, 'update'])->name('admin.clients.update');
Route::post('admin/clients/store', [ClientController::class, 'store'])->name('admin.clients.store');
Route::get('admin/clients/destroy', [ClientController::class, 'destroy'])->name('admin.clients.destroy');
Route::delete('admin/clients/{client}/delete', [ClientController::class, 'delete'])->name('admin.clients.delete');

// Projects
Route::get('admin/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
Route::get('admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
Route::get('admin/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
Route::put('admin/projects/{project}/update', [ProjectController::class, 'update'])->name('admin.projects.update');
Route::post('admin/projects/store', [ProjectController::class, 'store'])->name('admin.projects.store');
Route::get('admin/projects/destroy', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
Route::delete('admin/projects/{project}/delete', [ProjectController::class, 'delete'])->name('admin.projects.delete');

// Project Images
Route::get('admin/project-images', [ProjectImageController::class, 'index'])->name('admin.project-images.index');
Route::get('admin/project-images/create', [ProjectImageController::class, 'create'])->name('admin.project-images.create');
Route::get('admin/project-images/{project_image}/edit', [ProjectImageController::class, 'edit'])->name('admin.project-images.edit');
Route::put('admin/project-images/{project_image}/update', [ProjectImageController::class, 'update'])->name('admin.project-images.update');
Route::post('admin/project-images/store', [ProjectImageController::class, 'store'])->name('admin.project-images.store');
Route::get('admin/project-images/destroy', [ProjectImageController::class, 'destroy'])->name('admin.project-images.destroy');
Route::delete('admin/project-images/{project_image}/delete', [ProjectImageController::class, 'delete'])->name('admin.project-images.delete');



// Testimonials
Route::get('admin/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
Route::get('admin/testimonials/create', [TestimonialController::class, 'create'])->name('admin.testimonials.create');
Route::get('admin/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
Route::put('admin/testimonials/{testimonial}/update', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
Route::post('admin/testimonials/store', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
Route::get('admin/testimonials/destroy', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
Route::delete('admin/testimonials/{testimonial}/delete', [TestimonialController::class, 'delete'])->name('admin.testimonials.delete');

// Contact Messages (no create/edit)
Route::get('admin/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages.index');
Route::get('admin/contact-messages/{message}', [ContactMessageController::class, 'show'])->name('admin.contact-messages.show');
Route::get('admin/contact-messages/destroy', [ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
Route::delete('admin/contact-messages/{message}/delete', [ContactMessageController::class, 'delete'])->name('admin.contact-messages.delete');

// Products
Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('admin/products/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');
Route::post('admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('admin/products/destroy', [ProductController::class, 'destroy'])->name('admin.products.destroy');
Route::delete('admin/products/{product}/delete', [ProductController::class, 'delete'])->name('admin.products.delete');

//quotes
Route::get('admin/quotes', [QuoteController::class, 'index'])->name('admin.quotes.index');
Route::get('admin/quotes/create', [QuoteController::class, 'create'])->name('admin.quotes.create');
Route::get('admin/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('admin.quotes.edit');
Route::put('admin/quotes/{quote}/update', [QuoteController::class, 'update'])->name('admin.quotes.update');
Route::post('admin/quotes/store', [QuoteController::class, 'store'])->name('admin.quotes.store');
Route::get('admin/quotes/destroy', [QuoteController::class, 'destroy'])->name('admin.quotes.destroy');
Route::delete('admin/quotes/{quote}/delete', [QuoteController::class, 'delete'])->name('admin.quotes.delete');

// Company
Route::get('admin/company', [CompanyController::class, 'index'])->name('admin.company.index');
Route::get('admin/company/{company}/edit', [CompanyController::class, 'edit'])->name('admin.company.edit');


// Home front
Route::get('/', function () {
    return view('home', [
        'company'      => \App\Company::first(),
        'services'     => \App\Service::where('is_active', true)->orderBy('display_order')->get(),
        'sectors'      => \App\ActivitySector::where('is_active', true)->orderBy('display_order')->get(),
        'clients'      => \App\Client::all(),
        'projects'     => \App\Project::with('client','sector')->latest()->get(),
        'testimonials' => \App\Testimonial::where('is_active', true)->orderBy('display_order')->get(),
      'quotes' => \App\Quote::with(['service', 'project'])
            ->whereIn('status', ['NEW', 'IN_PROGRESS'])
            ->latest()
            ->get(),
        'products'     => \App\Product::where('is_active', true)->get(),
    ]);
})->name('home');




Route::view('/', 'home')->name('home');

Route::get('/dashboard', function () {
    return redirect('/admin/service');
})->middleware(['auth'])->name('dashboard');


Route::get('/admin/service', function () {
    return view('admin.service');
})->middleware(['auth']);

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});

use App\Service;

Route::get('/admin/service', function () {
    $services = Service::all(); // récupère tous les services
    return view('admin.service', compact('services'));
})->middleware(['auth']);


Route::middleware(['auth'])->group(function () {
    Route::resource('service', ServiceController::class);
});

Route::get('/admin/service', function () { $services = Service::all(); 
return view('admin.service', compact('services')); })->middleware(['auth']);


use Illuminate\Support\Facades\Auth;


Route::middleware(['auth'])->group(function () {

    // Routes pas accessibles aux EDITOR
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'EDITOR') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }], function () {
   Route::resource('clients', ClientController::class);
            Route::resource('sectors', ActivitySectorController::class);
            Route::resource('testimonials', TestimonialController::class);
            Route::resource('products', ProductController::class);
            Route::resource('contact-messages', ContactMessageController::class);
            Route::resource('quotes', QuoteController::class);
    });

    // Routes réservées uniquement aux ADMIN
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::user()->role === 'ADMIN') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }], function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('admin/services', ServiceController::class);
            Route::resource('admin/projects', ProjectController::class);
            Route::resource('clients', ClientController::class);
            Route::resource('sectors', ActivitySectorController::class);
            Route::resource('testimonials', TestimonialController::class);
            Route::resource('products', ProductController::class);
            Route::resource('contact-messages', ContactMessageController::class);
            Route::resource('quotes', QuoteController::class);
            Route::resource('company', CompanyController::class)->only(['index','edit','update']);
        });
    });
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/', [PageController::class, 'home']);
Route::get('/careers', [PageController::class, 'careers']);
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');


Route::get('/admin/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages.index');


require __DIR__.'/auth.php';

