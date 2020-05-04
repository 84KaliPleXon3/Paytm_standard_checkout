# How to install the sample test files on a local web server:(wamp/xampp)
 1. Copy zip file in document root of your server (like /var/www/)
 2. login to https://dashboard.paytm.com/next/apikeys and find your test api keys.
 2. Open config_paytm.php file from the lib folder and update the below constant values.
    - PAYTM_MERCHANT_KEY – Provided by Paytm
    - PAYTM_MERCHANT_MID - Provided by Paytm
    - PAYTM_MERCHANT_WEBSITE - Provided by Paytm
 3. files:
    - Kart.php – Testing transaction through Paytm gateway.
    - pgRedirect.php – This file has the logic of checksum generation and passing all required parameters to Paytm PG. 
    - callback.php – This file has the logic for processing PG response after the transaction        processing.
    - search.php – Testing Status Query API
    
# Video installation demo 


# For Offline(Wallet Api) Checksum Utility below are the methods:
  1. getChecksumFromString : For generating the checksum
  2. verifychecksum_eFromStr : For verifing the checksum
  

