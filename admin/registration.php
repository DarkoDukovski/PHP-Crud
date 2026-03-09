<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require('dbcon.php');

    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='auth-wrapper'>
                  <div class='form'>
                  <h3 class='success-title'>Registered successfully!</h3><br/>
                  <p class='link'><a href='login.php'>Sign in now</a></p>
                  </div></div>";
        } else {
            echo "<div class='auth-wrapper'>
                  <div class='form'>
                  <h3 class='error-title'>Required fields are missing.</h3><br/>
                  <p class='link'><a href='registration.php'>Try again</a></p>
                  </div></div>";
        }
    } else {
        ?>
        <div class="auth-wrapper">
            <form class="form" action="" method="post">
                <h1 class="login-title">Create Account</h1>
                <p class="auth-subtitle">Register a new account</p>
                <div class="input-group-custom">
                    <input type="text" class="login-input" name="username" placeholder="Username" required>
                </div>
                <div class="input-group-custom">
                    <input type="email" class="login-input" name="email" placeholder="Email Address">
                </div>
                <div class="input-group-custom">
                    <input type="password" class="login-input" name="password" placeholder="Password">
                </div>
                <input type="submit" name="submit" value="Register" class="login-button">
                <p class="link">
                    <a href="login.php">Already have an account? Sign in</a>
                </p>
            </form>
        </div>
        <?php
    }
    ?>
</body>

</html>