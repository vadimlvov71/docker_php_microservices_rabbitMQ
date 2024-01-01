

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/w3.css">
       
        <title>WebSocket Web Client</title>
    </head>
    <body>
        <h1>WebSocket Basics</h1>
        <ul class="tsummary">
            <li>allows two-way, event-driven communication between web browser and server</li>
            <li>great for <strong>real-time</strong> applications</li>
            <li>after this tutorial you should be able to create a simple Websockets app</li>
        </ul>


        <pre id="messages" style="width: 90%; margin-left: 5%; height: 200px; overflow: scroll">
        </pre>
        <input type="text" id="messageBox" placeholder="Type your message here"
            style="display: block; width: 90%; margin-bottom: 10px; margin-left: 5%; padding: 10px;" />
        <button id="send" title="Send Message!" style="width: 90%; margin-left: 5%; height: 30px;">
            Send Message
        </button>

        <?php
            include "./view/" . $view.".php";
        ?>
    </body>
</html>