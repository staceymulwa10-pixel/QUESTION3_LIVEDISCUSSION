<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}
include("db.php");

if(isset($_POST['create_room'])){

    $room_name = trim($_POST['room_name']);

    $created_by = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO rooms(room_name, created_by) VALUES(?, ?)");

    $stmt->bind_param("si", $room_name, $created_by);

    if($stmt->execute()){

        echo "<p style='color:green;'>Discussion room created successfully!</p>";

    }else{

        echo "<p style='color:red;'>Failed to create room.</p>";

    }

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Create Discussion Room</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<h2>Create Discussion Room</h2>

<form action="create_room.php" method="POST">

<label>Room Name</label><br>

<input type="text" name="room_name" required><br><br>

<input type="submit" name="create_room" value="Create Room">

</form>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</body>

</html>