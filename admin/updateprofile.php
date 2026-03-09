<?php
session_start();
require('dbcon.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$showMessage = false;
$messageType = '';
$messageText = '';

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));

if ($result) {
    $userData = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $newUsername = mysqli_real_escape_string($con, $_POST['new_username']);
    $newEmail = mysqli_real_escape_string($con, $_POST['new_email']);
    $newPassword = mysqli_real_escape_string($con, $_POST['new_password']);

    $updateQuery = "UPDATE users SET username='$newUsername', email='$newEmail', password='" . md5($newPassword) . "' WHERE username='$username'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        $_SESSION['username'] = $newUsername;
        $showMessage = true;
        $messageType = 'success';
        $messageText = 'Profile updated successfully! Your changes have been saved.';
    } else {
        $showMessage = true;
        $messageType = 'error';
        $messageText = 'Error updating profile. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include("header.php"); ?>

    <?php if ($showMessage): ?>
        <?php if ($messageType == 'success'): ?>
            <div class='container mt-5'>
                <div class='row justify-content-center'>
                    <div class='col-md-6'>
                        <div class='card'>
                            <div class='card-body text-center py-5'>
                                <i class='bi bi-check-circle' style='font-size: 3rem; color: #10b981;'></i>
                                <h4 class='mt-3'>Profile updated successfully!</h4>
                                <p class='text-muted'>Your changes have been saved.</p>
                                <a href='dashboard.php' class='btn btn-primary mt-2'>Back to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class='container mt-5'>
                <div class='row justify-content-center'>
                    <div class='col-md-6'>
                        <div class='card'>
                            <div class='card-body text-center py-5'>
                                <i class='bi bi-x-circle' style='font-size: 3rem; color: #ef4444;'></i>
                                <h4 class='mt-3'>Error updating profile</h4>
                                <p class='text-muted'>Please try again.</p>
                                <a href='updateprofile.php' class='btn btn-primary mt-2'>Try Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="bi bi-person-gear me-2"></i>Update Profile</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" name="update_profile">
                                <div class="mb-3">
                                    <label for="new_username">New Username</label>
                                    <input type="text" id="new_username" name="new_username" class="form-control"
                                        value="<?php echo isset($userData['username']) ? htmlspecialchars($userData['username']) : ''; ?>"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_email">New Email Address</label>
                                    <input type="email" id="new_email" name="new_email" class="form-control"
                                        value="<?php echo isset($userData['email']) ? htmlspecialchars($userData['email']) : ''; ?>"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password">New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control"
                                        placeholder="Enter new password" required>
                                </div>
                                <button type="submit" name="update" class="btn btn-primary w-100">
                                    <i class="bi bi-check-lg me-1"></i> Update Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>