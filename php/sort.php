<?php

require "dbconnect.php";

$input_name = $_GET['sort_type'];
$input_order = 'asc';


//TEST CASE 1
//$input_name = 'name';
//$input_order= 'asc';

/*
//TEST CASE 2
$input_name = 'gpa';
$input_order= 'desc';


//TEST CASE 3
$input_name = 'comp_size';
$input_order= 'asc';
*/


$order;

if ($input_name =='student_ID' && $input_order =='asc'){
  $order = 'Student_ID ASC';
}
else if ($input_name =='student_ID' && $input_order =='desc'){
  $order = 'Student_ID DESC';
}
else if ($input_name =='student_name' && $input_order =='asc'){
  $order ='Name ASC';
}
else if ($input_name =='student_name' && $input_order =='desc'){
  $order = 'Name DESC';
}
else if ($input_name =='grad_year' && $input_order =='asc'){
  $order = 'Graduation_year ASC';
}
else if ($input_name =='grad_year' && $input_order =='desc'){
  $order = 'Graduation_year DESC';
}
else if ($input_name =='gpa' && $input_order =='asc'){
  $order = 'GPA ASC';
}
else if ($input_name =='gpa' && $input_order =='desc'){
  $order = 'GPA DESC';
}
else if ($input_name =='comp_size' && $input_order =='asc'){
  $order ='FIELD (Company_size,"small","Medium","large")';
}
else if ($input_name =='comp_size' && $input_order =='desc'){
  $order ='FIELD (Company_size,"large","Medium","small")';
}

$query = 'SELECT Student_ID,Name,Major,GPA,Nationality,Graduation_year,Coop_Company,Current_Company,Job_title,Company_size,email FROM student_info ORDER BY ' . $order;

$result = $conn->query($query);

$output=array();

$json_rows = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id = $row['Student_ID'].' ';
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
echo $json_output;

?>
