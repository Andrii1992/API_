<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PostsAdminController;
use App\Http\Controllers\Admin\UsersAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('role:admin|user')->prefix('admin')->group(function () {

    // CRUD POSTS    
    Route::get('/', [HomeAdminController::class, 'index'])->name('indexAdmin');
    Route::get('posty', [PostsAdminController::class, 'showPostsEdition'])->name('postsAdmin');
    Route::get('posty/usun/{id}',  [PostsAdminController::class, 'delete'])->name('deletePostsAdmin');
    Route::get('posty/edycja/{id}',  [PostsAdminController::class, 'edit'])->name('editPostsAdmin');
    Route::post('posty/edycja',  [PostsAdminController::class, 'editStore'])->name('editStorePostsAdmin');
    Route::get('posty/nowypost',  [PostsAdminController::class, 'create'])->name('createPostsAdmin');
    Route::post('posty/nowypost',  [PostsAdminController::class, 'createStore'])->name('createStorePostsAdmin');
 });

Route::middleware('role:admin')->prefix('admin')->group(function () {
    // CRUD USERS
    Route::get('uzytkowniki', [UsersAdminController::class, 'showUsersEdition'])->name('usersAdmin');
    Route::get('uzytkowniki/nowy',  [UsersAdminController::class, 'create'])->name('getCreateUserAdmin');
    Route::post('uzytkowniki/nowy',  [UsersAdminController::class, 'createStore'])->name('postCreateUserAdmin');
    Route::get('uzytkowniki/usun/{id}',  [UsersAdminController::class, 'delete'])->name('deleteUserAdmin');
    Route::get('uzytkowniki/edycja/{id}',  [UsersAdminController::class, 'edit'])->name('editUserAdmin');
    Route::post('uzytkowniki/edycja',  [UsersAdminController::class, 'editStore'])->name('editStoreUserAdmin');
 });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
