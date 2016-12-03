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
    var note = document.getElementsByClassName('note-opened');

    $('.write-note').click(function () {
        //$('.modal').css('display', 'block');
        $('.note-container').addClass('note-opened');
        $('.write-note').addClass('opened-icon');
    })
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close-popup")[0];
    var closeNote = document.getElementsByClassName("close-note")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    $('.close-note').click(function () {
        $('.note-container').removeClass('note-opened');
        $('.write-note').removeClass('opened-icon');
    })
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == note) {
            $('.note-container').removeClass('note-opened');
        }
    }

})

