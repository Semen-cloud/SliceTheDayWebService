<?php
/**
 * @var \App\kernel\View\View $view 
 */
?>

<?php $view->component('start')?>

<div id = "modalWindowRegistry">
</div>

<div id="modalWindowAuth">
    <form action="" method="POST">
        <input id="authLogin" type="login" placeholder="Input here your login">
        <input id="authPassword" type="password" placeholder="Input here your password">
        <input id="submitForAuth" type="submit" value="Log in">
    </form>
</div>

<?php $view->component('end')?>