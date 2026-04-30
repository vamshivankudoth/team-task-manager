<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center" style="height:100vh;background:#eef2f7;">

<div class="card p-4" style="width:350px;">
    <h4 class="text-center mb-3">Forgot Password</h4>

    <form method="POST">
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
        <button name="check" class="btn btn-primary w-100">Next</button>
    </form>

    <?php
    if(isset($_POST['check'])){
        $email = $_POST['email'];

        $res = $conn->query("SELECT * FROM users WHERE email='$email'");

        if($res->num_rows > 0){
            header("Location: reset_password.php?email=$email");
        } else {
            echo "<div class='alert alert-danger mt-2'>Email not found</div>";
        }
    }
    ?>
</div>

</body>
</html>