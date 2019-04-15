<?php

if (!extension_loaded('sockets')) {
    echo "This example requires sockets extension (http://www.php.net/manual/en/sockets.installation.php)\n";
    exit(-1);
}
if (!extension_loaded('pcntl')) {
    echo "This example requires PCNTL extension (http://www.php.net/manual/en/pcntl.installation.php)\n";
    exit(-1);
}

function onConnect($client)
{
    $pid = pcntl_fork();
    if ($pid == -1) {
        die('could not fork');
    } else if ($pid) {
        // parent process
        return;
    }
    $read = '';
    printf("[%s] Connected at port %d\n", $client->getAddress(), $client->getPort());
    $client->send("sendmsg\n");
    $client->send("call-command: execute\n");
    $client->send("execute-app-name: set\n");
    $client->send("execute-app-arg: setfs=fs1\n\n");
    $client->close();
    printf("[%s] Disconnected\n", $client->getAddress());
}
require "sock/SocketServer.php";
$server = new \Sock\SocketServer();
$server->init();
$server->setConnectionHandler('onConnect');
$server->listen();

