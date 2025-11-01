<?php
$host = "sql113.infinityfree.com";
$user = "if0_40148312";
$pass = "Register890";
$dbname = "if0_40148312_Mydatabase";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
