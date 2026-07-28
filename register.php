<!DOCTYPE html>
<html>

<head>

<title>User Registration</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<h2>User Registration</h2>

<form action="register_process.php" method="POST">

<label>Full Name</label><br>

<input type="text" name="fullname" required><br><br>

<label>Email Address</label><br>

<input type="email" name="email" required><br><br>

<label>Password</label><br>

<input type="password" name="password" required><br><br>

<label>Confirm Password</label><br>

<input type="password" name="confirm_password" required><br><br>

<input type="submit" value="Register">

</form>

<br>

Already have an account?

<a href="login.php">Login</a>

</body>

</html>