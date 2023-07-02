<?php

$webhookUrl = "https://hooks.slack.com/services/your-webhook-url";

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];

$data = array(
    'text' => "You have a new message from your website:\n\nName: $name\nEmail: $email\nSubject: $subject\nMessage: $message"
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($webhookUrl, false, $context);

if ($result === false) {
    // Error handling if the request fails
} else {
    // Success handling if the request is successful
}

?>
