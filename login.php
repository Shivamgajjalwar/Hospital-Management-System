<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, password FROM table2 WHERE username=?");
    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password_from_db = $row['password'];
        if (password_verify($password, $hashed_password_from_db)) {
            // Password is correct, start a session and store user_id
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password";
        }
    } else {
        // Username not found
        echo "User not found";
    }
    $stmt->close();
}
?>
