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
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/sitemap.xml', function () {
    $urls = [
        [
            'loc' => route('home'),
            'changefreq' => 'weekly',
            'priority' => '1.0',
            'lastmod' => now()->toAtomString(),
        ],
        [
            'loc' => route('stages.index'),
            'changefreq' => 'daily',
            'priority' => '0.8',
            'lastmod' => now()->toAtomString(),
        ],
    ];

    $stageUrls = Stage::query()
        ->where('is_active', true)
        ->get(['slug', 'updated_at'])
        ->map(function (Stage $stage) {
            return [
                'loc' => route('stages.show', ['slug' => $stage->slug]),
                'changefreq' => 'weekly',
                'priority' => '0.7',
                'lastmod' => optional($stage->updated_at)->toAtomString() ?? now()->toAtomString(),
            ];
        })
        ->all();

    $urls = array_merge($urls, $stageUrls);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($urls as $url) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1) . "</loc>\n";
        $xml .= '    <lastmod>' . $url['lastmod'] . "</lastmod>\n";
        $xml .= '    <changefreq>' . $url['changefreq'] . "</changefreq>\n";
        $xml .= '    <priority>' . $url['priority'] . "</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');
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
