
<nav>
    <ul>
      <li><a href="insert.php">Insert Data</a></li>
      <li><a href="edit.php">Edit Data</a></li>
      <li><a href="delete.php">Delete Data</a></li>
      <li><a href="calculate_payment.php">Calculate Client Payments</a></li>
      <li><a href="calculate_supplier_payment.php">Calculate Supplier Payments</a></li>
      <li><a href="calculate_guard_salary.php">Calculate Guard Salaries</a></li>
      <li><a href="record_attendance.php">Record Guard Attendance</a></li>
      <li><a href="generate_reports.php">Generate Reports</a></li>
    </ul>
  </nav>

  <h1>Edit Information</h1>
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
    $id = $_POST['id'];
    $type = $_POST['type'];
    $name = $_POST['name'];

    switch ($type) {
        case 'client':
            $sql = "UPDATE clients SET name = '$name' WHERE id = $id";
            break;
        case 'supplier':
            $sql = "UPDATE suppliers SET name = '$name' WHERE id = $id";
            break;
        case 'guard':
            $salary = $_POST['salary'];
            $sql = "UPDATE guards SET name = '$name', salary = $salary WHERE id = $id";
            break;
        default:
            echo "Invalid input type!";
            break;
    }

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Retrieve the existing records from the database
$sql = "SELECT id, 'client' AS type, name FROM clients UNION SELECT id, 'supplier' AS type, name FROM suppliers UNION SELECT id, 'guard' AS type, name FROM guards";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Check if any records are found
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Type</th><th>Name</th><th>Edit</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $type = $row['type'];
            $name = $row['name'];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$type</td>";
            echo "<td>$name</td>";
            echo "<td><a href='edit.php?id=$id&type=$type'>Edit</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }
} else {
    echo "Error retrieving records: " . mysqli_error($conn);
}

// Close the result set
mysqli_free_result($result);

// Close the database connection
//mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Information</title>
    <style>

nav{
    margin-top: 40px;
  }
  
  /* Navigation styles */
  nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
  }
  
  nav ul li {
    display: inline-block;
    margin: 10px;
  }
  
  nav ul li a {
    color: #333;
    text-decoration: none;
    padding: 8px 16px;
    border: 1px solid #333;
    border-radius: 4px;
  }
  
  nav ul li a:hover {
    background-color: #333;
    color: #fff;
  }
  
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>


    

    <?php
    // Check if an individual record is selected for editing
    if (isset($_GET['id']) && isset($_GET['type'])) {
        $id = $_GET['id'];
        $type = $_GET['type'];

        // Retrieve the existing data for the selected record
        switch ($type) {
            case 'client':
                $sql = "SELECT * FROM clients WHERE id = $id";
                break;
            case 'supplier':
                $sql = "SELECT * FROM suppliers WHERE id = $id";
                break;
            case 'guard':
                $sql = "SELECT * FROM guards WHERE id = $id";
                break;
            default:
                echo "Invalid input type!";
                break;
        }

        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Check if a record is found
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Display the form to edit the record
                echo "<form method='POST' action='edit.php'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<input type='hidden' name='type' value='$type'>";
                echo "<label for='name'>Name:</label>";
                echo "<input type='text' name='name' id='name' value='" . $row['name'] . "'><br>";

                if ($type === 'guard') {
                    echo "<label for='salary'>Salary:</label>";
                    echo "<input type='number' name='salary' id='salary' value='" . $row['salary'] . "' step='0.01'><br>";
                }

                echo "<input type='submit' value='Update'>";
                echo "</form>";
            } else {
                echo "No record found";
            }
        } else {
            echo "Error retrieving record: " . mysqli_error($conn);
        }

        // Close the result set
        mysqli_free_result($result);
    }
    ?>
</body>
</html>
