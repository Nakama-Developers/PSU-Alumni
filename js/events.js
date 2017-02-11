// Green: #75B62A, 117,182,42
// Red: #E84747, 232,71,71
// Yellow: #FAB900, 250,185,0
//light Blue: #26B6C9, 38,182,201
//Blue: #45829F, 69,130,159
//Dark Blue: #005781 , 0,87,129

$(document).ready(function () {
    var numRecordsPerPage = 40;
    var prev = 0;
    var next = 2;
    $('#chartsLink').click(function () {
        drawCharts();
    });

    function drawCharts() {
        $("div").remove(".search-box");
        $("div").remove(".navegation-tools");
        $(".search-panel").attr('class', 'tools-set');
        $('.records').html('<div class="chart">\
                                            <canvas id="companies"></canvas>\
                                        </div>\
                                        <div class="chart">\
                                            <div class="pie-chart-container">\
                                                <canvas id="companySizes"></canvas>\
                                            </div>\
                                        </div>\
                                        <div class="chart">\
                                            <div class="pie-chart-container">\
                                                <canvas id="nationalities"></canvas>\
                                            </div>\
                                        </div>\
                                        <div class="chart">\
                                            <canvas id="numAlumnisByMajor"></canvas>\
                                        </div>');
        $(".records").attr('class', 'charts-container');
        $.ajax({ url: "php/exportStatistics.php", success: function (response) {
            var data = JSON.parse(response);
            if (data != undefined) {

                firstLabels = [];
                firstValues = [];
                var counter = 0;
                while (data['firstChart'][counter] !== undefined) {
                    firstLabels[counter] = data['firstChart'][counter]['Comp_Name'];
                    firstValues[counter] = data['firstChart'][counter]['Value'];
                    counter++;
                }
                var companies = $('#companies');
                var companySizes = $('#companySizes');
                var numAlumnisByMajor = $('#numAlumnisByMajor');
                var nationalities = $('#nationalities');
                var companiesChartObject = {
                    type: 'bar',
                    data: {
                        labels: firstLabels, // Companies Names
                        datasets: [{
                            label: '# of offers by company',
                            data: firstValues, // Values
                            backgroundColor: [
                                        'rgba(38,182,201, 0.4)',
                                        'rgba(117,182,42, 0.4)',
                                        'rgba(232,71,71, 0.4)',
                                        'rgba(250,185,0, 0.4)',
                                        'rgba(69,130,159, 0.4)',
                                        'rgba(0,87,129, 0.4)'
                                    ],
                            borderColor: [
                                        'rgba(38,182,201, 1)',
                                        'rgba(117,182,42, 1)',
                                        'rgba(232,71,71, 1)',
                                        'rgba(250,185,0, 1)',
                                        'rgba(69,130,159, 1)',
                                        'rgba(0,87,129, 1)'
                                    ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                };
                // console.log(companiesChartObject.data.datasets[0].data[0]);

                var companiesChart = new Chart(companies, companiesChartObject);

                secondLabels = [];
                secondValues = [];
                var counter = 0;
                while (data['secondChart'][counter] !== undefined) {
                    secondLabels[counter] = data['secondChart'][counter]['Comp_Size'];
                    secondValues[counter] = data['secondChart'][counter]['Value'];
                    counter++;
                }

                var companySizesObject = {
                    type: 'doughnut',
                    data: {
                        labels: secondLabels,
                        datasets: [
                                {
                                    data: secondValues,
                                    backgroundColor: [
                                        "#26B6C9",
                                        "#FAB900",
                                        "#E84747"
                                    ],
                                    hoverBackgroundColor: [
                                        "#26B6C9",
                                        "#FAB900",
                                        "#E84747"
                                    ]
                                }]
                    },
                    options: { responsive: true
                    }
                };

                var companySizesChart = new Chart(companySizes, companySizesObject);

                thirdLabels = [];
                thirdValues = [];
                var counter = 0;
                while (data['thirdChart'][counter] !== undefined) {
                    thirdLabels[counter] = data['thirdChart'][counter]['Major'];
                    thirdValues[counter] = data['thirdChart'][counter]['Value'];
                    counter++;
                }

                var numAlumnisByMajorCharObject = {
                    type: 'bar',
                    data: {
                        labels: thirdLabels, // Companies Names
                        datasets: [{
                            label: '# of Alumnis by major',
                            data: thirdValues, // Values
                            backgroundColor: [
                                        'rgba(38,182,201, 0.4)',
                                        'rgba(117,182,42, 0.4)',
                                        'rgba(232,71,71, 0.4)',
                                        'rgba(250,185,0, 0.4)',
                                        'rgba(69,130,159, 0.4)',
                                        'rgba(0,87,129, 0.4)'
                                    ],
                            borderColor: [
                                        'rgba(38,182,201, 1)',
                                        'rgba(117,182,42, 1)',
                                        'rgba(232,71,71, 1)',
                                        'rgba(250,185,0, 1)',
                                        'rgba(69,130,159, 1)',
                                        'rgba(0,87,129, 1)'
                                    ],
                            borderWidth: 1
                        }]
                    },
                    options: { responsive: true
                    }
                };

                var numAlumnisByMajorChar = new Chart(numAlumnisByMajor, numAlumnisByMajorCharObject);

                forthLabels = [];
                forthValues = [];
                var counter = 0;
                while (data['forthChart'][counter] !== undefined) {
                    forthLabels[counter] = data['forthChart'][counter]['Nationality'];
                    forthValues[counter] = data['forthChart'][counter]['Value'];
                    counter++;
                }

                var nationalitiesChartObject = {
                    type: 'pie',
                    data: {
                        labels: forthLabels,
                        datasets: [
                                {
                                    data: forthValues,
                                    backgroundColor: [
                                        "#26B6C9",
                                        "#FAB900",
                                        "#E84747"
                                    ],
                                    hoverBackgroundColor: [
                                        "#26B6C9",
                                        "#FAB900",
                                        "#E84747"
                                    ]
                                }]
                    },
                    options: { responsive: true
                    }
                };

                var nationalitiesChart = new Chart(nationalities, nationalitiesChartObject);
            }
        }
        });

    }

    $('.records-header > .selectable').click(function (e) {
        e.stopPropagation();
        if(!$(this).attr('class').includes('selected')){
            $(document).click();   
        }
        $(this).toggleClass('selected');
    });

    $(document).click(function () {
        $('.records-header > .selectable').removeClass('selected');
    });
    /************************* (CAUTION!) ***************************
    *   Please, any event regarding records must be inserted in     *
    *   runRecordsEvents() method.                                  *
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

        // Pin Record
        $('.pin').click(function () {
            isPinEvent = true;
            var node = this;
            var bool = isPinned(this);
            $.ajax({
                type: "GET",
                dataType: "JSON",
                data: {
                    req: "pin",
                    id: node.parentNode.parentNode.childNodes[3].innerText.trim(),
                    isPinned: bool
                },
                url: "php/events.php",
                success: function (response) {
                    console.log(isPinned(node) + " " + response.type + " " + response.query);
                    if (response.recieved == 1) {
                        $(node).parents('.record').toggleClass('pinned');
                        if (bool && $(node).parents('.record').parent().attr('id') != 'pageRecords') {
                            $(node).parents('.record').css('opacity', 0.7);
                        } else {
                            $(node).parents('.record').css('opacity', 1);
                        }
                        if (bool) {
                            $(node).attr('title', 'pin this record');
                        } else {
                            $(node).attr('title', 'unpin this record');
                        }
                    }
                }
            });
        });

        function isPinned(node) {
            return ($(node).parents('.record').css('border-right-width') === "4px");
        }

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

    // Sort Methods
    document.getElementById('sort_method').onchange = function () {
        $.ajax({ url: "php/events.php?req=sort&sort-method=" + this.value, success: function (response) {
            // TODO: 
            // response to be a boolean indicating that the backend process has succeeded
            prev = -1;
            next = 1;
            nextPage();
        }
        });
    };

    // Filter Methods
    $('.filterInput').change(function () {
        console.log(this.name + ": " + this.value + " " + this.checked);
        $.ajax({ url: "php/events.php?req=filter&category=" + this.name + "&value=" + this.value + "&checked=" + this.checked, success: function (response) {
            // TODO: 
            // response to be a boolean indicating that the backend process has succeeded
            prev = -1;
            next = 1;
            nextPage();
            var companies = document.getElementById('companies');
            // console.log(companies);
            if (companies !== null) {
                drawCharts();
            }
        }
        });
    });

    // Nav tags
    $('#next').click(function () {
        nextPage();
    });

    $('#prev').click(function () {
        prevPage();
    });

    function nextPage() {
        $.ajax({ url: "php/events.php?req=nav&pageNum=" + next, async: false, success: function (response) {
            // console.log(response);
            var data = JSON.parse(response);
            if (data.records.studentsRows != '') {
                var starter = (next - 1) * numRecordsPerPage;
                $('#pageRecords').html(data.records.studentsRows + '');
                // console.log(data.pinnedRecords);
                if (data.pinnedRecords != null) {
                    // console.log(data.pinnedRecords.studentsRows);
                    $('#pinnedRecords').html(data.pinnedRecords.studentsRows);
                } else {
                    $('#pinnedRecords .pin').off();
                    $('#pinnedRecords .record-row').off();
                }
                $('#resultsNumDisplay').text(starter + ' - ' + (starter + data.records.resultsNum));
                openProfilesEvents();
                runRecordsEvents();
                next++;
                prev++;
            }
        }
        });
    }

    function prevPage() {
        $.ajax({ url: "php/events.php?req=nav&pageNum=" + prev, async: false, success: function (response) {
            var data = JSON.parse(response);
            if (data.records.studentsRows != '') {
                var end = (prev) * numRecordsPerPage;
                $('#pageRecords').html(data.records.studentsRows + '');
                // console.log(data.pinnedRecords);
                if (data.pinnedRecords != null) {
                    // console.log(data.pinnedRecords.studentsRows);
                    $('#pinnedRecords').html(data.pinnedRecords.studentsRows);
                } else {
                    $('#pinnedRecords .pin').off();
                    $('#pinnedRecords .record-row').off();
                }
                $('#resultsNumDisplay').text((end - numRecordsPerPage) + ' - ' + end);
                openProfilesEvents();
                runRecordsEvents();
                next--;
                prev--;
            }
        }
        });
    }
});