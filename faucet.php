<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = $_POST["username"];


 // Storing google recaptcha response
    // in $recaptcha variable
    $recaptcha = $_POST['g-recaptcha-response'];

    // Put secret key here, which we get
    // from google console
    $secret_key = $recaptchaSecretkey;

    // Hitting request to the URL, Google will
    // respond with success or error scenario
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $secret_key . '&response=' . $recaptcha;

    // Making request to verify captcha
    $response = file_get_contents($url);

    // Response return by google is in
    // JSON format, so we have to parse
    // that json
    $response = json_decode($response);

    // Checking, if response is true or not
    if ($response->success == false) {
        
        echo '<script>alert("Error in Google reCAPTACHA")</script>';
    }

    

    $currentTime = time(); // Get the current time
    $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user

    // Check if the waitTime data array is not null
    if ($waitTimeData !== null) {
        // Check if the recipient's username is in the waitTime list
        if (array_key_exists($recipient, $waitTimeData) && $currentTime - $waitTimeData[$recipient] < $waitTimeTime) {
            $remainingTime = $waitTimeTime - ($currentTime - $waitTimeData[$recipient]);

            // Calculate hours, minutes, and seconds
            $hours = floor($remainingTime / 3600);
            $minutes = floor(($remainingTime % 3600) / 60);
            $seconds = $remainingTime % 60;

            // Format the output string
            // Format the output string with words "hours", "minutes", and "seconds"
            $formattedTime = $hours . " hours, " . $minutes . " minutes, and " . $seconds . " seconds";
            

            echo "<span class='alert alert-danger'>Be more Patient. Wait for " . $formattedTime . " before Trying again.<span>";
            return;
        }
    }

    // Check if the recipient's username is in the blacklist
    if (in_array($recipient, $blacklistData)) {
        echo "<span class='text-danger'>Sorry, You are not allowed to use this faucet.</span><br><br><br>";
        return;
    }

    // Your existing code for sending transaction request...

    $url = "https://mefaucet.com/api/v1/send?receiver=$recipient&amount=$amount&currency=$currency&ip_address=$ipAddress&api_key=$apiKey";

    $response = file_get_contents($url);
    $transactionData = json_decode($response, true);
    if ($response == false) {

        echo "<span class='text-danger'>Error: Failed to send transaction .</span>";
    }
    if(isset($transactionData['result']) ==='fail') {

        echo "<span class='text-danger'>Error: Failed to send transaction .".$transactionData['messages']['fail']."</span><br><br><br>";
    } 
    if (isset($transactionData['result']) =='success') {
        $transactionData = json_decode($response, true);

        if (isset($transactionData['result']) =='success') {
            echo "<span class='alert alert-success'>Transaction successful. Sent ". $amount ." ".$currency. " to " . $recipient . "</span><br><br><br>"; 

            // Update the last submit time in the waitTime data for the recipient's username
            $waitTimeData[$recipient] = $currentTime;
            // Save the updated waitTime data to the file
            file_put_contents($waitTimeFile, json_encode($waitTimeData));

        } else {
            echo "<span class='text-danger'>Error: Transaction failed. Reason: " . (isset($transactionData['error']) ? $transactionData['error'] : 'Unknown. Report this to kat on discord pls!</span><br><br><br>');
        }
    }
}
?>
