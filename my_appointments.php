<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    // Handle the case where user_id is not set in session
    echo "User ID is not set in session.";
    exit();
}

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalnew";
$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Using prepared statements to prevent SQL injection
$query = $connection->prepare("SELECT patient_name, date, time, doctor_name FROM appointments WHERE user_id = ?");
$query->bind_param("i", $user_id);

$query->execute();
$result = $query->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            background-color: #f0f0f0;
        }

        a {
            display: inline-block;
            text-align: center;
            padding: 8px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            width: 100px;
            margin: 0 auto;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>My Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['patient_name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                        echo "<td>" . $row['doctor_name'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No appointments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Close the database connection
$query->close();
$connection->close();
?>
