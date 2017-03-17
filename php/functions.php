<?php
require "printdata.php";
session_start();
if(isset($_SESSION['signedIn'])){
    function filter(){
        // This is how the session filter array looks like:
        //$_SESSION['filters'] = array('GPA' => ['2.0', '3.0']), 'Nationality' => ['saudi'], 'Company_size' => ['large'], 'Major' => ['Computer Science', 'Marketing', 'Finance']);
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
                // echo extractQuery();
                echo json_encode(printRecords(1));
            }
    }

    function sortRecords(){
        $_SESSION['sort'] = $_GET['sort-method'];
        echo json_encode(printRecords(1));
    }

    function navPages(){
        if(isset($_GET['pageNum'])){
            $output = array('records' => printRecords($_GET['pageNum']), 'pinnedRecords' => $_SESSION['pinStateChange']);
            if($_SESSION['pinStateChange'] == 1){
                $output = array('records' => printRecords($_GET['pageNum']), 'pinnedRecords' => printPinnedRecords());
                $_SESSION['pinStateChange'] = NULL;
            }
            echo json_encode($output);
        }
    }

    function pin($id){
        if(!isset($_SESSION['pinned'])){
            $_SESSION['pinned'] = array();
        }
        array_push($_SESSION['pinned'], $id);
        $_SESSION['pinStateChange'] = 1;
        $array = array("recieved" => 1, "type" => "pin", "query" => pinToQuery());
        echo json_encode($array);
    }

    function unpin($id){
        if(isset($_SESSION['pinned'])){
            unset($_SESSION['pinned'][array_search($id, $_SESSION['pinned'])]);
            $_SESSION['pinned'] = removeGaps($_SESSION['pinned']);
            if(count($_SESSION['pinned']) == 0){
                unset($_SESSION['pinned']);
            }
            $_SESSION['pinStateChange'] = 1;
        }
        $array = array("recieved" => 1, "type" => "unpin", "query" => pinToQuery());
        echo json_encode($array);
    }

    function setFeild($num, $value){
        if(isset($_SESSION['headers'])){
            $_SESSION['headers'][$num] = $value;
            $_SESSION['pinStateChange'] = 1;
        }
    }

    function search($value, $type){
        $_SESSION['search'] = array($type, $value);
        echo json_encode(printRecords(1));
    }

} else{
    header("location: ../login.php");
}
?>