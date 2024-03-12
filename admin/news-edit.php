<?php
session_start();
include 'dbcon.php';
if(isset($_POST['update_news']))
{
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
              echo "The file " . basename($fileName) . " has been uploaded";
            } else {
              echo "An error occurred. Please contact the administrator.";
            }
          } else {
            foreach ($errors as $error) {
              echo $error . "These are the errors" . "\n";
            }
          }
          $query = "UPDATE news SET title='$title', description='$description', status='$status', image='$fileName' WHERE title='$title' ";
    }
    else {
        $query = "UPDATE news SET title='$title', description='$description', status='$status' WHERE title='$title' ";
    }
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "News Updated Successfully";
        header("Location: news.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "News Not Updated";
        header("Location: news.php");
        exit(0);
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>News Edit</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>News Edit
                            <a href="news.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['title']))
                        {
                            $title = mysqli_real_escape_string($con, $_GET['title']);
                            $query = "SELECT * FROM news WHERE title='$title' ";
                            $query_run = mysqli_query($con, $query);
                            if ($query_run && mysqli_num_rows($query_run) > 0)
                            {
                                $row = mysqli_fetch_assoc($query_run);
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?=$row['title'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                <label>Description</label>
                                     <textarea class="form-control" name="description" rows="3"><?= $row['description']; ?></textarea>
                                        </div>

                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">--Select Status--</option>
                                            <option value="0" <?= ($row['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                            <option value="1" <?= ($row['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>News Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <img style="width: 200px; height: 200px;" alt="Image" src='img/<?= $row['image']; ?>' />
                                    <div class="mb-3">
                                        <button type="submit" name="update_news" class="btn btn-primary">
                                            Update News
                                        </button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>









