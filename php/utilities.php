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

function getCompanies(){
    $q = $GLOBALS['db']->query("SELECT Name FROM company");
    return $q->fetchAll();
}

function getCompanyId($name){
    $q = $GLOBALS['db']->query("SELECT Company_ID FROM company WHERE Name=" . sqlEncode($name));
    return $q->fetch();
}

function getStudentCurrentComp(){
    // TODO:
}


function studentProfileData($studentID){
    /*$query = "SELECT DISTINCT student.*,
(SELECT company.Name FROM company WHERE company.Company_ID IN ( SELECT student_career.Current_company FROM student_career WHERE student_career.Student_ID ='$studentID')) AS 'Current_Company',
(SELECT company.Name FROM company WHERE company.Company_ID IN ( SELECT student_career.Coop_company FROM student_career WHERE student_career.Student_ID ='$studentID')) AS 'Coop_Company',
(SELECT student_career.is_Family FROM student_career WHERE student_career.Student_ID ='$studentID') AS 'is_Family',
(SELECT student_career.Job_title FROM student_career WHERE student_career.Student_ID ='$studentID') AS 'Job_title',
(SELECT student_career.Worked_coop FROM student_career WHERE student_career.Student_ID ='$studentID') AS 'Worked_coop',
(SELECT student_career.Time_to_get_job FROM student_career WHERE student_career.Student_ID ='$studentID') AS 'Time_to_get_job',
contact_number.Phone, certificate.* FROM student_career , ((student natural join contact_number) left outer join certificate on student.student_id = certificate.Student_ID) WHERE student_career.Student_ID = '$studentID'  AND student.Student_ID ='$studentID';";*/
    
    $query = getStudentEducationInfo($studentID) . getStudentCareerInfo($studentID) . getStudentPersonalInfo($studentID) . getStudentCertificateInfo($studentID);
    

    return($query);
}

function StudentEducationInfo($studentID){
    $query = "SELECT Name, Major, GPA, Graduation_year FROM student WHERE Student_ID = '$studentID';";
    return $query;
}

function StudentCareerInfo($studentID){
    $query = " SELECT student_career.is_Family, student_career.Job_title, student_career.Worked_coop, student_career.Time_to_get_job,
               (SELECT company.Name FROM company WHERE company.Company_ID IN ( SELECT student_career.Coop_company FROM student_career WHERE student_career.Student_ID ='$studentID')) AS 'Coop_Company',
               (SELECT company.Name FROM company WHERE company.Company_ID IN ( SELECT student_career.Current_company FROM student_career WHERE student_career.Student_ID ='$studentID')) AS 'Current_Company'
                FROM student_career WHERE student_career.Student_ID ='$studentID';";
               return $query;
}              

function StudentPersonalInfo($studentID){
    $query = " SELECT National_ID, Nationality, email FROM student WHERE Student_ID = '$studentID';";
    return $query;
}

function ContactNumber($studentID){
    $query = "SELECT Phone FROM contact_number WHERE Student_ID = '$studentID';";
    return $query;
}

function StudentCertificateInfo($studentID){
    $query = "SELECT * FROM certificate WHERE Student_ID = '$studentID';";
    return $query;

}


