
<?php
    include('connect.php');


    session_start();
    $id = $_SESSION['id'];
    $title = $_GET['title'];
    $est = $_GET['est'];
    $note = $_GET['note'];


    $sql = "INSERT INTO tasks(userID, title, description, finishTime, currentTime)
            VALUES ($id,'$title','$note',$est,0)";
    if (mysqli_query($conn, $sql)){
        echo '<script>
        alert("Thành công!");
        location.href = "http://localhost/todolist/index.php";
        </script>';
    } else {
        echo '<script>
    alert("That bai!");
    location.href = "http://localhost/todolist/index.php";
    </script>';
    }
?>