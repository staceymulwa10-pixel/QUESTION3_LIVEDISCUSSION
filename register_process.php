<?php

include("db.php");

$fullname = trim($_POST['fullname']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($password != $confirm_password){

die("Passwords do not match.");

}

$check = $conn->prepare("SELECT id FROM users WHERE email=?");

$check->bind_param("s",$email);

$check->execute();

$result = $check->get_result();

if($result->num_rows > 0){

die("Email already exists.");

}

$hashed_password = password_hash($password,PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users(fullname,email,password) VALUES(?,?,?)");

$stmt->bind_param("sss",$fullname,$email,$hashed_password);

if($stmt->execute()){

echo "Registration Successful! <br><br>";

echo "<a href='login.php'>Click here to Login</a>";

}else{

echo "Registration Failed.";

}

?>