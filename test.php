<?php
include_once ("./common.php");
$reg_id="fKlICIvaz6Y:APA91bFhprUXd6PieCQt2OBpiSHqHdHWjUQJNe-AdgeKqAWaKioodVHub3QEkGPqBftU3RnjhvWcyNGczvdfe6-laqeIiDxONm2goKXEMYnioYz565hXEKcmwL20biwyT66ssmzcK31R";
$title="고파";
$content="test";
$apiKey = "AIzaSyBthrrN0WThkDJaIjpXj0d27a3AvavEadE";
$regId_array=array($reg_id);
$url = 'https://fcm.googleapis.com/fcm/send';

$fields = array(
    'registration_ids' => $reg_id,
    'data' => array( "title"=>$title,"message" => $content ),
);
$headers = array(
    'Authorization: key='.$apiKey,
    'Content-Type: application/json'
);
$ch = curl_init();
// Set the URL, number of POST vars, POST data
curl_setopt( $ch, CURLOPT_URL, $url);
curl_setopt( $ch, CURLOPT_POST, true);
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
// Execute post
$result = curl_exec($ch);
// Close connection
curl_close($ch);
$decode = json_decode($result, true);

print_r($decode);
?>