<?php
use App\Models\Blog;
use App\Models\Project;
use App\Models\Award;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $blogs = Blog::latest()->take(3)->get();
    $projects = Project::latest()->get();
    $awards = \App\Models\Certificate::latest()->get();

    return view('home', compact('blogs', 'projects', 'awards'));
});

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
