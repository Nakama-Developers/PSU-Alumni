<?php
    require "php/dbconfig.php";
    require "php/printData.php";
    session_start();
    $_SESSION['headers'] = array('1' => 'E-mail', '2' => 'Phone', '3' => 'Major');
    // unset($_SESSION['pinned']);
    // unset($_SESSION['filters']);
    if(isset($_SESSION['signedIn'])){
        $rows = printRecords(1);
        $pinnedStudentRecords = printPinnedRecords();
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
            <div class="search-container">
                <input class="search" type="text" name="search" placeholder="Search Here ...">
                <span class="opt-btn" title="Search by.."></span>
                    <ul class="search-options">
                        <p class="label">Search By:</p>
                        <li>
                            <span class="radio-container radio-checked">
                                <input class="radio search-option" value="Student_ID" name="search-option" id="student-id" type="radio" checked>
                                <span class="radio-check"></span>
                            </span>
                            <label for="student-id">Student ID</label>
                        </li>
                        <li>
                            <span class="radio-container">
                                <input class="radio search-option" value="Name" name="search-option" id="student-name" type="radio">
                                <span class="radio-check"></span>
                            </span>
                            <label for="student-name">Student Name</label>
                        </li>
                        <li>
                            <span class="radio-container">
                                <input class="radio search-option" value="comp-name" name="search-option" id="comp-name" type="radio">
                                <span class="radio-check"></span>
                            </span>
                            <label for="comp-name">Company Name</label>
                        </li>
                        <li>
                            <span class="radio-container">
                                <input class="radio search-option" value="Job_title" name="search-option" id="job-title" type="radio">
                                <span class="radio-check"></span>
                            </span>
                            <label for="job-title">Job Title</label>
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
                        <span>Graduation Year</span>
                        <ul class="options scroll-check">
                            ' . printGradYearFilter() . '
                        </ul>
                    </li><li class="filter-option-block" id="gpa_filter">
                        <span>Major</span>
                        <ul class="options majors-menu">
                            <li>
                                <span class="checkbox-container ' . isChecked("Computer Science","Major") . '">
                                    <input class="checkbox filterInput" value="Computer Science" name="Major" id="Computer Science" type="checkbox"' . isChecked("Computer Science","Major") . '>
                                </span>
                                <label for="Computer Science">Computer Science</label>
                            </li>
                            <li>
                                <span class="checkbox-container ' . isChecked("Finance","Major") . '">
                                    <input class="checkbox filterInput" value="Finance" name="Major" id="Finance" type="checkbox"' . isChecked("Finance","Major") . '>
                                </span>
                                <label for="Finance">Finance</label>
                            </li>
                            <li>
                                <span class="checkbox-container ' . isChecked("Marketing","Major") . '">
                                    <input class="checkbox filterInput" value="Marketing" name="Major" id="Marketing" type="checkbox"' . isChecked("Marketing","Major") . '>
                                </span>
                                <label for="Marketing">Marketing</label>
                            </li>
                            <li>
                                <span class="checkbox-container ' . isChecked("Information Systems","Major") . '">
                                    <input class="checkbox filterInput" value="Information Systems" name="Major" id="Information Systems" type="checkbox"' . isChecked("Information Systems","Major") . '>
                                </span>
                                <label for="Information Systems">Information Systems</label>
                            </li>
                        </ul>
                    </li><li class="filter-option-block" id="gpa_filter">
                        <span>Other</span>
                        <ul class="options others-menu">
                            <li>
                                <span>Nationality</span>
                                <ul class="options">
                                    <li>
                                        <span class="checkbox-container ' . isChecked("saudi","Nationality") . '">
                                            <input class="filterInput checkbox" value="saudi" name="Nationality" id="saudi" type="checkbox"' . isChecked("saudi","Nationality") . '>
                                        </span>
                                        <label for="saudi">Saudi</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked("nosaudi","Nationality") . '">
                                            <input class="filterInput checkbox" value="nosaudi" name="Nationality" id="nosaudi" type="checkbox"' . isChecked("nosaudi","Nationality") . '>
                                        </span>
                                        <label for="nosaudi">Non Saudi</label>
                                    </li>
                                </ul>
                                <span>Company Size</span>
                                <ul class="options">
                                    <li>
                                        <span class="checkbox-container ' . isChecked("large","Company_size") . '">
                                            <input class="filterInput checkbox" value="large" name="Company_size" id="large" type="checkbox"' . isChecked("large","Company_size") . '>
                                        </span>
                                        <label for="large">Large</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked("medium","Company_size") . '">
                                            <input class="filterInput checkbox" value="medium" name="Company_size" id="medium" type="checkbox"' . isChecked("medium","Company_size") . '>
                                        </span>
                                        <label for="medium">Medium</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked("small","Company_size") . '">
                                            <input class="filterInput checkbox" value="small" name="Company_size" id="small" type="checkbox"' . isChecked("small","Company_size") . '>
                                        </span>
                                        <label for="small">Small</label>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span>GPA</span>
                                <ul class="options">
                                    <li>
                                        <span class="checkbox-container ' . isChecked(0,"GPA") . '">
                                            <input class="checkbox filterInput" value="0" name="GPA" id="0" type="checkbox"' . isChecked(0,"GPA") . '>
                                        </span>
                                        <label for="0">0.5 - 2.0</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked(2,"GPA") . '">
                                            <input class="checkbox filterInput" value="2" name="GPA" id="2" type="checkbox"' . isChecked(2,"GPA") . ' >
                                        </span>
                                        <label for="2">2.0 - 2.5</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked(2.5,"GPA") . '">
                                            <input class="checkbox filterInput" value="2.5" name="GPA" id="2.5" type="checkbox"' . isChecked(2.5,"GPA") . ' >
                                        </span>
                                        <label for="2.5">2.5 - 3.0</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked(3,"GPA") . '">
                                            <input class="checkbox filterInput" value="3" name="GPA" id="3" type="checkbox"' . isChecked(3,"GPA") . '>
                                        </span>
                                        <label for="3">3.0 - 3.5</label>
                                    </li>
                                    <li>
                                        <span class="checkbox-container ' . isChecked(3.5,"GPA") . '">
                                            <input class="checkbox filterInput" value="3.5" name="GPA" id="3.5" type="checkbox"' . isChecked(3.5,"GPA") . '>
                                        </span>
                                        <label for="3.5">3.5 - 4.0</label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
          <div class="navegation-tools">
            <a href="#" id="prev"><</a>
            <span id="resultsNumDisplay">0 - ' . $recordsPerPage . '</span>
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
      <div class="records-header">
          <div class="label">
            <p>
              <span class="text">Name</span>
            </p>
          </div>
          <div class="label">
            <p>
              <span class="text">Student ID</span>
            </p>
          </div>
          <div class="drop-menu label selectable">
            <p class="selected">
              <span class="text" >E-mail</span>
              <span class="arrow"></span>
            </p>
            <ul class="options">
                <li class="opt1">
                   <p>Job Title</p>
                </li>
                <li class="opt2">
                    <p>Co-op Company</p>
                </li>
                <li class="opt3">
                    <p>Current Company</p>
                </li>
                <li class="opt4">
                    <p>Company Size</p>
                </li>
                <li class="opt5">
                    <p>Nationality</p>
                </li>
            </ul>
          </div>
          <div class="drop-menu label selectable">
            <p class="selected">
              <span class="text" >Phone</span>
              <span class="arrow"></span>
            </p>
            <ul class="options">
                <li class="opt1">
                    <p>Job Title</p>
                </li>
                <li class="opt2">
                    <p>Co-op Company</p>
                </li>
                <li class="opt3">
                    <p>Current Company</p>
                </li>
                <li class="opt4">
                    <p>Company Size</p>
                </li>
                <li class="opt5">
                    <p>Nationality</p>
                </li>
            </ul>
          </div>
          <div class="drop-menu label selectable">
            <p class="selected">
              <span class="text" >Major</span>
              <span class="arrow"></span>
            </p>
            <ul class="options">
                <li class="opt1">
                    <p>Job Title</p>
                </li>
                <li class="opt2">
                    <p>Co-op Company</p>
                </li>
                <li class="opt3">
                    <p>Current Company</p>
                </li>
                <li class="opt4">
                    <p>Company Size</p>
                </li>
                <li class="opt5">
                    <p>Nationality</p>
                </li>
            </ul>
          </div>
        </div>
      <div class="records">
        
        <!-- End of Header / Start of records -->
        <section id="pinnedRecords">' . $pinnedStudentRecords["studentsRows"] . '</section>
        ' . $studentsRows . '
        <!-- End of records -->
      </div>
    </div>
    <div class="logDiv">
        Loading...
    </div>
  </body>
</html>';

    } else{
        header("location: login.php");
    }
?>