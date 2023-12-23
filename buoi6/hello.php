<?php 
    if (!isset($_SESSION["username"])) {
        echo"can phai dang nhap de su dung chuc nang"."<br>";
        echo '<a href="login.php">dang nhap</a>';
    }else{
        echo '<a href="logout.php">dang xuat</a>';
    }
?>

    <hr>
    <h2>Session</h2>
    <hr>
    <div>
        <a href="index.php">Trang chu</a>
        <a href="about.php">Ca nhan</a>
    </div>
    <hr>