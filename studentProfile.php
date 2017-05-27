<?php

    require_once "php/printData.php";

    $studentID = $_GET['studentID'];
    $studentInfoArray = getStudentProfileData($studentID);
    
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Student Profile Page</title>
        <link  type="text/css" rel="stylesheet" href="css/studentProfile.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
        <!--<script src="https://use.fontawesome.com/cef442fadb.js"></script>  -->
        <script src="js/studentProfileEvents.js"></script>
    </head>
    <body>  
        <div class="top-functions">         
            <div class="container">
                <div class="main-content">
                    <img src="img/newLogo.png" alt="PSU">
                    <div class="icons">
                    <span title="log out" class="logout icon"></span>
                    <span class="notifications-icon"></span>
                    <span class="settings-icon"></span>
                </div> 
                </div>
                <!--
                <a class="psu-logo" href="#"><img src="img/transperant-logo.png" alt="PSU"></span></a>
                 <div class="search-box">   
                    <input type="search" class="search" placeholder="Search..">
                    <input class="search-btn" type="submit" name="search-btn" value="">
                </div>
                <div class="links">
                    <a href="#">Home</a>
                    <a href="#">News Feed</a>
                </div>-->
            </div>         
          </div>
       </div>

        <div class="main-content">  
        <div class="profile-container">
            <div class="profile-heading">
                <div class="profile-img-block outsider">
                    <div class="upload-phote">
                        <span class="upload-icon"></span>
                        <input accept="image/*" type="file">
                    </div>
                    <div class="profile-img-block insider">
                        <img alt="profile image" src="img/transperant-logo.png" class="profile-image">
                    </div>
                </div>
                <div class="profile-brief">
                    <div class="role alumni"><span>Alumni</span></div>
                    <div class="name"><span><?php echo $studentInfoArray[0]['Name']; ?></span></div>
                    <div class="general-info">
                        <ul>
                            <li>
                                <span class="icon comp"></span>
                                <div>Currently in 
                                    <span class="student-info-data"><?php echo $studentInfoArray[0]['Current_Company']; ?></span>
                                </div>
                            </li>
                            <li>
                                <span class="icon job"></span>
                                <div>Works as 
                                    <span class="student-info-data"> <?php echo $studentInfoArray[0]['Job_title']; ?> 
                                    </span>
                                </div>
                            </li>
                            <li>    
                                <span class="icon mobile"></span>
                                <div>Contact number: 
                                    <span class="student-info-data">
                                        <a href="tel:<?php echo $studentInfoArray[0]['Phone']; ?>">23232323223</a> 
                                    </span>
                                </div>
                            </li>
                            <li>    
                                <span class="icon email"></span>
                                <div>E-mail: 
                                    <span class="student-info-data">
                                        <a href="mailto:<?php echo $studentInfoArray[0]['email']; ?>"><?php echo $studentInfoArray[0]['email']; ?></a> 
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="profile-info-block">
                <div class="mobile-menu">
                    <span class="menuBtn">
                    </span>
                </div>
                <div class="menu">
                    <ul class="profile-categories">
                        <li class="category opened-category" id="overview">Overview</li>
                        <li class="category" id="education">Education</li>
                        <li class="category" id="certificates">Degrees</li>
                        <li class="category" id="career">Career</li>
                        <li class="category" id="personal">Personal Info</li>
                        <li class="category" id="social">Social Media</li>
                        <li class="category" id="resume">Résumé</li>
                    </ul>
                </div><div class="right-div">
                    <button class="editBtn hide styledBtn">
                        <span>
                        </span>
                    </button>
                    <button class="saveBtn hide styledBtn">
                        <span>
                        </span>
                    </button>
                    <div class="profile-info profile-info-overview">
                        <div class="info-overview-section">
                            <ul class="student-info-overview-list">
                                <li>
                                    <div class="student-info student-ID">Holds the student ID of <span class="student-info-data"><?php echo $studentID; ?></span> </div>
                                </li>
                                <li>
                                    <div class="student-info student-nationality">From <span class="student-info-data"><?php echo $studentInfoArray[0]['Nationality']; ?></span></div>
                                </li>
                                <li>
                                    <div class="student-info student-major">Studied <span class="student-info-data"><?php echo $studentInfoArray[0]['Major']; ?></span>  </div>
                                </li>
                                <li>
                                    <div class="student-info student-GPA">Got a GPA of <span class="student-info-data"><?php echo $studentInfoArray[0]['GPA']; ?></span>  </div>
                                </li>
                            </ul>            
                        </div>
                    </div>
                    <div class="profile-info profile-info-education">           
                        <div class="info-section">
                            <ul class="student-info-list">
                                <li>
                                    <div class="student-info student-ID">Holds the student ID of <input type="text" placeholder="empty" id="studentID" value='<?php echo $studentID; ?>' readonly></div>
                                </li>
                                <li>
                                    <div class="student-info student-major">Studied <input type="text" placeholder="empty" id="major" value='<?php echo $studentInfoArray[0]['Major']; ?>' readonly></div>
                                </li>
                                <li>
                                    <div class="student-info student-GPA">Got a GPA of <input type="text" placeholder="empty" id="GPA" value=<?php echo $studentInfoArray[0]['GPA']; ?> readonly> </div>
                                </li>
                                <li>
                                    <div class="student-info student-graduation-year">Graduated on <input type="text" placeholder="empty" id="graduationYear" value=<?php echo $studentInfoArray[0]['Graduation_year']; ?> readonly> </div>
                                </li>
                                <li>
                                   <div class="student-info edit-btn-block">
                                       <button class="btn" id="educationEditBtn">EDIT</button> 
                                       <button class="btn save-btn" id="educationSaveBtn">SAVE</button> 
                                   </div>                        
                                </li>
                            </ul>            
                        </div>
                    </div>
                    <div class="profile-info profile-info-career">
                        <div class="info-section">
                            <ul class="student-info-list">
                                <li>
                                    <div class="student-info">Did the Co-Op with  <input list="companies" type="text" placeholder="empty" id="coopCompany" value='<?php echo $studentInfoArray[0]['Coop_Company']; ?>' readonly></div>
                                </li>
                                <li>
                                    <div class="student-info">Job seeking time after Co-op <input type="text" placeholder="empty" id="timeToGetJob" value='<?php echo $studentInfoArray[0]['Time_to_get_job']; ?>'  readonly> Months</div>
                                </li>
                                <li>
                                    <div class="student-info">Currently working for <input list="companies" placeholder="empty" id="currentJob" value='<?php echo $studentInfoArray[0]['Current_Company']; ?>' readonly><?php echo printCompaniesList(); ?></div>
                                </li>
                                <li>
                                    <div class="student-info">Working as <input type="text" placeholder="empty" id="jobTitle" value='<?php echo $studentInfoArray[0]['Job_title']; ?>' readonly> </div>
                                </li>
                                <li>
                                    <div class="student-info">Took the job with the same company that did that coop with <input type="text" placeholder="empty" id="workedCoop" value='<?php echo $studentInfoArray[0]['Worked_coop']; ?>' readonly> </div>
                                </li>
                            
                                <li>
                                   <div class="student-info edit-btn-block">
                                       <button class="btn" id="careerEditBtn">EDIT</button>
                                       <button class="btn save-btn" id="careerSaveBtn">SAVE</button>
                                   </div>
                                </li>
                            </ul>            
                        </div>
                    </div>
                    <div class="profile-info profile-info-personal">
                        <div class="info-section">
                            <ul class="student-info-list">
                                <li>
                                    <div class="student-info student-nationalID">National ID <input type="text" placeholder="empty" id="nationalID" value="<?php echo $studentInfoArray[0]['National_ID']; ?>" readonly></div>
                                </li>
                                <li>
                                    <div class="student-info student-nationality">Country <input type="text" placeholder="empty" id="nationality" value="<?php echo $studentInfoArray[0]['Nationality']; ?>" readonly></div>
                                </li>
                                <li>
                                    <div class="student-info student-email">E-Mail <input type="text" placeholder="empty" id="email" value="<?php echo $studentInfoArray[0]['email']; ?>" readonly></div>
                                </li>
                                <li>
                                    <div class="student-info student-contact-number">Contact number <?php
                                                                                                        for($i = 0; $i<count($studentInfoArray);$i++){
                                                                                                            if($studentInfoArray[ $i ]['Phone']!= NULL)
                                                                                                            echo " <input type=\"text\" placeholder=\"empty\" class=\"contactNumber\" value= '".$studentInfoArray[ $i ]['Phone']."' readonly> <br>";
                                                                                                        }
                                                                                                       

                                                                                                          $tmpArr = array();
