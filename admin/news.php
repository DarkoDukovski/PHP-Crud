<?php
   
    require 'dbcon.php';
    include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <?php include("header.php"); ?>



    <title>Student CRUD</title>
</head>
<body>
    <div class="container mt-4">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>News
                    <a href="news-create.php" class="btn btn-primary float-end">Add News</a>
                </h4>
            </div>
            <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $query = "SELECT * FROM news";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['title']; ?></td>
                                                <td><?= $row['description']; ?></td>
                                                <td> <img src="./img/<?= $row['image']; ?>" width="150px" alt=""></td>
                                                <td><?= $row['status'] == 1 ? 'Active' : 'Inactive'       ; ?></td> 
                                               
                                               
                                                <td>
                                                    <a href="news-view.php?title=<?= $row['title']; ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="news-edit.php?title=<?= $row['title']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="delete-news.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete-news" value="<?=$row['title'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
                                    