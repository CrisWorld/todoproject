<?php 
    session_start();
    if (isset($_COOKIE['account'])) {
        unset($_COOKIE['account']);
        setcookie('account', '', 0); 
        $_SESSION['logout-info'] = true;
        if (isset($_SESSION['id'])){
            unset($_SESSION['id']);
        }
    } else $_SESSION['error'] = true;
    header('location: index.php');
?>