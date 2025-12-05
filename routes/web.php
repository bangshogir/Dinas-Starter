<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestArticles = \App\Models\Article::with(['category', 'author'])
        ->published()
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('welcome', compact('latestArticles'));
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Super Admin Routes - Full System Access
Route::group(['middleware' => ['auth', 'permission:system.manage']], function () {
    Route::view('admin/system', 'admin.system')->name('admin.system');
    Route::view('admin/settings', 'admin.settings')->name('admin.settings');
    Route::view('admin/backup', 'admin.backup')->name('admin.backup');
});

// Role & Permission Management Routes - Super Admin Only
Route::group(['middleware' => ['auth', 'permission:roles.create']], function () {
    Route::view('admin/roles', 'admin.roles')->name('admin.roles');
    Route::view('admin/permissions', 'admin.permissions')->name('admin.permissions');
});

// User Management Routes - Super Admin Only
Route::group(['middleware' => ['auth', 'permission:users.create']], function () {
    Route::view('admin/users', 'admin.users')->name('admin.users');
    Route::view('admin/users/create', 'admin.users-create')->name('admin.users.create');
    Route::view('admin/users/{user}/edit', 'admin.users-edit')->name('admin.users.edit');
});

// Admin Dashboard - Admin and Super Admin
Route::group(['middleware' => ['auth', 'permission:users.read']], function () {
    Route::view('admin', 'admin.dashboard')->name('admin.dashboard');
    Route::view('admin/users-list', 'admin.users-list')->name('admin.users.list');
});

// Content Management Routes - Admin, Super Admin, and Author
Route::group(['middleware' => ['auth', 'permission:content.create']], function () {
    Route::view('admin/content', 'admin.content')->name('admin.content');
    Route::view('admin/content/create', 'admin.content-create')->name('admin.content.create');
});

// Admin Articles Management
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Articles
    Route::middleware('permission:articles.read')->prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('create')->middleware('permission:articles.create');
        Route::post('/', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('store')->middleware('permission:articles.create');
        Route::get('/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'show'])->name('show');
        Route::get('/{article}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('edit')->middleware('permission:articles.update');
        Route::put('/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('update')->middleware('permission:articles.update');
        Route::delete('/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('destroy')->middleware('permission:articles.delete');
        Route::post('/{article}/publish', [App\Http\Controllers\Admin\ArticleController::class, 'publish'])->name('publish')->middleware('permission:articles.update');
        Route::post('/{article}/featured', [App\Http\Controllers\Admin\ArticleController::class, 'toggleFeatured'])->name('featured')->middleware('permission:articles.update');
    });

    // Article Categories
    Route::middleware('permission:content.read')->prefix('article-categories')->name('article-categories.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'create'])->name('create')->middleware('permission:content.create');
        Route::post('/', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'store'])->name('store')->middleware('permission:content.create');
        Route::get('/{articleCategory}', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'show'])->name('show');
        Route::get('/{articleCategory}/edit', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'edit'])->name('edit')->middleware('permission:content.update');
        Route::put('/{articleCategory}', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'update'])->name('update')->middleware('permission:content.update');
        Route::delete('/{articleCategory}', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'destroy'])->name('destroy')->middleware('permission:content.delete');
        Route::post('/order', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'updateOrder'])->name('order')->middleware('permission:content.update');
    });
});

// Profil Dinas Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware('permission:profil-dinas.read')->group(function () {
        Route::get('profil-dinas', [App\Http\Controllers\Admin\ProfilDinasController::class, 'index'])->name('profil-dinas');
    });

    Route::middleware('permission:profil-dinas.update')->group(function () {
        Route::get('profil-dinas/edit', [App\Http\Controllers\Admin\ProfilDinasController::class, 'edit'])->name('profil-dinas.edit');
        Route::put('profil-dinas', [App\Http\Controllers\Admin\ProfilDinasController::class, 'update'])->name('profil-dinas.update');
    });
});

// Public Articles
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [App\Http\Controllers\Public\ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [App\Http\Controllers\Public\ArticleController::class, 'show'])->name('show');
    Route::get('/category/{category:slug}', [App\Http\Controllers\Public\ArticleController::class, 'category'])->name('category');
    Route::get('/search', [App\Http\Controllers\Public\ArticleController::class, 'search'])->name('search');
});

// System Examples for Testing
Route::group(['middleware' => ['auth', 'role:Super Admin']], function () {
    Route::view('test/superadmin', 'test.superadmin')->name('test.superadmin');
});

Route::group(['middleware' => ['auth', 'role:Admin|Super Admin']], function () {
    Route::view('test/admin', 'test.admin')->name('test.admin');
});

Route::group(['middleware' => ['auth', 'role:Author|Admin|Super Admin']], function () {
    Route::view('test/author', 'test.author')->name('test.author');
});

Route::view('admin-test', 'admin.dashboard');

require __DIR__ . '/auth.php';

