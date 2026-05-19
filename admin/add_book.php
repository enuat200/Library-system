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

$message = "";

if(isset($_POST['add_book'])){

    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    $sql = "INSERT INTO books(title, author, category)
            VALUES('$title', '$author', '$category')";

    if($conn->query($sql)){
        $message = "Book Added Successfully 🚀";
    } else {
        $message = "Failed to Add Book!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
<link rel="stylesheet" href="../assets/style.css">
    

</head>

<body>
    <?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card small-card">

    <h2>Add Book</h2>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <input type="text"
               name="title"
               placeholder="Book Title"
               required>

        <input type="text"
               name="author"
               placeholder="Author Name"
               required>

        <input type="text"
               name="category"
               placeholder="Category"
               required>

        <button type="submit" name="add_book">
            Add Book
        </button>

    </form>

</div>
</div>

</body>
</html>