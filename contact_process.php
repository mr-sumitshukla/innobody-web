<?php
    // Your Slack API token
    $slackToken = 'xoxb-5015790489412-5512476894613-ifHXK8rLpqKGfhlwnGB3qqVY';

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
    $slackMessage = "New contact form submission:\n\n";
    $slackMessage .= "Name: " . $name . "\n";
    $slackMessage .= "Email: " . $email . "\n";
    $slackMessage .= "Subject: " . $subject . "\n";
    $slackMessage .= "Message: " . $message . "\n";

    // Slack API endpoint for posting messages
    $slackApiUrl = 'https://slack.com/api/chat.postMessage';
// 
    $data = array(
        'token' => $slackToken,
        'channel' => 'C053HJUK24C', // Replace with the ID of the channel you want to post the message to
        'text' => $slackMessage
    );

    // Use cURL to make the API call
    $ch = curl_init($slackApiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    // Optionally, you can check the response and handle any errors.
    if (!$response['ok']) {
        // Error handling
        die("Failed to send the Slack notification.");
    } else {
        // Success handling
        echo "Slack notification sent successfully.";
    }
?>
