<?php 
    require('./connect.php');
    if (isset($_POST['email']) && isset($_POST['password'])){
       $query = "select id from users where username = '".$_POST['email']."' and password = '".$_POST['password']."'";
       $table = mysqli_query($conn,$query);
       $num = mysqli_num_rows($table);
       if ($num == 0) {
            echo '<script>
                alert("Sai tài khoản hoặc mật khẩu");
                location.href = "http://localhost/todolist/index.php";
            </script>';
       } else {
        echo '<script>
        alert("Đăng nhập thành công");
        </script>';
        $row = mysqli_fetch_array($table);
        session_start();
        $_SESSION["id"] = $row['id'];
        $encryption_value = openssl_encrypt($row['id'],"AES-128-CTR","account");
        setcookie("account",$encryption_value,time()+20);
        echo '<script>
                location.href = "http://localhost/todolist/index.php";
            </script>';
       }
    } else {
        echo '<script>
            alert("Lỗi đăng nhập ! Vui lòng nhập lại");
            location.href = "http://localhost/todolist/index.php";
            </script>';
    }
?>