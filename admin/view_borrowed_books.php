<?php
session_start();

include "../config/db.php";

// Only admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>
            Access denied! Admins only.
          </h2>";

    header("refresh:3;url=../auth/login.php");

    exit();
}

$sql = "SELECT borrowed_books.*, books.title
        FROM borrowed_books
        JOIN books ON borrowed_books.book_id = books.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrowed Books</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card">

<h2>Borrowed Books</h2>

<table>

<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Book</th>
    <th>Borrow Date</th>
    <th>Due Date</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['borrower_name']; ?></td>

    <td><?php echo $row['phone']; ?></td>

    <td><?php echo $row['title']; ?></td>

    <td><?php echo $row['borrow_date']; ?></td>

    <td><?php echo $row['due_date']; ?></td>

    <td>
        <?php
        if($row['status'] == 'borrowed'){
            echo "<span class='borrowed'>Borrowed</span>";
        } else {
            echo "<span class='returned'>Returned</span>";
        }
        ?>
    </td>

</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>