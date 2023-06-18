<!DOCTYPE html>
<html>
<head>
    <title>Generate Reports</title>
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
    <h1>Generate Reports</h1>

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

    // Generate Guard Attendance Report
    $sqlAttendance = "SELECT g.name AS guard_name, a.attendance_date, a.status
                      FROM guards g
                      LEFT JOIN guard_attendance a ON g.id = a.guard_id";

    $resultAttendance = mysqli_query($conn, $sqlAttendance);

    if ($resultAttendance && mysqli_num_rows($resultAttendance) > 0) {
        echo "<h2>Guard Attendance Report</h2>";
        echo "<table>";
        echo "<tr><th>Guard Name</th><th>Attendance Date</th><th>Status</th></tr>";

        while ($row = mysqli_fetch_assoc($resultAttendance)) {
            $guardName = $row['guard_name'];
            $attendanceDate = $row['attendance_date'];
            $status = $row['status'];

            echo "<tr>";
            echo "<td>$guardName</td>";
            echo "<td>$attendanceDate</td>";
            echo "<td>$status</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found for guard attendance.</p>";
    }

    // Generate Total Expenditure Report
    // Generate Total Expenditure Report
$sqlExpenditure = "SELECT 'Client' AS type, name, amount
FROM clients

UNION

SELECT 'Supplier' AS type, name, amount
FROM suppliers";

$resultExpenditure = mysqli_query($conn, $sqlExpenditure);

$totalExpenditure = 0; // Initialize total expenditure variable

if ($resultExpenditure && mysqli_num_rows($resultExpenditure) > 0) {
echo "<h2>Total Expenditure Report</h2>";
echo "<table>";
echo "<tr><th>Type</th><th>Name</th><th>Amount</th></tr>";

while ($row = mysqli_fetch_assoc($resultExpenditure)) {
$type = $row['type'];
$name = $row['name'];
$amount = $row['amount'];

$totalExpenditure += $amount; // Add current amount to total expenditure

echo "<tr>";
echo "<td>$type</td>";
echo "<td>$name</td>";
echo "<td>$amount</td>";
echo "</tr>";
}

echo "<tr><td colspan='2'><strong>Total Expenditure</strong></td><td><strong>$totalExpenditure</strong></td></tr>";
echo "</table>";
} else {
echo "<p>No records found for total expenditure.</p>";
}


    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
