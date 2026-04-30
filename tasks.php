<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tasks - Team Task Manager</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
        }

        .container-box {
            margin-top: 40px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="container container-box">

    <div class="d-flex justify-content-between mb-3">
        <h3>📋 Task List</h3>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
    </div>

    <div class="card p-3">

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM tasks");

                while($row = $res->fetch_assoc()){

                    // Badge color logic
                    $color = "secondary";
                    if($row['status'] == "Pending") $color = "warning";
                    if($row['status'] == "In Progress") $color = "primary";
                    if($row['status'] == "Completed") $color = "success";

                    echo "<tr>
                        <td>{$row['title']}</td>

                        <td>
                            <span class='badge bg-$color'>{$row['status']}</span>
                        </td>

                        <td>
                            <form method='POST' class='d-flex'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                
                                <select name='status' class='form-select me-2'>
                                    <option>Pending</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                </select>

                                <button name='update' class='btn btn-primary'>Update</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>

        </table>

    </div>
</div>

<?php
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $s=$_POST['status'];

    $conn->query("UPDATE tasks SET status='$s' WHERE id=$id");
    header("Location: tasks.php");
}
?>

</body>
</html>