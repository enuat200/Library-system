<?php
session_start();

include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT b.id,
               bo.title,
               b.borrow_date,
               b.due_date,
               b.return_date,
               b.status
        FROM borrowed_books b
        JOIN books bo ON b.book_id = bo.id
        WHERE b.user_id = $user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Borrowed Books</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<div class="dashboard-page">

    <div class="table-card">

<h2>My Borrowed Books</h2>

<table>

<tr>
    <th>Book</th>
    <th>Borrow Date</th>
    <th>Due Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['title']; ?></td>

    <td><?php echo $row['borrow_date']; ?></td>

    <td><?php echo $row['due_date']; ?></td>

    <td>

        <?php
        if($row['status'] == 'borrowed'){

            if(strtotime($row['due_date']) < time()){

                echo "<span class='overdue'>Overdue</span>";

            } else {

                echo "<span class='borrowed'>Borrowed</span>";
            }

        } else {

            echo "<span class='returned'>Returned</span>";
        }
        ?>

    </td>

    <td>

        <?php if($row['status'] == 'borrowed') { ?>

            <a href="return_book.php?id=<?php echo $row['id']; ?>">
                Return Book
            </a>

        <?php } else { ?>

            Returned

        <?php } ?>

    </td>

</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>