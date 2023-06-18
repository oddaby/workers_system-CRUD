<!DOCTYPE html>
<html>
<head>
    <title>Calculate Client Payments</title>
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
    </style>
</head>
<body>
    <h1>Calculate Client Payments</h1>

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

    // Fetch clients with their total payment amounts
    $sql = "SELECT id,name,amount FROM clients";

    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if any records are found
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Amount</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $totalPayment = $row['amount'];

                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$name</td>";
                echo "<td>$totalPayment</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found for total payment.";
        }
    } else {
        echo "Error retrieving records: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
