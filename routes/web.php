<?php
use App\Models\Blog;
use App\Models\Project;
use App\Models\Award;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $blogs = Blog::latest()->take(3)->get();
    $projects = Project::latest()->get();
    $awards = Award::latest()->get();

    return view('home', compact('blogs', 'projects', 'awards'));
});
