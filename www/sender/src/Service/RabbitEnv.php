<?php
namespace App\Service;

enum RabbitEnv: string
{
    case Host = "rabbitmq";
    case Port = "5672";
    case Username = "guest";
    #case Password = "guest";
    case Exchange = "exchange_test";

      /**
    * Fatal error: Uncaught Error: Duplicate value in enum RabbitEnv for cases Username and Password 
     * @return string
     */
    public static function getPassword(): string
    {
        return self::Username->value;
    }
}