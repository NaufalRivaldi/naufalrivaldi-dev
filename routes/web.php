<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/services/{slug}', function (string $slug) {
    return view('service-detail', ['slug' => $slug]);
})->name('service.detail');

Route::get('/projects/{slug}', function (string $slug) {
    return view('project-detail', ['slug' => $slug]);
})->name('project.detail');
