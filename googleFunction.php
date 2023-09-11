<?php 
    function clientGoogle(){
        // Lấy những giá trị này từ https://console.google.com
        $client_id = "112542703613-8tih97l3fb76uvgfouu820ghug25da30.apps.googleusercontent.com"; // Client ID
        $client_secret = "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"; // Client secret
        $redirect_uri = "http://localhost/todolist/"; // URL tại Authorised redirect URIs
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        return $client;
    }
    function checkInfo($username){
        // nếu rỗng thì kiểm tra theo username
        global $conn;
        $sql="SELECT id FROM users WHERE username = '$username'";
        $table = mysqli_query($conn, $sql);
        if (mysqli_num_rows($table) == 0){
            return false;
        } else {
            return mysqli_fetch_assoc($table);
        }
    }
    function insertUser($username, $name){
        global $conn;
        $sql="INSERT INTO users(username, password, fullname) VALUES ('$username', md5('$username'), '$name')";
        $table = mysqli_query($conn, $sql);
        $sql="SELECT id FROM users WHERE username = '$username'";
        $table = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($table)) return $row['id']; else return false;
    }
?>