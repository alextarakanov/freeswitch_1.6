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
    while (true) {
        $read = trim($client->read());
       if ($read != '') {
            // $client->send('[' . date(DATE_RFC822) . '] ' . $read);
            $client->send("sendmsg\n");
            $client->send("call-command: execute\n");
            $client->send("execute-app-name: set\n\n");
            $client->send("execute-app-arg: setfs=fs1\n\n");
            break;
        } else {
            break;
        }
        if (preg_replace('/[^a-z]/', '', $read) == 'exit') {
            break;
        }
                           // if (preg_match('[^Content-Type: command/reply$]', $read)) {
                           // $client->send("1. $read\n");
                           // } elseif (preg_match('[^Reply-Text: \+OK$]', $read)) {
                           // $client->send("2. OK\n$read");
                           // } 
        if ($read === null) {
            printf("[%s] Disconnected\n", $client->getAddress());
            return false;
        } else {
            printf("[%s] recieved: %s", $client->getAddress(), $read);
        }
    }
    $client->close();
    printf("[%s] Disconnected\n", $client->getAddress());
}



require "sock/SocketServer.php";



$server = new \Sock\SocketServer();

$server->init();

$server->setConnectionHandler('onConnect');

$server->listen();

