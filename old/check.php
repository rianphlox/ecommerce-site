<?php
require 'config/db.php';

$username = $_POST["name"];
$password = $_POST["password"];

$query = "SELECT id FROM users WHERE username = ? AND password = ?";

$stmt = mysqli_stmt_init($conn);
if ($stmt = mysqli_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    mysqli_stmt_execute($stmt);
   // $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);
    if ($rows > 0) {
        echo "Success";
        header("Location: blog");
    } else {
        echo "Incorrect username or password";
    }
}
?>