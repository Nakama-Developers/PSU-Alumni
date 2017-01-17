<?php
require "dbconfig.php";
require "printdata.php";
//session_start();

if(isset($_SESSION['signedIn'])) {
    if(isset($_GET['pageNum'])){
        echo json_encode(printRecords($_GET['pageNum']));

    }
} else{
    echo "no access";
}

?>