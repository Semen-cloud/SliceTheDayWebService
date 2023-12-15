<?php

namespace App\kernel\Database;

include_once (APP_PATH . "/kernel/Database/DatabaseInterface.php");
include_once (APP_PATH . "/kernel/Config/ConfigInterface.php");
include_once (APP_PATH . "/kernel/Utils/Utils.php");

use App\kernel\Database\DatabaseInterface;
use App\kernel\Config\ConfigInterface;
use App\kernel\Utils\Utils;

class Database implements DatabaseInterface
{
    private $db;

    public function __construct(
        private ConfigInterface $config
    ){
        $this->connect();
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
        try {
            $this->db->query($query);
        } catch (\Exception $e) {
            return false;
        }

        return 5;
    }

    public function update(array $data, int $id) : bool {
        $query = "UPDATE users SET ";
        $fieldsToChange = "";
        foreach ($data as $key => $value) {
            $fieldsToChange .= "$key = '$value', ";
        }
        
        $query .= substr($fieldsToChange,0,-2) . " WHERE id = $id";

        try {
            $this->db->query($query);
        } catch (\Exception $e) {
            return false;
        }

        return true;
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
            $query = "SELECT id, email, login, isAdmin, isCreator FROM users WHERE email='" . $data['email']  . "' AND password= '" . $data['password'] . "'";
            $res = $this->db->query($query);
            if($row = $res->fetch_assoc()) {
                return array(
                    'id' => $row['id'],
                    'email' => $row['email'],
                    'login' => $row['login'],
                    'isAdmin' => $row['isAdmin'],
                    'isCreator' => $row['isCreator'],
                );
            }
        }
        return false;
    }

    public function addUserCreatorRights(int $id) : bool {
        $query = "UPDATE users SET isCreator = true WHERE id = $id";
        $res = $this->db->query($query);
        return $res;
    }

    public function availableVotings() : array {
        $query = "SELECT VotingId, Title, Description, CreateDate, ExpirationDate FROM voting WHERE ExpirationDate > NOW() AND isAvailable = true";
        $votingList = array();
        $res = $this->db->query($query);

        while($row = $res->fetch_assoc()) {
            $tmpArray = Utils::addVotingDataInArray($row);
            array_push($votingList, $tmpArray);
        }
        return $votingList;
    } 

    public function pastVotings() : array {
        $listPastVotings = array();
        $query = "SELECT VotingId, Title, Description, CreateDate, ExpirationDate FROM voting WHERE ExpirationDate < NOW() AND isAvailable = true";
        $res = $this->db->query($query);

        while($row = $res->fetch_assoc()) {
            $tmpArray = Utils::addVotingDataInArray($row);
            array_push($votingList, $tmpArray);
        }
        
        return $listPastVotings;
    }

    public function votingInfo(int $votingId, int $userId) : array {
        $query = "SELECT VotingId, Title, Description, CreateDate, ExpirationDate FROM voting WHERE VotingId = $votingId";
        $votingInformation = $this->db->query($query);
        $votingInformation = Utils::addVotingDataInArray($votingInformation->fetch_assoc());

        $query = "SELECT v.VariantId AS id, v.Description AS Description, v.Title AS Title, COUNT(g.VoteId) AS votesCount FROM variants v LEFT JOIN votes g ON v.VariantId = g.VariantId WHERE v.VotingId = $votingId GROUP BY v.VariantId";
        $votingResults = $this->db->query($query);
        $tmpArray = array();
        while($row = $votingResults->fetch_assoc()) {
            array_push($tmpArray, $row);
        }

        $isUserVoteFor = $this->isUserVotingFor($userId, $votingId);

        return array(
            'isUserVotingFor' => $isUserVoteFor,
            'votingInformation' => $votingInformation,
            'votingResults' => $tmpArray,
        );
    }

    public function blockVoting(int $id) : void {
        $query = "UPDATE voting SET isAvailable = false WHERE VotingId = $id";
        var_dump($query);
        $query = $this->db->query($query);
    }

    public function allUsers() : array {
        $query = "SELECT id, login, email, isCreator, isAdmin FROM users";
        $res = $this->db->query($query);
        $users = array();
        while($row = $res->fetch_assoc()) {
            $tmp = Utils::addUserInfoInArray($row);
            array_push($users, $tmp);
        }

        return $users;
    }

    public function allVotings() : array {
        $query = "SELECT * FROM voting";
        $res = $this->db->query($query);
        $votings = array();
        while($row = $res->fetch_assoc()) {
            array_push($votings, $row);
        }

        return $votings;
    }

    private function isUserVotingFor(int $id, int $votingId) : bool {
        $query =   "SELECT var.VotingId
                    FROM votes vot
                    JOIN variants var ON vot.VariantId = var.VariantId
                    WHERE vot.UserId = $id";
        $res = $this->db->query($query);
        while($row = $res->fetch_assoc()) {
            if($row['VotingId'] == $votingId) {
                return true;
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