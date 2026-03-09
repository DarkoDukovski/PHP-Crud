<?php

require 'dbcon.php';
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include("header.php"); ?>

    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Student Details</h4>
                        <a href="student-create.php" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add Student
                        </a>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">ID</th>
                                        <th style="width: 20%;">Student Name</th>
                                        <th style="width: 15%;">Date of Birth</th>
                                        <th style="width: 10%;">Image</th>
                                        <th style="width: 15%;">Email</th>
                                        <th style="width: 10%;">Phone</th>
                                        <th style="width: 10%;">Course</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM students";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $student) {
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><strong><?= $student['name']; ?></strong></td>
                                                <td><?= $student['date_of_birth']; ?></td>
                                                <td>
                                                    <?php if(!empty($student['image'])): ?>
                                                        <img src="./img/<?= $student['image']; ?>" alt="<?= $student['name']; ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <?php else: ?>
                                                        <div style="width: 60px; height: 60px; background-color: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                                            <i class="bi bi-person text-secondary" style="font-size: 1.5rem;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $student['email']; ?></td>
                                                <td><?= $student['phone']; ?></td>
                                                <td><?= $student['course']; ?></td>
                                                <td>
                                                    <a href="student-view.php?id=<?= $student['id']; ?>"
                                                        class="btn btn-info btn-sm mb-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="student-edit.php?id=<?= $student['id']; ?>"
                                                        class="btn btn-success btn-sm mb-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_student" value="<?= $student['id']; ?>"
                                                            class="btn btn-danger btn-sm mb-1">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center text-muted py-4'>No students found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>