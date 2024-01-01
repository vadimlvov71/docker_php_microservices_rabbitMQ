<?php
namespace App\Controllers;


use App\Classes\BaseController;
use App\Classes\Rabbit;
use App\Service\RabbitEnv;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * rabbitMQ script
 */
class IndexController extends BaseController{
    /**
     * run a rabbitMQ script
     * @return void
     */
    public function run(): void
    {
        $rabbit_connect = new Rabbit();
        //xdebug_debug_zval('rabbit_connect');
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
            $msg = new AMQPMessage($line);
            $channel->basic_publish($msg, RabbitEnv::Exchange->value);
            $rabbit_connect->setMessage($line_num, $line);
        }
        ### a sign to point the end of the queque
        $msg = new AMQPMessage("end");
        $channel->basic_publish($msg, RabbitEnv::Exchange->value,);
        $channel->close();
        $connection->close();
        
        ####render View with html
        $this->view->render("index", 'aaaaa');
    }
    public function contacts(): void
    {
        echo "contacts";
    }
}


