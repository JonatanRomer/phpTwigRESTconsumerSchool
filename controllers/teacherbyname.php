<?php

$uri = "http://anbo-studentservice.azurewebsites.net/SchoolService.svc/teachers";
$jsondata = file_get_contents($uri);
//print_r($jsondata);
$convertToAssociativeArray = true;
$teachers = json_decode($jsondata, $convertToAssociativeArray);

print_r($teachers);
//return;

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('teachers.html.twig');

$parametersToTwig = array("teachers" => $teachers);
echo $template->render($parametersToTwig);