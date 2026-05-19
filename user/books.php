<?php
session_start();

include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

// SEARCH LOGIC
$search = "";

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $sql = "SELECT * FROM books
            WHERE id LIKE '%$search%'
            OR title LIKE '%$search%'
            OR author LIKE '%$search%'";

} else {

    $sql = "SELECT * FROM books";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card">

<h2>Available Books</h2>

<form method="GET">

    <input type="text"
           name="search"
           placeholder="Search by ID, title or author"
           value="<?php echo $search; ?>">

    <button type="submit">
        Search
    </button>

</form>

<br>

<?php if($result->num_rows > 0){ ?>

<table>

<tr>
    <th>Title</th>
    <th>Author</th>
    <th>Category</th>
    <th>Action</th>
</tr>

<?php while($book = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $book['title']; ?></td>

    <td><?php echo $book['author']; ?></td>

    <td><?php echo $book['category']; ?></td>

    <td>
        <a href="borrow_book.php?id=<?php echo $book['id']; ?>">
            Borrow
        </a>
    </td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<h3 class="error">No results found</h3>

<?php } ?>

</div>
</div>

</body>
</html>