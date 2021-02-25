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
        $this->name = $_POST['name'];
        $this->hostname = $_POST['hostname'];
        $this->location = $_POST['location'];
        $this->tags = $_POST['tags'];
        $this->ressources = $_POST['ressources'];
        $this->provider = $_POST['provider'];
        $this->ips = $this->storeIps($_POST['ips']);
        $this->type = $_POST['type'];
        $this->os = $_POST['os'];
        $this->price = $_POST['price'];
        $this->notes = $_POST['notes'];
        // Write data to json file
        $this->writeToFile();
        return $this->id;
    }

    // Prepare IP/ASN objects
    function storeIps(string $ips): array {
        $ip_list = preg_split("/[\s,]+/", $ips);
        $result = [];
        foreach ($ip_list as &$ip) {
            array_push($result,array(
                "ip" => $ip,
                "asn" => $this->getAsnForIp($ip)
            ));
        }
        return $result;
    }
   
    // Write the host details to the file    
    function writeToFile() {
        $jsonData = array(
            "id" => $this->id,
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
                    // Remove .json ending
                    $id = str_replace(".json", "", $entry);
                    $newEntry = array(
                        "id" => $this->getValue($id, "id"),
                        "name" => $this->getValue($id, "name"),
                        "hostname" => $this->getValue($id, "hostname"),
                        "location" => $this->getValue($id, "location"),
                        "tags" => $this->getValue($id, "tags"),
                        "ressources" => $this->getValue($id, "ressources"),
                        "provider" => $this->getValue($id, "provider"),
                        "type" => $this->getValue($id, "type"),
                        "os" => $this->getValue($id, "os"),
                        "ips" => $this->getValue($id, "ips"),
                        "price" => $this->getValue($id, "price"),
                        "notes" => $this->getValue($id, "notes"),
                    );
                    // Add to array
                    array_push($listServer, $newEntry);
                }
            }
            closedir($handle);
        }
        return json_encode($listServer);
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

    // Fetch ASN for an IP address
    function getAsnForIp(string $ip): string {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE)) {
            $parts = explode('.',$ip);
            $dnslookup = implode('.', array_reverse($parts)) . '.origin.asn.cymru.com.';
        }
            elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE)) {
            $addr = inet_pton($ip);
            $unpack = unpack('H*hex', $addr);
            $hex = $unpack['hex'];
            $dnslookup = implode('.', array_reverse(str_split($hex))) . '.origin6.asn.cymru.com.';
        }

        if (isset($dnslookup)) {
            $record = dns_get_record($dnslookup, DNS_TXT);
            if (isset($record['0']['txt'])) {
                // example: 3356 | 4.0.0.0/9 | US | arin | 1992-12-01
                $result = explode(" | ", $record['0']['txt']);
                $asn_id = array_shift($result);
                $asn_name = $this->getAsnName(intval($asn_id));
                return $asn_id . " - " . $asn_name;
            }
        }

        return "private IP";
    }

    // Fetch ASN description for an ASN id
    public function getAsnName(int $asn): string {
        //AS3356.asn.cymru.com
        $dnslookup = 'AS' . $asn . '.asn.cymru.com.';
        $record = dns_get_record($dnslookup, DNS_TXT);
        if (isset($record['0']['txt'])) {
            // example: 3356 | US | arin | 2000-03-10 | LEVEL3, US
            $result = explode(" | ", $record['0']['txt']);
            $name = end($result);
            return $name;
        }

        return "n/a";
    }
}