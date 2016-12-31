<?php
    require "php/dbconfig.php";
    require "php/printData.php";
    session_start();

    if(isset($_SESSION['signedIn'])){
        $q = $db->query("SELECT * FROM student_info;");
        $studentsRows = "";
        $rows = $q->fetchAll();
        $counter = 0;
        //while(isset($rows[$counter])){
            $studentsRows .= '<section id="pageRecords">';
            for($i = 0; $i < $recordsPerPage; $i++){
                if(isset($rows[$counter])){
                    $studentsRows .= ('<div class="record">' . 
                    printStudentRow($rows[$counter]) . printStudentProfile($rows[$counter]) .
                    '</div>');
                    $counter++;   
                } else{
                    break;
                }
            //}
            }
            $studentsRows .= '<script type="text/javascript" src="js/loadRecords.js" ></script></section>';
        echo <<<_HTML_
        <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-icon.png">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--external style-->
    
    <script type="text/javascript" src="js/events.js" ></script>
    <script type="text/javascript" src="js/adminPageAjax.js" ></script>
    <link  type="text/css" rel="stylesheet" href="css/adminPage.css">
    <link  type="text/css" rel="stylesheet" href="css/popup.css">

    <title>Allumni - Control Panel</title>
  </head>
  <body>
    <div class="side-functions">
      <div class="logo">
        <img src="img/transperant-logo.png" alt="PSU logo" />
      </div>
      <div class="options">
        <ul>
          <li><a href="#">Create Survey</a></li>
          <li><a href="#">Publish Annoucment</a></li>
          <li><a href="#">Create Favourate List</a></li>
          <li><a href="#">Setting</a></li>
          <li><a href="logIn.php?logout=true">Log out</a></li>
        </ul>
      </div>
    </div>
    <div class="main-content">
      <div class="search-panel">
        <div class="search-box">
          <input class="search" type="text" name="search" placeholder="Search Here ..."><input class="search-btn" type="submit" name="search-btn" value="">
        </div>
        <div class="search-tools">
          <span class="label">Sort By:</span>
          <div class="sort">
            <select name="sort-method" id="sort_method" onchange="sort(value);">
                <option value="student_ID">Student ID</option>
                <option value="student_name" >Student Name</option>         
                <option value="gpa">GPA</option>
                <option value="grad_year">Graduation Year</option>
                <option value="comp_size">Company Size</option>
            </select>
          </div>
          <div class="navegation-tools">
            <a href="#" id="prev"><</a>
            <span id="resultsNumDisplay">1 - $recordsPerPage</span>
            <a href="#" id="next">></a>
          </div>
        </div>
        <div class="grouping">
          <div class="catagories">
            <a href="#" class="All">All
            </a><a href="#" class="Master">Master
            </a><a href="#" class="Bacholer">Bacholer
            </a>
          </div>
        </div>
      </div>
      <div class="records">
        <div class="records-header">
          <div class="label">
            <p>
              Name
            </p>
          </div>
          <div class="label">
            <p>
              Student ID
            </p>
          </div>
          <div class="label">
            <p>
              E-mail
            </p>
          </div>
          <div class="label">
            <p>
              Phone
            </p>
          </div>
          <div class="label">
            <p>
              Major
            </p>
          </div>
        </div>

        <!-- End of Header / Start of records -->
        $studentsRows
        <!-- End of records -->
      </div>
    </div>
  </body>
</html>
_HTML_;

    } else{
        header("location: login.php");
    }
?>