<?php 
    include('./connect.php');
    session_start();
    if (isset($_POST['email']) && isset($_POST['password'])){
       $query = "select id from users where username = '".$_POST['email']."' and password = md5('".$_POST['password']."')";
       $table = mysqli_query($conn,$query);
       $num = mysqli_num_rows($table);
       if ($num == 0) {
            $_SESSION["login-info"] = "fail";
       } else {
        $row = mysqli_fetch_array($table);
        $_SESSION["id"] = $row['id'];
        $_SESSION["login-info"] = "success";
        $encryption_value = openssl_encrypt($row['id'],"AES-128-CTR","account");
        setcookie("account",$encryption_value,time()+86400);
       }
    } else {
        $_SESSION["error"] = true;
    }
    echo '<script>
            location.href = "http://localhost/todolist/index.php";
            </script>';
?>