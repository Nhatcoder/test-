<?php
    if(!isset($_COOKIE["login"])){
?>
    <form action="login.php" method="post">
        Tên đăng nhập: <input type="text" name ="username"><br>
        Mật khẩu: <input type="password" name ="password"><br>
        <input type="submit" name ="submit">
    </form>

<?php
        if(isset($_POST["submit"])){
            $userName= $_POST["username"];
            $passWord= $_POST["password"];
            // echo " $userName,$passWord";
            if($userName == "admin" && $passWord =='123456'){
                setcookie("login",$userName,(time()+60*60));
                header("location: index.php");
            }else{
                echo "Sai thông tin mật khẩu hoặc tài khoản";
            }
        }
    }else{
        setcookie("login","", time()- 60*60);
    }

?>