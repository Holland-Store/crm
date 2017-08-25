var socket = new YiiNodeSocket();

socket.debug(true);

socket.onConnect(function () {
    socket.room('testRoom').join(function (success, numberOfRoomSubscribers) {
        if(success){
            console.log(numberOfRoomSubscribers + ' clients in room: '+roomId);
            // do something

            // bind events
            this.on('join', function (newMembersCount) {
                // fire on client join
            });

            this.on('data', function (data) {
                // fire when server send frame into this room with 'data' event
            });
        } else {
            // numberOfRoomSubscribers - error message
            alert(numberOfRoomSubscribers);
        }
    })
});

socket.onDisconnect(function () {
    // fire when connection close or lost
});

socket.onConnecting(function () {
    // fire when the socket is attempting to connect with the server
});

socket.onReconnect(function () {
    // fire when successfully reconnected to the server
});

socket.on('updateBoard', function (data) {
    // do any action
});

socket.on('message', function (message) {
    console.log(message.text);
});
