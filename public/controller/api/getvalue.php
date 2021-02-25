<?php
require "class/Server.php";
$server = new Server();


// Workaround, since the vars are "optional"
echo $server->getValue($id = null, $value = null);
