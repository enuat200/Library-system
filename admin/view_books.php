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

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card">

<h2>All Books</h2>

<table>

<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Author</th>
    <th>Category</th>
    <th>Action</th>
</tr>

<?php while($book = $result->fetch_assoc()) { ?>

<tr>
    <td><?php echo $book['id']; ?></td>

    <td><?php echo $book['title']; ?></td>

    <td><?php echo $book['author']; ?></td>

    <td><?php echo $book['category']; ?></td>

    <td>
        <a href="edit_book.php?id=<?php echo $book['id']; ?>">
            Edit
        </a>

        |

        <a href="delete_book.php?id=<?php echo $book['id']; ?>"
           onclick="return confirm('Are you sure?')">
            Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>