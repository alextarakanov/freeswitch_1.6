<?php

require __DIR__.'/class/mysqlClass.php';
$address='172.10.0.1';
$port='44445';
/**
 * Check dependencies
 */
if (!extension_loaded('sockets')) {
    echo "This example requires sockets extension (http://www.php.net/manual/en/sockets.installation.php)\n";
    exit(-1);
}

if (!extension_loaded('pcntl')) {
    echo "This example requires PCNTL extension (http://www.php.net/manual/en/pcntl.installation.php)\n";
    exit(-1);
}

/**
 * Connection handler
 */
function onConnect($client)
{
    $pid = pcntl_fork();

    if ($pid == -1) {
        die('could not fork');
    } else if ($pid) {
        // parent process
        return;
    }

    $uuid=date("YmdHis",time()).rand(100, 999);

    printf("[%s] Connected at port %d\n", $client->getAddress(), $client->getPort());
    $mysqlClass=new mysqlClass();
    $sql_request = "SELECT * FROM fs.unite
        where setCountCallDay>=useCountCallDay
            and setMinuteDay>=useMinuteDay
            and setMinuteMonth>=useMinuteMonth
            and setErrorDay>=useErrorDay
            and stateLine='ALLOW'
            and enable ='yes'
           order by dateLastCall
           limit 1";
    $varServer=$mysqlClass->sqlRequestAssoc($sql_request);
    $update="UPDATE fs.unite set uuid=".$uuid.", stateLine='USE', dateLastCall=now(), setCountCallDay=setCountCallDay+1  where id =". $varServer['id'];
    $mysqlClass->sqlUpdate($update);
//    var_dump($varServer['server']);
    $client->send("sendmsg\n");
    $client->send("call-command: execute\n");
    $client->send("execute-app-name: set\n");
    $client->send("execute-app-arg: setServer=".$varServer['server']."\n\n");
//    $client->send( "\n" );
    $client->send("sendmsg\n");
    $client->send("call-command: execute\n");
    $client->send("execute-app-name: set\n");
    $client->send("execute-app-arg: uuid=".$uuid."\n\n");

    $client->close();
    printf("[%s] Disconnected\n", $client->getAddress());

}

require "sock/SocketServer.php";

$server = new \Sock\SocketServer();
$server->address = $address;
$server->port = $port;
$server->init();
$server->setConnectionHandler('onConnect');
$server->listen();
