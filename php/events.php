<?php
require('functions.php');

if(isset($_GET['req'])){
    switch ($_GET['req']){
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
        default:
            break;
    }
}
?>
