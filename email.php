<?php
require 'vendor/autoload.php';
require_once 'form.php'

$email = new \SendGrid\Mail\Mail();
$email->setFrom("clemence.pereira@hotmail.fr");
$email->setSubject("You are sign in !");
$email->addTo($email, "Example User");
$email->addContent("text/plain", "You are sign in the form");

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
?>
