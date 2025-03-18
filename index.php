<?php require('config.php');?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?=$faucetName?> </title>
        <meta name="keywords" content="mefaucet,crypto faucet, Beginner crypto, Earn free crypto, Free crypto currency, Free, instant faucet">
        <meta name="description" content="Get Free 0.01-5 free duinocoin once a day">
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
            <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body style="background-color: rgb(185, 229, 250);color: #333;">
         <script>
            // Function to apply dark mode based on the user's preferred color scheme
            function applyDarkMode() {
                var body = document.body;
                var prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;

                if (prefersDarkMode) {
                    body.classList.add("dark-mode");
                } else {
                    body.classList.remove("dark-mode");
                }
            }

            // Call the applyDarkMode function when the window loads
            window.addEventListener("load", applyDarkMode);

            // Call the applyDarkMode function when the user changes their preferred color scheme
            window.matchMedia("(prefers-color-scheme: dark)").addListener(applyDarkMode);
        </script>
         
        <header>
            <h1> <?=$faucetName?></h1>
        </header>
        
        <div class="ads">
           <iframe src="https://zerads.com/ad/ad.php?width=728&ref=7615" marginwidth="0" marginheight="0" width="728" height="90" scrolling="no" border="0" frameborder="0"></iframe>
        </div>
        <h2>Enter your MeFaucet username or email or id to get 0.0001 Usd!</h2>
        <a href="https://mefaucet.com" target="about" style="color:indigo"><h5>Join MeFaucet!</h5></a>

       <div class="row">
        <div class="col-12 col-md-8 col-lg-6 order-md-2 mb-4 text-center">
        <form action="" method="post" onsubmit="return validateForm()">
            <label for="username">username / email / id:</label>
            <input type="text" id="username" name="username" required>
            <div class="g-recaptcha ads" data-sitekey="<?=$recaptchaSitekey?>"></div>
            <input type="submit" value="Get free <?=$currency?>">
        </form>
        <script>
            function validateForm() {
            var response = grecaptcha.getResponse();
            if (!response) {
                alert('Please complete the Captcha.');
                return false;
            }
            return true;
            }
        </script>


        <h2>Faucet balance</h2>
        <p id="balance" class="btn btn-light text-success"><b>

            <?php

            $url = "https://mefaucet.com/api/v1/get-balance?api_key=$apiKey&currency=$currency";
            $json = @file_get_contents($url);
            if ($json === FALSE) {
                echo 'Error fetching balance';
            } else {
                $data = json_decode($json, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo 'Error decoding JSON: ' . json_last_error_msg();
                } else {
                    if (isset($data['result']['0']['usd_balance'])) {
                        $balance = $data['result']['0']['usd_balance'];
                        echo "Balance: $balance $currency";
                    } else {
                        echo 'Error: Balance not found in the response';
                    }
                }
            }
        ?>
         </b></p><br><br>
        <a href="https://mefaucet.com/free-script" target="about">Start your own faucet for free!<br><br> Download MeFaucet Free Script <?=$faucetVersion?></a>
        <br><br>
                        <?php include('faucet.php');?>   

        </div>
        
        <div class="col-6 col-md-2 col-lg-3 order-md-1 p-0 left-ads"><iframe data-aa='2383443' src='//ad.a-ads.com/2383443?size=120x600' style='width:120px; height:600px; border:0px; padding:0; overflow:hidden; background-color: transparent;'></iframe>
</div>
        <div class="col-6 col-md-2 col-lg-3 order-md-3 p-0 right-ads"><iframe data-aa='2383443' src='//ad.a-ads.com/2383443?size=120x600' style='width:120px; height:600px; border:0px; padding:0; overflow:hidden; background-color: transparent;'></iframe>
</div>
        




         </div>

                 <div class="ads">
            <iframe src="https://zerads.com/ad/ad.php?width=300&ref=7615" marginwidth="0" marginheight="0" width="300" height="250" scrolling="no" border="0" frameborder="0"></iframe>
        </div>
<br><br><br>
<footer>
    <p>
        <?= date('Y')?>
        MeFaucet Free Script 
        <?=$faucetVersion?> Powered by <a href="https://mefaucet.com" target="about">Mefaucet</a>
    </p>
</footer>
</body>

</html>