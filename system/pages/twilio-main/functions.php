<?php

use Twilio\Rest\Client;

require 'vendor/autoload.php';

$sid = "AC99d1b1ef25c4c4ce7ca34d951d97364b";
$token = "13b9b3b03a9240ec8c7f07f3173f803b";
$twilioPhone = "+12249002514";

if (!function_exists("sendSMS")) {
    function sendSMS($message, $to, $from = "")
    {
        global $sid, $token, $twilioPhone;

        if ($from == "") {
            $from = $twilioPhone;
        }

        $client = new Client($sid, $token);

        try {
            $client->messages->create(
                $to,
                [
                    'from' => $from,
                    'body' => $message,
                ]
            );
            echo '<script>alert("Message sent successfully!"); window.location.href = "/finalfinalgradingsystem/system/pages/studgrade/studgrade.php";</script>';
            
        } catch (\Exception $e) {
            // JavaScript alert for failure
            echo '<script>alert("Message sending failed! ' . $e->getMessage() . '");</script>';
        }
    }
}

//preformatted var_dump function
if (!function_exists('dump')) {
    function dump($var, $adminOnly = false, $localhostOnly = false)
    {
      if ($var !== null) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    }
}

//preformatted dump and die function
if (!function_exists('dnd')) {
    function dnd($var)
    {
        dump($var);
        die();
    }
}
?>
