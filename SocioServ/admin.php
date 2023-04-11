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



// start the session and check if the user is logged in as an admin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

// handle form submission for adding a new task
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];

    // insert the new task into the database
    $stmt = $pdo->prepare("INSERT INTO tasks (task_name, task_description) VALUES (?, ?)");
    $stmt->execute([$task_name, $task_description]);
}

// retrieve the tasks from the database, including the name of the volunteer who has chosen to complete the task
$stmt = $pdo->prepare("SELECT tasks.*, users.name AS volunteer_name FROM tasks LEFT JOIN users ON tasks.volunteer_id = users.id");
$stmt->execute();
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
   


</head>
<body>

    <h1>Admin Panel</h1>

    <h2>Add a new task</h2>
    <form method="POST">
        <label for="task_name">Task Name:</label>
        <input type="text" id="task_name" name="task_name" required><br><br>

        <label for="task_description">Task Description:</label>
        <input type="text" id="task_description" name="task_description" required><br><br>

        <input type="submit" value="Add Task">
    </form>

    <h2>Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Volunteer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['task_name']; ?></td>
                    <td><?php echo $task['task_description']; ?></td>
                    <td><?php echo $task['volunteer_id'] ?? 'Unassigned'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
