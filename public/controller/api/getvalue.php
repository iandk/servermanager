<?php
require "class/Server.php";
$server = new Server();



if(isset($_POST["name"])) {
    if($_POST["name"] && $_POST["value"]) {
        echo $server->getValue($_POST["name"], $_POST["value"]);
    }
}

