<?php

require "dbconfig.php";
require "printdata.php";
// session_start();

$_SESSION['sort'] = $_GET['sort-method'];
echo printRecords(1);
?>
