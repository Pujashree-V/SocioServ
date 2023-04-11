<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">

</head>
<body>

	<h1>Sign Up</h1>
	<form action="signup_process.php" method="POST">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
	<input type="password" id="password" name="password" required><br><br>

	<label for="usertype">Sign Up As:</label>
	<select id="usertype" name="usertype">
		<option value="admin">Admin</option>
		<option value="volunteer">Volunteer</option>
	</select><br><br>

	<input type="submit" value="Sign Up">
</form>
</body>
</html>

