<?php
require ("classes/classes.php");
require("dataBase/jsonDB.php");

// проверка типа запроса
if (isAjax ()==true) {

    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        $login = htmlspecialchars($_POST['login']); // создание переменных для работы
        $password = htmlspecialchars($_POST['password']);
        $dbCon = new jsnDB("dataBase/users.json"); // подключение к базе данных
        $result = $dbCon->selectTable($login); // поиск в базе данных по полю Логин
        if ($result != false) {
            while ($row = $result) { // перебор массива из БД при совпадении
                $dbLogin = $row['login'];
                $dbHash = $row['password'];
                $salt = $row['salt'];
                break;
            }

            $hash = md5($password . $salt);

            if ($login == $dbLogin && $hash == $dbHash) { // проверка пароля пользователя
                $message = ["message" => "OK"];
                echo json_encode($message);
            } else {
                $message = ["message" => "Invalid password!"];
                echo json_encode($message);
            }
        } else {

            $message = ["message" => "Invalid login"];
            echo json_encode($message);
        }
    } else {
        $message = ["message" => "All fields are required!"];
        echo json_encode($message);
    }
}
