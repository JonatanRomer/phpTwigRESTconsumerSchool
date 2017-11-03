<?php
$id = $_GET["id"];
$uri = "http://anbo-studentservice.azurewebsites.net/SchoolService.svc/teachers/". $id ."/classes";
$jsondata = file_get_contents($uri);
//print_r($jsondata);
$convertToAssociativeArray = true;
$classes = json_decode($jsondata, $convertToAssociativeArray);

print_r($classes);
//return;

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('classes.html.twig');

$parametersToTwig = array("classes" => $classes);
echo $template->render($parametersToTwig);