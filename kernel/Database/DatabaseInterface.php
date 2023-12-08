<?php 

namespace App\kernel\Database;

interface DatabaseInterface 
{
    public function insert(string $table, array $data) : int | false;

    public function register(array $data) : bool;

    public function Auth(array $data) : array | false;
}