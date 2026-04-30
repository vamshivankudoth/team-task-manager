```php
<?php include "config.php"; 

// 🔐 Optional session check (recommended)
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Team Task Manager</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #1e3c72, #2a5298);
            color: white;
            padding: 20px;
        }

        .sidebar h4 {
            font-weight: 600;
        }

        .sidebar a {
            color: white;
            display: block;
            margin: 12px 0;
            padding: 8px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            padding-left: 12px;
        }

        .navbar-custom {
            background: white;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card-box {
            border-radius: 15px;
            transition: 0.3s;
        }

        .card-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4> Task Manager</h4>
            <hr>

            <a href="dashboard.php">📊 Dashboard</a>
            <a href="create_project.php">📁 Create Project</a>
            <a href="create_task.php">✅ Create Task</a>
            <a href="tasks.php">📋 View Tasks</a>
            <a href="logout.php">🚪 Logout</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">

            <!-- Top Navbar -->
            <div class="navbar-custom d-flex justify-content-between">
                <h5>Welcome</h5>
                <span>Role: <?php echo $_SESSION['role']; ?></span>
            </div>

            <div class="p-4">

                <h3 class="mb-4">📊 Dashboard Overview</h3>

                <?php
                // ✅ PDO queries
                $stmt = $conn->query("SELECT COUNT(*) as c FROM tasks");
                $total = $stmt->fetch(PDO::FETCH_ASSOC)['c'];

                $stmt = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='Completed'");
                $completed = $stmt->fetch(PDO::FETCH_ASSOC)['c'];

                $stmt = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='Pending'");
                $pending = $stmt->fetch(PDO::FETCH_ASSOC)['c'];

                $stmt = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE deadline < CURDATE() AND status!='Completed'");
                $overdue = $stmt->fetch(PDO::FETCH_ASSOC)['c'];
                ?>

                <div class="row text-center">

                    <div class="col-md-3">
                        <div class="card card-box bg-primary text-white p-4">
                            <h6>Total Tasks</h6>
                            <h2><?php echo $total; ?></h2>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-box bg-success text-white p-4">
                            <h6>Completed</h6>
                            <h2><?php echo $completed; ?></h2>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-box bg-warning text-dark p-4">
                            <h6>Pending</h6>
                            <h2><?php echo $pending; ?></h2>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-box bg-danger text-white p-4">
                            <h6>Overdue</h6>
                            <h2><?php echo $overdue; ?></h2>
                        </div>
                    </div>

                </div>

                <!-- Extra Section -->
                <div class="mt-5">
                    <h5>Quick Actions</h5>
                    <a href="create_project.php" class="btn btn-primary me-2">+ New Project</a>
                    <a href="create_task.php" class="btn btn-success me-2">+ New Task</a>
                    <a href="tasks.php" class="btn btn-info">View All Tasks</a>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>
```
