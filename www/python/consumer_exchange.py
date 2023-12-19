#consumer
import pika
#declaring the credentials needed for connection like host, port, username, password, exchange etc
credentials = pika.PlainCredentials('guest','guest')

connection = pika.BlockingConnection(
pika.ConnectionParameters(host='rabbitmq', port='5672', credentials = credentials))
channel = connection.channel()


result = channel.queue_declare(queue='hello1', durable=False, exclusive=False)
queue_name = result.method.queue

channel.queue_bind(exchange='exchange_test', queue=queue_name, routing_key="test.*")

print(' [*] Waiting for logs. To exit press CTRL+C')


def callback(ch, method, properties, body):
    print(" [x] %r:%r" % (method.routing_key, body))


channel.basic_consume(queue=queue_name, on_message_callback=callback, auto_ack=True)

channel.start_consuming()

