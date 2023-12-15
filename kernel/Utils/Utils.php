<?php

namespace App\kernel\Utils;

include_once (APP_PATH . "/kernel/Session/Session.php");

use App\kernel\Session\Session;

class Utils 
{
    public static function addUserDataToSession(Session $session, array $userData): void {
        $session->set('Auth', true);
        var_dump($userData);
        if(isset($userData['id'])) 
            $session->set('userId', $userData['id']);
        
        if(isset($userData['email']))
            $session->set('userEmail', $userData['email']);

        if(isset($userData['login']))
            $session->set('userLogin', $userData['login']);

        if(isset($userData['isAdmin']))
            $session->set('userIsAdmin', $userData['isAdmin']);
        echo $userData['isAdmin'];

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
        if(isset($votingData['ExpirationDate'])) {
            $resStr = implode('.', array_reverse(explode('-', $votingData['ExpirationDate']))); 
            $res['ExpirationDateOfVoting'] = $resStr;
        }
            
        return $res;
    }

    public static function addUserInfoInArray(array $userData) : array {
        $res = array();
        if(isset($userData['id']))
            $res['userId'] = $userData['id'];
        if(isset($userData['login']))
            $res['userLogin'] = $userData['login'];
        if(isset($userData['email']))
            $res['userEmail'] = $userData['email'];
        if(isset($userData['isAdmin']))
            $res['isUserAdmin'] = $userData['isAdmin'];
        if(isset($userData['isCreator']))
            $res['isUserCreator'] = $userData['isCreator'];

        return $res;
    }
}