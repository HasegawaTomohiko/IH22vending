<?php

    function db_connect(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=vending;charset=utf8','root','');

            return $pdo;
        }catch(PDOException $e){
            exit('接続失敗'.$e -> getMessage());
        }
    }


?>