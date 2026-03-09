<?php
session_start();
require 'dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include("header.php"); ?>

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>News Details</h4>
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

                            if (mysqli_num_rows($query_run) > 0) {
                                $row = mysqli_fetch_array($query_run);
                                ?>
                                <div class="mb-4"
                                    style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-radius: 8px; border: 1px solid #e2e8f0;">
                                    <img alt="<?= $row['title']; ?>" src='img/<?= $row['image']; ?>'
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="mb-3">
                                    <label>Title</label>
                                    <p class="form-control bg-light">
                                        <?= $row['title']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <div class="form-control bg-light" style="min-height: 80px; height: auto;">
                                        <?= $row['description']; ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <p class="form-control bg-light">
                                        <?php if ($row['status'] == 1): ?>
                                            <span class="badge-active">Active</span>
                                        <?php else: ?>
                                            <span class="badge-inactive">Inactive</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <?php
                            } else {
                                echo "<h4>No Such Title Found</h4>";
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