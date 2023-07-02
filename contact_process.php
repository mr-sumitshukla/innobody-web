<?php

$webhookUrl = "https://hooks.slack.com/services/your-webhook-url";

$name = $_REQUEST['name'];
//$email = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$number = $_REQUEST['number'];

// Validate mandatory fields
if (empty($name) || empty($subject) || empty($message) || empty($number)) {
    echo "Please fill in all the required fields.";
    exit;
}

// Validate contact number
if (!preg_match('/^\d{10}$/', $number)) {
    echo "Please enter a 10-digit contact number.";
    exit;
}

$data = array(
    'text' => "You have a new message from your website:\n\nName: $name\nContact: $number\nSubject: $subject\nMessage: $message"
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
    echo "An error occurred while sending the message.";
} else {
    echo "Your message was sent successfully. We will connect with you shortly.";
}

?>
