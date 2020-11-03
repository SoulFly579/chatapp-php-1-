<?php session_start();  ?>
<?php

include "db.php";
$oturum = $_SESSION["id"];
$oturum_isim = $_SESSION['username'];
$user_status = "offline";
$update_durum_offline = "UPDATE users SET status = 'offline' WHERE user_id = '$oturum' ";
$update_query_durum_offline = mysqli_query($baglan,$update_durum_offline);

session_destroy();

/* $_SESSION["username"] = null;
$_SESSION["email"] = null;
$_SESSION["password"] = null;
$_SESSION["role"] = null;*/

header("Location: user/login.php");

/* use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

require __DIR__ . '/vendor/autoload.php';

$client = new Client(new Version2X('http://localhost:5000', [
    'headers' => [
        'X-My-Header: websocket rocks',
        'Authorization: Bearer 12b3c4d5e6f7g8h9i'
    ]
]));

$client->initialize();
$client->emit('offline', [
'oturum_isim'=> $oturum_isim,
'offline' => $user_status, 
]);
$client->close(); */

?>