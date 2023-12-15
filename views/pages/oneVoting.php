<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
?>

<?php $view->component('start')?>

<div class="container">
    <?php $view->component('navDiv')?>

    <p class = "labelOfPage">Участие в голосовании</p>
    
    <?php $votingInfo = $session->getFlash('votingInfo'); 
    echo "<p class = \"titleOfVoting\">" . $votingInfo['votingInformation']['TitleOfVoting'] . "</p>";

    $allVoutesCount = 0;
    $maxVoutes = isset($votingInfo['votingResults'][0]['votesCount']) ? $votingInfo['votingResults'][0]['votesCount'] : 0;
    $winner = isset($votingInfo['votingResults'][0]['id']) ? $votingInfo['votingResults'][0]['id'] : 0;
    if($votingInfo['isUserVotingFor']) {
        echo "<p class = \"userAlreadyVoted\">Вы уже проголосовали</p>";
    } else 
    if(count($votingInfo['votingResults']) > 0) {
        foreach ($votingInfo['votingResults'] as $voteVariant) {
            echo "  <div class=\"oneVariant\">
                        <form action=\"/vote\" method=\"POST\">
                            <p class = \"titleOfVariant\">" . $voteVariant['Title'] . "</p>
                            <p class = \"descriptionOfVariant\">" . $voteVariant['Description'] . "</p>
                            <input type=\"text\" style=\"display:none;\" name=\"idVoteFor\" value = " . $voteVariant['id'] . ">
                            <input class = \"voteForBtn\" type=\"submit\" value = \"Проголосовать\">
                        </form>
                    </div>";
            $allVoutesCount += $voteVariant['votesCount'];
            if($maxVoutes < $voteVariant['votesCount']) {
                $maxVoutes = $voteVariant['votesCount'];
                $winner = $voteVariant['id'];
            }
        }
    } else {
        echo "<p class = \"noObjectsInside\">Нет вариантов для голосования!</p>";
    }
    ?>

    <p class = "labelOfPage">Результаты голосования</p>
    <?php
        if(count($votingInfo['votingResults']) > 0) {
            foreach ($votingInfo['votingResults'] as $voteVariant) {
                $procL = $allVoutesCount === 0 
                            ? 100
                            : ((2 * $voteVariant['votesCount']/$allVoutesCount - 1) >= 0 
                                ? 2 * $voteVariant['votesCount']/$allVoutesCount - 1 
                                : 0);
                $procC = ($procL == 100) 
                            ? 0
                            :$voteVariant['votesCount']/$allVoutesCount * 100 - $procL;
                $procR = (100 - $procL - $procC) >= 0 ? 100 - $procL - $procC : 0;
                $isWinnerStr = ($winner === $voteVariant['id']) ? "<span style=\"background-color:green;color:white;\"> Выйгрывает</span>" : "";

                echo "  <div class = \"resultVariantBlock\">
                            <p class = \"labelOfResult\">" . $voteVariant['Title'] . " " .  $isWinnerStr . ". Кол-во голосов: " . $voteVariant['votesCount'] ."</p>
                            <div style=\"display:flex;\">
                                <div style=\"margin:none;background-color:red;height:50px;width:" . $procL . "%;display:inline-block\"></div> 
                                <div style=\"margin:none;background:linear-gradient(to right, red, white);height:50px;width:" . $procC . "%;display:inline-block\"></div>
                                <div style=\"margin:none;background-color:white;height:50px;width:" . $procR . "%;display:inline-block\"></div>
                            </div>
                        </div>";
            }
        } else {
            echo "<p class = \"noObjectsInside\">Нет результатов голосования!</p>";
        }
    ?>    
</div>

<?php $view->component('end')?>