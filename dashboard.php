<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        a {
            display: block;
            padding: 10px;
            margin: 10px auto;
            max-width: 200px;
            text-align: center;
            text-decoration: none;
            color: #333;
            background-color: #f8f9fa;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>
    <a href="book_appointment.php">Book Appointment</a>
    <a href="my_appointments.php">My Appointments</a>

    <!-- Dashboard content here -->
</body>

</html>

