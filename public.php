<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Latest News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="admin/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #f0f2f5;">
  <div class="flex-grow-1">
    <!-- Combined Hero and Header Section -->
    <div class="public-hero"
      style="background: #1e293b !important; color: #fff; text-align: center; padding: 0 0 1.5rem 0; margin-bottom: 2.5rem;">

      <!-- Transparent Header -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-transparent navbar-transparent"
        style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 1.5rem;">
        <div class="container d-flex justify-content-between align-items-center">
          <a class="navbar-brand d-flex align-items-center" href="public.php" style="text-decoration: none;">
            <i class="bi bi-newspaper me-2" style="font-size: 1.4rem; color: #fff;"></i>
            <span class="fw-bold" style="color: #fff; font-size: 1.15rem; font-family: Inter, sans-serif;">PHP-CRUD
              News</span>
          </a>
          <a href="admin/login.php" class="btn btn-outline-light btn-sm px-4 fw-semibold"
            style="border-radius: 8px; padding-top: 0.5rem; padding-bottom: 0.5rem; transition: all 0.2s ease;">Login</a>
        </div>
      </nav>

      <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 60px;">
        <h1 class="d-flex align-items-center justify-content-center"
          style="font-size: 1.35rem; font-weight: 700; color: #fff; margin-bottom: 0.25rem; font-family: Inter, sans-serif; letter-spacing: -0.3px;">
          <i class="bi bi-newspaper me-2" style="font-size: 1.95rem;"></i>Latest News
        </h1>
        <p style="font-size: 0.9rem; opacity: 0.8; font-family: Inter, sans-serif; font-weight: 400; margin-bottom: 0;">
          Stay updated with the latest announcements</p>
      </div>
    </div>

    <?php
    include("admin/countingstudents.php");
    ?>

    <?php
    require 'admin/dbcon.php';

    // Retrieve only active news from the 'news' table
    $sql = "SELECT id, title, image, description FROM news WHERE status = 1";
    $result = $con->query($sql);
    ?>

    <!-- News Cards -->
    <div class="container">
      <div class="row g-4 justify-content-center">
        <?php
        if ($result->num_rows > 0) {
          // Display cards for active news
          while ($row = $result->fetch_assoc()) {
            // Encode ID to use in URL safely
            $newsId = urlencode($row['id']);
            echo '<div class="col-md-4 col-sm-6">';
            echo '<a href="public-news-view.php?id=' . $newsId . '" style="text-decoration: none; color: inherit; display: block; height: 100%;">';
            echo '<div class="news-card" style="border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.06);height:100%;background:#fff;transition:all 0.3s ease; cursor: pointer;">';
            echo '<img src="admin/img/' . $row['image'] . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '" style="height:200px;width:100%;object-fit:cover;">';
            echo '<div class="card-body" style="padding:1.25rem;">';
            echo '<h5 class="card-title" style="font-size:1.1rem;font-weight:700;color:#1e293b;margin-bottom:0.5rem;font-family:Inter,sans-serif;">' . htmlspecialchars($row['title']) . '</h5>';

            // Truncate description for the card preview to keep it uniform
            $desc = htmlspecialchars($row['description']);
            if (strlen($desc) > 100) {
              $desc = substr($desc, 0, 100) . '...';
            }

            echo '<p class="card-text" style="font-size:0.9rem;color:#64748b;line-height:1.6;font-family:Inter,sans-serif;">' . $desc . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
          }
        } else {
          echo '<div class="col-12 text-center py-5">';
          echo '<i class="bi bi-inbox" style="font-size: 3rem; color: #cbd5e1;"></i>';
          echo '<p style="color:#64748b;margin-top:0.75rem;font-family:Inter,sans-serif;">No news available at the moment.</p>';
          echo '</div>';
        }

        // Close result set and connection
        $result->free_result();
        $con->close();
        ?>
      </div>
    </div>
  </div>
  </div>

  <!-- Footer -->
  <footer
    style="background-color: #1e293b; color: #94a3b8; text-align: center; padding: 1.5rem 1rem; margin-top: 3rem; font-size: 0.85rem; font-family: Inter, sans-serif;">
    <div class="container">
      <p class="mb-0">&copy; <?php echo date('Y'); ?> PHP-CRUD Admin Panel. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>