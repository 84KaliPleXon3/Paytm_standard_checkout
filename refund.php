<?php
/**
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
require_once("lib/config_paytm.php");
require_once("lib/encdec_paytm.php");

/* initialize an array */
$paytmParams = array();

/* body parameters */
$paytmParams["body"] = array(

    /* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
    "mid" => PAYTM_MERCHANT_MID,

    /* This has fixed value for refund transaction */
    "txnType" => "REFUND",

    /* Enter your order id for which refund needs to be initiated */
    "orderId" => "ORDS43870265",

    /* Enter transaction id received from Paytm for respective successful order */
    "txnId" => "20200503111212800110168174101492212",

    /* Enter numeric or alphanumeric unique refund id */
    "refId" => "43870265",

    /* Enter amount that needs to be refunded, this must be numeric */
    "refundAmount" => "5.00",
);

/**
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = getChecksumFromString(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), PAYTM_MERCHANT_KEY);

/* head parameters */
$paytmParams["head"] = array(

    /* This is used when you have two different merchant keys. In case you have only one please put - C11 */
    "clientId"	=> "C11",

    /* put generated checksum value here */
    "signature"	=> $checksum
);

/* prepare JSON string for request */
$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw-stage.paytm.in/refund/apply";

/* for Production */
// $url = "https://securegw.paytm.in/refund/apply";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ( $httpCode != 200 ){
    echo "Return code is {$httpCode} \n".curl_error($ch);
} else {
    echo "<pre>".htmlspecialchars($response)."</pre>";
}

curl_close($ch);

?>
