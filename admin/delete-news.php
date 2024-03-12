<?php
session_start();
include 'dbcon.php';
if(isset($_POST['delete-news'])) {
    $title = mysqli_real_escape_string($con, $_POST['delete-news']);
    $query = "DELETE FROM news WHERE title = '$title'";
    $query_run = mysqli_query($con, $query);
    if($query_run) {
        $_SESSION['message'] = "Record deleted successfully";
        header("Location: news.php");
        exit();
    } else {
        $_SESSION['message'] = "Error deleting record";
        header("Location: news.php");
    }
}
?>