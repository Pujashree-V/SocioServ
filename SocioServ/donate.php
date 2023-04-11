<!DOCTYPE html>
<html>
<head>
	<title>Donate to Our Cause</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
		}
		.container {
			width: 80%;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ddd;
			box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
		}
		h1, h2 {
			text-align: center;
			color: #444;
			margin: 0;
			padding: 10px 0;
		}
		form {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			margin-top: 20px;
			padding: 20px;
			background-color: #eee;
			border: 1px solid #ddd;
		}
		label {
			display: block;
			width: 100%;
			margin-bottom: 5px;
			color: #444;
		}
		input[type="text"], input[type="email"], select, textarea {
			display: block;
			width: 100%;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 3px;
			margin-bottom: 20px;
			box-sizing: border-box;
			font-size: 16px;
			color: #444;
		}
		select {
			color: #444;
		}
		textarea {
			height: 150px;
		}
		input[type="submit"] {
			display: block;
			width: 100%;
			padding: 10px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 3px;
			font-size: 18px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		footer {
			text-align: center;
			padding: 10px;
			background-color: #444;
			color: #fff;
		}
	</style>
</head>
<body>

	<div class="container">
		<h1>Donate to Our Cause</h1>
		<p>Thank you for considering a donation to our organization. Your support helps us continue to make a difference in our community.</p>
		<form method="post" action="donate.php">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
			<label for="amount">Amount:</label>
            <input type="text" name="amount" required>
			<label for="text">Payment Method:</label>
            <select id="payment method" name="payment method" required>
				<option value="">-- Select the method --</option>
				<option>UPI</option>
				<option>BHIM</option>
				<option>RuPay</option>
			</select>
			<label for="message">Message:</label>
			<textarea id="message" name="message"></textarea>
			<input type="submit" value="Donate Now">

		</form>
	</div>
</body>
</html>
