<?php

include_once(APP_PATH . '/kernel/Router/Route.php');
include_once(APP_PATH . "/src/Controllers/GetController.php");
include_once(APP_PATH . "/src/Controllers/PostController.php");
include_once(APP_PATH . "/src/Controllers/AdminPostController.php");

use App\kernel\Router\Route;
use App\Controllers\GetController;
use App\Controllers\PostController;
use App\Controllers\AdminPostController;

return [
    Route::get('/default', [GetController::class, 'default']),
    Route::get('/personalArea', [GetController::class, 'personalArea']),
    Route::get('/teamBoard', [GetController::class, 'teamBoard']),
    Route::get('/admin/otherPersonalArea', [GetController::class, 'otherPersonalArea']),
    Route::get('/admin/newTasks', [GetController::class, 'newTasks']),
    Route::post('/registration', [PostController::class, 'register']),
    Route::post('/auth', [PostController::class, 'authOfUser']),
    Route::post('/admin/newTasks', [AdminPostController::class, 'newTasks']),
    Route::post('/admin/patchTasks', [AdminPostController::class, 'patchTasks']),
    Route::post('/admin/deleteTask', [AdminPostController::class, 'deleteTask']),
    Route::post('/admin/addUserToTeam', [AdminPostController::class, 'addUserToTeam']),
];