foreach ($studentInfoArray as $sub) {
  $tmpArr[] = implode(',', $sub);
}
$result = implode('|', $tmpArr);
echo $result;
                                                                                                    ?>  </div>
                                </li>
                                <li>
                                    <div class="student-info edit-btn-block">
                                        <button class="btn" id="personalEditBtn">EDIT</button>
                                        <button class="btn save-btn" id="personalSaveBtn">SAVE</button>
                                    </div>
                                </li>
                            </ul>            
                        </div>
                    </div>
                    <div class="profile-info profile-info-social">
                        <div class="info-section">
                            <span class="social-icons facebook"></span>
                            <span class="social-icons twitter"></span>
                            <span class="social-icons linkedIn"></span>
                        </div>
                    </div>
                    <div class="profile-info profile-info-resume">
                        <div class="info-section">
                            <div class="panel-body">
                                <!-- Standar Form -->
                                <h4>Select files from your computer</h4>
                                <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <input type="file" name="files[]" id="js-upload-files" multiple>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                                    </div>
                                </form>
                                    <!-- Upload Finished -->
                                <div class="js-upload-finished">
                                    <h3>Processed files</h3>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>Resume.pdf</a>                                              
                                    </div>
                                </div>
                              </div>                   
                        </div>
                    </div>             
                    </div>
                </div>
                
                             
             
               <!-- <div class="profile-info profile-info-certificate">           
                    <div class="info-section">
                        <ul class="student-info-list">
                            <li>
                                <div class="student-info">Degree: <input type="text" placeholder="empty" id="degree" value='<?php echo $studentInfoArray[0]['Degree']; ?>' readonly></div>
                            </li>
                            <li>
                                <div class="student-info">Major: <input type="text" placeholder="empty" id="majorDegree" value='<?php echo $studentInfoArray[0]['Degree_Major'];?>' readonly></div>
                            </li>
                            <li>
                                <div class="student-info">University: <input type="text" placeholder="empty" id="university" value='<?php echo $studentInfoArray[0]['University']; ?>' readonly> </div>
                            </li>
                            <li>
                                <div class="student-info">Year: <input type="text" placeholder="empty" id="degreeYear" value='<?php echo $studentInfoArray[0]['Year']; ?>' readonly> </div>
                            </li>
                            <li>
                               <div class="student-info edit-btn-block">
                                   <button class="edit-btn" id="certificateEditBtn">EDIT</button> 
                                   <button class="save-btn" id="certificateSaveBtn">SAVE</button> 
                               </div>                        
                            </li>
                        </ul>            
                    </div>
                </div>-->                
                
        </div>
            <?php
                //echo json_encode($studentInfoArray);
            ?>
    </div>
     <footer>
         <div class="main-content">
            <address>
              <small><a class="email icon" href="mailto:fahmri@psu.edu.sa">Fahed M. Al-Ahmary</a><br>
			        <a class="phone icon" href="tel:+966-55-253-2542">+966 55 253 2542</a></small>
              <div>Prince Sultan University</div>
            </address>
         </div>
     </footer>
    </body>
</html>
