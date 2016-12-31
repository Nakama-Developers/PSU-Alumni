$(document).ready(function () {

    /********************* (CAUTION!) *******************************
    *                                                               *
    *   Please, any event regarding records must be inserted in     *
    *   runRecordsEvents() method.                                  *                          *
    *****************************************************************/
    runRecordsEvents();
    function runRecordsEvents() {

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
        });

        // note popup
        var note = document.getElementsByClassName('note-opened');

        $('.write-note').click(function () {
            $('.note-container').addClass('note-opened');
            $('.write-note').addClass('opened-icon');
        })
        // Get the <span> element that closes the modal
        var closeNote = document.getElementsByClassName("close-note")[0];

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
    }
    // Nav tags
    var numRecordsPerPage = 40;
    var prev = 0;
    var next = 2;

    $('#next').click(function () {
        $.ajax({ url: "http://localhost:57644/php/navpages.php?pageNum=" + next, success: function (response) {
            var data = JSON.parse(response);
            if (data.studentsRows != '') {
                var starter = next * numRecordsPerPage;
                $('#pageRecords').html(data.studentsRows + '');
                $('#resultsNumDisplay').text(starter + ' - ' + (starter + data.resultsNum));
                openProfilesEvents();
                runRecordsEvents();
                next++;
                prev++;
            }
        }
        });
    });

    $('#prev').click(function () {
        $.ajax({ url: "http://localhost:57644/php/navpages.php?pageNum=" + prev, success: function (response) {
            var data = JSON.parse(response);
            if (data.studentsRows != '') {
                var end = prev * numRecordsPerPage;
                $('#pageRecords').html(data.studentsRows + '');
                $('#resultsNumDisplay').text((end - numRecordsPerPage) + ' - ' + end);
                openProfilesEvents();
                runRecordsEvents();
                next--;
                prev--;
            }
        }
        });
    });
});