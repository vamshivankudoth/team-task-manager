```php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

$error = "";

// 🔐 Handle login BEFORE HTML
if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);

    // ✅ Validation
    if(empty($email) || empty($pass)){
        $error = "Please fill all fields";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format";
    }
    else{
        // ✅ PDO prepared statement (FINAL FIX)
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($pass,$user['password'])){
            $_SESSION['user'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid Email or Password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Team Task Manager</title>

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

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 350px;
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

    <div class="login-box">
        <h4 class="mb-3">Login</h4>

        <!-- ✅ Error Message -->
        <?php if($error != ""){ ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <button class="btn btn-primary w-100" name="login">Login</button>
        </form>

        <div class="d-flex justify-content-between mt-3">
            <a href="signup.php">Signup</a>
            <a href="forgot_password.php">Forgot Password?</a>
        </div>

    </div>

</div>

</body>
</html>
```
