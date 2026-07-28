<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

if(!isset($_GET['room_id'])){

    die("Room not selected.");

}

$room_id = $_GET['room_id'];

?>

<!DOCTYPE html>

<html>

<head>

<title>Discussion Room</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<h2>Discussion Room</h2>

<p>Room ID: <?php echo $room_id; ?></p>

<hr>

<div id="messages"
style="
width:80%;
height:300px;
border:1px solid black;
margin:auto;
overflow-y:scroll;
padding:10px;
">

</div>

<br>

<div style="text-align:center;">

<input
type="text"
id="message"
placeholder="Type your message..."
onkeyup="typing()"
style="width:60%;">

<button onclick="sendMessage()">

Send

</button>

</div>

<<script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>

<script>

const socket = io("http://localhost:3000");
const roomId = "<?php echo $room_id; ?>";

// Load previous messages
fetch("get_message.php?room_id=" + roomId)
.then(response => response.text())
.then(data => {

    document.getElementById("messages").innerHTML = data;

    let messages = document.getElementById("messages");

    messages.scrollTop = messages.scrollHeight;

});

const roomId = "<?php echo $room_id; ?>";

fetch("get_message.php?room_id=" + roomId)
.then(response => response.text())
.then(data => {

    document.getElementById("messages").innerHTML = data;

    let messages = document.getElementById("messages");
    messages.scrollTop = messages.scrollHeight;

});
const roomId = "<?php echo $room_id; ?>";

fetch("get_messages.php?room_id=" + roomId)
.then(response => response.text())
.then(data => {

    document.getElementById("messages").innerHTML = data;

    let messages = document.getElementById("messages");

    messages.scrollTop = messages.scrollHeight;

});
socket.emit("joinRoom", {
    roomId: roomId,
    user: "<?php echo htmlspecialchars($_SESSION['fullname']); ?>"
});
const roomId = "<?php echo $room_id; ?>";

// Join the selected room
socket.emit("joinRoom", {

    roomId: roomId,

    user: "<?php echo htmlspecialchars($_SESSION['fullname']); ?>"

});
socket.emit("userOnline", {

    roomId: roomId,

    user: "<?php echo htmlspecialchars($_SESSION['fullname']); ?>"

});
// Receive messages
socket.on("receiveMessage", function(data){

    let messages = document.getElementById("messages");

    messages.innerHTML +=
        "<p><strong>" +
        data.user +
        ":</strong> " +
        data.message +
        "</p>";

    messages.scrollTop = messages.scrollHeight;

});
socket.on("userJoined", function(data){

    let messages = document.getElementById("messages");

    messages.innerHTML +=
        "<p style='color:green;'><em>" +
        data.user +
        " joined the discussion.</em></p>";

});

// Send message
function sendMessage(){

    let message = document.getElementById("message").value;

    if(message.trim()==""){

        return;

    }

    socket.emit("sendMessage",{

roomId: roomId,

userId: "<?php echo $_SESSION['user_id']; ?>",

user: "<?php echo htmlspecialchars($_SESSION['fullname']); ?>",

message: message

});

    document.getElementById("message").value="";

}
socket.on("userLeft", function(data){

    let messages = document.getElementById("messages");

    messages.innerHTML +=
        "<p style='color:red;'><em>" +
        data.user +
        " left the discussion.</em></p>";

});
let typingTimer;


// User starts typing
function typing(){

    socket.emit("typing",{

        roomId: roomId,

        user: "<?php echo htmlspecialchars($_SESSION['fullname']); ?>"

    });


    clearTimeout(typingTimer);


    typingTimer = setTimeout(()=>{


        socket.emit("stopTyping",{

            roomId: roomId

        });


    },1000);

}
socket.on("userTyping",(data)=>{


    document.getElementById("messages").innerHTML +=

    "<p id='typing' style='color:gray;'><em>" +

    data.user +

    " is typing...</em></p>";



});



socket.on("userStoppedTyping",()=>{


    let typingMessage = document.getElementById("typing");


    if(typingMessage){

        typingMessage.remove();

    }


});

</script>

</body>

</html>