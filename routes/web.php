<?php

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
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

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::name('news.')
    ->prefix('news')
    ->group(
        function () {
            Route::get('/categories', [NewsController::class, 'index'])->name('categories');
            Route::get('/{category}', [NewsController::class, 'showCategoryNews'])->name('showCategory');
            Route::get('/{category}/{news}', [NewsController::class, 'showOneNews'])->name('oneNews');
        }
    );

Route::view('/about', 'about')->name('about');

Route::name('admin.')
    ->prefix('admin')
    ->group(
        function () {
            Route::get('/', [AdminIndexController::class, 'index'])->name('index');
            Route::get('/test1', [AdminIndexController::class, 'test1'])->name('test1');
            Route::get('/test2', [AdminIndexController::class, 'test2'])->name('test2');
        }
    );
