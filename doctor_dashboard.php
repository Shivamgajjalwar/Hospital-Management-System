<?php
session_start();

if (!isset($_SESSION['doctor_username'])) {
    header("Location: doctor_login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalnew";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$doctor_username = $_SESSION['doctor_username'];

$sql = "SELECT * FROM appointments WHERE doctor_username='$doctor_username'";
$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <style>
        /* Your CSS styles here */
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
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 8px;
    border: 1px solid #ccc;
    text-align: left;
}

table th {
    background-color: #f0f0f0;
}

a {
    display: block;
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
        <h2>Doctor Dashboard</h2>
        <h3>Appointments</h3>
        <table>
            <tr>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['patient_name'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <a href="doctor_logout.php">Logout</a>
    </div>
</body>

</html>

<?php
mysqli_close($connection);
?>
