<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="date"],
        input[type="time"],
        select,
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h2>Book Appointment</h2>
    <form action="process_booking.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="doctor">Select Doctor:</label>
        <select id="doctor" name="doctor" required>
            <?php
            // Establish a database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hospitalnew";
            $connection = new mysqli($servername, $username, $password, $dbname);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Prepare and execute the query to retrieve the list of doctors
            $stmt = $connection->prepare("SELECT name, specialization, fees FROM doctors");
            $stmt->execute();
            $result = $stmt->get_result();

            // Display the list of doctors in the dropdown
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row["name"]) . '">' . htmlspecialchars($row["name"]) . ' - ' . htmlspecialchars($row["specialization"]) . ' - Fees: ' . htmlspecialchars($row["fees"]) . '</option>';
                }
            }

            // Close the database connection
            $stmt->close();
            $connection->close();
            ?>
        </select>

        <input type="submit" value="Book Appointment">
    </form>
</body>

</html>
