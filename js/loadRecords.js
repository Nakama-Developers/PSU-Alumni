    
var counter = 0;
var recordsBox = document.getElementById('pageRecords');

 function loadRecords(name, nationality, phone, email, ID, major, gpa, graduationYear, jobTitle, CurrentCompany, coopCompany, companySize) {

     
    // loading records from javascript
    //loading the record rows
    
    //var nameHTMLid = 'name' + counter;
    //var studentIDHTMLid = 'ID' + counter;
    //var emailHTMLid = 'email' + counter;
    //var numberHTMLid = 'number' + counter;
    //var majorHTMLid = 'major' + counter;
        recordsBox.innerHTML += '<div class="record">\
        <div class="record-row" title="Click for more details"> \
            <div class="info">\
              <p>\
                '+name+'\
              </p>\
            </div>\
            <div class="info">\
              <p>\
                '+ID+'\
              </p>\
            </div>\
            <div class="info">\
              <p>\
                '+email+'\
              </p>\
            </div>\
            <div class="info">\
              <p>\
               '+phone+'\
              </p>\
            </div>\
            <div class="info">\
              <p>\
               '+major+'\
              </p>\
            </div>\
          </div>\
          <article class="record-profile"></article></div>'
    
    //loading records profile
        var recordProfile = document.getElementsByClassName('record-profile');
        recordProfile[counter].innerHTML = '<div class="profile-img">\
              <img src="img/transperant-logo.png" alt="profile-pic" />\
            </div>\
            <section class="block-info personal-info">\
              <span class="block-title">Personal Info</span>\
                <div class="block-inputs">\
                    <div>\
                        <label for="name">Name:</label>\
                        <input class="field" type="text" value="'+name+'" readonly>\
                    </div>\
                    <div>\
                        <label for="nationality">Nationality:</label>\
                        <input class="field" type="text" value="'+nationality+'" readonly>\
                    </div>\
                    <div>\
                        <label for="Phone">Phones:</label>\
                        <input class="field" type="text" value="'+phone+'" readonly>\
                    </div>\
                    <div>\
                        <label for="email">E-mail:</label>\
                        <input class="field" type="email" value="'+email+'" readonly>\
                    </div>\
                </div>\
            </section><section class="block-info academic-info">\
              <span class="block-title">Academic Info</span>\
              <div class="block-inputs">\
                  <div>\
                      <label for="acad-id">Academic ID:</label>\
                      <input class="field"  type="text" name="acad-id" value="'+ID+'" readonly>\
                  </div>\
                  <div>\
                      <label for="major">Major:</label>\
                      <input class="field"  type="text" name="major" value="'+major+'" readonly>\
                  </div>\
                  <div>\
                      <label for="gpa">GPA:</label>\
                      <input class="field" type="number" step="0.01" name="gpa" value="'+gpa+'" readonly>\
                  </div>\
                  <div>\
                      <label for="grad-year">Graduation Year:</label>\
                      <input class="field" type="text" name="grad-year" value="'+graduationYear+'" readonly>\
                  </div>\
              </div>\
            </section><section class="block-info company-info">\
              <span class="block-title">Career Info</span>\
              <div class="block-inputs">\
                  <div>\
                      <label for="title">Job Title:</label>\
                      <input class="field" type="text" name="title" value="'+jobTitle+'" readonly>\
                  </div>\
                  <div>\
                      <label for="current-comp">Current Company:</label>\
                      <input class="field" type="text" name="current-comp" value="'+CurrentCompany+'" readonly>\
                  </div>\
                  <div>\
                      <label for="co-op-comp">Co-op Company:</label>\
                      <input class="field" type="text" name="co-op-comp" value="'+coopCompany+'" readonly>\
                  </div>\
                  <div>\
                      <label for="comp-size">Company Size:</label>\
                      <input class="field" type="text" name="comp-size" value="'+companySize+'" readonly>\
                  </div>\
              </div>\
            </section>\
            <section class="social-contact">\
              <div class="social-media">\
                  <a title="view his profile" href="#" class="alumni">\
                      <img src="img/transperant-logo.png" alt="PSU-logo"/>\
                  </a>\
                  <span title="view his facebook profile" class="facebook"></span>\
                  <span title="view his twitter account" class="twitter"></span>\
                  <span title="view his LinkedIn account" class="linkedIn"></span>\
              </div>\
              <div dir="rtl" class="functions">\
                  <span title="edit profile" class="edit editIcon"></span>\
                  <span title="write note" class="write-note"></span>\
                  <article dir="ltr" class="note-container">\
                    <header class="note-header">\
                        <span class="close-btn close-note"></span>\
                        <h2>Note</h2>\
                    </header>\
                    <section class="note-body">\
                        <textarea rows="6" cols="4" autofocus></textarea>\
                    </section>\
                  </article>\
              </div>\
            </section>\
            <span title="close" class="close-btn close-profile"></span>'
        counter++;
            }  
    


    // Open Student Profile
openProfilesEvents();
    function openProfilesEvents(){
        var profiles = document.getElementsByClassName('record');
        var recordProfiles = document.getElementsByClassName('record-profile');
        var recordRows = document.getElementsByClassName('record-row');
        var profileImages = document.getElementsByClassName('profile-img');

        for (var i = recordRows.length - 1; i >= 0; i--) {
            (function (i) {
                recordRows[i].addEventListener('click', function () {
                    closeProfile();
                    recordProfiles[i].className += ' open-profile';
                    recordRows[i].className += ' close-row';
                    profileImages[i].className += ' open-profile-img';
                });
            })(i);
        }

        var closeBtns = document.getElementsByClassName("close-profile");
        for (var i = closeBtns.length - 1; i >= 0; i--) {
            (function (i) {
                closeBtns[i].addEventListener('click', function () {
                    closeProfile();
                });
            })(i);
        }   
    }    

    // close whatever is opened from student profiles
    function closeProfile() {
        if (document.getElementsByClassName('open-profile')[0] !== undefined && document.getElementsByClassName('close-row')[0] !== undefined
    && document.getElementsByClassName('open-profile-img')[0] !== undefined) {
            document.getElementsByClassName('open-profile')[0].className = 'record-profile';
            document.getElementsByClassName('close-row')[0].className = 'record-row';
            document.getElementsByClassName('open-profile-img')[0].className = 'profile-img';
        }
    }

    var allCata = document.getElementsByClassName('All')[0];
    allCata.className = ' All-selected selected';

    var catagories = document.getElementsByClassName('catagories')[0].getElementsByTagName('a');
    for (var i = catagories.length - 1; i >= 0; i--) {
        (function (i) {
            catagories[i].addEventListener('click', function () {
                diselect();
                catagories[i].className = catagories[i].innerHTML.trim() + '-selected selected';
            });
        })(i);
    }

    function diselect() {
        for (var i = catagories.length - 1; i >= 0; i--) {
            catagories[i].className = catagories[i].innerHTML.trim();
        }
    }