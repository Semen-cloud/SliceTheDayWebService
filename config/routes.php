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

return [
    Route::get('/', [GetController::class, 'default']),
    Route::get('/personalArea', [GetController::class, 'personalArea']),
    Route::get('/voting', [GetController::class, 'oneVoting']),
    Route::get('/votings', [GetController::class, 'votings']),
    Route::get('/pastVotings', [GetController::class, 'pastVotings']),
    Route::get('/admin/newVoting', [AdminGetController::class, 'newVoting']),
    Route::post('/registration', [PostController::class, 'register']),
    Route::post('/auth', [PostController::class, 'authOfUser']),
    Route::post('/exit', [PostController::class, 'logout']),
    Route::post('/vote', [PostController::class, 'voteFor']),
    Route::post('/admin/createNew', [AdminPostController::class, 'createNew']),
    Route::post('/admin/deleteVoting', [AdminPostController::class, 'deleteVoting']),
];