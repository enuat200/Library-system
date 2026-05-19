<?php
session_start();

include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = null;
$message = "";

// Check if book ID is provided via GET or POST
if(isset($_GET['id'])){
    $book_id = intval($_GET['id']);
} elseif(isset($_POST['book_id'])){
    $book_id = intval($_POST['book_id']);
}

if(isset($_POST['borrow']) && $book_id !== null){

    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // check if already borrowed
    $check = "SELECT * FROM borrowed_books
              WHERE book_id=$book_id
              AND status='borrowed'";

    $res = $conn->query($check);

    if($res->num_rows > 0){

        $message = "Book already borrowed!";

    } else {

        $due_date = date('Y-m-d', strtotime('+5 days'));

        $sql = "INSERT INTO borrowed_books
                (user_id, book_id, borrower_name, phone,
                 borrow_date, due_date, status)

                VALUES
                ($user_id, $book_id,
                 '$name', '$phone',
                 CURDATE(), '$due_date', 'borrowed')";

        if($conn->query($sql)){

            header("Location: my_books.php");
            exit();

        } else {

            $message = "Failed to borrow book!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrow Book</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card small-card">

<h2>Borrow Book</h2>

<p class="error">
    <?php echo $message; ?>
</p>

<?php if($book_id === null): ?>

<h3>Enter Book ID</h3>

<form method="POST">

    <label>Book ID</label>

    <input type="number"
           name="book_id"
           required
           placeholder="Enter the book ID">

    <button type="submit">
        Continue
    </button>

</form>

<?php else: ?>

<form method="POST">

    <label>Your Name</label>

    <input type="text"
           name="name"
           required>

    <label>Phone Number</label>

    <input type="text"
           name="phone"
           required>

    <button type="submit" name="borrow">
        Borrow Book
    </button>

</form>

<?php endif; ?>

</div>
</div>

</body>
</html>