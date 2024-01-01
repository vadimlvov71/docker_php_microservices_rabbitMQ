<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;


try {
    $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
    $channel = $connection->channel();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$channel->queue_declare('hello', false, true, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
 
$callback = function($msg) {

    $waitSeconds = rand(15,30);
    addRowToFile($msg->body);
    echo " [x] Host!!!: " . getenv('HOSTNAME') ." Waiting: " . $waitSeconds . " seconds. Received msg: ", $msg->body, "\n";
    //sleep(substr_count($msg->body, '.'));
    sleep($waitSeconds);
    echo " [x] Done!!!", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    
};

$channel->basic_qos(null, 1, null);
try {
    $channel->basic_consume('hello', '', false, false, false, false, $callback);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


while(count($channel->callbacks)) {
    $channel->wait();
}

//Не забываем закрыть соединение и канал
$channel->close();
$connection->close();

function addRowToFile(string $line): void
{
    $myfile = fopen("./files/invoice2.txt", "a") or die("Unable to open file!");
    $txt = $line . PHP_EOL;
    fwrite($myfile, $txt);
    fclose($myfile);
}

