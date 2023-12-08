<?php

namespace App\kernel\Http;

include_once (APP_PATH . "/kernel/Http/RedirectInterface.php");

use App\kernel\Http\RedirectInterface;

class Redirect implements RedirectInterface 
{
    public function to(string $url) {
        header("Location: $url");
        exit;
    }
}