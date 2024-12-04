<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalnew";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['doctor_username'])) {
    // Redirect to doctor dashboard if already logged in
    header("Location: doctor_dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $sql = "SELECT * FROM doctors WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['doctor_username'] = $username;
        header("Location: doctor_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        /* Your CSS styles here */
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.container {
    max-width: 400px;
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

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
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
<div class="logo">
		<div>
			<table>
				<tr>
					<td width="600px" style="font-size:50px;font-family:forte;"> <font color="#428bca"> life line  </font><font color="#000"> Hospital</font> </td>
					<td> <br> <br>
						<div class="navbar">
							<font size="4px"> 
								<a href="index.html">
									<i class="fa-solid fa-house"></i>HOME</a> 
								<a href="about.html">
									<i class="fa-solid fa-address-card"></i>ABOUT US</a>  
								<a href="service.html">
									<i class="fa-solid fa-hospital"></i>SERVICE</a>
								 <!-- <a href="doctor.html">
								<i class="fa-solid fa-user-doctor"></i>DOCTORS</a>  -->
								<a href="contact.html"> 
								<i class="fa-solid fa-address-book"></i>CONTACT US</a>
								<a href="patientlogin.html">
								<i class="fa-solid fa-address-book"></i>LogIn
								</a>
                                <a href="doctor_login.php">
									<i class="fa-solid fa-address-book"></i>DoctorLogIn
									</a>
		  </li>
									
							</font>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
    <div class="container">
        <h2>Doctor Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
        <?php
        if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
    </div>
</body>

</html>
