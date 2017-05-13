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

function extractExcelQuery(){
    if (isset($_SESSION['filters']) && isset($_SESSION['pinned'])){
        $query = "SELECT * FROM student_info WHERE " . filterToQuery() . " OR " . pinToQuery();
    } else if(isset($_SESSION['pinned'])){
        $query = "SELECT * FROM student_info WHERE " . pinToQuery();
    } else if(isset($_SESSION['filters'])){
        $query = "SELECT * FROM student_info WHERE " . filterToQuery();
    }else{
        $query = "SELECT * FROM student_info";
    }
    return $query;
}

function excelGroupByQuery($first, $second){
    if($first !== NULL && $second !== NULL){
        $query = extractExcelQuery() . " ORDER BY " . $first . " , " . $second;
    }else if($first !== NULL){
        $query = extractExcelQuery() . " ORDER BY " . $first;
    }else if($second !== NULL){
        $query = extractExcelQuery() . " ORDER BY " . $second;
    } else{
        $query = extractExcelQuery();
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

function collageToQuery($collage){
    $filter = '';
    switch ($str) {
        case 'CCIS':
          $filter = "Major= 'Computer Science' AND Major= 'Software Engineering' AND Major= 'Information Systems'";
          break;

        case 'Engineering':
          $filter = "Major= 'Construction Management Engineering' AND Major= 'Networks Engineering' AND Major= 'Communications Engineering' AND Major= 'Production & Manufacturing Engineering'";
          break;

        case 'Business Administration':
          $filter = "Major= 'Marketing' AND Major= 'Finance' AND Major= 'Accounting' AND Major= 'Marketing' AND Major= 'Aviation'";
          break;
        case 'Law':
          $filter = "Major= 'Law'";
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
            array_push($q, "id = '" . $_SESSION['pinned'][$i] . "'");
        }
        return "(" . implode(' OR ', $q) . ") ";
    }
    return "";
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
            return 'id';
    }
}

function searchToQuery(){
    if(isset($_SESSION['search'])){
        $val = strtr($_SESSION['search'][1], array('_' => '\_', '%' => '\%', '\'' => '\\\''));
        if(!isset($_SESSION['pinned']) && !isset($_SESSION['filters'])){
            if($_SESSION['search'][0] === 'comp-name'){
                return " WHERE (Coop_Company LIKE '%" . $val . "%' OR Current_Company LIKE '%" . $val  . "%')";
            }
            return " WHERE {$_SESSION['search'][0]} LIKE '%" . $val  . "%'";
        } else{
            if($_SESSION['search'][0] === 'comp-name'){
                return " AND (Coop_Company LIKE '%" . $val . "%' OR Current_Company LIKE '%" . $val  . "%')";
            }
            return " AND {$_SESSION['search'][0]} LIKE '%" .$val  . "%'";
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

function getStudentContact($id){
    $query = "SELET Phone FROM contact_number WHERE Student_ID = " . sqlEncode($id);
    $q = $GLOBALS['db']->query($query);
    return $q->fetchAll();
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
function studentProfileData($studentID){
    $query = "SELECT * FROM student_info WHERE id = '$studentID' ";
    return($query);
}

function sqlEncode($val){
    $val = $GLOBALS['db']->quote($val);
    $val = strtr($val, array('_' => '\_', '%' => '\%', ';' => '\;'));
    return $val;
}

function sendEmail($address, $subject, $content){
    require '../lib/vendor/autoload.php';
    // coop.alumni@psu.edu.sa
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
    $transport->setUsername('nakama.developers@gmail.com');
    $transport->setPassword('PSUnakama3');
    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance();
    $message->setFrom(array('nakama.developers@gmail.com' => 'Alumni Portal'));
    $message->setTo(array($address => ''));
    $message->setSubject($subject);
    $message->setBody($content,'text/html');

    $mailer->send($message);
}

function isInvited($id){
    $q = $GLOBALS['db']->query("SELECT records.email, records.Student_ID, records.hash FROM 
        ( 
            SELECT student.email, student.Student_ID, student_hash.hash FROM student 
                LEFT JOIN student_hash ON 
                (student.Student_ID=student_hash.Student_ID)
        ) AS records WHERE records.Student_ID = " . sqlEncode($id));
    $rows = $q->fetch();
    if(!isset($rows['hash'])){
        return $rows['email'];
    }
    return NULL;
}

function removeInvite($id){
    $q = $GLOBALS['db']->prepare("DELETE FROM student_hash WHERE Student_ID=" . sqlEncode($id));
    $q->execute();
    return $q->rowCount();

}

function isSignedUp($id){
    $q = $GLOBALS['db']->query("SELECT records.Last_Visit, records.Student_ID FROM 
        ( 
            SELECT student.Student_ID, student_account.Last_Visit FROM student 
                LEFT JOIN student_account ON 
                (student.Student_ID=student_account.Student_ID)
        ) AS records WHERE records.Student_ID = " . sqlEncode($id));
    $rows = $q->fetch();
    if(isset($rows['Last_Visit'])){
        return $rows['Last_Visit'];
    }
    return NULL;
}

function createHash($id){
    $randValTime = rand();
    $seed = count($GLOBALS['db']->query(extractQuery())->fetchAll());
    srand($seed * microtime() * 10000);
    $randValSeed = rand();
    $record = $GLOBALS['db']->query("SELECT GPA FROM student WHERE Student_ID=" . sqlEncode($id));
    $record = $record->fetchAll();
    $gpa = $record[0]['GPA'];
    return md5(($randValTime + ($id * $randValSeed)) * $gpa);
}

function addInvitedStudent($id, $hash){
    $query = "INSERT INTO student_hash VALUES (" . sqlEncode($id) . ", '$hash')";
    return $GLOBALS['db']->query($query);
}

?>