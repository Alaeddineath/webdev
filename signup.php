<?php
session_start();

// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rihlate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = '';

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert the user data into the database
    $sql = "INSERT INTO user (firstName, lastName, email, phoneNumber, password) VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$password')";
    if (mysqli_query($conn, $sql)) {
        // Set session variable and redirect to loggedindex.php
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        header('Location: loggedindex.php');
        exit();
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/signup.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h1><a href="index.php">RIHLAT-e</a></h1>
    </div>
    <div class="container">
        <h1> Sign Up</h1>
        <form method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="submit">Sign Up</button>
            <?php if ($error_message !== '') { ?>
                <div class="error-message">
                    <?php echo '<h1>' . $error_message . '</h1>'; ?>
                </div>
            <?php } ?>
        </form>
    </div>
</body>
</html>
