<?php session_start(); ?>
<form action="" method="post">
    <label for="">Username:</label>
    <input type="text" name="username">
    <label for="">Password:</label>
    <input type="password" name="password">
    <input type="submit" value="mut">
</form>

<?php 
    if(isset($_POST['username']) && isset($_POST['password'])){
    $a= $_POST['username'];
    $b= $_POST['password'];
    if($a == "admin" && $b == "123466"){
            $_SESSION['username'] = $a;
            header('location: index.php');
    }else{
            echo "<h1>Login Failed</h1>";
    }
    }  
?>