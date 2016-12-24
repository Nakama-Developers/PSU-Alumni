<?php

require "php/dbconfig.php";
    session_start();
    // log out
    if(isset($_GET['logout'])){
        if($_GET['logout'] == true){
            unset($_SESSION['signedIn']);
        }
    }

    $error = "";
    $error_div = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $db->quote($_POST['username']);
        $username = strtr($username, array('_' => '\_', '%' => '\%'));
        $password =$db->quote(md5($_POST['password']));
        $q = $db->query("SELECT Role FROM user WHERE Username=$username AND Password=$password")->fetch();
        if ($q["Role"] === "admin") {
            if (isset($_SESSION['attempt'])){
                // After 3 failed attempts the user must solve the reCAPTCHA
                if($_SESSION['attempt'] > 2){
                    // checking if the user has solved the reCAPTCHA
                    $url = "https://www.google.com/recaptcha/api/siteverify";

                    $privatekey = "--------- Private key -----------";

                    $response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
                    $data = json_decode($response);
                    if(isset($data->success) and $data->success == true){
                        $_SESSION['signedIn'] = true;
                        header("location: index.php");
                    } else{
                        $GLOBALS['error'] = "humen only - no offense -";
                        $GLOBALS['error_div'] = show_error();
                        show_form(true);
                    }
                } else{
                    $_SESSION['signedIn'] = true;
                    header("location: index.php");
                }
            } else{
                $_SESSION['signedIn'] = true;
                header("location: index.php");
            }
        } // TODO: to add more users with different roles
        else if ($q["Role"] === null) {
            $GLOBALS['error'] = "wrong username or password";
            $GLOBALS['error_div'] = show_error();
            // Counting failed attempts
            if (isset($_SESSION['attempt'])) {
                $_SESSION['attempt'] = $_SESSION['attempt'] + 1;
                // determine whether to dislay the reCAPTCHA or not
                if($_SESSION['attempt'] > 2){
                    show_form(true);
                }else{
                    show_form();
                }
            } else {
                $_SESSION['attempt'] = 1;
                show_form();
            }
        }
    } else{
        if(isset($_SESSION['attempt'])){
            unset($_SESSION['attempt']);
        }
        show_form();
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
                            $er_div
                            <div class="submit-div">
                                <input tabindex="5" type="submit" value="Log In">
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