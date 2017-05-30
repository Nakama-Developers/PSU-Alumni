<?php
require('functions.php');
$req;

if(isset($_GET['req'])){
    $req = $_GET['req'];
} else if(isset($_POST['req'])){
    $req = $_POST['req'];
}

if($req != NULL){
    switch ($req){
        case 'filter':
            if(isset($_GET['checked'])){
                filter();
            }
            break;
        case 'sort':
            if(isset($_GET['sort-method'])){
                sortRecords();
            }
            break;
        case 'nav':
            navPages();
            break;
        case 'pin':
            if(isset($_GET['id'])){
                if($_GET['isPinned'] != "true"){
                    pin($_GET['id']);
                }else{
                    unpin($_GET['id']);
                }
            }
            break;
        case 'feild':
            setFeild($_GET['id'], $_GET['feild']);
            break;
        case 'search':
            search($_GET['value'], $_GET['type']);
            break;
        case 'excel':
            exportToExcel($_GET['exportConfigData']);
            break;
        case 'invite':
            invite($_POST['id']);
            break;
        case 'undo-invite':
            undoInvite($_POST['id']);
            break;
        case 'store':
            decodingEditedStudentData($_GET['information'], $_GET['data']);
            break;
        case 'upload-cv':
            uploadCV($_GET['studentID']);
            break;
        default:
            break;
    }
}
?>