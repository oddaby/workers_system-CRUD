<?php
// Replace with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assino";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $name = $_POST['name'];
    $salary = $_POST['salary'];



    switch ($type) {

        case 'client':
            $sql = "INSERT INTO clients (name,amount) VALUES ('$name','$salary')";
            if (mysqli_query($conn, $sql)) {
                echo "New client record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        case 'supplier':
            $sql = "INSERT INTO suppliers (name,amount) VALUES ('$name','$salary')";
            if (mysqli_query($conn, $sql)) {
                echo "New supplier record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        case 'guard':
            $salary = $_POST['salary'];
            $sql = "INSERT INTO guards (name, salary) VALUES ('$name', '$salary')";
            if (mysqli_query($conn, $sql)) {
                echo "New guard record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        default:
            echo "Invalid input type!";
            break;
    }

    // Add appropriate success/error messages and redirection as per your requirements
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        select,
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #555;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='12' viewBox='0 0 16 12'%3E%3Cpath fill='%23333' fill-rule='evenodd' d='M8 12l8-10H0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            padding-right: 30px;
            background-color: #fff;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .menu {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<h1>Insert Information</h1>
<div class="menu">
    <a href="calculate_client_payment.php">Calculate Client Payments</a>
    <a href="calculate_supplier_payment.php">Calculate Supplier Payments</a>
    <a href="delete.php">Delete Information</a>
</div>

<form method="POST" action="insert.php">
    <label for="type">Select Type:</label>
    <select name="type" id="type">
        <option value="client">Client</option>
        <option value="supplier">Supplier</option>
        <option value="guard">Guard</option>
    </select>

    <br><br>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br><br>

    <label for="salary">Salary:</label>
    <input type="number" name="salary" id="salary" step="0.01">
    <br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
