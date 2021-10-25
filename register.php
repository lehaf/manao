<?php include("includes/header.php"); ?>



<div class="container mregister">
    <div id="login">
        <h1>Регистрация</h1>
        <form action="" id="registerform" method="post"name="registerform">
            <h4 id="mess"></h4>
            <p><label for="user_login">Логин<span id="log" class='fieldEror'></span><br>
                    <input class="input" id="full_name" name="login"size="32"  type="text" value=""></label></p>
            <p><label for="user_email">E-mail<span id="mail" class='fieldEror'></span><br>
                    <input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
            <p><label for="user_pass">Ник<span id="nick" class='fieldEror'></span><br>
                    <input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<span id="pass" class='fieldEror'></span><br>
                    <input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
            <p><label for="user_repass">Повторите пароль<span id="repass" class='fieldEror'></span><br>
                    <input class="input" id="repassword" name="repassword"size="32"   type="password" value=""></label></p>
            <p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
            <p class="regtext">Уже зарегистрированы? <a href= "index.php">Вход</a></p>
        </form>
    </div>
</div>

<?php include("includes/footer.php"); ?>