<?php
//echo phpversion();

// Read the variables sent via POST from our API
$serverReqMeth = $_SERVER['REQUEST_METHOD'] ?? "";
$serverRemoteIp = $_SERVER['REMOTE_ADDR'] ?? "";
$serverRemoteHostNam = $_SERVER['REMOTE_HOST'] ?? "";
$response = "";

if ($serverReqMeth == "GET"){
    $sessionId   = $_GET["sessionId"] ?? "";
    $serviceCode = $_GET["serviceCode"] ?? "";
    $networkCode = $_GET["networkCode"] ?? "";
    $phoneNumber = $_GET["phoneNumber"] ?? "";
    $text        = $_GET["text"] ?? "999";

}elseif ($serverReqMeth == "POST") {
    $sessionId   = $_POST["sessionId"] ?? "";
    $serviceCode = $_POST["serviceCode"] ?? "";
    $networkCode = $_POST["networkCode"] ?? "";
    $phoneNumber = $_POST["phoneNumber"] ?? "";
    $text        = $_POST["text"] ?? "998";
}else{
    $response .= "END Invalid Resource";
    echo $response;
    exit();
}
#Declaring Variables
include "dbConnect.php";
$db = new DbConnect();
$conn = $db->connect();



$DebugCode ="\n \n";
$DebugCode .= "sessionId: ".$sessionId."\n";
$DebugCode .= "serviceCode: ".$serviceCode."\n";
$DebugCode .= "networkCode: ".$networkCode."\n";
$DebugCode .= "phoneNumber: ".$phoneNumber."\n";
$DebugCode .= "text: ".$text."\n";
$DebugCode .= "ReqMeth: ".$serverReqMeth."\n";
$DebugCode .= "RemoteIp: ".$serverRemoteIp."\n";
$DebugCode .= "HostName: ".$serverRemoteHostNam."\n";






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
    $response .= "\n - USSD Application by Prince T Olajide-Ajire\n";
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

//if ( $phoneNumber== "2348160581180"){
    $response .= $DebugCode;
//}

// Echo the response back to the API
//header('Content-type: text/plain');
echo $response;
?>
