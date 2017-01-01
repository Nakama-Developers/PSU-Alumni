<?php
    require "php/dbconfig.php";
    require "php/printData.php";
    //session_start();

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
    <!-- Charts.js CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js" type="text/javascript"></script>
    <!--external style-->
    
    <script type="text/javascript" src="js/events.js" ></script>
    <script type="text/javascript" src="js/adminPageAjax.js" ></script>
    <link  type="text/css" rel="stylesheet" href="css/adminPage.css">
    <link  type="text/css" rel="stylesheet" href="css/popup.css">
    <link  type="text/css" rel="stylesheet" href="css/statistics.css">

    <title>Allumni - Control Panel</title>
  </head>
  <body>
    <div class="side-functions">
      <div class="logo">
        <img src="img/transperant-logo.png" alt="PSU logo" />
      </div>
      <div class="options">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Publish Annoucment</a></li>
          <li><a id="chartsLink" href="#">Statistics</a></li>
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
                <option value="Name" >Student Name</option>         
                <option value="GPA">GPA</option>
                <option value="Graduation_year">Graduation Year</option>
                <option value="Company_size">Company Size</option>
            </select>
          </div>

          <span class="label">Filter By:</span>
            <div class="filter">
           <input class="submit-button" type="submit" value="Go" onclick='filter()'>
           <span class="filter-span">Filter By:</span>        
                    <div class="filter-option-block" id="gpa_filter">
                        <span  onclick="gpaFilterBlock()">GPA</span>
                        <ul class="options">
                            <li>
                                <label for="0">0.5 - 2.0</label>
                                <input value="0" name="GPA" id="0" type="checkbox">
                            </li>
                            <li>
                                <label for="2">2.0 - 2.5</label>
                                <input value="2" name="GPA" id="2" type="checkbox">
                            </li>
                            <li>
                                <label for="2.5">2.5 - 3.0</label>
                                <input value="2.5" name="GPA" id="2.5" type="checkbox">
                            </li>
                            <li>
                                <label for="3">3.0 - 3.5</label>
                                <input value="3" name="GPA" id="3" type="checkbox">
                            </li>
                            <li>
                                <label for="3.5">3.5 - 4.0</label>
                                <input value="3.5" name="GPA" id="3.5" type="checkbox">
                            </li>
                        </ul>
                    </div>                 
                    <div class="filter-option-block" id="comp_size_filter">
                        <span onclick = 'comp_size_filter_block()' >Company Size</span>
                        <ul class="options">
                            <li>
                                <label for="large">Large</label>
                                <input value="large" name="Company-size" id="large" type="checkbox">
                            </li>
                            <li>
                                <label for="medium">Medium</label>
                                <input value="medium" name="Company-size" id="medium" type="checkbox">
                            </li>
                            <li>
                                <label for="small">Small</label>
                                <input value="small" name="Company-size" id="small" type="checkbox">
                            </li>
                        </ul>
                    </div>                                         
                    <div class="filter-option-block" id = 'nationality_filter'>
                        <span onclick = 'nationality_filter_block()'>Nationality</span>
                        <ul class="options">
                            <li>
                                <label for="saudi">Saudi</label>
                                <input value="saudi" name="Nationality" id="saudi" type="checkbox">
                            </li>
                            <li>
                                <label for="nosaudi">Non Saudi</label>
                                <input value="nosaudi" name="Nationality" id="nosaudi" type="checkbox">
                            </li>
                        </ul>
                    </div>
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