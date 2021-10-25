<?php

class jsnDB // База данных JSON
{
    public $path; // Путь к файлу данных JSON

    public function __construct($path)
    {
        $this->path=$path;
    }


    public function showJsonDB() //Показать базу данных
    {
        $data=file_get_contents("$this->path");
        $data2=json_decode($data);
        $get=json_encode($data2);
        echo $get;
    }

    public function alterTable($nameTbl,$changingValue,$newValue) //изменить значение в таблице
    {
        $data=file_get_contents("$this->path");
        $jsnDecode=json_decode($data,true);
        $jsnDecode["$nameTbl"]["$changingValue"]=$newValue;
        $jsnEncode=json_encode($jsnDecode);
        file_put_contents("$this->path",$jsnEncode);
    }

    public function createTable($newTable,$arrayValues) //создать таблицу
    {
        $data=file_get_contents("$this->path");
        $jsnDecode=json_decode($data,true);
        $jsnDecode["$newTable"]=$arrayValues;
        $jsnEncode=json_encode($jsnDecode);
        file_put_contents("$this->path",$jsnEncode);
        return 1;
    }

    public function selectTable($login) // выбрать таблицу
    {
        $data=file_get_contents("$this->path");
        $jsnDecode=json_decode($data,true);

        foreach ($jsnDecode as $key=>$value){
            foreach ($value as $key=>$val){
                if ($key=="login" && $val==$login){
                    return $jsnDecode[$login];
                }
            }
        }
        return false;
    }

    public function selectField($field,$fieldValue) // выбрать поле в таблице
    {
        $data=file_get_contents("$this->path");
        $jsnDecode=json_decode($data,true);

        if($jsnDecode==null){
            return false;
        }
        foreach ($jsnDecode as $key=>$value){
           foreach ($value as $key=>$val){
               if ($key==$field && $val==$fieldValue){
                   return "$key=$val";
               }
           }
        }
        return false;
    }

    public function deleteField($table,$field) // удалить поле в таблице
    {
        $data = file_get_contents("$this->path");
        $jsnDecode = json_decode($data, true);
        unset($jsnDecode["$table"]["$field"]);
        $jsnEncode=json_encode($jsnDecode);
        file_put_contents("$this->path",$jsnEncode);
    }

    public function deleteTable($table)  // удалить таблицу
    {
        $data = file_get_contents("$this->path");
        $jsnDecode = json_decode($data, true);
        unset($jsnDecode["$table"]);
        $jsnEncode=json_encode($jsnDecode);
        file_put_contents("$this->path",$jsnEncode);
    }


}

