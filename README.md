### dockerized 2 php instances and python one as microservices with rabbitMQ
#### 4 containers:
1. nginx
2. php producer
3. php consumer
4. python consumer
5. rabbitmq
   
#### Aim:
* one php instance reads a file
* https://github.com/vadimlvov71/docker_php_microservices_rabbitMQ/blob/master/www/sender/files/newfile.txt
* and sends lines by lines data
  https://github.com/vadimlvov71/docker_php_microservices_rabbitMQ/blob/master/www/sender/index.php
* via the RabbitMQ instance as an exchange
* to another php service,
* where data were written lines by lines to another file
  https://github.com/vadimlvov71/docker_php_microservices_rabbitMQ/blob/master/www/src/Subscriber.php
* and to python instance
  https://github.com/vadimlvov71/docker_php_microservices_rabbitMQ/blob/master/www/python/consumer_exchange.py

![изображение](https://github.com/vadimlvov71/docker_php_microservices_rabbitMQ/assets/57807117/db958244-d512-4e90-9209-d1537b7e9c66)

####TO DO 
* the python instance put these data to elasticsearch instance
 
