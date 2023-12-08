<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
?>

<?php $view->component('start')?>

<div class="container">
    <div class = "navDiv">
        <img src="<?php echo APP_PATH . "/assets/img/logo.jpg"?>" alt="#">
        <div>
            <button class="products" <?php if(!$session->get('auth')) echo "style = \"display: none\";"?>>More</button>
            <button class="auth" <?php if($session->get('auth')) echo "style = \"display: none\";"?>>Log in</button>
            <button class="register"<?php if($session->get('auth')) echo "style = \"display: none\";"?>>Sign in</button>
        </div>
    </div>

</div>


<div id = "modalWindowProducts" class = "modalWindow">
    <div class="product">
        <img src="" alt="#">
        <p class = "descrOfProduct">bla bla bla</p>
        <button class = "addToBasket">Buy</button>
    </div>
    <div class="product">
        <img src="" alt="#">
        <p class = "descrOfProduct">bla bla bla</p>
        <button class = "addToBasket">Buy</button>
    </div>
    <div class="product">
        <img src="" alt="#">
        <p class = "descrOfProduct">bla bla bla</p>
        <button class = "addToBasket">Buy</button>
    </div>
</div>

<div id = "modalWindowRegistry" class = "modalWindow" style="<?php if($session->getFlash('registerModal')) echo "display: block;"; else echo "display: none;"?>">
    <form action="/registration" method="POST">
        <input class = "input" type="login" name="registerLogin" placeholder="input your new login" <?php if($session->has('login')) echo "value=\"" . $session->getFlash('login') . "\""?>>
        <input class = "input" type="text" name="registerEmail" placeholder="input your email"<?php if($session->has('email')) echo "value=\"" . $session->getFlash('email') . "\""?>>
        <input type="password" id="firstPass" name="passwordFirst" placeholder="Password">
        <input type="password" id="secondPass" name="passwordSecond" placeholder="Password again">
        <div>
            <input id="forCheck" type="checkbox">
            <label for="forCheck">Я согласен!</label>
        </div>
        <p class = "errors" style="color: red;">
            <?php if($session->has('userExist')) { echo "Пользователь уже существует!"; $session->remove('userExist');} else if($session->has('validationFailed')){echo "Неправильно введено имя пользователя, почта или пароль!"; $session->remove('validationFailed');}?>
        </p>
        <input type="submit" id="submitForRegister" value="Sign in">
    </form>
</div>

<div id="modalWindowAuth" class = "modalWindow">
    <form action="/auth" method="POST">
        <input class = "input" name="authEmail" type="login" placeholder="Input here your email">
        <input class = "input" name="authPassword" type="password" placeholder="Input here your password">
        <input class = "input" id="submitForAuth" type="submit" value="Log in">
    </form>
</div>

<script type="text/javascript" src = "../../assets/scripts/default.js"></script>

<?php $view->component('end')?>