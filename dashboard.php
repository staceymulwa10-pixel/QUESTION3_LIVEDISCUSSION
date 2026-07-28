<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</h2>

<p>You have successfully logged in.</p>

<hr>

<h3 style="text-align:center;">Discussion Rooms</h3>

<?php

include("db.php");

$sql = "SELECT rooms.*, users.fullname
        FROM rooms
        JOIN users ON rooms.created_by = users.id
        ORDER BY rooms.created_at DESC";

$result = $conn->query($sql);

?>

<table>

<tr>

<th>ID</th>

<th>Room Name</th>

<th>Created By</th>

<th>Date Created</th>

<th>Action</th>

</tr>

<?php

while($room = $result->fetch_assoc()){

?>

<tr>

<td><?php echo $room['id']; ?></td>

<td><?php echo htmlspecialchars($room['room_name']); ?></td>

<td><?php echo htmlspecialchars($room['fullname']); ?></td>

<td><?php echo $room['created_at']; ?></td>

<td>

<a href="chat.php?room_id=<?php echo $room['id']; ?>">

Join Room

</a>

</td>

</tr>

<?php

}

?>

</table>

<br>

<a href="create_room.php">Create New Room</a>

<br><br>

<a href="logout.php">Logout</a>

<br>

<a href="create_room.php">Create New Room</a>

<br><br>

<a href="logout.php">Logout</a>
</body>
</html>