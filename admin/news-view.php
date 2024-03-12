<?php
   session_start();
    require 'dbcon.php';
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Bootstrap CSS -->
   
    <?php include("header.php"); ?>



    <title>News View</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details 
                            <a href="news.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['title']))
                        {
                            $title = mysqli_real_escape_string($con, $_GET['title']);
                            $query = "SELECT * FROM news WHERE title='$title' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $row = mysqli_fetch_array($query_run);
                                ?>
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <p class="form-control">
                                            <?=$row['title'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        
                                        <textarea class="form-control" id="" rows="3"><?=$row['description'];?></textarea>

                                           
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                    <label>News Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <img style="width: 300px; height: 200px;" alt="Image" src='img/<?= $row['image']; ?>' />
                                        
                            

                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">--Select Status--</option>
                                            <option value="0" <?= ($row['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                            <option value="1" <?= ($row['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                        </select>
                                    </div>
                                
                               <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






