<?php
require "dbconfig.php";
require "printdata.php";
session_start();

// This is how the session filter array looks like:
//$_SESSION['filters'] = array('GPA' => ['2.0', '3.0']), 'Nationality' => ['saudi'], 'Company_size' => ['large'], 'Major' => ['Computer Science', 'Marketing', 'Finance']);

// unset($_SESSION['filters']);

/*** Responding to filter request ***/
if(isset($_SESSION['signedIn'])){
    if(isset($_GET['checked'])){
        if($_GET['checked'] == "true"){
            if(!isset($_SESSION['filters'])){
                $_SESSION['filters'] = array();
            }
            if(isset($_SESSION['filters'][$_GET['category']])){
                array_push($_SESSION['filters'][$_GET['category']], $_GET['value']);
            } else{
                $_SESSION['filters'][$_GET['category']] = array();
                array_push($_SESSION['filters'][$_GET['category']], $_GET['value']);
            }
            // echo extractQuery();
            echo json_encode(printRecords(1));
        }else{
            if(isset($_SESSION['filters'][$_GET['category']])){
                unset($_SESSION['filters'][$_GET['category']][array_search($_GET['value'],$_SESSION['filters'][$_GET['category']])]);
                $_SESSION['filters'][$_GET['category']] = removeGaps($_SESSION['filters'][$_GET['category']]);
                if(count($_SESSION['filters'][$_GET['category']]) === 0){
                    unset($_SESSION['filters'][$_GET['category']]);
                    if(count($_SESSION['filters']) === 0){
                        unset($_SESSION['filters']);
                    }
                }
            }
            //echo extractQuery();
            echo json_encode(printRecords(1));
        }
    }
}

function removeGaps($array){
    $cleanArray = array();
    $counter = count($array);
    for($i = 0; $i < $counter; $i++){
        array_push($cleanArray, array_pop($array));
    }
    return $cleanArray;
}
?>
