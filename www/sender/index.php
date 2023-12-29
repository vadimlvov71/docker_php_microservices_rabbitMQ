<?php
namespace Index;

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\Rabbit;
use App\Service\RabbitEnv;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * rabbitMQ script
 */
class Application {
    /**
     * run a rabbitMQ script
     * @return void
     */
    public function run(): void
    {
        $rabbit_connect = new Rabbit();
       
        $connection = $rabbit_connect->getConnection();
        
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
            $rabbit_connect->setMessage($line_num, $line);
        }
        
        $channel->close();
        $connection->close();
    }
}
$application = new Application();
$application->run();

