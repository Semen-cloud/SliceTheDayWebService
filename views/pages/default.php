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
        <div style="display:flex;justify-content:space-between;">
            <p class = "labelForModal">Вход в систему</p>
            <img src = "../../assets/img/closeModal.png" alt="#" id ="closeModalAuth" class = "closeModal">
        </div>
        <form action="/auth" method="POST" id="formForAuth">
            <label for="authEmail" class = "inputLabels">Email</label>
            <input class = "input" name="authEmail" type="login" placeholder="your email">
            <label for="authPassword" class = "inputLabels">Password</label>
            <input class = "input" name="authPassword" type="password" placeholder="your password">
            <input class = "input" id="submitForAuth" type="submit" value="Log in">
        </form>
        <p class = "errors" style="color: red;">
            <?php 
                if($session->getFlash('authDataCheckFailed')) {
                    echo "Неправильно введена почта или пароль!";
                }
            ?>
        </p>
    </div>
</div>

<div id = "modalWindowRegistry" class = "modalWindow" style="<?php if($session->getFlash('registerModal')) echo "display: block;"; else echo "display: none;"?>">
    <div class = "extraDivForModal">
        <div style="display:flex;justify-content:space-between;">
            <p class = "labelForModal">Регистрация</p>
            <img src = "../../assets/img/closeModal.png" alt="#" id ="closeModalRegistry" class = "closeModal">
        </div>
        <form action="/registration" method="POST">
            <label for="registerLogin" class = "inputLabels">Логин</label>
            <input class = "input" type="login" class = "registerLogin" name="registerLogin" placeholder="input your new login" <?php if($session->has('login')) echo "value=\"" . $session->getFlash('login') . "\""?>>
            <label for="registerEmail" class = "inputLabels">Email</label>
            <input class = "input" type="text" class = "registerEmail" name="registerEmail" placeholder="input your email"<?php if($session->has('email')) echo "value=\"" . $session->getFlash('email') . "\""?>>
            <label for="passwordFirst" class = "inputLabels">Пароль</label> <br>
            <input type="password" class = "passwordRegistryInput" id="firstPass" name="passwordFirst" placeholder="Password">
            <input type="password" class = "passwordRegistryInput" id="secondPass" name="passwordSecond" placeholder="Password again">
            <div>
                <input id="forCheck" type="checkbox">
                <label for="forCheck" class = "inputLabels">Я согласен!</label>
            </div>
            <p class = "errors" style="color: red;">
                <?php
                if($session->getFlash('userExist')) { 
                    echo "Пользователь уже существует! <br>"; 
                } 
                if($session->getFlash('validationFailed')) {
                    echo "Неправильно введено имя пользователя, почта или пароль! <br>"; 
                } 
                if($session->getFlash('notSamePass')) {
                    echo "Неодинаковые пароли! <br>";
                }?>
            </p>
            <input type="submit" id="submitForRegister" value="Зарегистрироваться">
        </form>
    </div>
</div>

<div class="container">
    <?php $view->component('navDiv'); ?>

    <div id="sliderDiv">
        <div class = "sliderPhotos">
            <?php 
            $i = 1; 
            while(file_exists(APP_PATH . "/assets/img/slider$i.jpg"))
            {
                echo "<img src=\"../../assets/img/slider$i.jpg\" alt=\"#\" class = \"sliderImgs\" style=\"display: none;\">\n";
                $i++;
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src = "../../assets/scripts/default.js"></script>

<?php $view->component('end')?>