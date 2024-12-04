<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $doctor = $_POST['doctor'];

    // Retrieve the doctor's username from the doctors table
    $stmt = $conn->prepare("SELECT username FROM doctors WHERE name = ?");
    $stmt->bind_param("s", $doctor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $doctor_username = $row['username'];

        // Check if user_id is set in session
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("INSERT INTO appointments (user_id, patient_name, doctor_name, doctor_username, date, time) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $user_id, $_SESSION['username'], $doctor, $doctor_username, $date, $time);

            if (!$stmt->execute()) {
                die("Error executing query: " . $stmt->error);
            }

            $_SESSION['message'] = "Appointment booked successfully!";
            header("Location: dashboard.php");
            exit();
        } else {
            // Handle the case where $_SESSION['user_id'] is not set
            echo "User ID is not set in session.";
        }
    } else {
        echo "Doctor not found.";
    }
}
?>
