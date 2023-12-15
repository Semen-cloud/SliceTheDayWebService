<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
if(!$session->has('Auth')) $view->page('default');
?>

<?php $view->component('start')?>

<div class="container">
    <?php $view->component('navDiv')?>  
    <p class = "labelOfPage">Личный кабинет</p> 
    <p class = "personalDataLabel">Личные данные пользователя с ID:<?php echo $session->get('userId')?></p>
    <form action="/updateUserData" method="POST">
        <label for="emailForUpdate" class = "inputLabels">EMAIL</label>
        <input type="text" class = "input inputForUpdate" name="emailForUpdate" readonly value=<?php echo $session->get('userEmail')?>>
        <label for="loginForUpdate" class = "inputLabels">новый логин</label>
        <input type="text" class = "input inputForUpdate" name="loginForUpdate" value=<?php echo $session->get('userLogin')?>>
        <label for="passForUpdate" class = "inputLabels">Новый пароль</label>
        <input type="password" class = "input inputForUpdate" name="passForUpdate" value="">
        <input type="submit" class = "btnForUpdate" value="Изменить">
    </form>
    <p class="errors" style="color:red">
        <?php
        if($session->getFlash('validationFailed'))
        {
            echo "Неправильно введен логин!";
        } else {
            if($session->getFlash('passwordValidationFailed')){
                echo "Неправильно введен пароль!";
            }
        }
        ?>
    </p>
</div>

<?php $view->component('end')?>