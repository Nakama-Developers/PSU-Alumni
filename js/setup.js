$(".intro").ready(function(){
  var delay = 3.5;
  var i = 1;
  $(".intro .text p").each(function(){
    $(this).css({"animation": "greeting-alumni " + 2 + "s " + (delay * i) + "s", "opacity":"1", "transition": "opacity 0s " + (delay * i) + "s "});
    i++;
  });

});

$(document).ready(function(){
$(".intro .close").click(function(){
  $(".intro").css("display","none");
  $(".header").css("position","fixed");
  $(".header img").addClass("img-container");
  $(".container").css("filter", "none");
});

  var numSteps = $("form").children("section").length;
  $("form > section").hide();
  $(".nav .prev").hide();

  var step = 0;
  $("form > section").eq(step).show();

  var process = $('.process > div');
  process.eq(step).addClass("focus");

  $("#next").click(function(){
    var err_input = validate();
    // console.log($(err_input).attr("id") + " : " + $(err_input).attr("class"));
    if(err_input == undefined){
      $("form > section").eq(step).slideUp();
      process.eq(step).addClass("completed");
      process.eq(step).removeClass("focus");
      step++;
      $("form > section").eq(step).slideDown();
      process.eq(step).addClass("focus");
      if(step == (numSteps - 1)){
        $(this).parents(".nav").hide();
      }
      $(this).prev().show();
    }else{
      var animation_duration = 4; // in seconds
      $(err_input).css("animation","border-err-light 0.8s 4 alternate");
      setTimeout(removeAnimation, animation_duration * 1000);
    }

    function removeAnimation(){
      $(err_input).css("animation", "");
    }

  });

  $(".prev").click(function(){
    $(".nav").show();
    if(step != 0){
      $("form > section").eq(step).slideUp();
      process.eq(step).removeClass("focus");
      step--;
      $("form > section").eq(step).slideDown();
      process.eq(step).addClass("focus");
      if(step == 0){
        $(this).hide();
      }

    }
  });

  $('input.radio').change(function () {
        console.log(this.checked);
        $(this).parents('.input-div').find('.radio-container').removeClass('radio-checked');
        $(this).parent().addClass('radio-checked');
    });

    function validate(){
      var inputs = $("form > section:nth-child(" + (step + 1) + ") input");
      var error_input;
      $(inputs).each(function(){
        if(($(this).val() == null || $(this).val() == "") || $(this).attr("class") == "error"){
          error_input = $(this);return;
        }
      });
      return error_input;
    }

    $("form").submit(function(event){
        event.preventDefault();
        if($("#password").val() != null || $("#password").val() != ""){
          if($("#password").val() != $("#con_password").val()){
            $("#con_password").css("border-color","#d00");
          }
          else{
            $("form").submit();
          }
        }
    });

});
