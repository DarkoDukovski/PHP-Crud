<?php
   
    require 'dbcon.php';
    include("auth_session.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $status = mysqli_real_escape_string($con, $_POST['status']);
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $currentDirectory = getcwd();
            $uploadDirectory = "/img/";
            $errors = []; // Store errors here
            $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed
            $fileName = $_FILES['image']['name'];
            //print($fileName);
            //exit(0);
            $fileSize = $_FILES['image']['size'];
            $fileTmpName  = $_FILES['image']['tmp_name'];
            $fileType = $_FILES['image']['type'];
            $fileParts = explode('.', $fileName);
            $fileExtension = strtolower(end($fileParts));
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
                  echo "The file " . basename($fileName) . " has been uploaded </br>";
                } else {
                  echo "An error occurred. Please contact the administrator.";
                }
              } else {
                foreach ($errors as $error) {
                  echo $error . "These are the errors" . "\n";
                }
              }
        $sql = "INSERT INTO news (title, description, image, status)
                VALUES ('$title', '$description', '$fileName', '$status')";
                }
                else {
                    $sql = "INSERT INTO news (title, description, status) VALUES ('$title', '$description','$status')";
                    //print "Test 2";
                    //exit(0);
                }
        $result = $con->query($sql);
        if ($result) {
            echo "News added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }



















?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <?php include("header.php"); ?>



    <title>Student CRUD</title>
</head>
<body>
   
           
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add News
                            <a href="news.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="news-create.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="image"  class="form-control"> 
                            </div>
                            <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">--Select Status--</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        
                       
                                <div class="mb-3">
                                <input type="submit" value="Submit">
                          </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>