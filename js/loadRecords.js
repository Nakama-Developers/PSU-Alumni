// Open Student Profile
var isPinEvent = false;
openProfilesEvents();
function openProfilesEvents(){
    var profiles = document.getElementsByClassName('record');
    var recordProfiles = document.getElementsByClassName('record-profile');
    var recordRows = document.getElementsByClassName('record-row');
    var profileImages = document.getElementsByClassName('profile-img');

    for (var i = recordRows.length - 1; i >= 0; i--) {
        (function (i) {
            //recordRows[i].addEventListener('click', openProfile(i));
        })(i);
    }

    // open profile
    $('.record-row').click(function () {
        if (!isPinEvent) {
            closeProfile();
            $(this).addClass('close-row');
            $(this).next().addClass('open-profile');
            $(this).next().children('.profile-img').addClass('open-profile-img');
        } else {
            isPinEvent = false;
        }
    });

    $('.close-profile').click(function () {
        closeProfile();
    });
}    

// close whatever is opened from student profiles
function closeProfile() {
    $('.open-profile').removeClass('open-profile');
    $('.close-row').removeClass('close-row');
    $('.open-profile-img').removeClass('open-profile-img');
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