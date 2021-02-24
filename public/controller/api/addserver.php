<?php
require "class/Server.php";
$server = new Server();

if(!isset($_POST["id"])) {
    $_POST["id"] = null;
}

if(isset($_POST["name"])) {
    if($_POST["name"] && $_POST["hostname"] && $_POST["location"] && $_POST["tags"]) {
        echo $server->addServer($_POST["id"], $_POST["name"], $_POST["hostname"], $_POST["location"], $_POST["tags"], $_POST["ressources"], $_POST["provider"], $_POST["ips"], $_POST["type"], $_POST["os"], $_POST["price"], $_POST["notes"]);
    }
}

