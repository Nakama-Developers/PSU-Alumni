$(document).ready(function () {

    $("#overviewCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").addClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "inline-block");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#educationCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").addClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "inline-block");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#careerCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#careerCategory").addClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "inline-block");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#personalInfoCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").addClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "inline-block");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "none");
    })

    $("#socialMediaCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").addClass("opened-category");
        $("#ResumeCategory").removeClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "inline-block");
        $(".profile-info-resume").css("display", "none");
    })

    $("#ResumeCategory").click(function () {
        // adding some style to the clicked category
        $("#overviewCategory").removeClass("opened-category");
        $("#educationCategory").removeClass("opened-category");
        $("#careerCategory").removeClass("opened-category");
        $("#personalInfoCategory").removeClass("opened-category");
        $("#socialMediaCategory").removeClass("opened-category");
        $("#ResumeCategory").addClass("opened-category");

        //showing the clicked info block
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-social").css("display", "none");
        $(".profile-info-resume").css("display", "inline-block");
    })

    $('.editBtn').click(function() {
        var categoryInputs = $('.editBtn').siblings('div').find('input');
        if (categoryInputs.is('[readonly]')) {
            categoryInputs.prop('readonly', false);
            $('.editBtn').removeClass('editIcon');
            $('.editBtn').addClass('saveIcon');
        }
        else {
            categoryInputs.prop('readonly', true);
            $('.editBtn').removeClass('saveIcon');
            $('.editBtn').addClass('editIcon');
        }
    })


})

