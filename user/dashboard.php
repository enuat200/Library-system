<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="dashboard-card">

        <h1>
            Welcome <?php echo $_SESSION['user_name']; ?> 
        </h1>

        <p>
            You are logged in successfully.
        </p>

        <h3>User Features</h3>

       <ul>

    <li>
        <a href="books.php">
            View available books
        </a>
    </li>

    <li>
        <a href="borrow_book.php">
             Borrow books
        </a>
    </li>

    <li>
        <a href="my_books.php">
            Return books
        </a>
    </li>

    <li>
        <a href="my_books.php">
            My borrowed books
        </a>
    </li>

</ul>

    </div>

</div>

</body>
</html>