<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('addcars', "Api\CarsController@store");
Route::put('editcar', "Api\CarsController@update");
Route::delete('deletecar', "Api\CarsController@destroy");
Route::post('adduser', "Api\UserController@store");
Route::put('edituser', "Api\UserController@update");
Route::delete('deleteuser', "Api\UserController@destroy");
Route::post('addrole', "Api\RoleController@store");
Route::put('editrole', "Api\RoleController@update");
Route::delete('deleterole', "Api\RoleController@destroy");
Route::post('addcarbrand', "Api\CarBrandsController@store");
Route::put('editcarbrand', "Api\CarBrandsController@update");
Route::delete('deletecarbrand', "Api\CarBrandsController@destroy");
Route::post('addcomments', "Api\CommentsController@store");
Route::put('editcomments', "Api\CommentsController@update");
Route::delete('deletecomments', "Api\CommentsController@destroy");
Route::post('addcommentreplies', "Api\CommentRepliesController@store");
Route::put('editcommentreplies', "Api\CommentRepliesController@update");
Route::delete('deletecommentreplies', "Api\CommentRepliesController@destroy");
Route::post('upvotecomments', "Api\UpvoteCommentsController@store");
Route::post('upvotecommentreplies', "Api\UpvoteCommentRepliesController@store");
Route::post('downvotecommentreplies', "Api\DownvoteCommentRepliesController@store");
Route::post('downvvotecomments', "Api\DownvoteCommentsController@store");
