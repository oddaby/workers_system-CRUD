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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert the user registration data into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === true) {
        echo "Registration successful";
        // You can redirect the user to a dashboard or home page here if needed
        header("Location: login.html");
        exit(); // Important: Terminate the current script to ensure the redirect happens
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>