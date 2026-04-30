<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center" style="height:100vh;background:#eef2f7;">

<div class="card p-4" style="width:350px;">
    <h4 class="text-center mb-3">Reset Password</h4>

    <form method="POST">
        <input type="password" name="newpass" class="form-control mb-3" placeholder="New Password" required>
        <button name="reset" class="btn btn-success w-100">Reset</button>
    </form>

    <?php
    if(isset($_POST['reset'])){
        $email = $_GET['email'];
        $newpass = password_hash($_POST['newpass'], PASSWORD_DEFAULT);

        $conn->query("UPDATE users SET password='$newpass' WHERE email='$email'");

        echo "<div class='alert alert-success mt-2'>Password updated! <a href='index.php'>Login</a></div>";
    }
    ?>
</div>

</body>
</html>