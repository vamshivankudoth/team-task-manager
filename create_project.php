<?php include "config.php"; 

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
    echo "Access Denied";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Project - Team Task Manager</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
        }

        .form-box {
            max-width: 500px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="form-box">

    <div class="d-flex justify-content-between mb-3">
        <h3>📁 Create Project</h3>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
    </div>

    <form method="POST">

        <div class="mb-3">
            <label>Project Name</label>
            <input type="text" name="pname" class="form-control" placeholder="Enter project name" required>
        </div>

        <button name="add" class="btn btn-primary w-100">Create Project</button>

    </form>

    <?php
    if(isset($_POST['add'])){
        $p = $_POST['pname'];
        $uid = $_SESSION['user'];

        $conn->query("INSERT INTO projects(project_name,created_by) VALUES('$p','$uid')");

        echo "<div class='alert alert-success mt-3'>Project created successfully!</div>";
    }
    ?>

</div>

</body>
</html>