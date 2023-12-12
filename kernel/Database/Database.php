<?php

namespace App\kernel\Database;

include_once (APP_PATH . "/kernel/Database/DatabaseInterface.php");
include_once (APP_PATH . "/kernel/Config/ConfigInterface.php");

use App\kernel\Database\DatabaseInterface;
use App\kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    private $db;

    public function __construct(
        private ConfigInterface $config
    ){
        //$this->connect();
    }
    public function insert(string $table, array $data) : int | false {
        $fields = array_keys($data);
        $values = array_values($data);

        $columns = implode(', ', $fields);
        $binds = "";
        foreach ($values as $value) {
            $binds .= "'$value', ";
        }
        $binds = substr($binds,0,-2);

        $query = "INSERT INTO $table ($columns) VALUES ($binds)";

        echo "  $query";

        try {
            $this->db->query($query);
        } catch (\Exception $e) {
            return false;
        }

        return 5;
    }

    public function register(array $data) : bool{
        if($this->isUserInDB($data['email'])) {
            return false;
        }
        $this->insert("users", $data);
        return true;
    }

    public function Auth(array $data) : array | false {
        if($this->isUserInDB($data['email'])) {
            $query = "SELECT id, email, login FROM users WHERE email='" . $data['email']  . "' AND password= '" . $data['password'] . "'";
            $res = $this->db->query($query);
            if($row = $res->fetch_assoc()) {
                return [$row['id'], $row['email'], $row['login']];
            }
        }
        return false;
    }

    private function isUserInDB(string $email) : bool {
        $query = "SELECT email FROM users WHERE email = '$email'";
        try {
            $res = $this->db->query($query);
            if($res->fetch_assoc()){
                return true;
            }
            else
                return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function connect() : void {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->db = mysqli_connect(
                $host, $username, $password, $database,
            );
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
}