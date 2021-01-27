<?php
require "class/Server.php";
$server = new Server();



if(isset($_POST["name"])) {
    if($_POST["name"] ) {
        echo $server->deleteServer($_POST["name"]);
    }
}

