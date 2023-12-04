<?php

define('APP_PATH', __DIR__);

include_once APP_PATH . '/kernel/App.php';

use App\kernel\App;
$app = new App();
$app->run();