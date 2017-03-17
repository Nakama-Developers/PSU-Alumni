<?php

require "dbconfig.php";
// session_start();

function extractQuery(){
    if(isset($_SESSION['sort']) && isset($_SESSION['filters'])){

        if($_SESSION['sort'] === "GPA" || $_SESSION['sort'] === "Graduation_year"){
            $query = "SELECT * FROM student_info WHERE " . filterToQuery() . integrateNotPinQuery(1) . searchToQuery() . " ORDER BY {$_SESSION['sort']} DESC";
        }else{
            $query = "SELECT * FROM student_info WHERE " . filterToQuery() . integrateNotPinQuery(1) . searchToQuery() . " ORDER BY {$_SESSION['sort']}";   
        }

    }else if (isset($_SESSION['sort'])){

        if($_SESSION['sort'] === "GPA" || $_SESSION['sort'] === "Graduation_year"){
            $query = "SELECT * FROM student_info " . integrateNotPinQuery(0) . searchToQuery() . " ORDER BY {$_SESSION['sort']} DESC";
        }else{
            $query = "SELECT * FROM student_info " . integrateNotPinQuery(0) . searchToQuery() . " ORDER BY {$_SESSION['sort']}";   
        }

    } else if (isset($_SESSION['filters'])){
        $query = "SELECT * FROM student_info WHERE " . filterToQuery() . integrateNotPinQuery(1) . searchToQuery();
    } else{
        $query = "SELECT * FROM student_info " . integrateNotPinQuery(0) . searchToQuery();
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
        }if(isset($_SESSION['filters']['Graduation_year'])){
            $gradyearfilters = array();
            for($i = 0; $i < count($_SESSION['filters']['Graduation_year']); $i++){
                array_push($gradyearfilters, gradYearToQuery($_SESSION['filters']['Graduation_year'][$i]));
            }
            array_push($q, "(" . implode(' OR ', $gradyearfilters) .") ");
        }
        if(isset($q)){
            $query = implode(' AND ', $q);
            return $query;   
        }
    }
}

function integrateNotPinQuery($isFiltered){
    if(isset($_SESSION['pinned'])){
        if($isFiltered){
            return "AND NOT " . pinToQuery();
        } else{
            return "WHERE NOT " . pinToQuery();
        }
    }else{
        return '';
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
        case 'Information Systems':
          $filter = "Major= 'Information Systems'";
          break;
    }
    return $filter;
}

function gradYearToQuery($str){
    return "Graduation_year = " . $str;
}

function pinToQuery(){
    if(isset($_SESSION['pinned'])){
        $q = array();
        for($i = 0; $i < count($_SESSION['pinned']); $i++){
            array_push($q, "Student_ID = '" . $_SESSION['pinned'][$i] . "'");
        }
        return "(" . implode(' OR ', $q) . ") ";
    }

}

function feildToQuery($str){
    switch ($str) {
        case 'Major':
          return $str;
        case 'Co-op Company':
          return 'Coop_Company';
        case 'E-mail':
          return 'email';
        case 'Current Company':
          return 'Current_Company';
        case 'Company Size':
          return 'Company_size';
        case 'Job Title':
          return 'Job_title';
        case 'Nationality':
          return $str;
        case 'Phone':
          return 'GPA';
        default:
            return 'Student_ID';
    }
}

function searchToQuery(){
    if(isset($_SESSION['search'])){
        if(!isset($_SESSION['pinned']) && !isset($_SESSION['filters'])){
            if($_SESSION['search'][0] === 'comp-name'){
                return " WHERE (Coop_Company LIKE '%" . $_SESSION['search'][1] . "%' OR Current_Company LIKE '%" . $_SESSION['search'][1] . "%')";
            }
            return " WHERE {$_SESSION['search'][0]} LIKE '%" . $_SESSION['search'][1] . "%'";
        } else{
            if($_SESSION['search'][0] === 'comp-name'){
                return " AND (Coop_Company LIKE '%" . $_SESSION['search'][1] . "%' OR Current_Company LIKE '%" . $_SESSION['search'][1] . "%')";
            }
            return " AND {$_SESSION['search'][0]} LIKE '%" . $_SESSION['search'][1] . "%'";
        }   
    } else{
        return '';
    }
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

function isPinned($id){
    if(array_search($id, $_SESSION['pinned']) !== FALSE){
        return 'pinned';
    } else{
        return FALSE;
    }
}
?>