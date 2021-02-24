<?php
require "class/Server.php";
$server = new Server();

if(isset($_POST["id"])) {
    echo $server->getValues($_POST["id"]);
}