<?php
// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];

// Connect to the database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "users";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$sql = "INSERT INTO users (username, password, usertype) VALUES ('$username', '$hashed_password', '$usertype')";

if (mysqli_query($conn, $sql)) {
    // Redirect to the appropriate page based on the user's choice
    if ($usertype == 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: volunteer.php');
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
