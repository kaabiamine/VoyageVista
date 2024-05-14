<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .chat-container {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .chat-messages {
            padding: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .chat-input {
            width: 100%;
            padding: 10px;
            border: none;
            border-top: 1px solid #ccc;
            outline: none;
        }

        .chat-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-messages" id="chatMessages">
            <p>Welcome to the chatbot!</p>
        </div>
        <input type="text" id="userInput" class="chat-input" placeholder="Type your message...">
        <button onclick="sendMessage()" class="chat-button">Send</button>
    </div>

    <script>
        function sendMessage() {
            var message = document.getElementById("userInput").value;
            if (message.trim() !== "") {
                displayMessage("You: " + message);
                document.getElementById("userInput").value = "";

                // Send message to PHP script
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "simple_chatbot.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        displayMessage("Chatbot: " + response.response);
                    }
                };
                xhr.send("message=" + message);
            }
        }

        function displayMessage(message) {
            var chatMessages = document.getElementById("chatMessages");
            var p = document.createElement("p");
            p.textContent = message;
            chatMessages.appendChild(p);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</body>

</html>
