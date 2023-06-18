<!DOCTYPE html>
<html>
<head>
    <title>Delete Information</title>
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
            display: inline;
        }

        .menu {
            margin-bottom: 20px;
        }

        .menu a {
            margin-right: 10px;
            color: #333;
            text-decoration: none;
            background-color: #ddd;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .menu a:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <h1>Delete Information</h1>

    <div class="menu">
        <a href="insert.php">Insert Information</a>
        <a href="edit.php">Edit Information</a>
        <a href="calculate_supplier_payment.php">Calculate Supplier Payments</a>
    </div>

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
        // Check if the delete button is clicked
        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $type = $_POST['type'];

            switch ($type) {
                case 'client':
                    $table = 'clients';
                    break;
                case 'supplier':
                    $table = 'suppliers';
                    break;
                case 'guard':
                    $table = 'guards';
                    break;
                default:
                    echo "Invalid input type!";
                    break;
            }

            // Delete the record from the database
            $sql = "DELETE FROM $table WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }
    }

    // Retrieve the existing records from the database
    $sql = "SELECT id, 'client' AS type, name FROM clients 
            UNION SELECT id, 'supplier' AS type, name FROM suppliers 
            UNION SELECT id, 'guard' AS type, name FROM guards";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if any records are found
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Type</th><th>Name</th><th>Delete</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $type = $row['type'];
                $name = $row['name'];

                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$type</td>";
                echo "<td>$name</td>";
                echo "<td>
                        <form method='POST' action='delete.php'>
                            <input type='hidden' name='id' value='$id'>
                            <input type='hidden' name='type' value='$type'>
                            <input type='submit' name='delete' value='Delete'>
                        </form>
                    </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }
    } else {
        echo "Error retrieving records: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>

