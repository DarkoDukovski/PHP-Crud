<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
  
    <img src="dd.jpg" alt="Logo" style="width: 50px; height: 50px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="students.php">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="news.php">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="university.php">API'S</a>
        </li>
        <li class="nav-item">
          <form class="form-inline ml-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search by Name" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item">
           <li class="nav-item">
          <a class="nav-link" href="updateprofile.php">Profile</a>
        </li>    
          <span class="navbar-text mr-3">

          
            <!-- Replace 'User Name' with the actual user's name -->
            <?php
    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
      echo $_SESSION['username'];
    }
    ?>
          </span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>