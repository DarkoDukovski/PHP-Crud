<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);

// Helper function to determine link style
function get_nav_style($page_name, $current_page)
{
    $base_style = "padding:0.5rem 0.9rem !important; border-radius:8px; transition:all 0.2s; font-family:Inter,sans-serif;";
    if ($current_page == $page_name) {
        // Active state
        return "color:#fff !important; font-weight:700; background:rgba(255,255,255,0.12); " . $base_style;
    } else {
        // Inactive state
        return "color:rgba(255,255,255,0.7) !important; font-weight:500; " . $base_style;
    }
}
?>
<nav class="navbar navbar-expand-lg"
    style="background:#1e293b !important; padding:0.6rem 1.5rem !important; box-shadow:0 2px 10px rgba(0,0,0,0.15) !important; border:none !important;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php" style="gap:0.6rem;">
            <img src="dd.jpg" alt="Logo" style="width:36px;height:36px;border-radius:8px;object-fit:cover;">
            <span
                style="color:#fff;font-weight:700;font-size:1.1rem;font-family:Inter,sans-serif;letter-spacing:-0.3px;">Admin
                Panel</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
            style="border-color:rgba(255,255,255,0.2);">
            <span class="navbar-toggler-icon" style="filter:invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto" style="gap:0.25rem;">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"
                        style="<?= get_nav_style('dashboard.php', $current_page) ?>">
                        <i class="bi bi-house-door me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="students.php" style="<?= get_nav_style('students.php', $current_page) ?>">
                        <i class="bi bi-people me-1"></i>Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php" style="<?= get_nav_style('news.php', $current_page) ?>">
                        <i class="bi bi-newspaper me-1"></i>News
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="university.php"
                        style="<?= get_nav_style('university.php', $current_page) ?>">
                        <i class="bi bi-cloud-arrow-down me-1"></i>API's
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center" style="gap:0.75rem;">
                <a class="nav-link d-flex align-items-center" href="updateprofile.php"
                    style="<?= get_nav_style('updateprofile.php', $current_page) ?> gap:0.4rem;">
                    <i class="bi bi-person-circle" style="font-size:1.1rem;"></i>
                    <span>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        } else {
                            echo "Admin";
                        }
                        ?>
                    </span>
                </a>
                <a href="logout.php"
                    style="color:#fff !important;background:rgba(239,68,68,0.85);font-weight:500;font-size:0.8rem;padding:0.4rem 0.9rem;border-radius:8px;text-decoration:none;transition:all 0.2s;font-family:Inter,sans-serif;display:inline-flex;align-items:center;gap:0.35rem;">
                    <i class="bi bi-box-arrow-right"></i>Logout
                </a>
            </div>
        </div>
    </div>
</nav>