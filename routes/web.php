<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ParserController as AdminParserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\NewsSourceController as AdminNewsSourceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
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

Route::match(['get', 'post'], '/profile', [ProfileController::class, 'update'])->name('profile');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->group(
        function () {
            Route::resource('/users', AdminUserController::class)->except(['show', 'create', 'edit', 'store']);
            Route::get('/ajax', [AdminIndexController::class, 'ajax'])->name('ajax');
            Route::post('/ajax', [AdminIndexController::class, 'send']);
            Route::get('/', [AdminIndexController::class, 'index'])->name('index');
            Route::name('download.')
                ->prefix('download')
                ->group(
                    function () {
                        Route::get('/json', [AdminNewsController::class, 'downloadJson'])->name('json');
                        Route::get('/image', [AdminNewsController::class, 'downloadImage'])->name('image');
                    }
                );
            Route::resource('/news', AdminNewsController::class)->except(['show']);
            Route::resource('/categories', AdminCategoryController::class)->except(['show']);
            Route::resource('/news_sources', AdminNewsSourceController::class)->except(['show']);
            Route::name('news.')
                ->prefix('news')
                ->group(
                    function () {
                        Route::get('/parse', [AdminParserController::class, 'parse'])->name('parse');
                        Route::get('/parser', [AdminParserController::class, 'index'])->name('parser');
                        Route::get('/categories', [AdminNewsController::class, 'index'])->name('categories');
                        Route::get('/{category}', [AdminNewsController::class, 'showCategoryNews'])->name('categoryNews');
                        Route::get('/{category}/{news}', [AdminNewsController::class, 'showOneNews'])->name('oneNews');
                    }
                );
        }
    );

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'is_admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/auth/{soc}', [LoginController::class, 'loginSoc'])->name('loginSoc');
Route::get('/auth/{soc}/response', [LoginController::class, 'responseSoc'])->name('responseSoc');
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Route::post('logout', [LoginController::class, 'logout']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
