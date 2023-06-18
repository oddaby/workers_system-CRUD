<!DOCTYPE html>
<html>
<head>
    <title>Record Guard Attendance</title>
    <style>
        /* Custom CSS styles */
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

        .menu {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select, input[type="submit"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="calculate_client_payment.php">Calculate Client Payments</a>
        <a href="calculate_supplier_payment.php">Calculate Supplier Payments</a>
        <a href="delete.php">Delete Information</a>
    </div>

    <h1>Record Guard Attendance</h1>

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

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $guardId = $_POST['guard'];
        $attendanceDate = $_POST['attendance_date'];

        // Insert the attendance record into the database
        $sql = "INSERT INTO guard_attendance (guard_id, attendance_date) VALUES ('$guardId', '$attendanceDate')";
        if (mysqli_query($conn, $sql)) {
            echo "Guard attendance recorded successfully";
        } else {
            echo "Error recording guard attendance: " . mysqli_error($conn);
        }
    }

    // Retrieve the list of guards
    $sql = "SELECT id, name FROM guards";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if any records are found
        if (mysqli_num_rows($result) > 0) {
            echo "<form method='POST' action='record_attendance.php'>";
            echo "<label for='guard'>Select Guard:</label>";
            echo "<select name='guard' id='guard'>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                echo "<option value='$id'>$name</option>";
            }

            echo "</select>";
            echo "<label for='attendance_date'>Attendance Date:</label>";
            echo "<input type='date' name='attendance_date' id='attendance_date'>";
            echo "<input type='submit' value='Record Attendance'>";
            echo "</form>";
        } else {
            echo "No guards found";
        }
    } else {
        echo "Error retrieving guards: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
