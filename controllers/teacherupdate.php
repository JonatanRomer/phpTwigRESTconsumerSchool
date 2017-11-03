<?php

$id = $_GET["id"];

$uri = "http://anbo-studentservice.azurewebsites.net/SchoolService.svc/teachers/" . $id;
$jsondata = file_get_contents($uri);
//print_r($jsondata);
$convertToAssociativeArray = true;
$teacher = json_decode($jsondata, $convertToAssociativeArray);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('teacherforupdate.html.twig');

$parametersToTwig = array("teacher" => $teacher);
echo $template->render($parametersToTwig);