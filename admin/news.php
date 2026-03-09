<?php
require 'dbcon.php';
include("auth_session.php");

if (isset($_POST['delete-news'])) {
    $title = mysqli_real_escape_string($con, $_POST['delete-news']);

    // Retrieve the filename of the picture associated with the news
    $query_select_image = "SELECT image FROM news WHERE title = '$title'";
    $result_select_image = mysqli_query($con, $query_select_image);
    if ($result_select_image && mysqli_num_rows($result_select_image) > 0) {
        $row = mysqli_fetch_assoc($result_select_image);
        $image_filename = $row['image'];

        // Delete the news record from the database
        $query_delete_news = "DELETE FROM news WHERE title = '$title'";
        $query_run = mysqli_query($con, $query_delete_news);

        if ($query_run) {
            // file unlink without logging to UI
            if (!empty($image_filename) && file_exists("img/$image_filename")) {
                unlink("img/$image_filename");
            }
            $_SESSION['message'] = "News deleted.";
        } else {
            $_SESSION['message'] = "News Not Deleted";
        }
    } else {
        $_SESSION['message'] = "Error: Record not found";
    }
    header("Location: news.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News</title>
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
                        <h4>News</h4>
                        <a href="news-create.php" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add News
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Title</th>
                                        <th style="width: 40%;">Description</th>
                                        <th style="width: 15%;">Image</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM news";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr>
                                                <td><strong><?= $row['title']; ?></strong></td>
                                                <td><?= $row['description']; ?></td>
                                                <td>
                                                    <?php if (!empty($row['image'])): ?>
                                                        <img src="./img/<?= $row['image']; ?>" alt="<?= $row['title']; ?>"
                                                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <?php else: ?>
                                                        <div
                                                            style="width: 60px; height: 60px; background-color: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                                            <i class="bi bi-image text-secondary" style="font-size: 1.5rem;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row['status'] == 1): ?>
                                                        <span class="badge-active">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge-inactive">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="news-view.php?title=<?= $row['title']; ?>"
                                                        class="btn btn-info btn-sm mb-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="news-edit.php?title=<?= $row['title']; ?>"
                                                        class="btn btn-success btn-sm mb-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="" method="POST" class="d-inline">
                                                        <input type="hidden" name="delete-news" value="<?= $row['title']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm mb-1">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center text-muted py-4'>No news found</td></tr>";
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