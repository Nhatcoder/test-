<?php
    $localhost="localhost";
    $dbName ="db_plane1";
    $dsn = "mysql:host=$localhost;dbname=$dbName";
    $username ="root";
    $password ="";

    try{
        $db= new PDO ($dsn,$username,$password);
        
        // if($db){
        //     echo "Kết nối thành công";
        // }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
