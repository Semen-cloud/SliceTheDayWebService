<?php
/**
 * @var \App\kernel\View\View $view 
 * @var \App\kernel\Session\Session $session
 */
?>
<?php $view->component('start')?>

<div id = "modalWindowProducts" class = "modalWindow" >
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

<div id="modalWindowAuth" class = "modalWindow" style="<?php if($session->getFlash('modalAuth')) echo "display: block;"; else echo "display: none;"?>">
    <div class = "extraDivForModal">
        <p class = "labelForModal" style="display: inline;">Вход в систему</p>
        <img src = "../../assets/img/closeModal.png" alt="#" id ="closeModalAuth">
        <form action="/auth" method="POST" id="formForAuth">
            <label for="authEmail" class = "inputLabels" id="closeModalAuth">Email</label>
            <input class = "input" name="authEmail" type="login" placeholder="Input here your email">
            <label for="authPassword" class = "inputLabels">Password</label>
            <input class = "input" name="authPassword" type="password" placeholder="Input here your password">
            <input class = "input" id="submitForAuth" type="submit" value="Log in">
        </form>
        <p class = "errors" style="color: red;">
            <?php 
                if($session->has('authDataCheckFailed')) {
                    echo "Неправильно введена почта или пароль!";
                    $session->remove("authDataCheckFailed");
                }
            ?>
        </p>
    </div>
</div>

<div id = "modalWindowRegistry" class = "modalWindow" style="<?php if($session->getFlash('registerModal')) echo "display: block;"; else echo "display: none;"?>">
        <form action="/registration" method="POST">
            <input class = "input" type="login" class = "registerLogin" name="registerLogin" placeholder="input your new login" <?php if($session->has('login')) echo "value=\"" . $session->getFlash('login') . "\""?>>
            <input class = "input" type="text" class = "registerEmail" name="registerEmail" placeholder="input your email"<?php if($session->has('email')) echo "value=\"" . $session->getFlash('email') . "\""?>>
            <input type="password" id="firstPass" name="passwordFirst" placeholder="Password">
            <input type="password" id="secondPass" name="passwordSecond" placeholder="Password again">
            <div>
                <input id="forCheck" type="checkbox">
                <label for="forCheck">Я согласен!</label>
            </div>
            <p class = "errors" style="color: red;">
                <?php
                if($session->get('userExist')) { 
                    echo "Пользователь уже существует! <br>"; 
                    $session->remove('userExist');
                } 
                if($session->get('validationFailed')) {
                    echo "Неправильно введено имя пользователя, почта или пароль! <br>"; 
                    $session->remove('validationFailed');
                } 
                if($session->get('notSamePass')) {
                    echo "Неодинаковые пароли! <br>";
                    $session->remove('notSamePass');
                }?>
            </p>
            <input type="submit" id="submitForRegister" value="Sign in">
        </form>
</div>

<div class="container">
    <div class = "navDiv">
        <a href="/default"><img src="<?php echo APP_PATH . "/assets/img/logo.jpg"?>" alt="#"></a>
        <div>
            <form action="/personalArea" method="GET" style="display: inline;"><input type="submit"<?php if(!$session->get('Auth')) echo "style = \"display: none;\"";?> value = "Личный кабинет"></form>
            <form action="/exit" method = "POST" style="display: inline;"><input class="exit" type="submit" <?php if(!$session->get('Auth')) echo "style = \"display: none;\"";?>value = "Exit"></form>
            <button class="showProducts" <?php if(!$session->get('Auth')) echo "style = \"display: none;\""?>>More</button>
            <button class="auth" <?php if($session->get('Auth')) echo "style = \"display: none\";"?>>Log in</button>
            <button class="register"<?php if($session->get('Auth')) echo "style = \"display: none\";"?>>Sign in</button>
        </div>
    </div>
</div>

<script type="text/javascript" src = "../../assets/scripts/default.js"></script>

<?php $view->component('end')?>