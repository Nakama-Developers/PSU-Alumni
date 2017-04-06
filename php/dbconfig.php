<?php

$dbtype = "mysql";
$dbname = "psu-alumni-v1";
$hostname= "localhost";
$username = "root";
$password = "";

try{
    $db = new PDO("{$dbtype}:host=$hostname;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    echo "Can't connect to DB " . $e->getMessage();
}

?>