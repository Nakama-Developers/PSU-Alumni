window.onload = function () {

    var outside1 = document.getElementsByClassName('search-panel')[0];
    var outside2 = document.getElementsByClassName('search-box')[0];
    // Open Student Profile
    var profiles = document.getElementsByClassName('record');
    var recordProfiles = document.getElementsByClassName('record-profile');
    var recordRows = document.getElementsByClassName('record-row');
    var profileImages = document.getElementsByClassName('profile-img');

    for (var i = profiles.length - 1; i >= 0; i--) {
        (function (i) {
            profiles[i].addEventListener('click', function () {
                closeProfile();
                recordProfiles[i].className += ' open-profile';
                recordRows[i].className += ' close-row';
                profileImages[i].className += ' open-profile-img';
            });
        })(i);
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

    // closing when click outside
    window.onclick = function (event) {
        if (event.target == outside1 || event.target == outside2 ) {
            closeProfile();
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
}
