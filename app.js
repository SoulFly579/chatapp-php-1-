var express = require('express')
    , http = require('http');
var app = express();
var server = http.createServer(app);
var io = require('socket.io').listen(server);


io.on('connection', function(socket){

    socket.on('SendMessage', (data)=>{
        io.emit('SendMessage', data)
    })
    // socket.on('offline', (data)=>{
    //     socket.emit('offline', data)
    // })
});

server.listen(5000, ()=>{
    console.log('Server Çalışıyor')
});