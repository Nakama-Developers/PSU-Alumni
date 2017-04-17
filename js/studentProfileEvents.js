$(document).ready(function () {

    $("#overviewCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").addClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#certificatesCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "inline-block");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-certificate").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#educationCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").addClass("opened-category");
        $("#certificatesCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "inline-block");
        $(".profile-info-certificate").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#certificatesCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#certificatesCategory").addClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-certificate").css("display", "inline-block");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#careerCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#certificatesCategory").removeClass("opened-category");
        $("#careerCategory").addClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-certificate").css("display", "none");
        $(".profile-info-career").css("display", "inline-block");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#personalInfoCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#certificatesCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").addClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-certificate").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "inline-block");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#socialMediaCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#certificatesCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").addClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-certificate").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "inline-block");
        $(".profile-info-resume").css("display", "none");
    })

    $("#ResumeCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#certificatesCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").addClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-certificate").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "inline-block");
    })

    // updating the student info
    $('#educationEditBtn').click(function editInputs() {

        $('.profile-info-education').css("background-color",'#cacaca');
        $('#educationSaveBtn').css("display", "block");
        $('#educationEditBtn').css("display", "none");
    });
    $('#educationSaveBtn').click(function saveInputs() {
        // getting the values
        var info = {tableName:"student",Student_ID:$('#studentID').val(), major:$('#major').val(), GPA:$('#GPA').val(),graduationYear:$('#graduationYear').val()};
        var myJSON = JSON.stringify(info);
        $('.profile-info-education').css("background-color",'#fff');
        $('#educationSaveBtn').css("display", "none");
        $('#educationEditBtn').css("display", "block");
        $.ajax({
            type: "GET",
             url: "../php/events.php" + "?req=store &studentInfo="+myJSON, 
             dataType: "json",
            success: function (data) {
                // send a popup that says successful like the loading one in the admin page
            }
        })
    });


    $('#careerEditBtn').click(function editCareerInputs() {
        $('.profile-info-career').css("background-color", "#cacaca");
        $('.profile-info-career').find('#careerSaveBtn').css("display", "block");
        $('#careerEditBtn').css("display", "none");
    });
    $('#careerSaveBtn').click(function saveCareerInputs() {
        // getting the values
        var info = {table:"student_career",Student_ID:$('#studentID').val(), Coop_company:$('#coopCompany').val(), Time_To_Get_Job:$('#timeToGetJob').val(),Current_company:$('#currentJob').val(),Job_title:$('#jobTitle').val()};
        var myJSON = JSON.stringify(info);
        $('.profile-info-career').css("background-color", "#fff");
        $.ajax({
            type: "GET",
             url: "../php/events.php" + "?req=store &studentInfo="+myJSON, 
             dataType: "json",
            success: function (data) {
                // send a popup that says successful like the loading one in the admin page
            }
        })
    });


    $('#contactEditBtn').click(function editContactInputs() {
        $('.profile-info-contact').find('input').css("background-color", "red");
        $('.profile-info-contact').find('#contactSaveBtn').css("display", "block");
        $('#contactEditBtn').css("display", "none");
    });
    $('#contactSaveBtn').click(function saveContactInputs() {
        // getting the values
        var info = {tableName:"student",Student_ID:$('#studentID').val(),Nationality:$('#nationality').val(), National_ID:$('#nationalID').val(), Phone:$('#conatctNumber').val(),email:$('#email').val()};
        var myJSON = JSON.stringify(info);
        $('.profile-info-education').find('input').css("background-color", "blue");
        $.ajax({
            type: "GET",
             url: "../php/events.php" + "?req=store &studentInfo="+myJSON, 
             dataType: "json",
            success: function (data) {
                // send a popup that says successful like the loading one in the admin page
            }
        })
    });
})

