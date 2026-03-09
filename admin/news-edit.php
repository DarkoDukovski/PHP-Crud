<?php
session_start();
include 'dbcon.php';
if (isset($_POST['update_news'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $currentDirectory = getcwd();
        $uploadDirectory = "/img/";
        $errors = [];
        $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
        $originalFileName = basename($_FILES['image']['name']);
        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9\.\-_]/", "_", $originalFileName);
        $fileSize = $_FILES['image']['size'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileParts = explode('.', $fileName);
        $fileExtension = strtolower(end($fileParts));
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
        $query = "UPDATE news SET title='$title', description='$description', status='$status', image='$fileName' WHERE title='$title' ";
    } else {
        $query = "UPDATE news SET title='$title', description='$description', status='$status' WHERE title='$title' ";
    }
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "News updated.";
        header("Location: news.php");
        exit(0);
    } else {
        $_SESSION['message'] = "News Not Updated";
        header("Location: news.php");
        exit(0);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit News</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Edit News</h4>
                        <a href="news.php" class="btn btn-danger">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['title'])) {
                            $title = mysqli_real_escape_string($con, $_GET['title']);
                            $query = "SELECT * FROM news WHERE title='$title' ";
                            $query_run = mysqli_query($con, $query);
                            if ($query_run && mysqli_num_rows($query_run) > 0) {
                                $row = mysqli_fetch_assoc($query_run);
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" value="<?= $row['title']; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control" name="description"
                                            rows="4"><?= $row['description']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-select">
                                            <option value="">-- Select Status --</option>
                                            <option value="0" <?= ($row['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                            <option value="1" <?= ($row['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image">News Image</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                    </div>
                                    <div class="mb-3"
                                        style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-radius: 8px; border: 1px solid #e2e8f0;">
                                        <img alt="Image" src='img/<?= $row['image']; ?>'
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_news" class="btn btn-primary">
                                            <i class="bi bi-check-lg me-1"></i> Update News
                                        </button>
                                    </div>
                                </form>
                                <?php
                            } else {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>