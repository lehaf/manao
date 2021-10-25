<?php
class erorHedler // Обработчик ошибок
{

    public function erorLogin($log) //выявляет ошибки в поле логин
    {
        $len=strlen(str_replace(' ','',$log));
        if ($len>=6){
            return "OK";
        }else {
            return "Login should have length not less then 6 chars!";
        }
    }

    public function erorPass($pass) //выявляет ошибки в поле пароль
    {
        $reg="/[0-9][a-z]|[a-z][0-9]/ui";
        $passChek=preg_match($reg,str_replace(' ','',$pass));
        $passCount=strlen(str_replace(' ','',$pass));
        if ($passChek==1 && $passCount>=6){
            return "OK";
        }elseif ($passChek!=1 && $passCount>=6){
            return "You should use words and numbers!";
        }elseif ($passChek==1 && $passCount<6){
            return "You should enter not less then 6 chars!";
        }else {
            return "You should enter not less then 6 chars and use words and numbers!";
        }

    }

    public function erorNick($nick) //выявляет ошибки в поле Ник
    {
        $regForNick="/[a-z][a-z]/ui";
        $nickChek=preg_match($regForNick,$nick);
        $nickLength=strlen($nick);
        if ($nickChek!=1 || $nickLength!=2 || ($nickChek!=1 && $nickLength!=2)){
            return "You should enter 2 chars using only letters!";
        }else {
            return "OK";
        }
    }

    public function erorMail($email) //выявляет ошибки в поле эмэйл
    {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)===false){
            return "Mailbox format is wrong!";
        }else {
            return "OK";
        }
    }
}

// функция генерации рандомной строки
function getRandomStr($length = 5) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}
// функция проверки запросов на соответствие AJAX
function isAjax () {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){
        return true;
    }else {
        return false;
    }
}