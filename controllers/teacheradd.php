<?php

$id = $_POST["id"];
$name = $_POST["name"];
$mobile = $_POST["mobile"];
$salary = $_POST["salary"];

$data = array("Id" => $id, "Name" => $name, "MobileNo" => $mobile, "Salary" => $salary);
$json_string = json_encode($data);

$uri = "http://anbo-studentservice.azurewebsites.net/SchoolService.svc/teachers";
$ch = curl_init($uri);
// curl is good for more complex operations than just plain GET
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_string))
);

$jsondata = curl_exec($ch);
$theNewTeacher = json_decode($jsondata, true);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('teacher.html.twig');

$parametersToTwig = array("teacher" => $theNewTeacher);
echo $template->render($parametersToTwig);
