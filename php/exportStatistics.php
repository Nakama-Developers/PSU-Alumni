<?php

require "dbconfig.php";
require "utilities.php";
session_start();
// unset($_SESSION['pinned']);
// unset($_SESSION['filters']);
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
        
        $filter = '';
        if(isset($_SESSION['filters'])){
           $filter =  "WHERE " . filterToQuery();
           if(isset($_SESSION['pinned'])){
               $filter .= (" OR " . pinToQuery());
           }
        } else{
           $filter =  "";
        }

        $firstChart = array(); // Companies most offerring co-op.
        $q = $db->query("SELECT Coop_company, count(*) FROM student_info $filter group by Coop_company ORDER BY count(*) DESC LIMIT 6;");
        $counter = 0;
        while($row = $q->fetch()){
            $firstChart[$counter]['Comp_Name'] = $row[0];
            $firstChart[$counter]['Value'] = $row[1];
            $counter++;
        }
        $secondChart = array(); // Student hiring based on company sizes
        $q = $db->query("SELECT Company_size, count(*) FROM student_info " . $filter ." group by Company_size;");
        $counter = 0;
        while($row = $q->fetch()){
            $secondChart[$counter]['Comp_Size'] = $row[0];
            $secondChart[$counter]['Value'] = $row[1];
            $counter++;
        }
        $thirdChart = array(); // # of alumni from each major

        $q = $db->query("SELECT Major, count(*) FROM student_info $filter group by Major ORDER BY Major;");
        $counter = 0;
        while($row = $q->fetch()){
            // Temp solution guys
            $thirdChart[$counter]['Major'] = $row[0];
            $thirdChart[$counter]['Value'] = $row[1];
            $row = $q->fetch();
            $thirdChart[$counter]['Value'] += $row[1];
            $counter++;
        }
        if($filter != ""){
            if(isset($_SESSION['pinned'])){
               $filter = "(" . filterToQuery() . " OR " . pinToQuery() . ')' ." AND";
            } else{
                $filter = filterToQuery() . " AND";
            }
        }

        $forthChart = array(); // # of alumni of Saudis
        $q = $db->query("SELECT Nationality, count(*) FROM student_info WHERE " . $filter ." Nationality='Saudia Arabia';");
        $counter = 0;
            // $forthChart[$counter]['Nationality'] = $row[0];
            $forthChart[$counter]['Nationality'] = 'Saudi';
            $forthChart[$counter]['Value'] = $q->fetch()[1];
            $counter++;
            $forthChart[$counter]['Nationality'] = 'Non Saudi';
            $forthChart[$counter]['Value'] = $db->query("SELECT Nationality, count(*) FROM student_info WHERE " . $filter ." Nationality!='Saudia Arabia';")->fetch()[1];

        $output = array();
        $output['firstChart'] = $firstChart;
        $output['secondChart'] = $secondChart;
        $output['thirdChart'] = $thirdChart;
        $output['forthChart'] = $forthChart;

        echo json_encode($output);
    }
    
}

?>