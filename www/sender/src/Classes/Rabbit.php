<?php
namespace App\Classes;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Service\RabbitEnv;

class Rabbit {

    public $connection;

    function __construct() {

        $this->connection = new AMQPStreamConnection(
            RabbitEnv::Host->value, 
            RabbitEnv::Port->value, 
            RabbitEnv::Username->value, 
            RabbitEnv::getPassword()
        );
    } 

    /**
     * RabbitMQ connection
     */
    public function getConnection() {
        return $this->connection;
    } 
    /**
     * @param mixed $line_num
     * @param mixed $line
     * 
     * @return void
     */

    public function setMessage($line_num, $line): void
    {
        echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
        echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
    }

}