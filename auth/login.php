<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../config/db.php';

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if(empty($email) || empty($password)){
        $message = "Email and password are required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "Please enter a valid email address.";
    } else {
        $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");

        if(!$stmt){
            error_log('Login prepare failed: ' . $conn->error);
            $message = "Database error. Please try again later.";
        } else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result && $result->num_rows > 0){
                $user = $result->fetch_assoc();

                if(password_verify($password, $user['password'])){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['role'] = $user['role'];

                    if($user['role'] === 'admin'){
                        header("Location: /admin/dashboard.php");
                    } else {
                        header("Location: /user/dashboard.php");
                    }

                    exit();
                } else {
                    $message = "Wrong password!";
                }
            } else {
                $message = "Email not found!";
            }

            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<div class="auth-page">

    <div class="auth-card">
        <h2>Login</h2>

        <?php if(!empty($message)): ?>
            <p class="error"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="/auth/login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>

    </div>

</div>
</body>
</html>