function storingStudentInfo($informationArray, $dataArray){    
    $informationArray = json_decode(json_encode($informationArray), True);
    echo implode(" ",$informationArray);

    $dataArray = json_decode(json_encode($dataArray), True);
    $studentID = $dataArray['Student_ID'];
    echo implode(" ",$dataArray);

    // this one for the student table or for the view
    if($informationArray['tableName'] =='student' || $informationArray['tableName'] =='student_info' ){

        
    // if the phone number is Not Updated
    if (!array_key_exists('PhoneArray',$dataArray)){
        $updateQueryPart1 = "UPDATE ".$informationArray['tableName']." SET ";   
        $arrayLength = count($dataArray);
        foreach ($dataArray as &$value) {
            $columnName = array_search($value, $dataArray);
            $updateQueryPart2 = $updateQueryPart2 . $columnName. "= '$value' ";
            if($arrayLength != 1){
                $updateQueryPart2 = $updateQueryPart2.",";
            }
        $arrayLength--;
    }
   unset($value);
   $updateQueryPart3 = "WHERE Student_ID = ".$dataArray['Student_ID'];
   $fullQuery = $updateQueryPart1.$updateQueryPart2.$updateQueryPart3;
   return  $fullQuery;
   }
   else{
        $updateQueryPart1 = "UPDATE ".$informationArray['tableName']." SET ";   
        $arrayLength = count($dataArray);
        foreach ($dataArray as &$value) {
            $columnName = array_search($value, $dataArray);
            if($columnName == 'PhoneArray'){
                    $deleteQuery = "DELETE FROM contact_number Where Student_ID ='$studentID'";
                    $q = $GLOBALS['db']-> query($deleteQuery);
                     //echo implode(" ",$value);
            foreach ($value as &$number){
             
                //  $value here is the phoneNumber Array
                if($number != NULL){
                    $insertQuery = "INSERT INTO contact_number VALUES($studentID,'$number')";
                   echo $insertQuery;
                   $q = $GLOBALS['db']-> query($insertQuery);
                     }      
                   
                }
                 unset($number);
                $arrayLength--;
                continue;
            }
        $updateQueryPart2 = $updateQueryPart2 . $columnName. "= '$value' ";
        if($arrayLength != 1){
              $updateQueryPart2 = $updateQueryPart2.",";
        }
        $arrayLength--;
        }
        
    }
   unset($value);
   $updateQueryPart3 = "WHERE Student_ID = '$studentID'";
   $fullQuery = $updateQueryPart1.$updateQueryPart2.$updateQueryPart3;
   return  $fullQuery;  
   }  
    
 


    // this one for the career table
    elseif($informationArray['tableName']=='student_career'){
        // add all student Ids from table student into student_career to make sure all student Ids are synced
        $syncronizationQuery = 'INSERT IGNORE INTO student_career (Student_ID) SELECT Student_ID FROM student ';
        echo  $syncronizationQuery ;
        $q = $GLOBALS['db']-> query($syncronizationQuery);

        $currentCompanyName = $informationArray['Current_company'] ;
        $coopCompanyName = $informationArray['Coop_company'];


        // adding the company if not exist
        $CompanyIsExistQuery = "Select Count(*) From company Where Name ='$currentCompanyName'";
        $q = $GLOBALS['db']-> query($CompanyIsExistQuery);
        $result = $q->fetchAll();
        $number = $result[0][0];
        if($number == 0){
            $insertNewCompanyQuery = "Insert Into company(Name) Values('$currentCompanyName')";
            $q = $GLOBALS['db']-> query($insertNewCompanyQuery);
        }
        $CompanyIsExistQuery = "Select Count(*) From company Where Name ='$coopCompanyName'";
        $q = $GLOBALS['db']-> query($CompanyIsExistQuery);
        $result = $q->fetchAll();
        $number = $result[0][0];
        if($number == 0){
            $insertNewCompanyQuery = "Insert Into company(Name) Values('$coopCompanyName')";
            $q = $GLOBALS['db']-> query($insertNewCompanyQuery);
        }

        // showing the companies in the profile
        if($currentCompanyName != NULL){
            $currentCompanyIdQuery = "SELECT Company_ID FROM company WHERE Name ='$currentCompanyName'";
            echo  $currentCompanyIdQuery ;
            $q = $GLOBALS['db']-> query($currentCompanyIdQuery);
            $currentCompanyIdResult = $q->fetchAll();
            $currentCompanyId = $currentCompanyIdResult[0]['Company_ID'];
        }
        if($coopCompanyName != NULL){    
            $coopCompanyIdQuery = "SELECT Company_ID FROM company WHERE Name ='$coopCompanyName'";
            echo  $coopCompanyIdQuery ;
            $q = $GLOBALS['db']-> query($coopCompanyIdQuery);
            $coopCompanyIdResult = $q->fetchAll();
            $coopCompanyId = $coopCompanyIdResult[0]['Company_ID'];
        }
        $updateQueryPart1 = "UPDATE student_career SET ";
        $arrayLength = count($dataArray);
        foreach ($dataArray as &$value) {
            $columnName = array_search($value, $dataArray);
            $updateQueryPart2 = $updateQueryPart2 . $columnName. "= '$value' ";
            if($arrayLength != 1){
                $updateQueryPart2 = $updateQueryPart2.",";
            }
            $arrayLength--;
        }  
        
        if($currentCompanyName != NULL){
             $updateQueryPart2 = $updateQueryPart2.", Current_company ='$currentCompanyId' ";
         }
         if($coopCompanyName != NULL){
             $updateQueryPart2 = $updateQueryPart2.", Coop_company = '$coopCompanyId' ";
         }
       
       unset($value);
       $updateQueryPart3 = "WHERE Student_ID = ".$informationArray['Student_ID'];
       $fullQuery = $updateQueryPart1.$updateQueryPart2.$updateQueryPart3;
       return  $fullQuery;
    }
    
}

?>