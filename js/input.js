
// This will call the constructor and create div.intl-tel-input

$("#phone").intlTelInput({
  initialCountry: "auto",
  geoIpLookup: function(callback) {
    $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
      callback(countryCode);
    });
  },
  utilsScript: "../lib/intl-tel-input-11.0.0/build/js/utils.js"  // just for formatting/placeholders etc
});

var validations ={
    email: [/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Please enter a valid email address']
};

var email = $("input#email"),
  emailErrorMsg = $('#email-error-msg'),
  emailValidMsg = $('#email-valid-msg');

email.blur( function(){
        // Reset error/valid msgs
        email.removeClass("error");
        emailErrorMsg.addClass("hide");
        emailValidMsg.addClass("hide");
        // Set the regular expression to validate the email
        validation = new RegExp(validations['email'][0]);
        if($.trim($(this).val())){
          if (!validation.test(this.value)){
              email.addClass("error");
              emailErrorMsg.removeClass("hide");
              return false;
          } else {
              emailValidMsg.removeClass("hide");
          }
        }
    });

$('.intl-tel-input').append('<span id="valid-msg" class="hide">✓ Valid</span> \
<span id="error-msg" class="hide">Invalid</span>');

  var telInput = $("#phone"),
  errorMsg = $("#error-msg"),
  validMsg = $("#valid-msg"),
  phoneVal;


var reset = function() {
  telInput.removeClass("error");
  errorMsg.addClass("hide");
  validMsg.addClass("hide");
};

// on blur: validate
telInput.blur(function() {
  reset();
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
      phoneVal = $(telInput).val();
      $(telInput).val(telInput.intlTelInput("getNumber"));
      validMsg.removeClass("hide");
    } else {
      telInput.addClass("error");
      errorMsg.removeClass("hide");
    }
  }
});

telInput.focus(function() {
  $(telInput).val(phoneVal);
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);
