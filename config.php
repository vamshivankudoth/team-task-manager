```php
<?php
session_start();

$host = getenv("MYSQLHOST");
$port = getenv("MYSQLPORT");   // IMPORTANT
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");

try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("ERROR: " . $e->getMessage());   // SHOW REAL ERROR
}
?>
```
