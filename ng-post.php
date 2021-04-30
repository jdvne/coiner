<?php

// header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

// retrieve data from the request
$postdata = file_get_contents("php://input");

// process data
// extract json format to PHP array
$request = json_decode($postdata);

$data = [];
foreach ($request as $k => $v)
{
    $temp = "$k => $v";
    $data[0]['post_'.$k] = $v;
}

$current_date = date("Y-m-d");
// send response (json) back to the front end
echo json_encode(['content'=>$data, 'response_on'=>$current_date]);
?>