<?php
session_start();
require 'dbcon.php';

if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query_get_image = "SELECT image FROM students WHERE id='$student_id'";
    $result = mysqli_query($con, $query_get_image);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_filename = $row['image'];

        $query_delete_student = "DELETE FROM students WHERE id='$student_id' ";
        $query_run = mysqli_query($con, $query_delete_student);

        if ($query_run) {
            $image_path = "img/" . $image_filename;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $_SESSION['message'] = "Student deleted.";
            header("Location: students.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Student Not Deleted";
            header("Location: students.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Student Not Found";
        header("Location: students.php");
        exit(0);
    }
}
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

        $currentDirectory = getcwd();
        $uploadDirectory = "/img/";

        $errors = [];

        $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];

        $originalFileName = basename($_FILES['file']['name']);
        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9\.\-_]/", "_", $originalFileName);
        $fileSize = $_FILES['file']['size'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileExtension = strtolower(end(explode('.', $fileName)));

        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);


        if (!in_array($fileExtension, $fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        }

        $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course', image='$fileName', date_of_birth='$date_of_birth' WHERE id='$student_id' ";

    } else {
        $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course', date_of_birth='$date_of_birth' WHERE id='$student_id' ";
    }

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student updated.";
        header("Location:students.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: students.php");
        exit(0);
    }

}


if (isset($_POST['save_student'])) {

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $imageUploaded = false;
    $errors = [];
    $fileName = '';

    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        if ($_FILES['image']['error'] == 1 || $_FILES['image']['error'] == 2) {
            $errors[] = "File exceeds maximum size allowed by server.";
        } elseif ($_FILES['image']['error'] == 0) {
            $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
            $originalFileName = basename($_FILES['image']['name']);
            $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9\.\-_]/", "_", $originalFileName);
            $fileSize = $_FILES['image']['size'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileParts = explode('.', $fileName);
            $fileExtension = strtolower(end($fileParts));

            if (!in_array($fileExtension, $fileExtensionsAllowed)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file.";
            }
            if ($fileSize > 4000000) {
                $errors[] = "File exceeds maximum size (4MB).";
            }
            if (empty($errors)) {
                $imageUploaded = true;
            }
        } else {
            $errors[] = "An error occurred during file upload.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['message'] = implode("<br>", $errors);
        $_SESSION['message_type'] = 'error';
        $_SESSION['form_data'] = $_POST;
        header("Location: student-create.php");
        exit(0);
    }

    if ($imageUploaded) {
        $didUpload = move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $fileName);
        if (!$didUpload) {
            $_SESSION['message'] = "An error occurred while uploading the image.";
            $_SESSION['message_type'] = 'error';
            $_SESSION['form_data'] = $_POST;
            header("Location: student-create.php");
            exit(0);
        }
    }

    $query = "INSERT INTO students (name,date_of_birth,image,email,phone,course) VALUES ('$name','$date_of_birth','$fileName','$email','$phone','$course')";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Student created.";
        header("Location: students.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Created";
        $_SESSION['message_type'] = 'error';
        $_SESSION['form_data'] = $_POST;
        header("Location: student-create.php");
        exit(0);
    }
}

?>