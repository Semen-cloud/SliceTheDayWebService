<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
?>
<?php $view->component('start')?>

<div class="container">
    <?php $view->component('navDiv'); ?>
    <p class="labelOfPage">Создание нового голосования</p>

    <div class = "votingInformation">
        <form action="/creator/createNew" method="POST">
            <div>
                <label for="newVotingTitle" class = "inputLabels">Название голосования</label>
                <input type="text" class = "newVotingInputs" name = "newVotingTitle" style="display:block;">
                <label for="newVotnewVotingDescriptioningTitle" class = "inputLabels">Описание голосования</label>
                <input type="text" class = "newVotingInputs" name = "newVotingDescription" style="display:block;">
                <label for="newVotingExpirationDate" class = "inputLabels">Дата окончания голосования</label>
                <input type="date" class = "newVotingDate" name = "newVotingExpirationDate" style="display:block;"><br>
            </div>
            <div class = "newVariants" style="display:flex; flex-wrap:wrap;">
                <div class = "newVariant">
                    <label for="newTitle1" class = "inputLabels">Название варианта</label>
                    <input type="text" class = "newVariantTitle" name = "newTitle1" style ="display:block">
                    <label for="newDescription1" class = "inputLabels">Описание</label>
                    <input type="text" class = "newVariantDescription" name = "newDescription1" style = "display:block"> <br>  
                </div>
            </div>
            <input type="submit" value = "Создать">
        </form>
        <p class = "variantCounter">1/10</p>
        <button class = "addVariant">Добавить вариант</button><br>
        <div class = "errors" style="color:red;">
            <?php   if($res = $session->getFlash('variantsValidationFailed'))
                        echo "Неправильно введен вариант № " . $res;
                    else
                        if($session->getFlash('votingValidationFailed'))
                            echo "Неправильно введены данные голосования!"; ?>
        </div>
    </div>

</div>

<script src = "../../assets/scripts/createNew.js"></script>

<?php $view->component('end')?>