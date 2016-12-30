﻿<?php
    session_start();
    if(isset($_SESSION['signedIn'])){
        
?>
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
        <script type="text/javascript" src="js/loadRecords.js" ></script>

          <!-- End of records / The comments popup-->
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <article class="modal-content">
                <header class="modal-header">
                    <span class="close-popup">×</span>
                    <h2>Note</h2>          
                </header>
                <section class="modal-body">                
                    <textarea rows="12" cols="4"></textarea>                
                </section>
            </article>
         </div>
      </div>
    </div>
  </body>
</html>
<?php
    } else{
        header("location: login.php");
    }
?>