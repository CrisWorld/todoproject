<?php 
    include '../sendMail.php';
    session_start();
    // error_reporting(0);
    if (isset($_POST['email'],$_POST['fullname'],$_POST['password'])){
        $code = strval(rand(100000, 999999));
        $encryption_key = "ripemd128"; // Đảm bảo độ dài của khóa là 16 byte (128 bit)
        $encrypted_data = hash($encryption_key, $code);
        echo $encrypted_data."<br>";
        $encrypted_data = hash($encryption_key, $code);
        echo $encrypted_data."<br>";
        if (isset($_COOKIE["code"])) {
            unset($_COOKIE["code"]);
            setcookie("code", '', 0, "/"); 
        }
        setcookie("code", $encrypted_data, time() + 120, "/");
        $content = "<h1>Tomató xin chào!</h1>
            <p>Dưới đây là mã xác thực tài khoản của bạn:</p>
            <h2 style='background-color: #f2f2f2; padding: 10px; display: inline-block;'>Mã Xác Thực: $code</h2>
            <p>Vui lòng sử dụng mã này để xác thực tài khoản của bạn.</p>
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";
        GuiMail($content,$_POST['email'],$_POST['fullname']);
    } else {
        $_SESSION['error'] = true;
        header('Location: ../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a id="logo">
        <img src="../image/tomato.png" alt="" style="width: 30px; aspect-ratio: 1 / 1; color: white;">
        Tomató
    </a>
    <form action="../register.php" method="POST">
        <img src="../image/code.png" alt="" style="height: 100%;">
        <div class="input">
            <h1 style="text-transform: uppercase; color: #1f2659; margin-bottom: 50px;">authentication</h1>
            <div class="container">
                <input type="text" placeholder="CODE" id="code-confirm" name="code-confirm">
            </div>
            <input type="hidden" id="fullname" name="fullname" value="<?php echo  $_POST['fullname'] ?>">
            <input type="hidden" id="email" name="email" value="<?php echo  $_POST['email'] ?>">
            <input type="hidden" id="password" name="password" value="<?php echo  $_POST['password'] ?>">
            <input type="submit" value="SEND" class="submit">
        </div>
    </form>
</body>
</html>