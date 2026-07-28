<?php

session_start();

include "db.php";

if (!isset($_GET['room_id'])) {
    exit();
}

$room_id = $_GET['room_id'];

$sql = "SELECT
            messages.message,
            users.fullname,
            messages.sent_at
        FROM messages
        INNER JOIN users
            ON messages.user_id = users.id
        WHERE messages.room_id = ?
        ORDER BY messages.sent_at ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {

    echo "<p><strong>"
        . htmlspecialchars($row['fullname'])
        . ":</strong> "
        . htmlspecialchars($row['message'])
        . "</p>";

}
?>