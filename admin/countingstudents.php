<?php
require_once 'dbcon.php';

$studentCount = 0;
$newsCount = 0;
$countactivenews = 0;
$countinactivenews = 0;

$result = mysqli_query($con, "SELECT COUNT(id) AS student_count FROM students");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $studentCount = $row['student_count'];
}

$result = mysqli_query($con, "SELECT COUNT(DISTINCT title) AS news_count FROM news");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $newsCount = $row['news_count'];
}

$result = mysqli_query($con, "SELECT COUNT(status) AS activeCount FROM news WHERE status = '1'");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $countactivenews = $row['activeCount'];
}

$result = mysqli_query($con, "SELECT COUNT(status) AS inactiveCount FROM news WHERE status = '0'");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $countinactivenews = $row['inactiveCount'];
}