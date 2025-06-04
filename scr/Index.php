<?php
//Docker Test
//echo phpversion();

// Read the variables sent via POST from our API
$sessionId   = $_GET["sessionId"];
$serviceCode = $_GET["serviceCode"];
$networkCode = $_GET["networkCode"];
$phoneNumber = $_GET["phoneNumber"];
$text        = $_GET["text"];

function stripNonNumeric($input) {
    // Use preg_replace to remove anything that's not a digit
    return preg_replace('/\D/', '', $input);
}

function maskNonNumeric($input) {
    // Check if last character is non-numeric, remove it if so
    if (preg_match('/\D$/', $input)) {
        $input = substr($input, 0, -1);
    }
    // Replace remaining non-numeric characters with '*'
    $masked = preg_replace('/\D/', '*', $input);

    return $masked;
}

//$text= stripNonNumeric($text);
$orgText = $text;
$text= maskNonNumeric($text); 

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON What would you want to check \n";
    $response .= "1. My Account \n";
    $response .= "2. My phone number\n";
    $response .= " ";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Account number \n";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Your phone number is ".$phoneNumber;

} else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your account number is ".$accountNumber;

} else if ($text == "1*2"){
    $Balance = "NGN 10,000";

    $response = "END Your Balance is ".$Balance;
} else {
    $response = "END invalid USSD Code: ".$text."; orginal code:".$orgText;
}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;
?>