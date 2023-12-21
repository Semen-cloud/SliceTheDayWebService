<?php 

namespace App\kernel\Database;

interface DatabaseInterface 
{
    public function insert(string $table, array $data) : int | false;

    public function register(array $data) : bool;

    public function Auth(array $data) : array | false;

    public function update(array $data, int $id) : bool;

    public function addUserCreatorRights(int $id, int $time) : void;
    
    public function availableVotings() : array;

    public function votingInfo(int $votingId, int $userId) : array;

    public function pastVotings() : array;

    public function blockVoting(int $id) : void;

    public function allUsers() : array;

    public function allVotings() : array;
}