<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\Api\admin\HomeAdminController;
use App\Http\Controllers\Api\admin\PostsAdminController;
use App\Http\Controllers\Api\admin\UsersAdminController;
use App\Http\Controllers\Api\PostsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('/blog', [PostsController::class, 'getAllPosts']);
Route::middleware('api')->get('/blog/{id}', [PostsController::class, 'getByIdPost']);

Route::middleware('role:admin|user')->prefix('admin')->group(function () {

    // CRUD POSTS    
    Route::get('/', [HomeAdminController::class, 'index'])->name('indexAdmin');
    Route::get('posty', [PostsAdminController::class, 'showPostsEdition']);
    Route::get('posty/usun/{id}',  [PostsAdminController::class, 'delete']);
    Route::get('posty/edycja/{id}',  [PostsAdminController::class, 'edit']);
    Route::post('posty/edycja',  [PostsAdminController::class, 'editStore']);
    Route::get('posty/nowypost',  [PostsAdminController::class, 'create']);
    Route::post('posty/nowypost',  [PostsAdminController::class, 'createStore']);
});

Route::middleware('role:admin')->prefix('admin')->group(function () {
    
    // CRUD USERS
    Route::get('uzytkowniki', [UsersAdminController::class, 'showUsersEdition']);
    Route::get('uzytkowniki/nowy',  [UsersAdminController::class, 'create']);
    Route::post('uzytkowniki/nowy',  [UsersAdminController::class, 'createStore']);
    Route::get('uzytkowniki/usun/{id}',  [UsersAdminController::class, 'delete']);
    Route::get('uzytkowniki/edycja/{id}',  [UsersAdminController::class, 'edit']);
    Route::post('uzytkowniki/edycja',  [UsersAdminController::class, 'editStore']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $name = $request->user()->name;
    $role = $request->user()->getRole();

    return  compact('name', 'role');
});



















// register
Route::get('register', function (Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return $user;
});

// login
Route::post('login', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if (!auth()->attempt($credentials)) {
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials'
        ]);
    }

    $request->session()->regenerate();

    return response()->json(null, 201);
});

// logout

Route::post('logout', function (Request $request) {
    auth()->guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return response()->json(null, 200);
});
