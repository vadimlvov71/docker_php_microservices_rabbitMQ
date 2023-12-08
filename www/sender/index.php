<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, true, false, false);

$lines = file('./files/newfile.txt');
foreach ($lines as $line_num => $line) {
    /*$myfile = fopen("./files/result.txt", "a") or die("Unable to open file!");
    fwrite($myfile, $line);
    fclose($myfile);*/
    $msg = new AMQPMessage($line,
   // array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
    );
    $channel->basic_publish($msg, '', 'hello');
    echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
}
/*
$msg = new AMQPMessage('1111111',
   // array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);

$msg1 = new AMQPMessage('222222222222222!',
   /// array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);
$msg2 = new AMQPMessage('3333333333333!',
   /// array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);
*/
//$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World New! 123'\n";

$channel->close();
$connection->close();
/*
$myfile = fopen("/var/www/sender/files/newfile.txt", "w+") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);*/
