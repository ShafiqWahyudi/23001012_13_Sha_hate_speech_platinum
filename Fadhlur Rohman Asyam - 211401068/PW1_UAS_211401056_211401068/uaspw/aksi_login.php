<?php
    session_start();
    include ('config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "select * from user where username = '$username' and password = '$password'");
    
    $cek = mysqli_num_rows($query);

    if ($cek == TRUE){
        $_SESSION['username'] = $username;
        header ("location:dashboard.php");
    }else {
        echo "<script> alert('Username or Password is Invalid'); location = 'login.php';
        </script>";
    }
?>
<html>

</html>