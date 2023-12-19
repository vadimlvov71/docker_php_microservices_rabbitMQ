#consumer
import pika
#declaring the credentials needed for connection like host, port, username, password, exchange etc
credentials = pika.PlainCredentials('guest','guest')
connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbitmq', port='5672', credentials= credentials))
channel = connection.channel()
channel.exchange_declare('test', durable=True, exchange_type='topic')
#defining callback functions responding to corresponding queue callbacks
def callbackFunctionForQueueA(ch,method,properties,body):
    print('Got a message from Queue A: ', body)

 #Attaching consumer callback functions to respective queues that we wrote above
channel.basic_consume(queue='hello', on_message_callback=callbackFunctionForQueueA, auto_ack=True)

#this will be command for starting the consumer session
channel.start_consuming()

