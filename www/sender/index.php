<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/service/RabbitEnv.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    RabbitEnv::Host->value, 
    RabbitEnv::Port->value, 
    RabbitEnv::Username->value, 
    RabbitEnv::getPassword()
);
$channel = $connection->channel();

$channel->exchange_declare(
    RabbitEnv::Exchange->value, 
    'fanout', # type
    false,    # passive
    false,    # durable
    false     # auto_delete
);

$lines = file('./files/newfile.txt');

foreach ($lines as $line_num => $line) {
    $msg = new AMQPMessage($line,
   // array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
    );
    $channel->basic_publish($msg, RabbitEnv::Exchange->value,);
    echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
    echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
}

$channel->close();
$connection->close();


