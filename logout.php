<?php 
    session_start();
    if (isset($_COOKIE['account'])) {
        unset($_COOKIE['account']);
        setcookie('account', '', 0); 
    }
    if (isset($_SESSION['id'])){
        unset($_SESSION['id']);
    }
    header('location: index.php');
?>