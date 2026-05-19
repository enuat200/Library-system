<?php
include "../config/db.php";

$message = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if($result->num_rows > 0){

        $message = "Email already exists!";

    } else {

        $sql = "INSERT INTO users(name, email, password)
                VALUES('$name', '$email', '$password')";

        if($conn->query($sql)){

            $message = "Registration Successful 🚀";

        } else {

            $message = "Something went wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<div class="auth-page">

    <div class="auth-card">

        <h2>Register</h2>

        <p class="error">
            <?php echo $message; ?>
        </p>

        <form method="POST">

            <input type="text"
                   name="name"
                   placeholder="Full Name"
                   required>

            <input type="email"
                   name="email"
                   placeholder="Enter Email"
                   required>

            <input type="password"
                   name="password"
                   placeholder="Enter Password"
                   required>

            <button type="submit" name="register">
                Register
            </button>

        </form>

    </div>

</div>

</body>
</html>