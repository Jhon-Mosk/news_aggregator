<?php

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index'])->name('main');

Route::name('news.')
    ->prefix('news')
    ->group(
        function () {
            Route::get('/categories', [NewsController::class, 'index'])->name('categories');
            Route::get('/{category}', [NewsController::class, 'showCategoryNews'])->name('categoryNews');
            Route::get('/{category}/{news}', [NewsController::class, 'showOneNews'])->name('oneNews');
        }
    );

Route::view('/about', 'about')->name('about');

Route::name('admin.')
    ->prefix('admin')
    ->group(
        function () {
            Route::get('/', [AdminIndexController::class, 'index'])->name('index');
            Route::match(['get', 'post'], '/news/create', [AdminIndexController::class, 'createNews'])->name('createNews');
            Route::name('download.')
                ->prefix('download')
                ->group(
                    function () {
                        Route::get('/json', [AdminIndexController::class, 'downloadJson'])->name('json');
                        Route::get('/image', [AdminIndexController::class, 'downloadImage'])->name('image');
                    }
                );
        }
    );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
