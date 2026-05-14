<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Portfolio Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/cv/download', [PortfolioController::class, 'downloadCv'])->name('cv.download');
Route::post('/contact', [PortfolioController::class, 'sendContact'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile/edit', [AdminController::class, 'profileEdit'])->name('profile.edit');
    Route::put('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');

    // CV Upload
    Route::get('/cv', [AdminController::class, 'cvUpload'])->name('cv.upload');
    Route::post('/cv', [AdminController::class, 'cvStore'])->name('cv.store');

    // Skills CRUD
    Route::get('/skills', [AdminController::class, 'skillsIndex'])->name('skills.index');
    Route::get('/skills/create', [AdminController::class, 'skillsCreate'])->name('skills.create');
    Route::post('/skills', [AdminController::class, 'skillsStore'])->name('skills.store');
    Route::get('/skills/{skill}/edit', [AdminController::class, 'skillsEdit'])->name('skills.edit');
    Route::put('/skills/{skill}', [AdminController::class, 'skillsUpdate'])->name('skills.update');
    Route::delete('/skills/{skill}', [AdminController::class, 'skillsDestroy'])->name('skills.destroy');

    // Experience CRUD
    Route::get('/experience', [AdminController::class, 'experienceIndex'])->name('experience.index');
    Route::get('/experience/create', [AdminController::class, 'experienceCreate'])->name('experience.create');
    Route::post('/experience', [AdminController::class, 'experienceStore'])->name('experience.store');
    Route::get('/experience/{experience}/edit', [AdminController::class, 'experienceEdit'])->name('experience.edit');
    Route::put('/experience/{experience}', [AdminController::class, 'experienceUpdate'])->name('experience.update');
    Route::delete('/experience/{experience}', [AdminController::class, 'experienceDestroy'])->name('experience.destroy');

    // Projects CRUD
    Route::get('/projects', [AdminController::class, 'projectsIndex'])->name('projects.index');
    Route::get('/projects/create', [AdminController::class, 'projectsCreate'])->name('projects.create');
    Route::post('/projects', [AdminController::class, 'projectsStore'])->name('projects.store');
    Route::get('/projects/{project}/edit', [AdminController::class, 'projectsEdit'])->name('projects.edit');
    Route::put('/projects/{project}', [AdminController::class, 'projectsUpdate'])->name('projects.update');
    Route::delete('/projects/{project}', [AdminController::class, 'projectsDestroy'])->name('projects.destroy');
});
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/test-cloudinary', function() {
    try {
        $config = config('cloudinary.cloud_url');
        $masked = substr($config, 0, 20) . '...';

        // Test if credentials are loaded
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET') ? 'SET' : 'NOT SET';

        return response()->json([
            'cloud_url_preview' => $masked,
            'cloud_name' => $cloudName,
            'api_key' => $apiKey,
            'api_secret' => $apiSecret,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});
