<?php


class Server {
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
    function addServer($name, $hostname, $location, $tags, $ressources, $provider, $ips, $type, $os, $price, $notes) {
        $this->name = $name;
        $this->hostname = $hostname;
        $this->location = $location;
        $this->tags = $tags;
        $this->ressources = $ressources;
        $this->provider = $provider;
        $this->ips = $ips;
        $this->type = $type;
        $this->os = $os;
        $this->price = $price;
        $this->notes = $notes;
        // Write data to json file
        $this->writeToFile();
        return true;
    }

    // Delete the server with the given name
    function deleteServer($name) {
        $filename = "data/" . $name . ".json";
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
                if ($entry != "." && $entry != "..") {    
                    // Remove .json ending
                    $name = str_replace(".json", "", $entry);
                    $newEntry = array(
                        "name" => $this->getValue($name, "name"),
                        "hostname" => $this->getValue($name, "hostname"),
                        "location" => $this->getValue($name, "location"),
                        "tags" => $this->getValue($name, "tags"),
                        "ressources" => $this->getValue($name, "ressources"),
                        "provider" => $this->getValue($name, "provider"),
                        "type" => $this->getValue($name, "type"),
                        "os" => $this->getValue($name, "os"),
                        "ips" => $this->getValue($name, "ips"),
                        "price" => $this->getValue($name, "price"),
                        "notes" => $this->getValue($name, "notes"),
                    );
                    // Add to array
                    array_push($listServer, $newEntry);
                }
            }
            return json_encode($listServer);
            closedir($handle);
        }
    }

    // Helper function for writeToFile
    function dumpAll() {
        $jsonData = array(
            "name" => $this->name,
            "hostname" => $this->hostname,
            "location" => $this->location,   
            "tags" => $this->tags,   
            "ressources" => $this->ressources,   
            "provider" => $this->provider,   
            "ips" => $this->ips,
            "price" => $this->price,
            "type" => $this->type,
            "os" => $this->os,    
            "notes" => $this->notes
        );
        return json_encode($jsonData);
    }
    
    function writeToFile() {
        // Create new json file to store data
        $file = fopen("data/" . $this->name . ".json", "w");
        fwrite($file, $this->dumpAll());
    }

    function getValue($name, $value) {
        $filename = "data/" . $name . ".json";
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

    function getValues($name) {
        $filename = "data/" . $name . ".json";
        if(file_exists($filename)) {
            $file = file_get_contents($filename);
            return $file;
        }
        else {
            return false;
        }
    }

    function getStatus($name) {
        $ip =  $this->getValue($name, "hostname");
        exec("/sbin/ping -W 2 -c 3 $ip", $output, $status);
        if ($status == 0) {
            return true;
        }
        else {
            return false;
        }
    }
}