
<?php
// Check if a session is already started
if (session_status() == PHP_SESSION_NONE) {
    // Check if the form was submitted with a username and password
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Filter the input values for security
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        // Connect to the database
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "users";

        $conn = mysqli_connect($host, $user, $pass, $dbname);

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the query to find a matching user
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the query was successful
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Check if a matching user was found
        if (mysqli_num_rows($result) == 1) {
            // Get the user's information
            $row = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Store the user ID in the session
                session_start();
                $_SESSION['user_id'] = $row['id'];

                // Redirect to the appropriate page based on usertype
                if ($row['usertype'] == 'admin') {
                    header('Location: admin.php');
                    exit;
                } elseif ($row['usertype'] == 'volunteer') {
                    header('Location: volunteer.php');
                    exit;
                }
            } else {
                // If the password is incorrect, show an error message
                $error_msg = "Invalid username or password.";
            }
        } else {
            // If the username is incorrect, show an error message
            $error_msg = "Invalid username or password.";
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If the form was not submitted with a username and password, set an error message
        $error_msg = "Please";
}
}
?>