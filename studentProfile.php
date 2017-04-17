<?php

    require "php/printData.php";

    $studentID = $_GET['studentID'];
    $studentInfoArray = getStudentProfileData($studentID);
    
   // echo "heeeey";
    //echo implode(" ",$studentInfoArray);
    print_r($studentInfoArray);
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Student Profile Page</title>
        <link  type="text/css" rel="stylesheet" href="css/studentProfile.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>      
        <script src="js/studentProfileEvents.js"></script>
    </head>
    <body>  
        <div class="top-functions">         
            <div class="container">
                <a class="psu-logo" href="#"><img src="img/transperant-logo.png" alt="PSU"></span></a>
                 <div class="search-box">   
                    <input type="search" class="search" placeholder="Search..">
                    <input class="search-btn" type="submit" name="search-btn" value="">
                </div>
                <div class="links">
                    <a href="#">Home</a>
                    <a href="#">News Feed</a>
                </div>
                <div class="icons">
                    <span class="messages-icon"></span>
                    <span class="notifications-icon"></span>
                    <span class="settings-icon"></span>
                </div> 
            </div>         
          </div>
       </div>

        <div class="main-content">  
        <div class="profile-container">
            <div class="profile-heading">
                <div class="profile-img-block">
                    <img alt="profile image" src="img/transperant-logo.png" class="profile-image">
                </div>
                <div class="profile-name"><span class="student-info-data"><?php echo $studentInfoArray[0]['Name']; ?></span></div>
            </div>
            <div class="profile-info-block">
                <div class="profile-categories">
                    <div class="category opened-category" id="overviewCategory">Overview</div>
                    <div class="category" id="educationCategory">Education</div>
                    <div class="category" id="certificatesCategory">Degrees</div>
                    <div class="category" id="careerCategory">Career</div>
                    <div class="category" id="personalInfoCategory">Personal Info</div>
                    <div class="category" id="socialMediaCategory">Social Media</div>
                    <div class="category" id="ResumeCategory">Résumé</div>
                </div>


                <div class="profile-info profile-info-overview">
                    <div class="info-overview-section">
                        <ul class="student-info-overview-list">
                            <li>
                                <div class="student-overview-info student-ID">Holds the student ID of <span class="student-info-data"><?php echo $studentID; ?></span> </div>
                            </li>
                            <li>
                                <div class="student-overview-info student-nationality">From <span class="student-info-data"><?php echo $studentInfoArray[0]['Nationality']; ?></span></div>
                            </li>
                            <li>
                                <div class="student-overview-info student-major">Studied <span class="student-info-data"><?php echo $studentInfoArray[0]['Major']; ?></span>  </div>
                            </li>
                            <li>
                                <div class="student-overview-info student-GPA">Got a GPA of <span class="student-info-data"><?php echo $studentInfoArray[0]['GPA']; ?></span>  </div>
                            </li>
                        </ul>            
                    </div>
                    <div class="info-overview-section-2">
                        <ul class="student-info-overview-list">
                            <li>
                                <div class="student-info-optional student-current-company"><span class="side-icon"><i class="company-icon"></i></span><span class="student-side-info-block">Currently Working in <span class="student-info-data"><?php echo $studentInfoArray[0]['Current_Company']; ?></span></span></div>
                            </li>
                            <li>
                                <div class="student-info-optional student-job-title"><i class="job-icon"></i>Works as <span class="student-info-data"> <?php echo $studentInfoArray[0]['Job_title']; ?> </span></div>
                            </li>
                            <li>    
                                <div class="student-info-optional student-contact-number"><i class="contact-number-icon"></i>Contact number: <span class="student-info-data"> <?php echo 9999999; ?> </span> </div>
                            </li>
                        </ul>            
                    </div>
                </div>                 
             <div class="profile-info profile-info-education">           
                    <div class="info-section">
                        <ul class="student-info-list">
                            <li>
                                <div class="student-info student-ID">Holds the student ID of <input type="text" placeholder="empty" id="studentID" value=<?php echo $studentInfoArray[0]['Student_ID']; ?> readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-major">Studied <input type="text" placeholder="empty" id="major" value='<?php echo "not inserted in db yet";?>' readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-GPA">Got a GPA of <input type="text" placeholder="empty" id="GPA" value=<?php echo $studentInfoArray[0]['GPA']; ?> readonly> </div>
                            </li>
                            <li>
                                <div class="student-info student-graduation-year">Graduated on <input type="text" placeholder="empty" id="graduationYear" value=<?php echo $studentInfoArray[0]['Graduation_year']; ?> readonly> </div>
                            </li>
                            <li>
                               <div class="student-info edit-btn-block">
                                   <button class="edit-btn" id="educationEditBtn">EDIT</button> 
                                   <button class="save-btn" id="educationSaveBtn">SAVE</button> 
                               </div>                        
                            </li>
                        </ul>            
                    </div>
                </div>
                <div class="profile-info profile-info-certificate">           
                    <div class="info-section">
                        <ul class="student-info-list">
                            <li>
                                <div class="student-info">Degree: <input type="text" placeholder="empty" id="studentID" value=<?php echo $studentInfoArray[0]['Degree']; ?> readonly></div>
                            </li>
                            <li>
                                <div class="student-info">Major: <input type="text" placeholder="empty" id="major" value='<?php echo "not inserted in db yet";?>' readonly></div>
                            </li>
                            <li>
                                <div class="student-info">University: <input type="text" placeholder="empty" id="GPA" value=<?php echo $studentInfoArray[0]['University']; ?> readonly> </div>
                            </li>
                            <li>
                                <div class="student-info">Year: <input type="text" placeholder="empty" id="graduationYear" value=<?php echo $studentInfoArray[0]['Year']; ?> readonly> </div>
                            </li>
                            <li>
                               <div class="student-info edit-btn-block">
                                   <button class="edit-btn" id="educationEditBtn">EDIT</button> 
                                   <button class="save-btn" id="educationSaveBtn">SAVE</button> 
                               </div>                        
                            </li>
                        </ul>            
                    </div>
                </div>
                <div class="profile-info profile-info-career">
                    
                    <div class="info-section">
                        <ul class="student-info-list">
                            <li>
                                <div class="student-info student-coop-company">Did the Co-Op with  <input type="text" placeholder="empty" id="coopCompany" value='<?php echo $studentInfoArray[0]['Coop_Company']; ?>' readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-first-job-date">Time taken to get the job after finishing the Co-op: <input type="text" placeholder="empty" id="timeToGetJob" value='<?php echo 'need to be edited in the db'; ?>' readonly> Months</div>
                            </li>
                            <li>
                                <div class="student-info student-current-job">Currently working for <input type="text" placeholder="empty" id="currentJob" value='<?php echo $studentInfoArray[0]['Current_Company']; ?>' readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-job-title">Working as <input type="text" placeholder="empty" id="jobTitle" value='<?php echo $studentInfoArray[0]['Job_title']; ?>' readonly> </div>
                            </li>
                            
                            <li>
                               <div class="student-info edit-btn-block">
                                   <button class="edit-btn" id="careerEditBtn">EDIT</button>
                                   <button class="save-btn" id="careerSaveBtn">SAVE</button>
                               </div>
                            </li>
                        </ul>            
                    </div>
                </div>
                <div class="profile-info profile-info-contact">
                    
                    <div class="info-section">
                        <ul class="student-info-list">
                            <li>
                                <div class="student-info student-first-nationalID">National ID <input type="text" placeholder="empty" id="nationalID" value="2160186789" readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-nationality">Country <input type="text" placeholder="empty" id="nationality" value="Syria" readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-email">E-Mail <input type="text" placeholder="empty" id="email" value="o.maksousa@hotmail.com" readonly></div>
                            </li>
                            <li>
                                <div class="student-info student-contact-number">Contact number <input type="text" placeholder="empty" id="conatctNumber" value="0552968456" readonly> </div>
                            </li>
                            <li>
                                <div class="student-info edit-btn-block">
                                    <button class="edit-btn" id="contactEditBtn">EDIT</button>
                                    <button class="save-btn" id="contactSaveBtn">SAVE</button>
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
    </div>
    </body>
</html>
