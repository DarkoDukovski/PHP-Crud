<?php
require 'admin/dbcon.php';

if (isset($_GET['title'])) {
    $title_param = mysqli_real_escape_string($con, $_GET['title']);
    $sql = "SELECT * FROM news WHERE title='$title_param' AND status = 1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $news_item = mysqli_fetch_assoc($result);
    } else {
        $news_item = null;
    }
} else {
    $news_item = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $news_item ? htmlspecialchars($news_item['title']) : 'News Not Found' ?>
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="admin/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #f0f2f5;">
    <!-- Combined Hero and Header Section -->
    <div class="public-hero"
        style="background: #1e293b !important; color: #fff; text-align: center; padding: 0 0 1.5rem 0; margin-bottom: 2.5rem;">

        <!-- Transparent Header -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent navbar-transparent"
            style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 1.5rem;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand d-flex align-items-center" href="public.php" style="text-decoration: none;">
                    <i class="bi bi-newspaper me-2" style="font-size: 1.4rem; color: #fff;"></i>
                    <span class="fw-bold"
                        style="color: #fff; font-size: 1.15rem; font-family: Inter, sans-serif;">PHP-CRUD News</span>
                </a>
                <a href="admin/login.php" class="btn btn-outline-light btn-sm px-4 fw-semibold"
                    style="border-radius: 8px; padding-top: 0.5rem; padding-bottom: 0.5rem; transition: all 0.2s ease;">Login</a>
            </div>
        </nav>

        <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 60px;">
            <h1 class="d-flex align-items-center justify-content-center"
                style="font-size: 1.35rem; font-weight: 700; color: #fff; margin-bottom: 0.25rem; font-family: Inter, sans-serif; letter-spacing: -0.3px;">
                <i class="bi bi-newspaper me-2" style="font-size: 1.95rem;"></i>News Details
            </h1>
        </div>
    </div>

    <div class="container container-fluid flex-grow-1 mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card form-card" style="margin-top: 0 !important;">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom-0 pb-0">
                        <h4><i class="bi bi-card-heading me-2 text-primary"></i> News Details</h4>
                        <a href="public.php" class="btn btn-back">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body pt-4">
                        <?php if ($news_item): ?>

                            <div class="mb-4 text-center rounded overflow-hidden shadow-sm"
                                style="border: 1px solid #e2e8f0; background: #f8fafc;">
                                <img alt="<?= htmlspecialchars($news_item['title']); ?>"
                                    src="admin/img/<?= htmlspecialchars($news_item['image']); ?>" class="img-fluid w-100"
                                    style="max-height: 400px; object-fit: cover;">
                            </div>

                            <div class="form-group-custom">
                                <label class="text-uppercase tracking-wider small fw-bold text-muted mb-2">Title</label>
                                <div class="p-3 bg-light rounded border border-light-subtle shadow-sm"
                                    style="color: #1e293b; font-size: 1.05rem; font-weight: 500;">
                                    <?= htmlspecialchars($news_item['title']); ?>
                                </div>
                            </div>

                            <div class="form-group-custom mt-4">
                                <label
                                    class="text-uppercase tracking-wider small fw-bold text-muted mb-2">Description</label>
                                <div class="p-3 bg-light rounded border border-light-subtle shadow-sm"
                                    style="min-height: 120px; color: #475569; line-height: 1.7;">
                                    <?= nl2br(htmlspecialchars($news_item['description'])); ?>
                                </div>
                            </div>

                            <div class="form-group-custom mt-4">
                                <label class="text-uppercase tracking-wider small fw-bold text-muted mb-2">Status</label>
                                <div>
                                    <span class="badge bg-success rounded-pill px-3 py-2 fw-semibold"
                                        style="letter-spacing: 0.5px;">Active</span>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-exclamation-triangle text-warning mb-3" style="font-size: 3rem;"></i>
                                <h4 class="text-dark fw-bold">Oops! News Not Found</h4>
                                <p class="text-muted">The news article you are looking for does not exist or has been
                                    removed.</p>
                                <a href="public.php" class="btn btn-primary mt-3 px-4 rounded-pill">View Latest News</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer
        style="background-color: #1e293b; color: #94a3b8; text-align: center; padding: 1.5rem 1rem; font-size: 0.85rem; font-family: Inter, sans-serif;">
        <div class="container">
            <p class="mb-0">&copy;
                <?= date('Y'); ?> PHP-CRUD Admin Panel. All rights reserved.
            </p>
        </div>
    </footer>

    <?php mysqli_close($con); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>