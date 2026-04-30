<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Task - Team Task Manager</title>

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
            max-width: 600px;
            margin: 50px auto;
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
        <h3>➕ Create Task</h3>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
    </div>

    <form method="POST">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="desc" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>Assign User</label>
            <select name="user" class="form-control">
                <?php
                $users = $conn->query("SELECT * FROM users");
                while($u = $users->fetch_assoc()){
                    echo "<option value='{$u['id']}'>{$u['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Project</label>
            <select name="project" class="form-control">
                <?php
                $pro = $conn->query("SELECT * FROM projects");
                while($p = $pro->fetch_assoc()){
                    echo "<option value='{$p['id']}'>{$p['project_name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" required>
        </div>

        <button name="create" class="btn btn-success w-100">Create Task</button>

    </form>

    <?php
    if(isset($_POST['create'])){
        $t=$_POST['title'];
        $d=$_POST['desc'];
        $u=$_POST['user'];
        $p=$_POST['project'];
        $dl=$_POST['deadline'];

        $conn->query("INSERT INTO tasks(title,description,assigned_to,project_id,deadline) 
        VALUES('$t','$d','$u','$p','$dl')");

        echo "<div class='alert alert-success mt-3'>Task created successfully!</div>";
    }
    ?>

</div>

</body>
</html>