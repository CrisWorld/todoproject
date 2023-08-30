
<?php
    include('connect.php');
    session_start();
    if (isset($_COOKIE['account'],$_SESSION['id']) && $_SESSION['isLogin']){
        if(isset($_GET['title'],$_GET['est'],$_GET['note'])){
            $id = $_SESSION['id'];
            $title = $_GET['title'];
            $est = $_GET['est'];
            $note = $_GET['note'];
            $sql = "INSERT INTO tasks(userID, title, description, finishTime, currentTime)
                    VALUES ($id,'$title','$note',$est,0)";
            if (mysqli_query($conn, $sql)){
                $_SESSION['isSaved'] = true;
            } else {
                $_SESSION['isSaved'] = false;
            }
        } else $_SESSION['error'] = true;
    } else $_SESSION['isLogin'] = false;
    header('Location: ../');
?>