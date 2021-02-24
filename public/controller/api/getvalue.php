<?php
require "class/Server.php";
$server = new Server();



if(isset($_POST["id"])) {
    if($_POST["id"] && $_POST["value"]) {
        echo $server->getValue($_POST["id"], $_POST["value"]);
    }
}

