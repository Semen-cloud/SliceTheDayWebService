<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
?>

<?php $view->component('start')?>

<div class="container">
    <?php $view->component('navDiv')?>
    <p class = "labelOfPage">Прошедшие голосования</p><br>

    <div class = "pastVotings">
        <?php
            foreach($session->getFlash('pastVotings') as $voting) {
                echo "  <div class = \"activeVotingDiv\">
                            <p class = \"votingLabelInDiv\">" . $voting['TitleOfVoting'] . "</p>
                            <p class = \"descriptionOfVoting\">" . $voting['DescriptionOfVoting'] . "</p>
                            <p class = \"DateInDiv\">Закончилось: " . $voting['ExpirationDateOfVoting'] . "</p>

                            <span class = \"status\">Статус: </span><span class = \"votingEndedStatus\">Окончено</span>
                            <p class = \"labelSmall\">Результаты</p>";
                
                foreach($voting['results'] as $oneResult)
                    echo "<p>" . $oneResult['title'] . ": " . $oneResult['votesCount'] . "</p>";
                echo "</div><br>";
                
            }
        ?>
    </div>
    <p></p>

    
</div>

<?php $view->component('end')?>