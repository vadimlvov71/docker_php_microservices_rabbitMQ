


        <script>
            let messageObj = {};
            messageObj.user_id = 1;
            if ("WebSocket" in window) {
                const sendBtn = document.querySelector('#send');
                const messages = document.querySelector('#messages');
                const messageBox = document.querySelector('#messageBox');
                
                function showMessage(message) {
                    messages.textContent += `\n${message}`;
                    messages.scrollTop = messages.scrollHeight;
                    messageBox.value = '';
                }


                let ws = new WebSocket("ws://localhost:7000");
                //let ws = new WebSocket('ws://18.208.227.200:9000/');
                ws.onopen = function() {
                    console.log("Connected to Server");
                };


                sendBtn.onclick = function() {
                    if (ws) {
                        console.log(messageBox.value);
                        messageObj.messageBody = messageBox.value;
                        ws.send(messageBox.value);
                        //ws.send(JSON.stringify(messageBox.value));
                        showMessage(`ME: ${messageBox.value}`);
                    } else {
                        alert("ERROR: Not connected... refresh to try again!");
                    }
                }


                ws.onmessage = function ({data}) {
                    showMessage(`YOU: ${data}`);
                };


                ws.onclose = function() {
                    ws = null;
                    alert("Connection closed... refresh to try again!");
                };


            } else {
                alert("WebSocket NOT supported by your Browser!");
            }
        </script>
    </body>
</html>



