<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,UserController,BlogController};

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

 Route::get('/',[HomeController::class,'index'])->name('dashboard');

 //Auth Routes
Route::group(['middleware' => 'guest'],function(){
     Route::get('user-register',[UserController::class,'index'])->name('user.register');
     Route::get('user-login',[UserController::class,'login'])->name('user.login');
     Route::post('user-registration',[UserController::class,'register'])->name('user.registration');
     Route::post('users-login',[UserController::class,'userLogin'])->name('user.login');
});

//Blog Routes
Route::group(['middleware' => 'auth'],function(){
     Route::get('create-blog',[BlogController::class,'index'])->name('blog.create');
     Route::post('save-blog',[BlogController::class,'create'])->name('save.blog');
     Route::get('my-blogs',[BlogController::class,'myBlogs'])->name('my-blogs');
     Route::get('edit-blog/{id}',[BlogController::class,'edit'])->name('edit-blog');
     Route::post('update-blog/{id}',[BlogController::class,'update'])->name('update-blog');
     Route::get('delete-blog/{id}',[BlogController::class,'destroy'])->name('delete-blog');
 });

 Route::get('user-logout',[UserController::class,'logout'])->name('user.logout');

