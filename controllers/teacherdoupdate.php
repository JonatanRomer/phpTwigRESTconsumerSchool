<?php
echo "request: ";
//print_r($_REQUEST);

$id = $_REQUEST["id"];
$name = $_REQUEST["name"];
$mobile = $_REQUEST["mobile"];
$salary = $_REQUEST["salary"];

$data = array("Id" => $id, "Name" => $name, "MobileNo" => $mobile, "Salary" => $salary);
//print_r($data);
$json_string = json_encode($data);

$uri = "http://anbo-studentservice.azurewebsites.net/SchoolService.svc/teachers";
$uri = $uri . "/". $id;
echo $uri;
$ch = curl_init($uri);
// curl is good for more complex operations than just plain GET
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_string))
);

$jsondata = curl_exec($ch);
//print_r($jsondata);
$theUpdatedTeacher = json_decode($jsondata, true);

//print_r($theUpdatedTeacher);
//return;
// https://stackoverflow.com/questions/46553921/how-to-move-from-current-php-page-to-another-php-page-if-condition-true
$host = $_SERVER['HTTP_HOST'];
header("Location: http://{$host}/phpTwigRESTconsumerSchool/controllers/teacherbyname.php");
return;