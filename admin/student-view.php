<?php
include("auth_session.php");
require 'dbcon.php';
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
    <title>Student Details</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Student Details</h4>
                        <a href="students.php" class="btn btn-danger">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM students WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <div class="text-center mb-4">
                                    <img alt="<?= $student['name']; ?>" src='img/<?= $student['image']; ?>'
                                        style="width: 250px; height: 250px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: 2px solid #e2e8f0;">
                                </div>
                                <div class="mb-3">
                                    <label>Student Name</label>
                                    <p class="form-control bg-light">
                                        <?= $student['name']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Date of Birth</label>
                                    <p class="form-control bg-light">
                                        <?= $student['date_of_birth']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <p class="form-control bg-light">
                                        <?= $student['email']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Phone</label>
                                    <p class="form-control bg-light">
                                        <?= $student['phone']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Course</label>
                                    <p class="form-control bg-light">
                                        <?= $student['course']; ?>
                                    </p>
                                </div>
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