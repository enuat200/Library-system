<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="dashboard-card">

        <h1>
            Welcome Admin <?php echo $_SESSION['user_name']; ?> 
        </h1>

        <p>
            Manage your library system efficiently.
        </p>

        <h3>Admin Features</h3>
    <ul>
          <li><a href="add_book.php">Add book</a></li>
        <li><a href="view_books.php">View books</a></li>
        <li><a href="view_borrowed_books.php">Borrowed Books</a></li>
    </ul>


    </div>

</div>

</body>
</html>