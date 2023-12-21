<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
?>

<?php $view->component('start')?>

<div class="container">
    <?php $view->component('navDiv'); ?>

    <form action="/creator/newVoting" method="GET" <?php if(!$session->get('userIsCreator')) echo "style=\"display:none;\""?>>
        <input type="submit" class = "createNewVoting" value="Создать новое голосование">
    </form>
    <form action="/pastVotings" method="GET">
        <input type="submit" class = "goToPastVotings" value="Прошедшие голосования">
    </form>
    
    <p class = "labelOfPage">Доступные голосования</p>
    <?php
        $listOfVoting = $session->getFlash('votings');
        if (count($listOfVoting) < 1) {
            echo "<p class = \"noObjectsInside\">Нет активных голосований</p>";
        } else {
            foreach ($listOfVoting as $voting) {
                echo "  <div class = \"activeVotingDiv\">
                            <p class = \"votingLabelInDiv\">" . $voting['TitleOfVoting'] . "</p>
                            <p class = \"descriptionOfVoting\">" . $voting['DescriptionOfVoting'] . "</p>
                            <p class = \"DateInDiv\">Доступно до: " . $voting['ExpirationDateOfVoting'] . "</p>
                            <form action=\"oneVoting\" method = \"GET\" style=\"display:inline;\">
                                <input style = \"display:none\" type=\"text\" value = " . $voting['VotingId'] . " name = \"idOfVoting\">
                                <input type=\"submit\" class = \"btnForRedirectToVoting\" value = \"Учавствовать\">
                            </form>

                            <span class = \"status\">Статус: </span><span class = \"votingActiveStatus\">Активно</span>
                        </div>";
            }
        }
    ?>
</div>

<?php $view->component('end')?>