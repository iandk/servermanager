<?php



$router->get('', 'controller/index.php');


# API routes


$router->get('api', 'controller/api/api.php');
$router->post('api', 'controller/api/api.php');

$router->get('api/listserver', 'controller/api/listserver.php');
$router->post('api/listserver', 'controller/api/listserver.php');

$router->get('api/addserver', 'controller/api/addserver.php');
$router->post('api/addserver', 'controller/api/addserver.php');

$router->get('api/deleteserver', 'controller/api/deleteserver.php');
$router->post('api/deleteserver', 'controller/api/deleteserver.php');

$router->get('api/countserver', 'controller/api/countserver.php');
$router->post('api/countserver', 'controller/api/countserver.php');

$router->get('api/getvalue', 'controller/api/getvalue.php');
$router->post('api/getvalue', 'controller/api/getvalue.php');

$router->get('api/getvalues', 'controller/api/getvalues.php');
$router->post('api/getvalues', 'controller/api/getvalues.php');

$router->get('api/getstatus', 'controller/api/getstatus.php');
$router->post('api/getstatus', 'controller/api/getstatus.php');


$router->get('api/isfirstsetup', 'controller/api/isfirstsetup.php');
$router->post('api/isfirstsetup', 'controller/api/isfirstsetup.php');

$router->get('api/completesetup', 'controller/api/completesetup.php');
$router->post('api/completesetup', 'controller/api/completesetup.php');