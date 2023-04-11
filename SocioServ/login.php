<?php
$host = 'localhost';
$dbname = 'users';
$username = 'root';
$password = '';

// establish a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// start the session and include the login processing logic
session_start();
require_once 'login_process.php';

// if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query the database for the user with the given username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // if the user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['usertype']; // add this line to store the user's usertype in the session

        // redirect to the appropriate page based on the user's usertype
        if ($user['usertype'] == 'admin') {
            header('Location: admin.php');
            exit();
        } elseif ($user['usertype'] == 'volunteer') {
            header('Location: volunteer.php');
            exit();
        } else {
            $error_msg = "Invalid usertype";
        }
    } else {
        $error_msg = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="signup.css">

    
</head>
<body>

    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Log In">

        <?php if (isset($error_msg)): ?>
        <p><?php echo $error_msg; ?></p>
    <?php endif; ?>
</form>

    
</body>
</html>
