<?php
    $client = clientGoogle();
    $url = $client->createAuthUrl();
    $service = new Google_Service_Oauth2($client);
    // Tạo ra 1 biến mới để lấy thông tin người dùng
    // Kiểm tra xem có $_GET[‘code’] không. nếu không thì trở về login còn không thì tiếp tục xử lý
    if(isset($_GET['code'])){
        // Kiểm tra mã code có hợp lệ hay không
        $check = $client->authenticate($_GET['code']);
        // Mã code sẽ phát sinh trong lần request đầu tiên lần phát sinh sau sẽ lỗi.
        // Và mã code sẽ sinh ra 1 đoạn array có các key là: error(mã lỗi), error_description(Thông báo lỗi)
        if(isset($check['error'] )){
            $_SESSION['error'] = true;
        } else {
            // Thông tin người dùng
            $user = $service->userinfo->get();
            // Lấy thông tin người dùng
            $info = checkInfo($user->email); // lấy token bằng hàm getAccessToken
            if(!$info){
                // Nếu không có tài khoản thì thêm 1 tài khoản mới
                $email = $user->email; // var_dump($user) ra xem
                $fullname = $user->name;
                $id = insertUser($email, $fullname); // thêm người dùng vào nè
                // SET SESSION[‘id’] và trở về trang chủ
                $_SESSION['id'] = $id;
            } else {
                // Nếu đã có tài khoản thì set SESSION[‘id’] và trở về lại trang chủ
                $_SESSION['id'] = $info['id'];
            }
            $encryption_value = openssl_encrypt($_SESSION['id'],"AES-128-CTR","account");
            setcookie("account",$encryption_value,time()+86400, "/");
            $_SESSION["login-info"] = 'success';
            $client->revokeToken();
        }
    }
?>