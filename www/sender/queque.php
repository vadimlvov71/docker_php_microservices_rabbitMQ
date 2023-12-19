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
    $msg = new AMQPMessage($line,
   // array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
    );
    $channel->basic_publish($msg, '', 'hello');
    echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
    echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
}

//$channel->basic_publish($msg, '', 'hello');

$channel->close();
$connection->close();
