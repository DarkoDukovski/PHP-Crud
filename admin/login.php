<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require('dbcon.php');
    session_start();

    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "<div class='auth-wrapper'>
                  <div class='form'>
                  <h3 class='error-title'>Incorrect Username/password.</h3><br/>
                  <p class='link'><a href='login.php'>Try again</a></p>
                  </div></div>";
        }
    } else {
        ?>
        <div class="auth-wrapper">
            <form class="form" method="post" name="login">
                <h1 class="login-title">Welcome Back</h1>
                <p class="auth-subtitle">Sign in to your account</p>
                <div class="input-group-custom">
                    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true">
                </div>
                <div class="input-group-custom">
                    <input type="password" class="login-input" name="password" placeholder="Password">
                </div>
                <input type="submit" value="Sign In" name="submit" class="login-button">
                <p class="link">
                    <a href="registration.php">Create an Account</a>
                </p>
            </form>
        </div>
        <?php
    }
    ?>
</body>

</html>