<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

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

// Article Management Routes - All roles with proper permissions
Route::group(['middleware' => ['auth', 'permission:articles.read']], function () {
    Route::view('articles', 'articles.index')->name('articles.index');
});

Route::group(['middleware' => ['auth', 'permission:articles.create']], function () {
    Route::view('articles/create', 'articles.create')->name('articles.create');
    Route::view('articles/{article}/edit', 'articles.edit')->name('articles.edit');
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
