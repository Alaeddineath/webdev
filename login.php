<?php
session_start();
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rihlate";
$error_message = '';

if (isset($_POST['login'])) {
    $conn = mysqli_connect("localhost", "root", "", "rihlate");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        // Set session variable and redirect to loggedindex.php
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        header('Location: loggedindex.php');
        exit;
    } else {
        $error_message = "Invalid email or password.";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
     <h1><a href="index.php">RIHLAT-e</a></h1>
 </div>
    <div class="container">
        <form method="post">
            <h1> Log In</h1>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="login">Login</button>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>
        <?php if ($error_message !== '') { ?>
            <div class="error-message">
                <?php echo '<h1>' . $error_message . '</h1>'; ?>
            </div>

        <?php } ?>
    </div>
</body>
</html>
