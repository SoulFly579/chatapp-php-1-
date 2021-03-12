<?php

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

require __DIR__ . '/vendor/autoload.php';

$client = new Client(new Version2X('http://localhost:5000', [
    'headers' => [
        'X-My-Header: websocket rocks',
        'Authorization: Bearer 12b3c4d5e6f7g8h9i'
    ]
]));

$client->initialize();
$client->emit('SendMessage', function(){

});
$client->close();

?>