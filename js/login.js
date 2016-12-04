window.onload = function () {

    var divs = document.getElementsByClassName("input-div");
    var labels = document.getElementsByClassName("label");
    var inputs = document.getElementsByClassName("input");

    $("#input1").focus(function () {
        alterHighlight();
        $("#input1").addClass("clicked-div");
        $("#username-label").addClass("clicked-label");
        $("#username-label").removeClass("grayColor");
        $("#username").addClass("clicked-input");
        $("#username").focus();
    });

    $("#username").blur(function () {
        alterHighlight();
    });

    $("#input2").focus(function () {
        alterHighlight();
        $("#input2").addClass("clicked-div");
        $("#password-label").addClass("clicked-label");
        $("#password-label").removeClass("grayColor");
        $("#password").addClass("clicked-input");
        $("#password").focus();
    });

    $("#password").blur(function () {
        alterHighlight();
    });

    for (var i = 0; i < divs.length; i++) {
        (function (i) {
            divs[i].addEventListener("click", function () {
                alterHighlight();
                divs[i].className = "input-div clicked-div";
                labels[i].className = "label clicked-label";
                inputs[i].className = "input clicked-input";
                inputs[i].focus();
            });
        })(i);
    }

    function alterHighlight() {
        var divsFocused = document.getElementsByClassName('clicked-div');
        var labelsFocused = document.getElementsByClassName('clicked-label');
        var inputsFocused = document.getElementsByClassName('clicked-input');

        for (var i = 0; i < labelsFocused.length; i++) {
            if (inputsFocused[i].value != "") {
                labelsFocused[i].className += " grayColor";
            }
            else {
                labelsFocused[i].className = "label";
                inputsFocused[i].className = "input";
            }
            if (divsFocused[i] !== undefined) {
                divsFocused[i].className = "input-div";
            }
        }
    }
}