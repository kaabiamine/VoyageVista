<?php

// Sample responses for demonstration
$responses = [
    "hi" => "Hello! How can I assist you?",
    "how are you" => "I'm doing well, thank you!",
    "bye" => "Goodbye! Have a great day!",
    "fares" => "fares",
    "default" => "I'm sorry, I didn't understand that. Can you please rephrase?",
    "tunis" => " c'est définitivement un bon choix pour des vacances culturelles ",
    "pari" => " c'est définitivement un bon choix pour des vacances culturelles ",

];

// Retrieve the message from the HTML form
$message = isset($_POST['message']) ? strtolower(trim($_POST['message'])) : '';

// Process the message and generate a response
if (array_key_exists($message, $responses)) {
    $response = $responses[$message];
} else {
    $response = $responses['default'];
}

// Send the response back to the HTML page
echo json_encode(['response' => $response]);
?>
