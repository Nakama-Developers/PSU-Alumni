<?php

require "dbconfig.php";

// adding the company if not exist
        $currentCompanyIsExistQuery = "Select Count(*) From company Where Name = 'AAAA'";
        $q = $GLOBALS['db']-> query($currentCompanyIsExistQuery);
        $result = $q->fetchAll();
        $number = $result[0][0];
        echo  $number;
        if($number == 0){
            $insertNewCompanyQuery = "Insert Into company(Name) Values('AAAA')";
            $q = $GLOBALS['db']-> query($insertNewCompanyQuery);
            echo 'done';
        }
?>