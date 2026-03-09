<?php
include("auth_session.php");
include("countingstudents.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
            <h4>Dashboard Overview</h4>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <!-- Students Card -->
              <div class="col-lg-3 col-md-6">
                <div class="card"
                  style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition:transform 0.2s ease, box-shadow 0.2s ease;"
                  onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                  <div class="card-body d-flex align-items-center justify-content-between" style="padding:1.5rem;">
                    <div>
                      <h5
                        style="color:#64748b; font-size:0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem; font-family:Inter,sans-serif;">
                        Students</h5>
                      <span
                        style="font-size:2rem; font-weight:700; color:#1e293b; font-family:Inter,sans-serif; line-height:1; display:block;"><?php echo $studentCount; ?></span>
                    </div>
                    <div
                      style="width:52px; height:52px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:rgba(99,102,241,0.1); color:#6366f1;">
                      <i class="bi bi-people" style="font-size:1.75rem;"></i>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Total News Card -->
              <div class="col-lg-3 col-md-6">
                <div class="card"
                  style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition:transform 0.2s ease, box-shadow 0.2s ease;"
                  onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                  <div class="card-body d-flex align-items-center justify-content-between" style="padding:1.5rem;">
                    <div>
                      <h5
                        style="color:#64748b; font-size:0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem; font-family:Inter,sans-serif;">
                        Total News</h5>
                      <span
                        style="font-size:2rem; font-weight:700; color:#1e293b; font-family:Inter,sans-serif; line-height:1; display:block;"><?php echo $newsCount; ?></span>
                    </div>
                    <div
                      style="width:52px; height:52px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:rgba(14,165,233,0.1); color:#0ea5e9;">
                      <i class="bi bi-newspaper" style="font-size:1.75rem;"></i>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Active News Card -->
              <div class="col-lg-3 col-md-6">
                <div class="card"
                  style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition:transform 0.2s ease, box-shadow 0.2s ease;"
                  onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                  <div class="card-body d-flex align-items-center justify-content-between" style="padding:1.5rem;">
                    <div>
                      <h5
                        style="color:#64748b; font-size:0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem; font-family:Inter,sans-serif;">
                        Active News</h5>
                      <span
                        style="font-size:2rem; font-weight:700; color:#1e293b; font-family:Inter,sans-serif; line-height:1; display:block;"><?php echo $countactivenews; ?></span>
                    </div>
                    <div
                      style="width:52px; height:52px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:rgba(34,197,94,0.1); color:#22c55e;">
                      <i class="bi bi-check-circle" style="font-size:1.75rem;"></i>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Inactive News Card -->
              <div class="col-lg-3 col-md-6">
                <div class="card"
                  style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition:transform 0.2s ease, box-shadow 0.2s ease;"
                  onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                  <div class="card-body d-flex align-items-center justify-content-between" style="padding:1.5rem;">
                    <div>
                      <h5
                        style="color:#64748b; font-size:0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem; font-family:Inter,sans-serif;">
                        Inactive News</h5>
                      <span
                        style="font-size:2rem; font-weight:700; color:#1e293b; font-family:Inter,sans-serif; line-height:1; display:block;"><?php echo $countinactivenews; ?></span>
                    </div>
                    <div
                      style="width:52px; height:52px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:rgba(239,68,68,0.1); color:#ef4444;">
                      <i class="bi bi-x-circle" style="font-size:1.75rem;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>