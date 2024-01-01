<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/service/RabbitEnv.php';
require_once __DIR__ . '/service/FileHelper.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
#use PhpAmqpLib\Message\AMQPMessage;

define("FILE_PATH", "./files/invoice2.txt");

$connection = new AMQPStreamConnection(
    RabbitEnv::Host->value, 
    RabbitEnv::Port->value, 
    RabbitEnv::Username->value, 
    RabbitEnv::getPassword()
);

$channel = $connection->channel();

# Create the exchange if it doesnt exist already.
$channel->exchange_declare(
    RabbitEnv::Exchange->value, 
    'fanout', # type
    false,    # passive
    false,    # durable
    false     # auto_delete
);

list($queue_name, ,) = $channel->queue_declare(
    "",    # queue
    false, # passive
    false, # durable
    true,  # exclusive
    false  # auto delete
);

$channel->queue_bind($queue_name, RabbitEnv::Exchange->value);
print 'Waiting for logs. To exit press CTRL+C' . PHP_EOL;

$callback = function($msg){
    FileHelper::addRowToFile (FILE_PATH, $msg->body);
    print "Read: " . $msg->body . PHP_EOL;
    if ($msg->body === "end"){
        print "end: " . $msg->body . PHP_EOL;
    }
};

$channel->basic_consume(
    $queue_name, 
    '', 
    false, 
    true, 
    false, 
    false, 
    $callback
);

while (count($channel->callbacks)) 
{
    $channel->wait();
}

$channel->close();
$connection->close();