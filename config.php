<?php

//
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$apiKey="";// You faucet api key
$faucetName="";// You faucet name
$faucetUrl="";// You faucet name
$waitTimeTime = 3600; // wait in seconds
$amount = 0.0001;// You faucet reward amount
$currency="usd";// You faucet reward currency
$recaptchaSitekey="";
$recaptchaSecretkey="";




// Don't change here
$faucetVersion="v1.0";
// File path to store the waitTime data
$waitTimeFile = 'waitTime.txt';
$blacklistFile = 'blacklist.txt';
// Initialize the waitTime data array
$waitTimeData = array();
// Read the waitTime data from the file if it exists
if (file_exists($waitTimeFile)) {
    $waitTimeData = json_decode(file_get_contents($waitTimeFile), true);
} else {
    // Create the waitTime file if it doesn't exist
    file_put_contents($waitTimeFile, json_encode($waitTimeData));
}

$blacklistData = array();
// Read the blacklist data from the file if it exists
if (file_exists($blacklistFile)) {
    $blacklistData = file($blacklistFile, FILE_IGNORE_NEW_LINES);
} else {
    // Create the blacklist file if it doesn't exist
    file_put_contents($blacklistFile, implode("\n", $blacklistData));
}
?>