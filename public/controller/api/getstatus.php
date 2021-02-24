<?php
require "class/Server.php";
$server = new Server();



if(isset($_POST["id"])) {
    echo $server->getStatus($_POST["id"]);
}

