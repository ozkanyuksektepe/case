<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\PanelController;

use App\Http\Controllers\Frontend\FrontendController;


/*
    url arada tire (-) olarak yazılacak
    method isimleri camelCase olarak yazılacak
    route nameleri nokta (.) ile yazılacak
*/

Route::name("frontend.")->group(function(){
  Route::get("/",[FrontendController::class,"index"])->name("index");
  Route::get("/blog/kategori/{slug}",[FrontendController::class,"blogCategories"])->name("blog.categories");
  Route::get("/blog/detay/{slug}",[FrontendController::class,"blogDetails"])->name("blog.details");
});


Route::prefix('panel')->name('panel.')->group(function(){
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login-auth', [LoginController::class, 'auth'])->name('login.auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function(){
        Route::get("/",[PanelController::class,"index"])->name("index");
        Route::resource('user', UserController::class)->except(['show']);

        Route::resource('blog-category', BlogCategoryController::class)->except(['show']);

        Route::resource('blog', BlogController::class)->except(['show']);

        Route::name('image.')->group(function(){
            Route::get('image', [ImageController::class, 'index'])->name('index');
            Route::get('image/show/{folder}/{item_id}/{name}', [ImageController::class, 'show'])->name('show');
            Route::post('image/store', [ImageController::class, 'store'])->name('store');
            Route::post('image/status/{id}', [ImageController::class, 'status'])->name('status');
            Route::post('image/cover/{id}', [ImageController::class, 'cover'])->name('cover');
            Route::post('image/rank', [ImageController::class, 'rank'])->name('rank');
            Route::get('image/destroy/{id}', [ImageController::class, 'destroy'])->name('destroy');
        });

        Route::prefix("file")->name("file.")->group(function(){
            Route::get("/",[FileController::class,"index"])->name("index");
            Route::get("/show/{folder}/{item_id}/{name}",[FileController::class,"show"])->name("show");
            Route::post("/store",[FileController::class,"store"])->name("store");
            Route::get("/edit/{id}",[FileController::class,"edit"])->name("edit");
            Route::post("/update/{id}",[FileController::class,"update"])->name("update");
            Route::post("/status/{id}",[FileController::class,"status"])->name("status");
            Route::post("/rank",[FileController::class,"rank"])->name("rank");
            Route::get("/destroy/{id}",[FileController::class,"destroy"])->name("destroy");
        });
    });
});
