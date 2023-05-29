<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'rihlate';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST['comment'])) {
  // Retrieve the comment data from the Ajax request
  $date = date('Y-m-d');
  $time = time();
  $content = $_POST['comment'];
  $rating = $_POST['rating'];

  // Set the user_id and travel_plan_id based on your logic
  $user_id =$_SESSION['user_id']; // Replace with your own logic to get the user ID
  $travel_plan_id = $_GET['id'] ?? null; // Replace with your own logic to get the travel plan ID

  // Prepare the SQL statement with placeholders
  $query = "INSERT INTO comment (date, time, content, user_id, travel_plan_id, rating) VALUES (?, ?, ?, ?, ?, ?)";

  // Create a prepared statement
  $stmt = $conn->prepare($query);

  // Bind the parameters to the prepared statement
  $stmt->bind_param("sisiii", $date, $time, $content, $user_id, $travel_plan_id, $rating);

  // Execute the prepared statement
  if ($stmt->execute()) {
    $response = array('success' => true);
  } else {
    $response = array('success' => false, 'message' => 'Failed to insert comment into the database.');
  }

  // Send the JSON response back to the Ajax request
  header('Content-Type: application/json');
  echo json_encode($response);

  // Close the prepared statement and database connection
  $stmt->close();
  $conn->close();
}
?>
