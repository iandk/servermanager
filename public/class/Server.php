<?php


class Server {

    private $id;
    private $name;
    private $hostname; 
    private $location;
    private $tags;
    private $ressources;
    private $provider;
    private $ips; 
    private $type;
    private $os; 
    private $price; 
    private $notes; 


    // Add new server 
    function addServer() {
        // If the method is called with "existingID", then a existing host should get updated instead of creating a new one
        // Generate a new unique ID if there was no ID given 
        if(!$_POST['id']) {
            $this->id = uniqid();
        } 
        // No ID was given, therefore update the existing host
        else {
            $this->id = $_POST['id'];
        }

        // Write data to json file
        $this->writeToFile();
        return $this->id;
    }
   
    // Write the host details to the file    
    function writeToFile() {
        $jsonData = array(
            "id" => $this->id,
            "name" => $_POST['name'],
            "hostname" => $_POST['hostname'],
            "location" => $_POST['location'],   
            "tags" => $_POST['tags'],   
            "ressources" => $_POST['ressources'],   
            "provider" => $_POST['provider'],   
            "ips" => $_POST['ips'],
            "price" => $_POST['price'],
            "type" => $_POST['type'],
            "os" => $_POST['os'],    
            "notes" => $_POST['notes'],
            "status" => "false"
        );
        // Create new json file to store data
        $file = fopen("data/" . $this->id . ".json", "w");
        fwrite($file, json_encode($jsonData));
    }

    // Delete the server with the given name
    function deleteServer() {
        $filename = "data/" . $_POST['id'] . ".json";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        else {
            return false;
        }
    }

    // Count all available servers
    function countServer() {
        $files = scandir("data/");
        // -2 since "." and ".." are also counted
        return json_encode(count($files)-2);
    }

    // List all server names
    function listServer() {
        $listServer = [];
        if ($handle = opendir('data/')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != ".gitkeep") { 
                    // Read file   
                    $file = json_decode(file_get_contents('data/' . $entry));
                    // Add to array
                    array_push($listServer, $file);
                }
            }
            return json_encode($listServer);
            closedir($handle);
        }
    }

    function getValue($id, $value) {
        
        # Fallback to $_POST if no vars are passed
        if(!isset($id)) {
            $id = $_POST['id'];
        }
        if (!isset($value)) {
            $value = $_POST['value'];
        }

        $filename = "data/" . $id . ".json";
        if(file_exists($filename)) {
            $file = fopen($filename, "r");
            $filecontent = json_decode(fread($file, filesize($filename)), true);
            if($filecontent[$value]) {
                return $filecontent[$value];
            } 
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    function getValues() {
        $filename = "data/" . $_POST['id'] . ".json";
        if(file_exists($filename)) {
            $file = file_get_contents($filename);
            return $file;
        }
        else {
            return false;
        }
    }

    function getStatus() {
        $ip = $this->getValue($_POST['id'], "hostname");
        exec("/usr/bin/ping -W 2 -c 3 $ip", $output, $status);
        if ($status == 0) {
            return true;
        }
        else {
            return false;
        }
    }
}