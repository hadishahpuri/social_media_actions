<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['Auth']],function (){
    Route::group(['prefix' => 'sma'],function (){
        Route::post('/comment', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class,'createComment'])->name('actions.createComment');
        Route::post('/update_comment', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class,'updateComment'])->name('actions.updateComment');
        Route::post('/delete_comment', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class,'deleteComment'])->name('actions.deleteComment');
        Route::post('/approve_comment', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class,'approveComment'])->name('actions.approveComment');
        Route::post('/like_or_dislike', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class,'likeOrDislike'])->name('actions.likeOrDislike');
        Route::post('/bookmarks', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class, 'bookmarks'])->name('actions.bookmarks');
        Route::post('/bookmark', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class, 'bookmark'])->name('actions.bookmark');
        Route::post('/delete_bookmark', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class, 'deleteBookmark'])->name('actions.delete');
    });
});
Route::group(['prefix' => 'sma'],function (){
    Route::post('/comments', [\Hadishahpuri\SocialMediaActions\Controllers\SocialMediaActionController::class,'comments'])->name('actions.comments');
});
