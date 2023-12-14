<?php

namespace App\kernel\Utils;

include_once (APP_PATH . "/kernel/Session/Session.php");

use App\kernel\Session\Session;

class Utils 
{
    public static function addUserDataToSession(Session $session, array $userData): void {
        $session->set('Auth', true);
        if(isset($userData['email']))
            $session->set('userEmail', $userData['email']);

        if(isset($userData['login']))
            $session->set('userLogin', $userData['login']);

        if(isset($userData['isAdmin']))
            $session->set('userIsAdmin', $userData['isAdmin']);

        if(isset($userData['isCreator']))
            $session->set('userIsCreator', $userData['isCreator']);            
    }

    public static function addVotingDataInArray(array $votingData): array {
        $res = array();
        if(isset($votingData['VotingId']))
            $res['VotingId'] = $votingData['VotingId'];
        if(isset($votingData['Title']))
            $res['TitleOfVoting'] = $votingData['Title'];
        if(isset($votingData['Description']))
            $res['DescriptionOfVoting'] = $votingData['Description'];
        if(isset($votingData['CreateDate']))
            $res['CreateDateOfVoting'] = $votingData['CreateDate'];
        if(isset($votingData['ExpirationDateOfVoting']))
            $res['ExpirationDateOfVoting'] = $votingData['ExpirationDate'];

        return $res;
    }
}