<?php 
   // lắng nghe online và offline
    echo '<script>
    window.addEventListener("online", (e) => addMessage("Bạn đang trực tuyến", "success"));
    window.addEventListener("offline", (e) => addMessage("Không kết nối trực tuyến", "error"));
    </script>';
    // xử lý register
    if (isset($_SESSION["registerStatus"])){
        if ($_SESSION["registerStatus"]) echo '<script>addMessage("Đăng ký thành công", "success")</script>';
        else echo '<script>addMessage("Đăng ký thất bại", "error")</script>';
        unset($_SESSION["registerStatus"]);
        exit();
    }
    if (isset($_SESSION['existEmail']) && $_SESSION['existEmail']){
        echo '<script>addMessage("Email đã tồn tại", "error")</script>';
        unset($_SESSION["existEmail"]);
        exit();
    }
    if(isset($_SESSION['wrongCode']) && $_SESSION['wrongCode']){
        echo '<script>addMessage("Sai mã xác nhận", "error")</script>';
        unset($_SESSION["wrongCode"]);
        exit();
    }
    // Lỗi không mong muốn
    if (isset($_SESSION['error']) && $_SESSION['error']){
        echo '<script>addMessage("Lỗi không mong muốn", "error")</script>';
        unset($_SESSION["error"]);
        exit();
    }
    // Add tasks
    if (isset($_SESSION['isLogin'])){
        if($_SESSION['isLogin']){
            if(isset($_SESSION['isSaved'])){
                if($_SESSION['isSaved']) echo '<script>addMessage("Lưu thành công", "success")</script>';
                else echo '<script>addMessage("Lưu thất bại", "error")</script>';
                unset($_SESSION['isSaved']);
            }
        } else {
            unset($_SESSION["isLogin"]);
            echo '<script>addMessage("Bạn cần đăng nhập", "error")</script>';
            exit();
        }
    }
    // Xử lý login
    if (isset($_COOKIE["account"])){
        if (isset($_SESSION["login-info"]) && strcmp($_SESSION["login-info"],"success") == 0){
            echo '<script>addMessage("Đăng nhập thành công", "success")</script>';
            unset($_SESSION["login-info"]);
        }
        exit();
    } else if(isset($_SESSION["login-info"]) && strcmp($_SESSION["login-info"],"fail") == 0) {
        echo '<script>addMessage("Đăng nhập thất bại", "error")</script>';
        unset($_SESSION["login-info"]);
        exit();
    } else if (isset($_SESSION["logout-info"]) && $_SESSION["logout-info"]){ // Xử lý logout
        echo '<script>addMessage("Đã đăng xuất", "information")</script>';
        unset($_SESSION["logout-info"]);
        exit();
    } else echo '<script>addMessage("Bạn chưa đăng nhập", "information")</script>';
?>