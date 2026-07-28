<?php

session_start();

include("db.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid request.");
}

// Read form data
$email = trim($_POST['email']);
$password = $_POST['password'];

// Find the user by email
$stmt = $conn->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 1){

    $user = $result->fetch_assoc();

    // Compare entered password with hashed password
    if(password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];

        header("Location: dashboard.php");
        exit();

    }else{

        echo "Incorrect password.";

    }

}else{

    echo "Email not found.";

}

?>