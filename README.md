### dockerized php microservices rabbitMQ
#### 4 containers:
1. nginx
2. php producer
3. php consumer
4. python consumer
5. rabbitmq
   
#### Aim:
* one php instance reads a file
* and sends lines by lines data
* via the RabbitMQ instance
* to another php service
* where data were written lines by lines to another file 
