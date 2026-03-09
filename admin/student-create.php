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
    <title>Add Student</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container mt-5">

        <?php
        include('message.php');
        $formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
        if (isset($_SESSION['form_data']))
            unset($_SESSION['form_data']);
        ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card form-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4><i class="bi bi-person-plus me-2 text-primary"></i> Add Student</h4>
                        <a href="students.php" class="btn btn-back">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group-custom">
                                <label for="name">Student Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-custom"
                                    value="<?= isset($formData['name']) ? htmlspecialchars($formData['name']) : '' ?>"
                                    required>
                            </div>
                            <div class="form-group-custom">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="date_of_birth"
                                    class="form-control form-control-custom"
                                    value="<?= isset($formData['date_of_birth']) ? htmlspecialchars($formData['date_of_birth']) : '' ?>"
                                    required>
                            </div>
                            <div class="form-group-custom">
                                <label for="image">Photo Upload</label>
                                <input type="file" id="image" name="image" class="form-control form-control-custom">
                            </div>
                            <div class="form-group-custom">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control form-control-custom"
                                    value="<?= isset($formData['email']) ? htmlspecialchars($formData['email']) : '' ?>"
                                    required>
                            </div>
                            <div class="form-group-custom">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-custom"
                                    value="<?= isset($formData['phone']) ? htmlspecialchars($formData['phone']) : '' ?>">
                            </div>
                            <div class="form-group-custom">
                                <label for="course">Course</label>
                                <input type="text" id="course" name="course" class="form-control form-control-custom"
                                    value="<?= isset($formData['course']) ? htmlspecialchars($formData['course']) : '' ?>"
                                    required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" name="save_student" class="btn btn-form-submit">
                                    <i class="bi bi-check-lg me-1"></i> Save Student
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