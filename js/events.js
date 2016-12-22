$(document).ready(function () {

    $('.edit').click(function () {
        if ($('.open-profile input').is('[readonly]')) {
            $('.open-profile input').prop('readonly', false);
            $('.edit').removeClass('editIcon');
            $('.edit').addClass('saveIcon');
        }
        else {
            $('.open-profile input').prop('readonly', true);
            $('.edit').removeClass('saveIcon');
            $('.edit').addClass('editIcon');
        }
    })

    // note popup
    var modal = document.getElementById('myModal');
    $('.write-note').click(function () {
        $('.modal').css('display', 'block');
    })
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close-popup")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

})

