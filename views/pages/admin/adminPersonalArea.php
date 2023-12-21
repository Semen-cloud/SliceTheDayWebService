<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
if(!$session->has('Auth')) {$view->page('default');exit;}
if(!$session->get('userIsAdmin')) {$view->page('default');exit;}
?>

<?php $view->component('start')?>

<div class="container">
<?php $view->component('navDiv')?>  
    <p class = "labelOfPage">Личный кабинет администратора c ID: <?php echo $session->get('userId');?></p>
    <div style="display:flex;justify-content:space-around;">
        
        <div class = "verticalBlock">
            <p class = "labelOfDivAdmin">Пользователи</p>
            <?php
                $users = $session->get('allUsers');
                foreach($users as $user) {
                    $btnToAddRights = $user['isUserCreator'] ? "style=\"display:none;\"" : "" ;
                    $userRole = "";
                    if($user['isUserAdmin']) $userRole .= "Администратор";
                    if($user['isUserCreator']){
                        if(!empty($userRole))
                            $userRole .= "<br>";
                        $userRole .= "Создатель";
                    }
                    if(empty($userRole)) $userRole = "Пользователь";

                    echo "  <div class=\"blockInAdminPersonal\">
                                <p class = \"userDataInDiv\">" . $user['userLogin'] . "</p>
                                <p class = \"userDataInDiv\">" . $user['userEmail'] . "</p>
                                <p class = \"userDataInDiv\">" . $userRole . "</p>
                                <form action=\"/admin/makeCreator\" method=\"POST\" $btnToAddRights>
                                    <input type=\"text\" name=\"userId\" value = " . $user['userId'] . " style = \"display:none;\">
                                    <input type=\"submit\" class = \"makeCreatorBtn\" value=\"Сделать создателем\">
                                </form>
                            </div><br>";

                }
            
            ?>
        </div>

        
        <div class = "verticalBlock">
            <p class = "labelOfDivAdmin">Голосования</p>
            <?php
                $votings = $session->get('allVotings');
                foreach($votings as $voting) {
                    $blockedBtn = $voting['isAvailable'] == 0 ? "style=\"display:none;\"" : "";
                    $blockedText = $voting['isAvailable'] == 0 ? "<p class = \"blocked\">Blocked</p>" : "";
                    echo "  <div class = \"blockInAdminPersonal\">
                                <p class=\"votingLabelInDiv\">" . $voting['Title'] . "</p>
                                <p class=\"descriptionOfVoting\">" . $voting['Description'] . "</p>
                                <p class=\"DateInDiv\">" . $voting['CreateDate'] . "</p>
                                <p class=\"DateInDiv\">" . $voting['ExpirationDate'] . "</p>
                                $blockedText
                                <form action=\"/admin/blockVoting\" method=\"POST\" $blockedBtn>
                                    <input type=\"text\" name = \"deletingVotingId\" style=\"display:none;\" value=" . $voting['VotingId'] . ">
                                    <input type=\"submit\" class = \"blockingBtn\" value=\"Заблокировать\">
                                </form>
                            </div><br>";
                }
            ?>
        </div>
    </div>
</div>