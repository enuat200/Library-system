<?php
session_start();

include "../config/db.php";

// Restrict access: Only logged-in users with the 'admin' role can proceed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>
            Access denied! Admins only.
          </h2>";

    header("refresh:3;url=../auth/login.php");

    exit();
}
$id = $_GET['id'];

$sql = "DELETE FROM books WHERE id=$id";

if($conn->query($sql)){
    header("Location: view_books.php");
}
?>