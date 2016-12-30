<?php
    require "php/dbconfig.php";
    session_start();

    if(isset($_SESSION['signedIn'])){
        $q = $db->query("SELECT * FROM student_info;");
        $studentsRows = "";
        $rows = $q->fetchAll();
        $counter = 0;
        while(isset($rows[$counter])){
            $studentsRows .= '<section id="' . $counter .'">';
            for($i = 0; $i < 40; $i++){
                if(isset($rows[$counter])){
                    $studentsRows .= ('<div class="record">' . 
                    printStudentRow($rows[$counter]) . printStudentProfile($rows[$counter]) .
                    '</div>');
                    $counter++;   
                }
            }
            $studentsRows .= '</section>';
        }
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
            <select name="sort-method">
              <option class="options">Name</option>
              <option>Student ID</option>
              <option>Graduation Year</option>
              <option>GPA</option>
            </select>
          </div>
          <div class="navegation-tools">
            <a href="#"><</a>
            <span>1 - 50</span>
            <a href="#">></a>
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
        <script type="text/javascript" src="js/loadRecords.js" ></script>
        <!-- End of records -->
      </div>
    </div>
  </body>
</html>
_HTML_;

    } else{
        header("location: login.php");
    }

    function printStudentRow($row){
        return '<div class="record-row" title="Click for more details">
            <div class="info">
              <p>
                '. $row['Name'].'
              </p>
            </div>
            <div class="info">
              <p>
                '. $row['Student_ID'] .'
              </p>
            </div>
            <div class="info">
              <p>
                '. $row['email'] .'
              </p>
            </div>
            <div class="info">
              <p>
                +966537514186
              </p>
            </div>
            <div class="info">
              <p>
                '. $row['Major'] .'
              </p>
            </div>
          </div>';
    }

    function printStudentProfile($row){
        return '<article class="record-profile">
        <div class="profile-img">
              <img src="img/transperant-logo.png" alt="profile-pic" />
            </div>
            <section class="block-info personal-info">
              <span class="block-title">Personal Info</span>
                <div class="block-inputs">
                    <div>
                        <label for="name">Name:</label>
                        <input class="field" type="text" name="name" value="'. $row['Name'] .'" readonly>
                    </div>
                    <div>
                        <label for="nationality">Nationality:</label>
                        <input class="field" type="text" value="'. $row['Nationality'] .'" readonly>
                    </div>
                    <div>
                        <label for="Phone">Phones:</label>
                        <input class="field" type="text" name="phone" value="+966562249819" readonly>
                    </div>
                    <div>
                        <label for="email">E-mail:</label>
                        <input class="field" type="email" name="email" value="'. $row['email'] .'" readonly>
                    </div>
                </div>
            </section><section class="block-info academic-info">
              <span class="block-title">Academic Info</span>
              <div class="block-inputs">
                  <div>
                      <label for="acad-id">Academic ID:</label>
                      <input class="field" type="text" name="acad-id" value="'. $row['Student_ID'] .'" readonly>
                  </div>
                  <div>
                      <label for="major">Major:</label>
                      <input class="field" type="text" name="major" value="'. $row['Major'] .'" readonly>
                  </div>
                  <div>
                      <label for="gpa">GPA:</label>
                      <input class="field" type="number" step="0.01" name="gpa" value="'. $row['GPA'] .'" readonly>
                  </div>
                  <div>
                      <label for="grad-year">Graduation Year:</label>
                      <input class="field" type="text" name="grad-year" value="'. printGraduateYear($row['Graduation_year']) .'" readonly>
                  </div>
              </div>
            </section><section class="block-info company-info">
              <span class="block-title">Career Info</span>
              <div class="block-inputs">
                  <div>
                      <label for="title">Job Title:</label>
                      <input class="field" type="text" name="title" value="'. $row['Job_title'] .'" readonly>
                  </div>
                  <div>
                      <label for="current-comp">Current Company:</label>
                      <input class="field" type="text" name="current-comp" value="'. $row['Current_Company'] .'" readonly>
                  </div>
                  <div>
                      <label for="co-op-comp">Co-op Company:</label>
                      <input class="field" type="text" name="co-op-comp" value="'. $row['Coop_Company'] .'" readonly>
                  </div>
                  <div>
                      <label for="comp-size">Company Size:</label>
                      <input class="field" type="text" name="comp-size" value="'. $row['Company_size'] .'" readonly>
                  </div>
              </div>
            </section>
            <section class="social-contact">
              <div class="social-media">
                  <a title="view his profile" href="#" class="alumni">
                      <img src="img/transperant-logo.png" alt="PSU-logo"/>
                  </a>
                  <span title="view his facebook profile" class="facebook"></span>
                  <span title="view his twitter account" class="twitter"></span>
                  <span title="view his LinkedIn account" class="linkedIn"></span>
              </div>
              <div dir="rtl" class="functions">
                  <span title="edit profile" class="edit editIcon"></span>
                  <span title="write note" class="write-note"></span>
                  <article dir="ltr" class="note-container">
                    <header class="note-header">
                        <span class="close-btn close-note"></span>
                        <h2>Note</h2>
                    </header>
                    <section class="note-body">
                        <textarea rows="6" cols="4" autofocus></textarea>
                    </section>
                  </article>
              </div>
            </section>
            <span title="close" class="close-btn close-profile"></span>
        </article>';
    }

    function printGraduateYear($year){  
        return ($year - 1) . ' / ' . $year;
    }
?>