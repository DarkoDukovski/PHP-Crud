<?php
require 'dbcon.php';
include("auth_session.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $imageUploaded = false;
    $errors = [];

    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        if ($_FILES['image']['error'] == 1 || $_FILES['image']['error'] == 2) {
            $errors[] = "File exceeds maximum size allowed by server.";
        } elseif ($_FILES['image']['error'] == 0) {
            $currentDirectory = getcwd();
            $uploadDirectory = "/img/";
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
                $imageUploaded = true;
            }
        } else {
            $errors[] = "An error occurred during file upload.";
        }
    }

    if (!empty($errors)) {
        $message = implode("<br>", $errors);
        $alertClass = "alert-danger";
    } else {
        $sql = "";
        if ($imageUploaded) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
                $sql = "INSERT INTO news (title, description, image, status) VALUES ('$title', '$description', '$fileName', '$status')";
            } else {
                $message = "An error occurred while uploading the image. Please try again.";
                $alertClass = "alert-danger";
            }
        } else {
            $sql = "INSERT INTO news (title, description, status) VALUES ('$title', '$description','$status')";
        }

        if (!empty($sql)) {
            $result = $con->query($sql);
            if ($result) {
                $_SESSION['message'] = "News created.";
                header("Location: news.php");
                exit(0);
            } else {
                $message = "Error inserting news into the database.";
                $alertClass = "alert-danger";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add News</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container mt-5">
        <?php if (isset($message)): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert <?= $alertClass ?> alert-dismissible fade show d-flex align-items-center shadow-sm"
                        role="alert"
                        style="background-color: <?= ($alertClass == 'alert-danger') ? '#fef2f2' : '#f0fdf4' ?>; border: 1px solid <?= ($alertClass == 'alert-danger') ? '#fecaca' : '#bbf7d0' ?>; color: <?= ($alertClass == 'alert-danger') ? '#991b1b' : '#166534' ?>; border-radius: 12px; padding: 1rem 1.25rem;">
                        <i class="bi <?= ($alertClass == 'alert-danger') ? 'bi-exclamation-circle-fill' : 'bi-check-circle-fill' ?> me-3"
                            style="font-size: 1.25rem; color: <?= ($alertClass == 'alert-danger') ? '#ef4444' : '#22c55e' ?>;"></i>
                        <div>
                            <strong
                                style="font-weight: 600;"><?= ($alertClass == 'alert-danger') ? 'Error!' : 'Success!' ?></strong>
                            <span style="font-weight: 500; opacity: 0.9;"><?= $message ?></span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"
                            style="font-size: 0.8rem; opacity: 0.6; padding: 1.25rem;"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card form-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4><i class="bi bi-file-earmark-plus me-2 text-primary"></i> Add News</h4>
                        <a href="news.php" class="btn btn-back">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="news-create.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group-custom">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control form-control-custom"
                                    value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>"
                                    required>
                            </div>
                            <div class="form-group-custom">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control form-control-custom"
                                    rows="4"
                                    required><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                            </div>
                            <div class="form-group-custom">
                                <label for="image">Image Upload</label>
                                <input type="file" id="image" name="image" class="form-control form-control-custom"
                                    required>
                            </div>
                            <div class="form-group-custom">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control form-control-custom">
                                    <option value="">-- Select Status --</option>
                                    <option value="0" <?= (isset($_POST['status']) && $_POST['status'] == '0') ? 'selected' : '' ?>>Inactive</option>
                                    <option value="1" <?= (isset($_POST['status']) && $_POST['status'] == '1') ? 'selected' : '' ?>>Active</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-form-submit">
                                    <i class="bi bi-check-lg me-1"></i> Create News
                                </button>
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