<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>






<body>

<?php include("header.php"); ?>
<style>   .body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

/* .form styles */
.form {
    max-width: 400px;
    margin: 50px auto; /* Adjust the top margin to create space */
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form h1 {
    text-align: center;
}

.form label {
    display: block;
    margin-bottom: 5px;
}

.form input[type="text"],
.form input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 3px;
    border: 1px solid #ccc;
}

.form input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 3px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
}

.form input[type="submit"]:hover {
    background-color: #0056b3;
    
    
}

.form .link {
    text-align: center;
    
    
}
</style>
    <?php
    require('db.php');
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Fetch user details from the database
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $query) or die(mysql_error());

        if ($result) {
            $userData = mysqli_fetch_assoc($result);
        }

        // When the update form is submitted
        if (isset($_POST['update'])) {
            $newUsername = mysqli_real_escape_string($con, $_POST['new_username']);
            $newPassword = mysqli_real_escape_string($con, $_POST['new_password']);

            // Update user details in the database
            $updateQuery = "UPDATE users SET username='$newUsername', password='" . md5($newPassword) . "' WHERE username='$username'";
            $updateResult = mysqli_query($con, $updateQuery);

            if ($updateResult) {
                // Update the session variable with the new username
                $_SESSION['username'] = $newUsername;
                echo "<div class='form'>
                    <h1>Profile updated successfully.</h1><br/>
                    <p class='link'>Back to <a href='dashboard.php'>Dashboard</a>.</p>
                    </div>";
            } else {
                echo "<div class='form'>
                    <h1>Error updating profile. Please try again.</h1><br/>
                    <p class='link'>Back to <a href='dashboard.php'>Dashboard</a>.</p>
                    </div>";
            }
        } else {
    ?>
        <form class="form" method="post" name="update_profile">
            <h1>Update Profile</h1>
            <label>New username:</label>
            <input type="text" name="new_username" value="<?php echo $userData['username']; ?>" required/>
            <label>New password:</label>
            <input type="password" name="new_password" placeholder="New Password" required/>
            <input type="submit" value="Update" name="update" />
        </form>
    <?php
        }
    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login.php");
    }
    ?>
    
</body>
</html>
