<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HobbiesController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SpyController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',                  [MainController::class,       'index'])    -> name('main.index');
Route::get('/main',              [MainController::class,       'index'])    -> name('main.index');
Route::get('/about',             [AboutController::class,      'index'])    -> name('about.index');
Route::get('/contact',           [ContactController::class,    'index'])    -> name('contact.index');
Route::get('/history',           [HistoryController::class,    'index'])    -> name('history.index');
Route::get('/hobbies',           [HobbiesController::class,    'index'])    -> name('hobbies.index');
Route::get('/learning',          [LearningController::class,   'index'])    -> name('learning.index');
Route::get('/photo',             [PhotoController::class,      'index'])    -> name('photo.index');
Route::get('/test',              [TestController::class,       'index'])    -> name('test.index');

Route::post('/contact',          [ContactController::class,    'store'])    -> name('contact.store');
Route::post('/test',             [TestController::class,       'store'])    -> name('test.store');
Route::get('/test/table',        [TestController::class,       'table'])    -> name('test.table')       -> middleware('authorized');

Route::get('/guestbook',         [GuestBookController::class,  'index'])    -> name('guestbook.index');
Route::post('/guestbook',        [GuestBookController::class,  'store'])    -> name('guestbook.store');
Route::get('/guestbook/edit',    [GuestBookController::class,  'edit'])     -> name('guestbook.edit')   -> middleware('admin');
Route::post('/guestbook/update', [GuestBookController::class,  'update'])   -> name('guestbook.update') -> middleware('admin');

Route::get('/blog',              [BlogController::class,       'index'])    -> name('blog.index');
Route::get('/blog/create',       [BlogController::class,       'create'])   -> name('blog.create');
Route::post('/blog',             [BlogController::class,       'store'])    -> name('blog.store');
Route::get('/blog/file_upload',  [BlogController::class,       'file_upload']) -> name('blog.file_upload');
Route::post('/blog/file_upload', [BlogController::class,       'file_upload_update']) -> name('blog.file_upload_update');
Route::get('/blog/{id}',         [BlogController::class,       'show'])     -> name('blog.show');
// Route::get('/blog/{id}/edit',    [BlogController::class,       'edit'])     -> name('blog.edit');
Route::post('/blog/{id}',        [BlogController::class,       'update'])   -> name('blog.update');
Route::delete('/blog/{id}',      [BlogController::class,       'destroy'])  -> name('blog.destroy');

Route::get('/login',             [AuthController::class,       'login_form']) -> name('auth.login_form');
Route::post('/login',            [AuthController::class,       'login'])    -> name('auth.login');
Route::get('/registration',      [AuthController::class,       'registration_form']) -> name('auth.registration_form');
Route::post('/registration',     [AuthController::class,       'registration']) -> name('auth.registration');
Route::get('/logout',            [AuthController::class,       'logout'])   -> name('auth.logout')      -> middleware('authorized');

Route::get('/spy',               [SpyController::class,        'index']) -> name('spy.index')       -> middleware('admin');

Route::get('/try_register',      [AuthController::class,       'try_register']);
