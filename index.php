<?php

require "php/dbconfig.php";
    session_start();
    unset($_SESSION['signedIn']);
    unset($_SESSION['role']);
    // log out
    if(isset($_GET['logout'])){
        if($_GET['logout'] == true){
            unset($_SESSION['signedIn']);
            unset($_SESSION['role']);
            session_unset();
        }
    }

    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == "admin"){
            header("location: admin.php");
        } else{
            header("location: studentProfile.php?studentID=" . $_SESSION['username']);
        }
    }

    $error = "";
    $error_div = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $db->quote($_POST['username']);
        $username = strtr($username, array('_' => '\_', '%' => '\%'));
        $password =$db->quote(md5($_POST['password']));
        $q = $db->query("SELECT Role FROM user WHERE Username=$username AND Password=$password")->fetch();
        if(!isset($q["Role"])){
            $q = $db->query("SELECT records.Role, records.Number_Of_Visits, records.Password, records.Student_ID FROM
                            ( 
                                SELECT student_account.Number_Of_Visits, student_account.Password, 
                                student_account.Student_ID,
                                student.Role FROM student 
                                    INNER JOIN student_account ON 
                                    student.Student_ID=student_account.Student_ID
                            ) AS records WHERE records.Student_ID = $username AND records.Password=$password")->fetch();
        }
        if(isset($_SESSION['attempt'])){
            // After 2 failed attempts the user must solve the reCAPTCHA
            if($_SESSION['attempt'] > 2){
                // checking if the user has solved the reCAPTCHA
                $url = "https://www.google.com/recaptcha/api/siteverify";

                    $privatekey = "_________Private Key_________";

                    $response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
                    $data = json_decode($response);
                    if(isset($data->success) and $data->success == true){
                        // ----------- Auth ------------
                        if(!auth()){
                            show_form(true);
                        }
                    }
                    else{
                        $GLOBALS['error'] = "humen only - no offense -";
                        $GLOBALS['error_div'] = show_error();
                        show_form(true);
                    }
                } 
                else{
                    // --------- Auth -------------
                    // Determine whether to display reCAPTCHA 
                    if(!auth() && $_SESSION['attempt'] >= 2){
                        // A failed attempt is registered.
                        show_form(true);
                    } else{
                        // A failed attempt is registered.
                        show_form();
                    }
                }
            }
            // Registering the first Failed attempt 
            else{
                $_SESSION['attempt'] = 1;
                // --------- Auth -----------
                if(!auth()){
                   show_form();
                }
            }
    } else if(isset($_GET['sign-up-req'])){
        $hash = $db->quote($_GET['sign-up-req']);
        $hash = strtr($hash, array('_' => '\_', '%' => '\%'));
        $q = $db->query("SELECT Student_ID,Name,Nationality,Role FROM student WHERE Student_ID=(SELECT Student_ID FROM student_hash WHERE hash=$hash)")->fetch();
        if($q["Role"] == "alumni"){
            echo '<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="lib/intl-tel-input-11.0.0/build/css/intlTelInput.css">
    <link rel="stylesheet" href="css/setup.css">
    <title>Alumni Portal - Set Up</title>
    <style media="screen">
    .iti-flag {background-image: url("lib/intl-tel-input-11.0.0/build/img/flags.png");}

      @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
      .iti-flag {background-image: url("lib/intl-tel-input-11.0.0/build/img/flags.png");}
    }
    </style>
    <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="js/setup.js"></script>
  </head>
  <body>
    <div class="intro">
      <div class="text">
        <h2>Welcome Back ' . $q["Name"] . ' !</h2>
        <h2>Nice To See You Again!</h2>
        <p ><b>Alumni Portal</b> is being developed to connect <b>PSU</b> with their Alumni</p>
        <p >The data you provide will be used for academic accreditation authorities</p>
        <p >Please, take a few moments to <b>update</b> your info and <b>log in</b> to your new PSU profile</p>
        <address>
              <div><div><a href="mailto:fahmri@psu.edu.sa">Fahed M. Al-Ahmary</a></div>
			        <a href="tel:+966-55-253-2542">+966 55 253 2542</a></div>
              <div>Prince Sultan University</div>
        </address>
      </div>
      <span class="close"> X </span>
    </div>
    <header class="header">
      <div class="background">
        <img src="img/newLogo.png" alt="PSU Logo">
      </div>
    </header>
    <article class="container">
      <div class="process">
        <div class="step1">
          Step 1
        </div>
        <div class="step2">
          Step 2
        </div>
        <div class="step3">
          Step 3
        </div>
      </div>
      <form class="set-up" action="#" method="post">
        <section class="step1 personal-info">
          <div class="input-div title">
            Personal Info
          </div>
          <div class="input-div">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="' . $q["Name"] . '" tabindex="2" required autofocus="autofocus">
          </div>
          <div class="input-div">
            <label for="nationality">Nationality:</label>
            <input type="text" name="nationality" id="nationality" tabindex="3" value="' . $q["Nationality"] . '" readonly>
          </div>
          <div class="input-div">
            <label for="national-id">National ID:</label>
            <input type="number" name="national-id" id="national-id" tabindex="4" value="" required>
          </div>
          <div class="input-div">
            <label for="email">E-mail:</label>
            <div class="validation-div">
              <input type="email" name="email" id="email" tabindex="5" pattern="[a-zA-Z0-9!#$%&amp;\'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required>
              <span id="email-valid-msg" class="valid input-msg hide">✓ Valid</span>
              <span id="email-error-msg" class="invalid input-msg hide">Invalid</span>
            </div>
          </div>
          <div class="input-div">
            <label for="phone">Phone:</label>
            <input type="tel" name="mobile-phone" tabindex="6" id="phone" required>
            <script src="lib/intl-tel-input-11.0.0/build/js/intlTelInput.min.js"></script>
            <script src="lib/intl-tel-input-11.0.0/build/js/utils.js"></script>
          </div>
        </section>
        <section class="step2 career-info">
          <div class="input-div title">
            Career Info
          </div>
          <div class="input-div">
            <label for="job-title">Job Title:</label>
            <input type="text" name="job-title" tabindex="8" id="job-title" value="" required>
          </div>
          <div class="input-div">
            <label for="current-company">Current Company:</label>
            <input name="current-company" tabindex="9" list="companies" id="current-company" value="">
            <datalist id="companies">
            	<option value="MooTools">
            	<option value="Moobile">
            	<option value="Dojo Toolkit">
            	<option value="jQuery">
            	<option value="YUI">
            </datalist>
          </div>
          <div class="input-div">
            <label for="coop-company">Co-op Company:</label>
            <input name="coop-company" tabindex="10" list="companies" id="coop-company" value="" required>
            <datalist id="companies">
            	<option value="MooTools">
            	<option value="Moobile">
            	<option value="Dojo Toolkit">
            	<option value="jQuery">
            	<option value="YUI">
            </datalist>
          </div>
          <div class="input-div time_to_get_job">
            <p class="label">When did you get your first job?</p>
            <div>
              <span class="radio-container radio-checked">
                  <input class="radio" value="1" tabindex="11" name="time_to_get_job" id="1" type="radio" checked="checked">
                  <span class="radio-check"></span>
              </span>
              <label for="1">After 1 month of graduation</label>
            </div>
            <div>
              <span class="radio-container">
                  <input class="radio" value="3" tabindex="12" name="time_to_get_job" id="3" type="radio">
                  <span class="radio-check"></span>
              </span>
              <label for="3">After 3 month of graduation</label>
            </div>
            <div>
              <span class="radio-container">
                  <input class="radio" value="6" tabindex="13" name="time_to_get_job" id="6" type="radio">
                  <span class="radio-check"></span>
              </span>
              <label for="6">After 6 month of graduation</label>
            </div>
          </div>
          <div class="input-div coop_job_offering">
            <p class="label">Have you been offered a job by your co-op company after/during the co-cop?</p>
            <div>
              <span class="radio-container radio-checked">
                  <input class="radio" value="true" tabindex="14" name="coop_job_offering" id="true" type="radio" checked="checked">
                  <span class="radio-check"></span>
              </span>
              <label for="true">Yes</label>
            </div>
            <div>
              <span class="radio-container">
                  <input class="radio" value="false" tabindex="15" name="coop_job_offering" id="false" type="radio">
                  <span class="radio-check"></span>
              </span>
              <label for="false">No</label>
            </div>
          </div>
        </section>
        <section class="step3 last-step pwd-setup">
          <div class="input-div title">
            Set up Password
          </div>
          <div class="input-div">
            <label for="username">username / id:</label>
            <input type="text" name="username" tabindex="17" id="username" value="' . $q["Student_ID"] . '" readonly>
          </div>
          <div class="input-div">
            <label for="password">Password:</label>
            <input type="password" tabindex="18" name="password" id="password" value="" required>
          </div>
          <div class="input-div">
            <label for="con_password">Confirm Password:</label>
            <input type="password" tabindex="19" name="con_password" id="con_password" value="" required>
          </div>
          <div class="input-div">
            <a class="prev" href="#">< Previous</a>
            <input id="submit" class="submit" tabindex="20" type="submit" name="submit" value="Submit">
          </div>
        </section>
      </form>
      <section class="nav">
        <div class="input-div">
          <a class="prev" href="#">< Previous</a>
          <a id="next" href="#">Next ></a>
        </div>
      </section>
    </article>
    <script src="input.js"></script>
  </body>
</html>
';
        }
    }
    // Making sure to reset the attempt counter when the user access the page again. (Usability)
    else{
        if(isset($_SESSION['attempt'])){
            unset($_SESSION['attempt']);
        }
        show_form();
    }

    // ******** Authentication ************** //
    function auth(){
        global $q, $username;
         if (isset($q["Role"])){
             if($q["Role"] === "admin") {
                 $_SESSION['username'] = $_POST['username'];
                 $_SESSION['role'] = $q["Role"];
                 header("location: admin.php");
             } else{
                 $_SESSION['username'] = $_POST['username'];
                 $_SESSION['role'] = $q["Role"];
                 updateAccountInfo($GLOBALS['username'], ++$q['Number_Of_Visits']);
                 header("location: studentProfile.php?studentID=" . $_POST['username']);
             }
         } else {
             $_SESSION['attempt'] = $_SESSION['attempt'] + 1;
             $GLOBALS['error'] = "Wrong Username or Password";
             $GLOBALS['error_div'] = show_error();
             return FALSE;
         }
    }

    function updateAccountInfo($id, $num){
        $q = $GLOBALS['db']->query("Update student_account SET Number_Of_Visits=$num, Last_Visit=Current_Timestamp WHERE Student_ID=$id");
    }

    function show_error(){
        if ($GLOBALS['error'] !== null || $GLOBALS['error'] !== "") {
            return '<div class="errors-div">' . $GLOBALS['error'] . '</div>';
        }
    }

    function show_form($testneeded = false){
        $reCAPTCHA = "";
        if($testneeded){
            $reCAPTCHA = '<div class="recaptch-container">
<div class="g-recaptcha" data-sitekey="6LfLrw8UAAAAAOaLozAbtTySVCaoGeZNx4k8RC5H"></div>
</div>';
        }
        $er_div = $GLOBALS['error_div'];
        echo <<<_FORM_
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Login page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="img/logo-icon.png">
      <link href="css/loginPage.css" rel="stylesheet" type="text/css"/>
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="js/login.js" type="text/javascript"></script>
      <script src="https://www.google.com/recaptcha/api.js"></script>
    </head>
    <body>
        <div class="container">
            <article class="article-form">
                <header class="header">
                    <img src="img/psulogo.png" alt="PSU Logo">
                    $er_div
                </header>
                <section class="login-form">
                    <div class="form-container">
                        <form method="POST" action="$_SERVER[PHP_SELF]">
                            <div id="input1" class="input-div username-div" tabindex="1">
                                <label id="username-label" class="label" for="username">Username</label>
                                <input name="username" class="input" id="username" type="text" required tabindex="2">
                            </div>
                            <div id="input2" class="input-div password-div" tabindex="3">
                                <label id="password-label" class="label" for="password">Password</label>
                                <input name="password" class="input" id="password" type="password" required tabindex="4">
                            </div>
                            $reCAPTCHA
                            <div class="submit-div">
                                <input tabindex="6" type="submit" value="Log In">
                            </div>
                        </form>
                    </div>
                    <div class="forget-password">
                        <a href="#">Forgotten Password?</a>
                    </div>
                </section>
            </article>
        </div>
    </body>
    </html>
_FORM_;
    }
?>