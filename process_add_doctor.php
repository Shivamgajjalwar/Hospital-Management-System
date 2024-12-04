<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalnew";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $specializations = implode(',', $_POST['specialization']); // Convert array to comma-separated string
    $fees = $_POST['fees'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $name = mysqli_real_escape_string($connection, $name);
    $specializations = mysqli_real_escape_string($connection, $specializations);
    $fees = mysqli_real_escape_string($connection, $fees);
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $sql = "INSERT INTO doctors (name, specialization, fees, username, password) VALUES ('$name', '$specializations', '$fees', '$username', '$password')";
    if (mysqli_query($connection, $sql)) {
        echo "Doctor added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>
