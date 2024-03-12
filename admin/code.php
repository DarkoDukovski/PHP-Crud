<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}
if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

      
        //print "Ima slika";
        //exit(0);

        $currentDirectory = getcwd();
        $uploadDirectory = "/img/";
    
        $errors = []; // Store errors here
    
        $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
    
        $fileName = $_FILES['file']['name'];
        //print($fileName);
        //exit(0);
        $fileSize = $_FILES['file']['size'];
        $fileTmpName  = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 


        if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
          }
    
          if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
          }
    
          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    
            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
            } else {
              echo "An error occurred. Please contact the administrator.";
            }
          } else {
            foreach ($errors as $error) {
              echo $error . "These are the errors" . "\n";
            }
          }

          $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course', image='$fileName', date_of_birth='$date_of_birth' WHERE id='$student_id' ";

    }
    else {
        $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course', date_of_birth='$date_of_birth' WHERE id='$student_id' ";
        //print "Nema Slika";
        //exit(0);

    }

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location:students.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: students.php");
        exit(0);
    }

}


if(isset($_POST['save_student'])){

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $image = $_FILES["image"]["name"]; 

    move_uploaded_file($_FILES["image"]["tmp_name"],"img/".$_FILES['image']['name']);
    
    $query = "INSERT INTO students (name,date_of_birth,image,email,phone,course) VALUES ('$name','$date_of_birth','$image','$email','$phone','$course')";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }   
}

?>