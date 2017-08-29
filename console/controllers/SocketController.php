<?php

namespace console\controllers;

use console\models\SocketServer;
use React\EventLoop\Factory;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\Wamp\WampServer;
use Ratchet\WebSocket\WsServer;
use React\Socket\Server;
use React\ZMQ\Context;
use yii\console\Controller;

class SocketController extends Controller
{
    public function actionStartSocket($port = 5555)
    {
        $loop   = Factory::create();
        $pusher = new SocketServer();

        // Listen for the web server to make a ZeroMQ push after an ajax request
        $context = new Context($loop);
        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:', $port); // Binding to 127.0.0.1 means the only client that can connect is itself
        $pull->on('message', [$pusher, 'onPushEventData']);

        // Set up our WebSocket server for clients wanting real-time updates
        $webSock = new Server($loop);
        $webSock->listen(8080, '0.0.0.0'); // Binding to 0.0.0.0 means remotes can connect
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );

        $loop->run();
    }
}
