<?php

require "dbconfig.php";
// session_start();

function extractQuery(){
    if(isset($_SESSION['sort']) && isset($_SESSION['filters'])){

        if($_SESSION['sort'] === "GPA" || $_SESSION['sort'] === "Graduation_year"){
            $query = "SELECT * FROM student_info " . filterToQuery() . " ORDER BY {$_SESSION['sort']} DESC;";
        }else{
            $query = "SELECT * FROM student_info " . filterToQuery() . " ORDER BY {$_SESSION['sort']};";   
        }

    }else if (isset($_SESSION['sort'])){

        if($_SESSION['sort'] === "GPA" || $_SESSION['sort'] === "Graduation_year"){
            $query = "SELECT * FROM student_info ORDER BY {$_SESSION['sort']} DESC;";
        }else{
            $query = "SELECT * FROM student_info ORDER BY {$_SESSION['sort']};";   
        }

    } else if (isset($_SESSION['filters'])){
        $query = "SELECT * FROM student_info " . filterToQuery() . ";";
    } else{
        $query = "SELECT * FROM student_info;";
    }
    return $query;
}

function filterToQuery(){
    if(isset($_SESSION['filters'])){
        $q = array();
        if(isset($_SESSION['filters']['GPA'])){
            $gpafilters = array();
            for($i = 0; $i < count($_SESSION['filters']['GPA']); $i++){
                array_push($gpafilters, gpaToQuery($_SESSION['filters']['GPA'][$i]));
            }
            array_push($q, "(" . implode(' OR ', $gpafilters) .") ");

        }if(isset($_SESSION['filters']['Nationality'])){
            $nationalitiesfilters = array();
            for($i = 0; $i < count($_SESSION['filters']['Nationality']); $i++){
                array_push($nationalitiesfilters, nationalityToQuery($_SESSION['filters']['Nationality'][$i]));
            }
            array_push($q, "(" . implode(' OR ', $nationalitiesfilters) .") ");

        }if(isset($_SESSION['filters']['Company_size'])){
            $companysizefilters = array();
            for($i = 0; $i < count($_SESSION['filters']['Company_size']); $i++){
                array_push($companysizefilters, compSizeToQuery($_SESSION['filters']['Company_size'][$i]));
            }
            array_push($q, "(" . implode(' OR ', $companysizefilters) .") ");

        }if(isset($_SESSION['filters']['Major'])){
            $majorfilters = array();
            for($i = 0; $i < count($_SESSION['filters']['Major']); $i++){
                array_push($majorfilters, majorToQuery($_SESSION['filters']['Major'][$i]));
            }
            array_push($q, "(" . implode(' OR ', $majorfilters) .") ");
        }
        if(isset($q)){
            $query = "WHERE " . implode(' AND ', $q);
            return $query;   
        }
    }
}

function gpaToQuery($str){
    $filter = '';
    switch ($str) {
        case '0':
          $filter = 'GPA > 0 AND GPA <=2';
          break;

        case '2':
          $filter = 'GPA > 2 AND GPA <=2.5';
          break;
	  
	     case '2.5':
          $filter = 'GPA > 2.5 AND GPA <=3';
          break;

        case '3':
          $filter = 'GPA > 3 AND GPA <=3.5';
          break;

        case '3.5':
          $filter = 'GPA > 3.5 AND GPA <=4';
          break;
    }
    return $filter;
}
function nationalityToQuery($str){
    $filter = '';
    switch ($str) {
        case 'saudi':
          $filter = "Nationality= 'Saudia Arabia'";
          break;

        case 'nosaudi':
          $filter = "Nationality!= 'Saudia Arabia'";
          break;
    }
    return $filter;
}

function compSizeToQuery($str){
    $filter = '';
    switch ($str) {
        case 'small':
          $filter = "Company_size= 'small'";
          break;

        case 'medium':
          $filter = "Company_size= 'Medium'";
          break;

        case 'large':
          $filter = "Company_size= 'large'";
          break;
    }
    return $filter;
}

function majorToQuery($str){
    $filter = '';
    switch ($str) {
        case 'Finance':
          $filter = "Major= 'finance'";
          break;

        case 'Marketing':
          $filter = "Major= 'Marketing'";
          break;

        case 'Computer Science':
          $filter = "Major= 'Computer Science'";
          break;
    }
    return $filter;
}

function isChecked($value, $category){
    $isChecked = 'No';
    if(isset($_SESSION['filters'][$category])){
        if(array_search($value, $_SESSION['filters'][$category]) !== FALSE){
            $isChecked = "checked";
        }
    }

    return $isChecked;
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