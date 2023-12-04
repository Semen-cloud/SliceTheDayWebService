<?php

include_once(APP_PATH . '/kernel/Router/Route.php');
include_once(APP_PATH . "/src/Controllers/HomeController.php");
include_once(APP_PATH . "/src/Controllers/NewVotingController.php");


use App\kernel\Router\Route;
use App\Controllers\HomeController;
use App\Controllers\NewVotingController;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/admin/newVoting', [NewVotingController::class,'index']),
    Route::post('/admin/newVoting', [NewVotingController::class,'createNew']),
];