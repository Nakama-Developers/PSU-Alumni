<?php
    require "php/dbconfig.php";
    require "php/printData.php";
    session_start();

    if(isset($_SESSION['signedIn'])){
        $rows = printRecords(1);
        $studentsRows = '<section id="pageRecords">' . $rows['studentsRows'] . '<script type="text/javascript" src="js/loadRecords.js" ></script></section>';
        echo '
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
          <!--<li><a href="#">Publish Annoucment</a></li>-->
          <li><a id="chartsLink" href="#">Statistics</a></li>
          <li><a href="#">Create Favourate List</a></li>
          <li><a href="#">Setting</a></li>
          <li><a href="logIn.php?logout=true">Log out</a></li>
        </ul>
      </div>
    </div>
    <div class="main-content">
      <div class="search-panel">
        <div class="search-div">
          <div class="search-box">
            <input class="search" type="text" name="search" placeholder="Search Here ..."><div class="dropdown">
            <span class="dropdown-label"></span>
                <ul class="search-options">
                            <li>
                                <label for="student-id">Student ID</label>
                                <input class="search-option" value="student-id" name="search-option" id="student-id" type="radio">
                            </li>
                            <li>
                                <label for="student-name">Student Name</label>
                                <input class="search-option" value="student-name" name="search-option" id="student-name" type="radio">
                            </li>
                            <li>
                                <label for="comp-name">Company Name</label>
                                <input class="search-option" value="comp-name" name="search-option" id="comp-name" type="radio">
                            </li>
                            <li>
                                <label for="job-title">Job Title</label>
                                <input class="search-option" value="job-title" name="search-option" id="job-title" type="radio">
                            </li>
                        </ul>
            </div><input class="search-btn" type="submit" name="search-btn" value="">
          </div>
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
            <div class="filter">
           <span class="filter-span">Filter By:</span>  
                <ul class="menu">      
                    <li class="filter-option-block" id="gpa_filter">
                        <span>GPA</span>
                        <ul class="options">
                            <li>
                                <label for="0">0.5 - 2.0</label>
                                <input class="filterInput" value="0" name="GPA" id="0" type="checkbox"' . isChecked(0,"GPA") . '>
                            </li>
                            <li>
                                <label for="2">2.0 - 2.5</label>
                                <input class="filterInput" value="2" name="GPA" id="2" type="checkbox"' . isChecked(2,"GPA") . ' >
                            </li>
                            <li>
                                <label for="2.5">2.5 - 3.0</label>
                                <input class="filterInput" value="2.5" name="GPA" id="2.5" type="checkbox"' . isChecked(2.5,"GPA") . ' >
                            </li>
                            <li>
                                <label for="3">3.0 - 3.5</label>
                                <input class="filterInput" value="3" name="GPA" id="3" type="checkbox"' . isChecked(3,"GPA") . '>
                            </li>
                            <li>
                                <label for="3.5">3.5 - 4.0</label>
                                <input class="filterInput" value="3.5" name="GPA" id="3.5" type="checkbox"' . isChecked(3.5,"GPA") . '>
                            </li>
                        </ul>
                    </li>                 
                    <li class="filter-option-block" id="comp_size_filter">
                        <span>Company Size</span>
                        <ul class="options">
                            <li>
                                <label for="large">Large</label>
                                <input class="filterInput" value="large" name="Company_size" id="large" type="checkbox"' . isChecked("large","Company_size") . '>
                            </li>
                            <li>
                                <label for="medium">Medium</label>
                                <input class="filterInput" value="medium" name="Company_size" id="medium" type="checkbox"' . isChecked("medium","Company_size") . '>
                            </li>
                            <li>
                                <label for="small">Small</label>
                                <input class="filterInput" value="small" name="Company_size" id="small" type="checkbox"' . isChecked("small","Company_size") . '>
                            </li>
                        </ul>
                    </li>                                         
                    <li class="filter-option-block" id ="nationality_filte">
                        <span>Nationality</span>
                        <ul class="options">
                            <li>
                                <label for="saudi">Saudi</label>
                                <input class="filterInput" value="saudi" name="Nationality" id="saudi" type="checkbox"' . isChecked("saudi","Nationality") . '>
                            </li>
                            <li>
                                <label for="nosaudi">Non Saudi</label>
                                <input class="filterInput" value="nosaudi" name="Nationality" id="nosaudi" type="checkbox"' . isChecked("nosaudi","Nationality") . '>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
          <div class="navegation-tools">
            <a href="#" id="prev"><</a>
            <span id="resultsNumDisplay">1 - ' . $recordsPerPage . '</span>
            <a href="#" id="next">></a>
          </div>
        </div>
        <div class="grouping">
          <div class="catagories">
            <a href="#" class="All">All
            </a><a href="#" class="Alumni">Alumni
            </a><a href="#" class="Master">Master
            </a><a href="#" class="Co-op">Co-op
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
        ' . $studentsRows . '
        <!-- End of records -->
      </div>
    </div>
  </body>
</html>';

    } else{
        header("location: login.php");
    }
?>