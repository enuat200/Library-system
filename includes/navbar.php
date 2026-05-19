<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<div class="navbar">

    <h2>Library System</h2>

    <div>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>

            <a href="../admin/dashboard.php">Admin Dashboard</a>
            <a href="../admin/add_book.php">Add Book</a>   
            <a href="../admin/view_books.php">View Books</a>
            <a href="../admin/view_borrowed_books.php">Borrowed Books</a>

        <?php } ?>


        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'){ ?>

            <a href="../user/books.php">Available Books</a>
            <a href="../user/dashboard.php">User Dashboard</a>

        <?php } ?>
        <a href="../auth/logout.php">Logout</a>

    </div>

</div>