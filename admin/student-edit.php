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
    <title>Edit Student</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Edit Student</h4>
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
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                    <div class="mb-3">
                                        <label for="name">Student Name</label>
                                        <input type="text" id="name" name="name" value="<?= $student['name']; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" id="dob" name="date_of_birth"
                                            value="<?= $student['date_of_birth']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="file">Student Photo</label>
                                        <input type="file" id="file" name="file" class="form-control mb-2">
                                        <input type="hidden" name="image_old" value="<?php echo $student['image']; ?>">
                                        <img alt="Current Image" src='img/<?= $student['image']; ?>'
                                            style="width: 150px; height: 150px; border-radius: 8px; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="<?= $student['email']; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" value="<?= $student['phone']; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="course">Course</label>
                                        <input type="text" id="course" name="course" value="<?= $student['course']; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            <i class="bi bi-check-lg me-1"></i> Update Student
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