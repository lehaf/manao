<?php
require ("classes/classes.php");
require("dataBase/jsonDB.php");

// Если это аjax запрос то следуем скрипту
if (isAjax ()==true) {
    // если все эти переменные не пусты, то следуем скрипту
    if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $repassword = htmlspecialchars($_POST['repassword']);
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);

        $dbConnect = new jsnDB("dataBase/users.json"); // подключение к БД
        $er = new erorHedler(); //создание обработчика ошибок

        //проверка всех полей на соответствие условиям
        if ($er->erorLogin($login) != "OK") {
            $erLog = $er->erorLogin($login);
            echo json_encode(["login" => $erLog]);
        } elseif ($er->erorMail($email) != "OK") {
            $erMail = $er->erorMail($email);
            echo json_encode(["email" => $erMail]);
        } elseif ($er->erorNick($username) != "OK") {
            $erNick = $er->erorNick($username);
            echo json_encode(["nick" => $erNick]);
        } elseif ($er->erorPass($password) != "OK") {
            $erPass = $er->erorPass($password);
            echo json_encode(["pass" => $erPass]);
        } else {

            if ($password == $repassword) {
                $resLogin = $dbConnect->selectField("login", $login); // поиск совпадений по логину в БД
                $resEmail = $dbConnect->selectField("email", $email); // поиск совпадений по email в БД
                if ($resLogin == false && $resEmail == false) {

                    $salt = getRandomStr(); // создание соли для пароля
                    $hash = md5($password . $salt);  // создание хэша

                    // создание массива данных для внесения их в БД
                    $newUser = ["login" => "$login", "password" => "$hash", "email" => "$email", "username" => "$username", "salt" => "$salt"];
                    $result = $dbConnect->createTable($login, $newUser);  // внесение данных в базу
                    if ($result == 1) {
                        $message = ["message" => "Account Successfully Created"];
                        echo json_encode($message);
                    } else {
                        $message = ["message" => "Failed to insert data information!"];
                        echo json_encode($message);
                    }
                } elseif ($resLogin == false && $resEmail != false) {
                    $emailOccupEror = ["email" => "That email already exists! Please try another one!"];
                    echo json_encode($emailOccupEror);
                } elseif ($resLogin != false && $resEmail == false) {
                    $secondLoginEror = ["login" => "That login already exists! Please try another one!"];
                    echo json_encode($secondLoginEror);
                } else {
                    $emailAndLoginEror = ["email" => "That email already exists! Please try another one!",
                        "login" => "That login already exists! Please try another one!"];
                    echo json_encode($emailAndLoginEror);

                }
            } else {
                $passMessage = ["repass" => "Passwords mismatch!"];
                echo json_encode($passMessage);
            }
        }
    } else {
        $message = ["allfields" => "All fields are required!"];
        echo json_encode($message);
        die();
    }
}


