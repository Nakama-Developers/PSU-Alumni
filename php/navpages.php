<?php

require "dbconfig.php";
require "printdata.php";
session_start();

if(isset($_SESSION['signedIn'])){
    if(isset($_GET['pageNum'])){
        $printedRecordsNum = 0;
        if(!isset($_SESSION['sort']) && !isset($_SESSION['filter'])){
            $q = $db->query("SELECT * FROM student_info;");
            $studentsRows = "";
            $rows = $q->fetchAll();
            $starter = ($_GET['pageNum'] - 1) * $recordsPerPage;
            $end = $_GET['pageNum'] * $recordsPerPage;
            for($i = $starter; $i < $end; $i++){
                if(isset($rows[$i])){
                    $printedRecordsNum++;
                    $studentsRows .= ('<div class="record">' . 
                    printStudentRow($rows[$i]) . printStudentProfile($rows[$i]) .
                    '</div>');  
                } else{
                    break;
                }
            }
            $result = array('resultsNum' => $printedRecordsNum, 'studentsRows' => $studentsRows);
            
            echo json_encode($result);   
        }
    }   
} else{
    echo "no access";
}

?>