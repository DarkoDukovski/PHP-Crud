<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

?>

<?php
//include auth_session.php file on all user panel pages
include("countingstudents.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Information</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>






<body>

<?php include("header.php"); ?>



    <div class="container mt-4">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body bg-primary">
       
            <h5 class="card-title">Students <?php echo $studentCount; ?> </h5>
            <i class="bi bi-people text-white" style="font-size: 3rem;"></i>

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
        <div class="card-body bg-warning">
        
            <h5 class="card-title">Total news <?php echo $newsCount; ?> </h5>
            <i class="bi bi-newspaper fs-1 text-white"  style="font-size: 3rem;"></i>
            
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
        <div class="card-body bg-danger">
            <h5 class="card-title">Active news <?php echo $countactivenews; ?> </h5>                              
            <i class="bi bi-newspaper fs-5 text-white"  style="font-size: 3rem;"></i>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
        <div class="card-body bg-success">
            <h5 class="card-title">Inactive news <?php echo $countinactivenews; ?> </h5> 
            <i class="bi bi-newspaper fs-5 text-white"  style="font-size: 3rem;"></i>

          </div>
        </div>
      </div>
    </div>
  </div>



</body>
</html>