<?php 
    include('connect.php');
    session_start();
    if (isset($_POST['code-confirm'])){
        $encryption_key = "ripemd128";
        $encrypted_data = hash($encryption_key, $_POST['code-confirm']);
        if (strcmp($encrypted_data,$_COOKIE['code']) == 0){
            if (isset($_POST['password'],$_POST['fullname'],$_POST['email'])
            && $_POST['password'] !== "" && $_POST['email'] !== "" && $_POST['fullname'] !== ""){
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $password = $_POST['password'];
                $query = "insert into users(username, password, fullname)
                values ('$email', md5('$password'), '$fullname')";
                if (mysqli_query($conn, $query)){
                    // đăng ký thành công
                    $_SESSION['registerStatus'] = true;
                }
                else $_SESSION['registerStatus'] = false;
            } else $_SESSION['error'] = true;
        if (isset($_COOKIE['code'])) {
            unset($_COOKIE['code']);
            setcookie('code', '', 0, "/");
        } // Xóa cookie sau khi nhập mã
        header('Location: ../');
    } else {
        $_SESSION['wrongCode'] = true;
        header('Location: ../');
    }
    }
?>