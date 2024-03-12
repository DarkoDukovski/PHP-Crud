<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <!-- Header Menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="dd.jpg" alt="Logo" style="width: 50px; height: 50px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Home</a>
        </li>
      </ul>
    </div>
  </nav>
  

  <?php
  include("countingstudents.php");
  ?>
  <!-- Center Active News box -->
  <div class="container mt-4 d-flex justify-content-center">
    <div class="col-lg-3 col-md-6">
      <div class="card card3">
        <div class="card-body bg-danger text-center">
          <h5 class="card-title">Active news <?php echo $countactivenews; ?></h5>
          <i class="bi bi-newspaper text-white" style="font-size: 3rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "crud1";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve only active news from the 'news' table
  $sql = "SELECT title, image, description FROM news WHERE status = 1";
  $result = $conn->query($sql);
  ?>

  <!-- Cards with news below Active News -->
  <div class="container mt-4">
    <div class="row justify-content-center">
      <?php
      // Display cards for active news
      while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3 mb-4">';
        echo '<div class="card">';
        echo '<img src="admin/img/' . $row['image'] . '" class="card-img-top" alt="Card Image">';






        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
        echo '<p class="card-text">' . $row['description'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }

      // Close result set and connection
      $result->free_result();
      $conn->close();
      ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
