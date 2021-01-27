<?php
require "class/Server.php";
$server = new Server();

if(isset($_POST["name"])) {
    echo $server->getValues($_POST["name"]);
}