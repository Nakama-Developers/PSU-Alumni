<?php
require "dbconnect.php";

$name = $_POST['email'];
$coop_comp =  $_POST['coop_comp'];
$current_comp =  $_POST['current_comp'];
$job_title =  $_POST['job_title'];


$query = 'UPDATE student_info SET Name=' .$name.',Job_title='.$job_title.',Current_Company='.$current_comp.',Coop_Company='.$coop_comp;

 $conn->query($query);


 ?>
