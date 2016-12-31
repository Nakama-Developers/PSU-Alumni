<?php

$recordsPerPage = 40;

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

