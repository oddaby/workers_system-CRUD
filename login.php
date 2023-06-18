<?php
// Assuming you have a MySQL database set up with appropriate credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assino";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the submitted form data
$email = $_POST['email'];
$password = $_POST['password'];

// Validate user credentials
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login successful
    // Redirect the user to the dashboard
    header("Location: dashboard.html");
    exit(); // Important: Terminate the current script to ensure the redirect happens
} else {
    echo "Invalid email or password";
}

// Close the database connection
$conn->close();
?>
