$(document).ready(function () {
    // Green: #75B62A, 117,182,42
    // Red: #E84747, 232,71,71
    // Yellow: #FAB900, 250,185,0
    //light Blue: #26B6C9, 38,182,201
    //Blue: #45829F, 69,130,159
    //Dark Blue: #005781 , 0,87,129
    $('#chartsLink').click(function () {
        $.ajax({ url: "php/exportStatistics.php", success: function (response) {
            var data = JSON.parse(response);
            if (data != undefined) {
                $('.main-content').html('<div class="tools-set">\
                                        <div class="search-tools">\
                                            <span class="label">Filter By:</span>\
                                            <div class="filter">\
                                           <input class="submit-button" type="submit" value="Go" onclick="filter()">\
                                           <span class="filter-span">Filter By:</span>\
                                                    <div class="filter-option-block" id="gpa_filter">\
                                                        <span  onclick="gpaFilterBlock()">GPA</span>\
                                                        <ul class="options">\
                                                            <li>\
                                                                <label for="0">0.5 - 2.0</label>\
                                                                <input value="0" name="GPA" id="0" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="2">2.0 - 2.5</label>\
                                                                <input value="2" name="GPA" id="2" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="2.5">2.5 - 3.0</label>\
                                                                <input value="2.5" name="GPA" id="2.5" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="3">3.0 - 3.5</label>\
                                                                <input value="3" name="GPA" id="3" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="3.5">3.5 - 4.0</label>\
                                                                <input value="3.5" name="GPA" id="3.5" type="checkbox">\
                                                            </li>\
                                                        </ul>\
                                                    </div>\
                                                    <div class="filter-option-block" id="comp_size_filter">\
                                                        <span onclick = "comp_size_filter_block()" >Company Size</span>\
                                                        <ul class="options">\
                                                            <li>\
                                                                <label for="large">Large</label>\
                                                                <input value="large" name="Company-size" id="large" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="medium">Medium</label>\
                                                                <input value="medium" name="Company-size" id="medium" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="small">Small</label>\
                                                                <input value="small" name="Company-size" id="small" type="checkbox">\
                                                            </li>\
                                                        </ul>\
                                                    </div>\
                                                    <div class="filter-option-block" id = "nationality_filter">\
                                                        <span onclick = "nationality_filter_block()">Nationality</span>\
                                                        <ul class="options">\
                                                            <li>\
                                                                <label for="saudi">Saudi</label>\
                                                                <input value="saudi" name="Nationality" id="saudi" type="checkbox">\
                                                            </li>\
                                                            <li>\
                                                                <label for="nosaudi">Non Saudi</label>\
                                                                <input value="nosaudi" name="Nationality" id="nosaudi" type="checkbox">\
                                                            </li>\
                                                        </ul>\
                                                    </div>\
                                            </div>\
                                        </div>\
                                        <div class="grouping">\
                                          <div class="catagories">\
                                            <a href="#" class="All">All\
                                            </a><a href="#" class="Master">Master\
                                            </a><a href="#" class="Bacholer">Bacholer\
                                            </a>\
                                          </div>\
                                        </div>\
                                      </div>\
                                      <div class="charts-container">\
                                        <div class="chart">\
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
                                        </div>\
                                      </div>');
                console.log(data['firstChart'][0]['Comp_Name']);
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
    });

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

    document.getElementById('sort_method').onchange = function () {
        // console.log(this.value);
        $.ajax({ url: "php/sort.php?sort-method=" + this.value, success: function (response) {
            var data = JSON.parse(response);
            if (data.studentsRows != '') { 
                $('#pageRecords').html(data.studentsRows + '');
                openProfilesEvents();
                runRecordsEvents();
            }
        } 
        });
    };

    // Nav tags
    var numRecordsPerPage = 40;
    var prev = 0;
    var next = 2;

    $('#next').click(function () {

        $.ajax({ url: "php/navpages.php?pageNum=" + next, success: function (response) {
            var data = JSON.parse(response);
            if (data.studentsRows != '') {
                var starter = (next -1) * numRecordsPerPage;
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
        $.ajax({ url: "php/navpages.php?pageNum=" + prev, success: function (response) {
            var data = JSON.parse(response);
            if (data.studentsRows != '') {
                var end = (prev + 1) * numRecordsPerPage;
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
//filter
    function gpaFilterBlock() {
        if( $('#gpa_filter').find('ul').is(':visible') ) {
            $('#gpa_filter').find('ul').css('display', 'none');
        }
        else{
            $('#gpa_filter').find('ul').css('display', 'block');
        }
        
    }
     function comp_size_filter_block() {
        if( $('#comp_size_filter').find('ul').is(':visible') ) {
            $('#comp_size_filter').find('ul').css('display', 'none');
        }
        else{
            $('#comp_size_filter').find('ul').css('display', 'block');
        }
        
    }
     function nationality_filter_block() {
        if( $('#nationality_filter').find('ul').is(':visible') ) {
            $('#nationality_filter').find('ul').css('display', 'none');
        }
        else{
            $('#nationality_filter').find('ul').css('display', 'block');
        }
        
    }
     function major_filter_block() {
        if( $('#major_filter').find('ul').is(':visible') ) {
            $('#major_filter').find('ul').css('display', 'none');
        }
        else{
            $('#major_filter').find('ul').css('display', 'block');
        }
        
    }