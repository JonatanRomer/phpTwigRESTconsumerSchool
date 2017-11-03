<?php
/**
 * Created by PhpStorm.
 * User: EASJ
 * Date: 03/11/2017
 * Time: 11:10
 */

$id = $_GET["id"];

$uri = "http://anbo-studentservice.azurewebsites.net/SchoolService.svc/teachers";
$uri = $uri . "/" . $id;
echo $uri;
$ch = curl_init($uri);

// curl is good for more complex operations than just plain GET
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

$jsondata = curl_exec($ch);
$theDeletedTeacher = json_decode($jsondata, true);

// https://stackoverflow.com/questions/46553921/how-to-move-from-current-php-page-to-another-php-page-if-condition-true
$host = $_SERVER['HTTP_HOST'];
header("Location: http://{$host}/phpTwigRESTconsumerSchool/controllers/teacherbyname.php");
return;

/*
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('teacher.html.twig');

$parametersToTwig = array("teacher" => $theDeletedTeacher);
echo $template->render($parametersToTwig);
*/
