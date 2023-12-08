<?php

namespace App\kernel\Session;

include_once (APP_PATH . "/kernel/Session/SessionInterface.php");

use App\kernel\Session\SessionInterface;

class Session implements SessionInterface
{
    public function __construct() {
        session_start();
    }

    public function set(string $key, $value) : void {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key) : bool {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key) : void {
        unset($_SESSION[$key]);
    }

    public function destroy() : void {
        session_destroy();
    }

    public function getFlash(string $key, $default = null) {
        $value = $this->get($key, $default);
        $this->remove($key);

        return $value;
    }
}