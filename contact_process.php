<?php
    $webhookUrl = 'https://hooks.slack.com/services/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';

    // Validate the form fields
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // Handle the case when one or more fields are missing
        die("Please fill out all the required fields.");
    }

    // Construct the Slack message
    $message = "New contact form submission:\n\n";
    $message .= "Name: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Subject: " . $subject . "\n";
    $message .= "Message: " . $message . "\n";

    $data = array('text' => $message);
    $jsonData = json_encode($data);

    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    // Optionally, you can check the result of the request and handle any errors.
    if ($result === false) {
        // Error handling
        die("Failed to send the Slack notification.");
    } else {
        // Success handling
        echo "Slack notification sent successfully.";
    }
?>
