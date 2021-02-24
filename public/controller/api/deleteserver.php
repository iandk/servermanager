<?php
require "class/Server.php";
$server = new Server();



if(isset($_POST["id"])) {
    if($_POST["id"] ) {
        echo $server->deleteServer($_POST["id"]);
    }
}

