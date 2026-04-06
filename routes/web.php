<?php

use App\Http\Controllers\ActivitySectorController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDataSyncController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CrmActivityController;
use App\Http\Controllers\KpiMetricController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PricingPlanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StageCandidatureController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');
Route::post('/testimonial', [TestimonialController::class, 'submitFromWebsite'])->name('testimonial.store');

// Pages publiques stages
Route::get('/stages', [PageController::class, 'stages'])->name('stages.index');
Route::get('/stages/{slug}', [PageController::class, 'stageShow'])->name('stages.show');
Route::post('/stages/{stage:slug}/postuler', [StageCandidatureController::class, 'store'])->name('candidatures.store');

Route::get('/dashboard', function (Request $request) {
    if ($request->user() && $request->user()->role === 'ADMIN') {
        return redirect()->route('admin.dashboard');
    }

    abort(403, 'Unauthorized');
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', ServiceController::class);
    Route::resource('sectors', ActivitySectorController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('kpis', KpiMetricController::class)->only(['index', 'edit', 'update']);
    Route::resource('leads', LeadController::class)->except(['show']);
    Route::resource('opportunities', OpportunityController::class)->except(['show']);
    Route::patch('opportunities/{opportunity}/stage', [OpportunityController::class, 'updateStage'])->name('opportunities.update-stage');
    Route::resource('crm-activities', CrmActivityController::class)->except(['show']);
    Route::post('kpis/recalculate', [KpiMetricController::class, 'recalculate'])->name('kpis.recalculate');
    Route::resource('company', CompanyController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('data-sync/website-static', [AdminDataSyncController::class, 'syncWebsiteStatic'])->name('data-sync.website-static');

    // Stages & candidatures
    Route::resource('stages', StageController::class);
    Route::get('candidatures', [StageCandidatureController::class, 'index'])->name('candidatures.index');
    Route::get('candidatures/{candidature}', [StageCandidatureController::class, 'show'])->name('candidatures.show');
    Route::patch('candidatures/{candidature}', [StageCandidatureController::class, 'update'])->name('candidatures.update');
    Route::delete('candidatures/{candidature}', [StageCandidatureController::class, 'destroy'])->name('candidatures.destroy');

    // Pricing
    Route::resource('pricing', PricingPlanController::class);

    // Legacy delete routes used by existing blade templates.
    Route::delete('services/{service}/delete', [ServiceController::class, 'destroy'])->name('services.delete');
    Route::delete('sectors/{sector}/delete', [ActivitySectorController::class, 'destroy'])->name('sectors.delete');
    Route::delete('clients/{client}/delete', [ClientController::class, 'destroy'])->name('clients.delete');
    Route::delete('projects/{project}/delete', [ProjectController::class, 'destroy'])->name('projects.delete');
    Route::delete('testimonials/{testimonial}/delete', [TestimonialController::class, 'destroy'])->name('testimonials.delete');
});

require __DIR__.'/auth.php';
