$(document).ready(function () {

    $(".category").click(function () {
        $(".category").removeClass("opened-category");
        $(".profile-info").slideUp();
        $(".profile-info-" + $(this).attr("id")).slideDown();
        $(this).addClass("opened-category");
    });

    $(".mobile-menu > .menuBtn").click(function (e) {
        e.stopPropagation();
        $(".menu").toggleClass("show");
        $(".menu").toggleClass("toggle-menu");
    });

    $(".menu").click(function (e) {
        e.stopPropagation();
    });

    $(document).click(function () {
        $(".menu").removeClass("show");
        $(".menu").removeClass("toggle-menu");
    });

    //**************************************************************************************

    $(".editBtn").click(function () {
        $(this).css("transform", "rotateY(270deg)");
        $(".saveBtn").css("transform", "rotateY(360deg)");
        //$('.profile-info[style*="display: block"]').addClass("editBlock");
        $('.right-div').addClass("editBlock");
    });

    $(".saveBtn").click(function () {
        $(this).css("transform", "rotateY(270deg)");
        $(".editBtn").css("transform", "rotateY(360deg)");
        //$('.profile-info[style*="display: block"]').removeClass("editBlock");
        $('.right-div').removeClass("editBlock");
    });


    // updating the student info
    $('#educationEditBtn').click(function editInputs() {
        $('.profile-info-education').find('input').prop('readonly', false);
        $('#educationSaveBtn').css("display", "block");
        $('#educationEditBtn').css("display", "none");
    });
    $('#educationSaveBtn').click(function saveInputs() {
        $('.profile-info-education').find('input').prop('readonly', true);

        // getting the values
        var information = { tableName: "student" };
        var data = { Student_ID: $('#studentID').val(), Major: $('#major').val(), GPA: $('#GPA').val(), Graduation_year: $('#graduationYear').val() };
        var informationJSON = JSON.stringify(information);
        var dataJSON = JSON.stringify(data);
        $('.profile-info-education').css("background-color", '#fff');
        $('#educationSaveBtn').css("display", "none");
        $('#educationEditBtn').css("display", "block");
        $.ajax({
            type: "GET",
            contentType: "application/json",
            data:
            {
                req: "store",
                information: informationJSON,
                data: dataJSON
            },
            url: "php/events.php",

            success: function (data)//we got the response
            {
                alert(data);
            },
            error: function (exception) { alert('Exeption:' + exception); }
        })

    });

    /* $('#certificateEditBtn').click(function editCertificateInputs() {
    $('.profile-info-certificate').find('input').prop('readonly', false);
    $('.profile-info-certificate').css("background-color", '#cacaca');
    $('#certificateSaveBtn').css("display", "block");
    $('#certificateEditBtn').css("display", "none");
    });
    $('#certificateSaveBtn').click(function saveCertificateInputs() {
    $('.profile-info-certificate').find('input').prop('readonly', true);

    //getting the values
    var information = { tableName: "certificate"};
    var data = {Student_ID: $('#studentID').val(), Degree: $('#degree').val(), Degree_Major: $('#majorDegree').val(), University: $('#university').val(),Year:$('#degreeYear').val() };
    var informationJSON = JSON.stringify(information);
    var dataJSON = JSON.stringify(data);
    $('.profile-info-certificate').css("background-color", '#fff');
    $('#certificateSaveBtn').css("display", "none");
    $('#certificateEditBtn').css("display", "block");
        
    $.ajax({
    type: "GET",
    contentType: "application/json",
    data: 
    {
    req: "store",
    information: informationJSON,
    data: dataJSON
    },
    url: "php/events.php",
            
    success:function(data)//we got the response
    {
    alert(data);
    },
    error:function(exception){alert('Exeption:'+exception);}
    })
    });*/


    $('#careerEditBtn').click(function editCareerInputs() {
        $('.profile-info-career').find('input').prop('readonly', false);
        $('.profile-info-career').css("background-color", "#cacaca");
        $('#careerSaveBtn').css("display", "block");
        $('#careerEditBtn').css("display", "none");
    });
    $('#careerSaveBtn').click(function saveCareerInputs() {
        $('.profile-info-career').find('input').prop('readonly', true);
        $('.profile-info-career').css("background-color", "#fff");
        // getting the values
        var information = { tableName: "student_career", Student_ID: $('#studentID').val(), Coop_company: $('#coopCompany').val(), Current_company: $('#currentJob').val() };
        var studentData = { Time_To_Get_Job: $('#timeToGetJob').val(), Job_title: $('#jobTitle').val(), Worked_coop: $('#workedCoop').val() };
        var informationJSON = JSON.stringify(information);
        var dataJSON = JSON.stringify(studentData);

        alert(informationJSON);
        alert(dataJSON);


        $.ajax({
            type: "GET",
            contentType: "application/json",
            data:
            {
                req: "store",
                information: informationJSON,
                data: dataJSON
            },
            url: "php/events.php",

            success: function (data)//we got the response
            {
                alert(data);
            },
            error: function (exception) { alert('Exeption:' + exception); }
        })
        $('.profile-info-career').css("background-color", '#fff');
        $('#careerSaveBtn').css("display", "none");
        $('#careerEditBtn').css("display", "block");
    });



    $('#personalEditBtn').click(function editPersonalInputs() {
        $('.profile-info-personal').find('input').prop('readonly', false);
        $('.profile-info-personal').css("background-color", "#cacaca");
        $('#personalSaveBtn').css("display", "block");
        $('#personalEditBtn').css("display", "none");
    });



    $('#personalSaveBtn').click(function savePersonalInputs() {
        $('.profile-info-personal').find('input').prop('readonly', true);
        $('.profile-info-personal').css("background-color", "#fff");
        // getting the values

        var phoneElementsArray = document.getElementsByClassName('contactNumber');
        var phoneDataArray = [];
        for (var i = 0; i < phoneElementsArray.length; i++) {
            phoneDataArray[i] = phoneElementsArray[i].value;
        }
        var information = { tableName: "student" };
        var studentData = { Student_ID: $('#studentID').val(), National_ID: $('#nationalID').val(), Nationality: $('#nationality').val(), email: $('#email').val(), PhoneArray: phoneDataArray };
        var informationJSON = JSON.stringify(information);
        var dataJSON = JSON.stringify(studentData);

        alert(informationJSON);
        alert(dataJSON);
        $.ajax({
            type: "GET",
            contentType: "application/json",
            data:
            {
                req: "store",
                information: informationJSON,
                data: dataJSON
            },
            url: "php/events.php",

            success: function (data)//we got the response
            {
                alert(data);
            },
            error: function (exception) { alert('Exeption:' + exception); }
        })
        $('.profile-info-personal').css("background-color", '#fff');
        $('#personalSaveBtn').css("display", "none");
        $('#personalEditBtn').css("display", "block");
    });
});

