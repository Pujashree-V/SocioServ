<?php
$host = 'localhost';
$dbname = 'users';
$username = 'root';
$password = '';

// establish a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}


// start the session and include the login processing logic
session_start();
require_once 'login_process.php';
$sql = "SELECT tasks.task_id, tasks.task_name, tasks.task_description, tasks.admin_id, tasks.volunteer_id, tasks.status, users.name AS admin_name FROM tasks LEFT JOIN users ON tasks.admin_id = users.user_id WHERE tasks.volunteer_id IS NULL AND tasks.status='open'";


// if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['task_id']) && !empty($_POST['task_id'])) {
        $task_id = $_POST['task_id'];

        // update the task's status and volunteer_id in the database
        $stmt = $pdo->prepare("UPDATE tasks SET status = 'assigned', volunteer_id = ? WHERE id = ?");
        $stmt->execute([$_SESSION['user_id'], $task_id]);

        // redirect to the volunteer page
        header('Location: volunteer.php');
        exit();
    }
}

// retrieve the tasks from the database
$stmt = $pdo->prepare("SELECT * FROM tasks");
$stmt->execute();
$tasks = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Tasks</title>
    <link rel="stylesheet" href="admin.css">
    



</head>
<body>
    <h1>Volunteer Tasks</h1>
    <p>Your volunteer ID is: <?php echo $_SESSION['user_id']; ?></p>

    

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Choose</th>
                <th>Volunteer ID</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['task_name']; ?></td>
                    <td><?php echo $task['task_description']; ?></td>
                    
                    <td>
                        <form method="POST">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit">Choose</button>
                        </form>
                        <td><?php echo $task['volunteer_id']; ?></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
