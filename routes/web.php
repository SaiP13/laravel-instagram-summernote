<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StudentController;

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


//students and marks

Route::get('/student',[StudentController::class, 'average']);
Route::get('/getStudent',[StudentController::class, 'getStudent']);

//localities
Route::any('/locality',[HomeController::class, 'locality']);
Route::any('/get_locality',[HomeController::class, 'getLocality']);

//comments

Route::any('/saveComment',[BlogController::class, 'saveComment']);
Route::any('/addLike',[BlogController::class, 'addLike']);
Route::any('/removeLike',[BlogController::class, 'removeLike']);

Route::any('/addDislike',[BlogController::class, 'addDislike']);
Route::any('/removeDislike',[BlogController::class, 'removeDislike']);

Route::any('/getComments',[BlogController::class, 'getComments']);
Route::any('/getAjaxBlogs',[BlogController::class, 'getAjaxBlogs']);

//web
Route::any('/blog',[BlogController::class, 'index']);

Route::any('admin/blogs',[AdminController::class, 'blogs']);

Route::any('addBlog',[BlogController::class, 'addBlog']);
Route::any('updateBlog',[BlogController::class, 'updateBlog']);
Route::any('deleteBlog/{id}',[BlogController::class, 'deleteBlog']);
Route::any('deleteComment',[BlogController::class, 'deleteComment']);
Route::any('updateComment',[BlogController::class, 'updateComment']);
Route::any('getBlogDetails',[BlogController::class, 'getBlogDetails']);

Route::get('/home', [HomeController::class,'index']);
Route::get('/', function(){
    return view('home');
});

Route::get('/admin',[AdminController::class, 'index']);

//admin pages
Route::any('admin.home',[AdminController::class, 'home']);
Route::any('update-home-content',[AdminController::class, 'updateHomeContent']);
Route::any('delete-home-content',[AdminController::class, 'deleteHomeContent']);



//login
Route::get('logout',[LoginController::class, 'logout']);
Route::get('login',[LoginController::class, 'login']);
Route::any('loginAction',[LoginController::class, 'loginAction']);


Route::any('register',[LoginController::class, 'register']);
Route::any('registerAction',[LoginController::class, 'registerAction']);

Route::get('blank',[AdminController::class, 'blank']);

