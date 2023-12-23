<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php 
        include 'hello.php';
        if (isset($_SESSION["username"])) {
            echo'<h4>xin chao '.$_SESSION["username"].',day la trang chu</h4>';
        }else{
            echo'<h4>ban chua dang nhap</h4>';
        }

   ?>
</body>
</html>
<?php
    

?>