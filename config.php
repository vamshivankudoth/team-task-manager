<?php
$conn = new mysqli("localhost", "root", "", "team_task_manager");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>