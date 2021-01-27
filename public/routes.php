<?php



$router->get('', 'controller/index.php');


# API routes


$router->get('api', 'controller/api/api.php');
$router->post('api', 'controller/api/api.php');

$router->get('api/listserver', 'controller/api/listserver.php');
$router->post('api/listserver', 'controller/api/listserver.php');

$router->get('api/addserver', 'controller/api/addserver.php');
$router->post('api/addserver', 'controller/api/addserver.php');

$router->get('api/deleteall', 'controller/api/deleteall.php');
$router->post('api/deleteall', 'controller/api/deleteall.php');

$router->get('api/deleteserver', 'controller/api/deleteserver.php');
$router->post('api/deleteserver', 'controller/api/deleteserver.php');

$router->get('api/countserver', 'controller/api/countserver.php');
$router->post('api/countserver', 'controller/api/countserver.php');

$router->get('api/getvalue', 'controller/api/getvalue.php');
$router->post('api/getvalue', 'controller/api/getvalue.php');

$router->get('api/showsingle', 'controller/api/showsingle.php');
$router->post('api/showsingle', 'controller/api/showsingle.php');

$router->get('api/getstatus', 'controller/api/getstatus.php');
$router->post('api/getstatus', 'controller/api/getstatus.php');