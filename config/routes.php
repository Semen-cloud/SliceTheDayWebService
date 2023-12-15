<?php

include_once(APP_PATH . '/kernel/Router/Route.php');
include_once(APP_PATH . "/src/Controllers/GetController.php");
include_once(APP_PATH . "/src/Controllers/PostController.php");
include_once(APP_PATH . "/src/Controllers/AdminPostController.php");
include_once(APP_PATH . "/src/Controllers/AdminGetController.php");

use App\kernel\Router\Route;
use App\Controllers\GetController;
use App\Controllers\PostController;
use App\Controllers\AdminPostController;
use App\Controllers\AdminGetController;
use App\Controllers\CreatorGetController;
use App\Controllers\CreatorPostController;

return [
    Route::get('/', [GetController::class, 'default']),
    Route::get('/personalArea', [GetController::class, 'personalArea']),
    Route::get('/oneVoting', [GetController::class, 'oneVoting']),
    Route::get('/votings', [GetController::class, 'votings']),
    Route::get('/pastVotings', [GetController::class, 'pastVotings']),
    Route::get('/creator/newVoting', [CreatorGetController::class, 'newVoting']),
    Route::get('/admin/personalArea', [AdminGetController::class, 'personalAreaAdmin']),
    Route::post('/registration', [PostController::class, 'register']),
    Route::post('/auth', [PostController::class, 'authOfUser']),
    Route::post('/exit', [PostController::class, 'logout']),
    Route::post('/vote', [PostController::class, 'voteFor']),
    Route::post('/updateUserData', [PostController::class,'updateData']),
    Route::post('/creator/createNew', [CreatorPostController::class, 'createNew']),
    Route::post('/admin/blockVoting', [AdminPostController::class, 'blockVoting']),
    Route::post('/admin/makeCreator', [AdminPostController::class, 'makeCreator']),
];