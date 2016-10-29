<?php
// Get the PHP helper library from twilio.com/docs/php/install
require_once "vendor/autoload.php";
use Twilio\Rest\Client;

// contains the SID, Auth Token, and phone numbers to send to
$config = json_decode(file_get_contents('./config.json'), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Body"], $_POST["AccountSid"]) && $config) {

    $sid = $config['sid'];
    $token = $config['token'];
    $contacts = $config['contacts'];
    $from = $config['from'];

    // To validate this request came from Twilio
    if($_POST["AccountSid"] === $sid) {

        $client = new Client($sid, $token);

        foreach ($contacts as $key => $value) {
            $client->messages->create(
                $value,
                array(
                    "from" => $from,
                    "body" => $_POST["Body"]
                )
            );
            sleep(1);
        }
    }
}
