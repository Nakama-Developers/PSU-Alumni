<?php
require "dbconfig.php";
session_start();

$_SESSION['filters'] = array('GPA' => ['2.0', '3.0']);//, 'Nationality' => ['saudi'], 'Company_size' => ['large'], 'Major' => ['Computer Science', 'Marketing', 'Finance']);

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
    }
    $query = "WHERE " . implode(' AND ', $q);
    return $query;
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
//$input_name = $_GET['name'];
//$input_value = $_GET['value'];


//TEST CASE 1
//$input_name = 'Nationality';
//$input_value='saudi';

//TEST CASE 2
//$input_name = 'GPA';
//$input_value='3.5';

//TEST CASE 3
//$input_name = 'grad_year';
//$input_value= '2008';

//TEST CASE 4
//$input_name='major';
//$input_value ='Information Systems';

//TEST CASE 5
//$input_name='comp_size';
//$input_value='small';


$filter='';

/*
if ($input_name=='major'){
  $filter = 'Major = ' . '"'. $input_value .'"';
}
else if ($input_name=='grad_year'){
  $filter = 'Graduation_year = ' . $input_value;
}

else {

switch ($input_value) {
    case 'saudi':
      $filter = 'Nationality= "Saudia Arabia"';
      break;

    case 'nosaudi':
      $filter = 'Nationality!= "Saudia Arabia"';
      break;

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

    case 'small':
      $filter = 'Company_size= "small"';
      break;

    case 'medium':
      $filter = 'Company_size= "Medium"';
      break;

    case 'large':
      $filter = 'Company_size= "large"';
      break;

}

}
/*
$query = 'SELECT Student_ID,Name,Major,GPA,Nationality,Graduation_year,Coop_Company,Current_Company,Job_title,Company_size,email FROM student_info WHERE ' . $filter;
echo $query;
$result = $conn->query($query);

$output=array();

$json_rows = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id = $row['Student_ID'];

      $output[$id]['Name'] = $row['Name'];
      $output[$id]['Major'] = $row['Major'];
      $output[$id]['GPA'] = $row['GPA'];
      $output[$id]['Nationality'] = $row['Nationality'];
      $output[$id]['Graduation_year'] = $row['Graduation_year'];
      $output[$id]['Coop_Company'] = $row['Coop_Company'];
      $output[$id]['Current_Company'] = $row['Current_Company'];
      $output[$id]['Job_title'] = $row['Job_title'];
      $output[$id]['Company_size'] = $row['Company_size'];
      $output[$id]['Email'] = $row['email'];

    }

}
$json_output = json_encode($output);
echo $json_output;*/
 ?>
