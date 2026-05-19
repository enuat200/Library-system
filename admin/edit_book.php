<?php
session_start();

include "../config/db.php";

// Restrict access: Only admins allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>
            Access denied! Admins only.
          </h2>";

    header("refresh:3;url=../auth/login.php");

    exit();
}

// Get book ID safely
$id = intval($_GET['id']);

// Get book data
$sql = "SELECT * FROM books WHERE id=$id";
$result = $conn->query($sql);
$book = $result->fetch_assoc();

$message = "";

// Update book
if(isset($_POST['update_book'])){

    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    $update = "UPDATE books
               SET title='$title',
                   author='$author',
                   category='$category'
               WHERE id=$id";

    if($conn->query($update)){
        header("Location: view_books.php");
        exit();
    } else {
        $message = "Update Failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card small-card">

    <h2>Edit Book</h2>

    <p class="error"><?php echo $message; ?></p>

    <form method="POST">

        <input type="text"
               name="title"
               value="<?php echo $book['title']; ?>"
               required>

        <input type="text"
               name="author"
               value="<?php echo $book['author']; ?>"
               required>

        <input type="text"
               name="category"
               value="<?php echo $book['category']; ?>"
               required>

        <button type="submit" name="update_book">
            Update Book
        </button>

    </form>
</div>

</div>

</body>
</html>