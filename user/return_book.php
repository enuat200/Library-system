<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$borrow_id = $_GET['id'];

// update only if it belongs to this user and is still borrowed
$sql = "UPDATE borrowed_books 
        SET status='returned',
            return_date=CURDATE()
        WHERE id=$borrow_id 
        AND user_id=$user_id 
        AND status='borrowed'";

if($conn->query($sql)){
    header("Location: my_books.php");
} else {
    echo "Failed to return book!";
}
?>