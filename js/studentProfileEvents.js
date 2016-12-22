$(document).ready(function () {

    $("#overviewCategory").click(function () {
        $(".profile-info-overview").css("display", "inline-block");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-comments").css("display", "none");
                
    })

    $("#educationCategory").click(function () {
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "inline-block");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-comments").css("display", "none");
    })

    $("#careerCategory").click(function () {
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "inline-block");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-comments").css("display", "none");
    })

    $("#personalInfoCategory").click(function () {
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "inline-block");
        $(".profile-info-comments").css("display", "none");
    })

    $("#commentsCategory").click(function () {
        $(".profile-info-overview").css("display", "none");
        $(".profile-info-education").css("display", "none");
        $(".profile-info-career").css("display", "none");
        $(".profile-info-contact").css("display", "none");
        $(".profile-info-comments").css("display", "inline-block");
    })
})

