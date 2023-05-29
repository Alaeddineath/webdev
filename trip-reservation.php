<!DOCTYPE html>
<html>
<head>
    <title>Reserve a Trip</title>
    <link href="assets/css/signup.css" rel="stylesheet" type="text/css" >
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="assets/css/signup.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h1><a href="index.html">RIHLAT-e</a></h1>
    </div>
    <div class="container">
        <h1> Reserve a Trip</h1>
        <form method="post">
            <label>Is the transport included?</label>
            <label><input type="radio" name="transport" value="yes" checked> Yes</label>
            <label><input type="radio" name="transport" value="no"> No</label><br>
            <input type="hidden" name="travel_id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" name="submit">Reserve Now</button>
        </form>
    </div>
    <?php
    session_start();

    // Check if the form was submitted
    if (isset($_POST['submit'])) {
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

        // Retrieve the form data
        $transport = $_POST['transport'];
        $travel_id = $_POST['travel_id'];
        $user_id = $_SESSION['user_id'];

        // Insert the reservation data into the database
        $sql = "INSERT INTO reservation (user_ID, travel_plan_id, reservation_id, reservation_date, transport)
                VALUES ('$user_id', '$travel_id', '', CURRENT_DATE, '$transport')";

        if (mysqli_query($conn, $sql)) {
            // Reservation successful
            echo "Reservation successful!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</body>
</html>
