<?php include "db.php"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<?php

  if(!isset($_SESSION["id"])){
    header("Location: user/login.php");
    }else{
    
    }


?>

<?php

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

require __DIR__ . '/vendor/autoload.php';


$receiver_id = $_GET["chat"];
$sender_id = $_SESSION["id"];
if(isset($_POST['submit'])){
    if(isset($_POST["message"])){
    $message = $_POST["message"];
    $sql = "INSERT INTO chat (receiver_id, sender_id, message, message_read, date) VALUES ('$receiver_id', '{$_SESSION["id"]}', '{$message}', 'notseen', now())";
    $query_sql = mysqli_query($baglan,$sql);


$client = new Client(new Version2X('http://localhost:5000', [
    'headers' => [
        'X-My-Header: websocket rocks',
        'Authorization: Bearer 12b3c4d5e6f7g8h9i'
    ]
]));

$client->initialize();
$client->emit('SendMessage', [
    'receiver_id' => $receiver_id,
    'sender_id' => $sender_id,
    'message' => $message,
    'date' => date("d-m-Y H:i:s"),
    ]);
$client->close();
}}
?>

<?php 

    // Read Information 
    $sql_read_information = "SELECT * FROM chat WHERE receiver_id = {$sender_id} AND message_read = 'notseen' AND sender_id = {$receiver_id} ";
    $sql_query_read_information = mysqli_query($baglan,$sql_read_information);
    $sql_read_information_update = "UPDATE chat SET message_read = 'seen' WHERE receiver_id = '$sender_id' AND sender_id = {$receiver_id}";
    $sql_query_information_update = mysqli_query($baglan,$sql_read_information_update);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"]?></title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/96c862bdc8.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="chat">
        <div class="sidebar">
            <div class="search">
                <input type="text" placeholder="ara..">
                <i class="fa fa-search"></i>
            </div>
            <div class="contacts">
                <ul>

                    <?php
                        $receiver_id = $_GET["chat"];
                        $sender_id = $_SESSION["id"];
                        $last_message_query = "SELECT * FROM chat WHERE receiver_id = {$sender_id} AND sender_id = {$receiver_id} ORDER BY id DESC LIMIT 1";
                        $last_message_conn = mysqli_query($baglan,$last_message_query);
                        while($last_message_row = mysqli_fetch_assoc($last_message_conn)){
                            $last_message = $last_message_row["message"];
                        }
                        $query = "SELECT * FROM users WHERE role = 'student' ";
                        $sql_query = mysqli_query($baglan,$query);
                        while($row = mysqli_fetch_assoc($sql_query)){
                            $user_name = $row["user_name"];
                            $user_email = $row["user_email"];
                            $user_id = $row["user_id"];
                            $sql_read_contact_information = "SELECT * FROM chat WHERE receiver_id = {$sender_id} AND message_read = 'notseen' AND sender_id = {$user_id} ";
                            $sql_query_contact_information = mysqli_query($baglan,$sql_read_contact_information);
                            $count_notseen_message = mysqli_num_rows($sql_query_contact_information);
                    ?>
                        
                        <?php 
                            if($user_id==$_SESSION["id"]){
                                
                            }elseif($count_notseen_message > 0){
                                echo "<li id='offline' class='active'>
                                    <a class='jv' href='index.php?chat=$user_id'>
                                        <img src='image/image.jpg' alt=''>
                                        <div class='contact'>
                                            <div class='name'>{$user_name}</div>
                                            <div class='message'></div>
                                        </div>
                                        <div class='notification'>{$count_notseen_message}</div>
                                    </a>    
                                </li>";
                            }
                            else
                            {
                                echo "
                                <li>
                                <a class='jv' href='index.php?chat=$user_id'>
                                <img src='image/image.jpg' alt=''>
                                <div class='contact'>
                                    <div class='name'>
                                        {$user_name}
                                    </div>
                                    <div class='message'></div>
                                </div>
                            </a>
                            </li> "; 
                            }

                        ?>
                        <?php } ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="message-header">
                <div class="user-info">
                    <?php 
                        $user_name_chat_id = $_GET["chat"];
                        $query2 = "SELECT * FROM users WHERE user_id = '$user_name_chat_id' ";
                        $sql_query2 = mysqli_query($baglan,$query2);
                        while($row2 = mysqli_fetch_array($sql_query2)){
                            $user_id_chat = $row2["user_id"];
                            $user_name_chat = $row2["user_name"];
                        }
                    
                    ?>
                    <img src="image/image.jpg" alt="">
                    <a href="profile/index.php?profile=<?php echo $user_id_chat; ?>" class="user">

                        <div class="name"><?php echo $user_name_chat; ?></div>
                        <div class="time">10 dk önce</div>
                    </a>
                </div>
                <div class="actions">
                    <ul>
                        <li>
                            <a href="home.php">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="message-content">
            <?php
                $sql2 = "SELECT * FROM chat WHERE (receiver_id = '$receiver_id' AND sender_id = '$sender_id') OR (receiver_id = '$sender_id' AND sender_id = '$receiver_id') ORDER BY 1 ASC";
                $sql2_query = mysqli_query($baglan,$sql2);
                while($chatmessage = mysqli_fetch_assoc($sql2_query)){
                    $chat_message = $chatmessage["message"];
                    $chat_receiver_id = $chatmessage["receiver_id"];
                    $chat_sender_id = $chatmessage["sender_id"];
                    $chat_date = $chatmessage["date"];
                
                    if($sender_id == $chat_sender_id && $receiver_id == $chat_receiver_id){
                    $chat_message_sender_me = $chat_message;
                    echo "<div class='message me'>
                                    <div class='bubble'>
                                        {$chat_message_sender_me}
                                    </div>
                                    <div class='time'>1 dk önce</div>
                                </div>";
                    }

                if($sender_id == $chat_receiver_id && $receiver_id == $chat_sender_id){
                    $chat_message_receiver_me = $chat_message; 
                    echo "  <div class='message'>
                                        <div class='bubble'>
                                            {$chat_message_receiver_me}
                                        </div>
                                        <div class='time'>1 dk önce</div>
                                    </div>";
                }  
            } 
        ?>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
            <div class="message-form">
                <ul>
                    <li class="emoji-btn">
                        <a href="#">
                            <i class="fa fa-laugh"></i>
                        </a>
                    </li>

                    <li class="input">
                        <input type="text" id="SendMessage" name="message" placeholder="Bir şeyler yaz.." autofocus>
                    </li>
                    <li class="sound-btn">
                        <a href="#">
                        <button type="submit" name="submit"><i class="fas fa-paper-plane"></i></button>
                        </a>
                    </li>
                </ul>
            </div>
            </form>
        </div>
    </div>     

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.js" integrity="sha512-AcZyhRP/tbAEsXCCGlziPun5iFvcSUpEz2jKkx0blkYKbxU81F+iq8FURwPn1sYFeksJ+sDDrI5XujsqSobWdQ==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        var socket = io('http://localhost:5000/');
        socket.on('connection', ()=>{

        })
        socket.on('SendMessage',(data)=>{
            setTimeout(() => {
                $('.message-content').append(`
            <div class='message'>
                <div class='bubble'>
                   ${data.message}
                </div>
                <div class='time'>1 dk önce</div>
            </div>
            `)
            }, 1000);
        })
        // socket.on('offline',(data)=>{
        //     console.log('Offline moda geçildi.')
        //     document.getElementById("offline").innerHTML="<div class="cevrimdisi"></div>";

        // })
    </script>
</body>

</html>