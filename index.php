<?php
session_start();
?>
<?php require("dataBase/jsonDB.php"); ?>
<?php include("includes/header.php"); ?>
<?php
// Если существует переменная $_SESSION то происходит перенаправление
if(isset($_SESSION["session_username"])){
    header("Location: intropage.php");
    die();
}

 if(!empty($_POST['login'])) {

     $login = htmlspecialchars($_POST['login']);
     $dbCon = new jsnDB("dataBase/users.json"); // подключение к базе данных
     $query = $dbCon->selectTable($login); //Найти и выбрать пользователя в БД
     while ($row = $query) {  // перебрать массив, найти нужное значение и присвоить его переменной
         $dbUsername = $row['username'];
         break;
     }
     $_SESSION['session_username'] = $dbUsername;
     header("Location: intropage.php");

     $message="OK";

     echo json_encode($message);

 }
?>

<div class="container mlogin">
    <div id="login">
        <h1>Вход</h1>
        <form action="" id="loginform" method="post" name="loginform">
            <p><label for="user_login">Логин<span class="fieldEror" id="logAJAX"></span><br>
                    <input class="input" id="username" name="login" size="20"
                           type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<span class="fieldEror" id="pasAJAX"></span><br>
                    <input class="input" id="password" name="password" size="20"
                           type="password" value=""></label></p>
            <p class="submit"><input class="button" id="enter" name="btn" type= "submit" value="Войти"></p>
            <p class="regtext">Еще не зарегистрированы?<br> <a href= "register.php">Регистрация</a></p>
        </form>
    </div>
</div>
<?php include("includes/footer.php"); ?>