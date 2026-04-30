<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup - Team Task Manager</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .signup-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .app-title {
            color: white;
            font-weight: 600;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

<div class="text-center">

    <h2 class="app-title">Team Task Manager</h2>

    <div class="signup-box">
        <h4 class="mb-3">Create Account</h4>

        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>

            <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <select name="role" class="form-control mb-3">
                <option value="admin">Admin</option>
                <option value="member">Member</option>
            </select>

            <button class="btn btn-success w-100" name="register">Signup</button>
        </form>

        <p class="mt-3">
            Already have an account? <a href="index.php">Login</a>
        </p>

        <?php
        if(isset($_POST['register'])){
            $name=$_POST['name'];
            $email=$_POST['email'];
            $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role=$_POST['role'];

            $check = $conn->query("SELECT * FROM users WHERE email='$email'");

            if($check->num_rows > 0){
                echo "<div class='alert alert-warning mt-2'>Email already exists</div>";
            } else {
                $conn->query("INSERT INTO users(name,email,password,role) VALUES('$name','$email','$pass','$role')");
                echo "<div class='alert alert-success mt-2'>Registered Successfully! <a href='index.php'>Login</a></div>";
            }
        }
        ?>

    </div>

</div>

</body>
</html>