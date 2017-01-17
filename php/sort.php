<?php

require "dbconfig.php";
require "printdata.php";
// session_start();

$_SESSION['sort'] = $_GET['sort-method'];
echo json_encode(printRecords(1));
?>
