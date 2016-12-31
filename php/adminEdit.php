<?php
require "dbconnect.php";

$name = $_POST['email'];
$id =  $_POST['id'];
$nationality = $_POST['nationality'];
$email = $_POST['email'];
$major =  $_POST['major'];
$gpa =  $_POST['gpa'];
$grad_year = $_POST['grad_year'];
$job_title =  $_POST['job_title'];
$current_comp =  $_POST['current_comp'];
$coop_comp =  $_POST['coop_comp'];
$comp_size = $_POST['comp_size'];




$query = 'UPDATE student_info SET Name=' .$name. ',Major='.$major.',Student_ID='.$id.',GPA='.$gpa.',Nationality='.$nationality.',email='.$email.',Graduation_year='.$grad_year.',Job_title='.$job_title.',Current_Company='.$current_comp.',Coop_Company='.$coop_comp.',Company_size='.$comp_size;
$conn->query($query);








 ?>
