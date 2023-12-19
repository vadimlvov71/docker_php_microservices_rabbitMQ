<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
$channel->exchange_declare('exchange_test', 'topic', false, false, false);
//use PhpAmqpLib\Connection\AMQPConnection;

/* Create a connection using all default credentials: */
//$connection = new AMQPConnection('rabbitmq', 5672, 'guest', 'guest');
//$connection->connect();

//$channel = new AMQPChannel($connection);

/* create a queue object */
//$queue = new AMQPQueue($channel);

//declare the queue
//$queue->declare('hello');

//get the messages
/*$messages = $queue->get(AMQP_AUTOACK);
$myfile = fopen("./files/invoice1.txt", "a") or die("Unable to open file!");
    $txt = $message->getBody() . PHP_EOL;
    fwrite($myfile, $txt);
    fclose($myfile);
echo $message->getBody();
$channel->close();
$connection->close();*/