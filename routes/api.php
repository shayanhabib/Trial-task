<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SubscriberController;
use App\Http\Controllers\MailControllerr;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//post..

Route::post('/addPost', [PostController::class,'store']);
Route::post('/showAllPosts', [PostController::class,'index']);
Route::post('/showPost', [PostController::class,'show']);
Route::post('/updatePost', [PostController::class,'update']);
Route::post('/deletePost', [PostController::class,'delete']);


//subscriber..

Route::post('/addSubscriber', [SubscriberController::class,'store']);
Route::post('/showAllSubscribers', [SubscriberController::class,'index']);
Route::post('/showSubscriber', [SubscriberController::class,'show']);
Route::post('/updateSubscriber', [SubscriberController::class,'update']);
Route::post('/deleteSubscriber', [SubscriberController::class,'delete']);


//send mail
Route::get('/sendTestEmail', [MailControllerr::class,'send']);