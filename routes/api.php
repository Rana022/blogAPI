<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/posts', 'PostController');
Route::apiResource('/categories', 'CategoryController');
Route::apiResource('/tags', 'TagController');
Route::group(['prefix' => 'post'], function(){
    Route::apiResource('/{post}/comments', 'CommentController');
});

