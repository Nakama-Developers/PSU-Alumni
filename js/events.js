// Green: #75B62A, 117,182,42
// Red: #E84747, 232,71,71
// Yellow: #FAB900, 250,185,0
//light Blue: #26B6C9, 38,182,201
//Blue: #45829F, 69,130,159
//Dark Blue: #005781 , 0,87,129
var headers = ['E-mail', 'Phone', 'Major', 'Job Title', 'Co-op Company', 'Current Company', 'Company Size', 'Nationality'];
var searchBy = 'id';

$(document).ready(function () {
    var numRecordsPerPage = 40;
    var prev = 0;
    var next = 2;
    // $('.logDiv').slideUp("fast");
    $('.logDiv').hide();
    $('.search-options').hide();
    $('#chartsLink').click(function () {
        $('.logDiv').text('Laoding...');
        $('.logDiv').show();
        drawCharts();
    });

    function drawCharts() {
        $("div").remove(".search-box");
        $("div").remove(".navegation-tools");
        $("div").remove(".records-header");
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
            $('.logDiv').hide();
        }
        });

    }

    $('.records-header > .selectable').click(function (e) {
        e.stopPropagation();
        if (!$(this).attr('class').includes('selected')) {
            $(document).click();
        }
        $(this).toggleClass('selected');
    });

    $(document).click(function () {
        $('.records-header > .selectable').removeClass('selected');
        $('.search-options').slideUp("fast");
        $('.opt-btn').removeClass('opened');
        $('.filter-option-block > .options').css('visibility', 'hidden');
    });

    $('.filter-option-block').click(function (e) {
        e.stopPropagation();
        $('.filter-option-block > .options').css('visibility', 'hidden');
        $(this).children('.options').css('visibility', 'visible');
    });
    /************************* (CAUTION!) ***************************
    *   Please, any event regarding records must be inserted in     *
    *   runRecordsEvents() method.                                  *
    *****************************************************************/
    runRecordsEvents();
    function runRecordsEvents() {
        inviteBtnEvents();

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
        $('.pin').click(function (e) {
            $('.logDiv').text('Loading...');
            e.stopPropagation();
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

    // Drop search options
    $('.opt-btn').click(function (e) {
        e.stopPropagation();
        $(this).toggleClass('opened');
        $('.search-options').slideToggle('fast');
    });

    $('.search-options').click(function (e) {
        e.stopPropagation();
    });

    // Search option 
    $('.search-option').change(function (e) {
        e.stopPropagation();
        $('.radio-container').removeClass('radio-checked');
        $(this).parent().toggleClass('radio-checked');
        searchBy = $(this).val();
    });

    // SEARCH
    $('.search').keyup(function () {
        var val = $(this).val();
        $.ajax({
            url: "php/events.php",
            type: "GET",
            datatype: "JSON",
            data: {
                req: "search",
                value: val,
                type: searchBy
            },
            success: function () {
                if (next > 1) {
                    next--;
                    prev--;
                }
                nextPage();
            }
        });
    });

    // Sort Methods
    document.getElementById('sort_method').onchange = function () {
        // $('.logDiv').slideDown("fast");
        $('.logDiv').text('Loading...');
        $('.logDiv').show();

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
        // $('.logDiv').slideDown("fast");
        $('.logDiv').text('Loading...');
        $('.logDiv').show();
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



    // Excel
    $('#exportToExcel').click(function () {
        $('.modal-header > .popup-title').text('Export To Excel Sheet');
        $('.modal-body').html('<div class="excelExport"><div class="row-input">\
                    <label for="group-option" class="input-title">Grouped By</label>\
                    <ul id="excel-grouping-options" class="options">\
                        <li>\
                            <div>\
                                <span class="checkbox-container checked first">\
                                    <input class="checkbox" value="Graduation_year" name="Graduation_year" id="Grad-Year"  type="checkbox" checked>\
                                </span>\
                                <label for="Grad-Year">Graduation Year</label>\
                            </div>\
                            <div>\
                                <span class="checkbox-container">\
                                    <input class="checkbox" value="Nationality" name="Nationality" id="Nationality"  type="checkbox">\
                                </span>\
                                <label for="Nationality">Nationality</label>\
                            </div>\
                        </li>\
                        <li>\
                            <div>\
                                <span class="checkbox-container">\
                                    <input class="checkbox" value="Major" name="Major" id="Major"  type="checkbox">\
                                </span>\
                                <label for="Major">Major</label>\
                            </div>\
                            <div>\
                                <span class="checkbox-container">\
                                    <input class="checkbox" value="Collage" name="Collage" id="Collage"  type="checkbox">\
                                </span>\
                                <label for="Collage">Collage</label>\
                            </div>\
                        </li>\
                        <li>\
                            <div>\
                                <span class="checkbox-container">\
                                    <input class="checkbox" value="Company-size" name="Company-Size" id="Company-Size"  type="checkbox">\
                                </span>\
                                <label for="Company-Size">Company Size</label>\
                            </div>\
                        </li>\
                    </ul>\
                </div>\
                <div class="row-input excel-sheet-title">\
                    <label for="excel-title"class="input-title">Title: </label>\
                    <input id="excel-title" type="text" value="excelSheet">\
                </div>\
                <div class="row-input">\
                    <div id="Export-options" class="options-dropdown">\
                        <span class="input-title">Print ...</span>\
                        <span class="dropdown-arrow"></span>\
                        <ul class="options scroll-check gray">\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Name" name="name" id="name"  type="checkbox" checked>\
                                </span>\
                                <label for="name">Name</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="id" name="id" id="id"  type="checkbox" checked>\
                                </span>\
                                <label for="id">Student ID</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Major" name="major" id="major"  type="checkbox" checked>\
                                </span>\
                                <label for="major">Major</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="GPA" name="gpa" id="gpa"  type="checkbox" checked>\
                                </span>\
                                <label for="gpa">GPA</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Nationality" name="nationality" id="nationality"  type="checkbox" checked>\
                                </span>\
                                <label for="nationality">Nationality</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Graduation_year" name="grad-year" id="grad-year"  type="checkbox" checked>\
                                </span>\
                                <label for="grad-year">Graduation Year</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="email" name="email" id="email"  type="checkbox" checked>\
                                </span>\
                                <label for="email">Email</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Current_Company" name="current-company" id="current-company"  type="checkbox" checked>\
                                </span>\
                                <label for="current-company">Current Company</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Coop_Company" name="coop-company" id="coop-company"  type="checkbox" checked>\
                                </span>\
                                <label for="coop-company">Co-op Company</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container">\
                                        <input class="checkbox" value="Company_size" name="company-size" id="company-size"  type="checkbox">\
                                </span>\
                                <label for="company-size">Company Size</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container checked">\
                                        <input class="checkbox" value="Job_title" name="job" id="job"  type="checkbox" checked>\
                                </span>\
                                <label for="job">Job Title</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container">\
                                        <input class="checkbox" value="Worked_coop" name="worked-coop" id="worked-coop"  type="checkbox">\
                                </span>\
                                <label for="worked-coop">Offered Job by Coop Comp</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container">\
                                        <input class="checkbox" value="phone" name="phone" id="phone"  type="checkbox">\
                                </span>\
                                <label for="phone">Phone</label>\
                            </li>\
                            <li>\
                                <span class="checkbox-container">\
                                        <input class="checkbox" value="time-get-job" name="time-get-job" id="time-get-job"  type="checkbox">\
                                </span>\
                                <label for="time-get-job">Time To Get Job</label>\
                            </li>\
                         </ul>\
                     </div>\
                </div>\
                <div class="row-input">\
                    <input type="button" value="Reset" id="resetBtn" class="btn">\
                    <input type="button" value="Export" id="exportBtn" class="proceedBtn btn">\
                </div>\
            </div>');

        exportToExcelEvents();
    });

    // select feild
    $('.options > li').click(function () {
        // $('.logDiv').slideDown("fast");
        $('.logDiv').text('Loading...');
        $('.logDiv').show();
        var text = $(this).text().trim();
        var num = $(this).parents('.label').index();
        switchTextNode($('.options > .' + $(this).attr('class') + ' > p'), $(this).parents('.label').children('.selected').children('.text'));
        $.ajax({
            url: "php/events.php",
            type: "GET",
            datatype: "JSON",
            data: {
                req: "feild",
                id: --num,
                feild: text
            },
            success: function () {
                if (next > 1) {
                    next--;
                    prev--;
                }
                nextPage();
            }
        });
    });

    // DEPRECATED
    function changeFeild(num, feild) {
        $.ajax({
            url: "php/events.php",
            type: "GET",
            datatype: "JSON",
            data: {
                req: "feild",
                id: --num,
                feild: feild
            },
            success: function () {
                if (next > 1) {
                    next--;
                    prev--;
                }
                nextPage();
            }
        });
    }

    function switchTextNode(nodeA, nodeB) {
        var temp = $(nodeA).eq(0).text();
        $(nodeA).text($(nodeB).text());
        $(nodeB).text(temp);
    }

    // Nav tags
    $('#next').click(function () {
        // $('.logDiv').slideDown("fast");
        $('.logDiv').text('Loading...');
        $('.logDiv').show();
        setTimeout(nextPage, 50);
    });

    $('#prev').click(function () {
        // $('.logDiv').slideDown("fast");
        $('.logDiv').text('Loading...');
        $('.logDiv').show();
        setTimeout(prevPage, 50);
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
            } else if (next == 1) {
                $('#pageRecords').html('<div style="font-size:1.4em;font-weight:bold;padding: 30px 0;color:#0078D7;background-color:rgba(255, 255, 255, 0.4);text-align:center;">Ops!... No Match is Found</div>');
                $('#resultsNumDisplay').text("0");
            }
            $('.logDiv').slideUp();
            // $('.logDiv').hide();
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
            $('.logDiv').slideUp();
            // $('.logDiv').hide();
        }
        });
    }

    $('.modal .close').click(function () {
        $('.modal').css('visibility', 'hidden');
        $('.menu').removeClass('focus');
        $('.modal-content').removeClass('show-modal');
        $('#Export-options').removeClass('selected');
    });

    $('.modal').click(function () {
        $('.modal').css('visibility', 'hidden');
        $('.menu').removeClass('focus');
        $('.modal-content').removeClass('show-modal');
        $('#Export-options').removeClass('selected');
    });

    $('.modal-content').click(function (e) {
        $('.filter-option-block > .options').css('visibility', 'hidden');
        $('#Export-options').removeClass('selected');
        e.stopPropagation();
    });

    $('.functions a').click(function () {
        $('.menu').addClass('focus');
        $('.modal').css('visibility', 'visible');
        setTimeout(50, $('.modal-content').addClass('show-modal'));
    });

    // Export to Excel event
    function exportToExcelEvents() {
        var checkBoxClasses = { 1: "first", 2: "second" };

        // 'What to export' options
        $('#Export-options').click(function (e) {
            e.stopPropagation();
            if (!$(this).attr('class').includes('selected')) {
                $('.modal-content').click();
            }
            $(this).toggleClass('selected');
        });

        $('#excel-grouping-options #Grad-Year').change();

        $('#Export-options li').click(function (e) {
            e.stopPropagation();
        });

        $('#excel-grouping-options input.checkbox').change(function (e) {
            e.stopPropagation();
            if (this.checked) {
                console.log(this.checked);
                $(this).parent().addClass('checked ' + checkBoxClasses[document.querySelectorAll('#excel-grouping-options span.checked').length + 1]);
            } else {
                console.log(this.checked);
                $('#excel-grouping-options .checkbox-container.checked').attr('class', 'checkbox-container');
                $('#excel-grouping-options input.checkbox').removeAttr('checked');
            }
            if (document.querySelectorAll('#excel-grouping-options span.checked').length == 2) {
                $('#excel-grouping-options .checkbox-container:not(.checked) > input.checkbox').attr('disabled', 'disabled');
            } else {
                $('#excel-grouping-options .checkbox-container:not(.checked) > input.checkbox').removeAttr('disabled');
            }
        });
        /*
        $('input[disabled="disabled"]').click(function () {
        console.log('pingo');
        });
        */
        $('#Export-options input.checkbox').change(function () {
            console.log(this.checked);
            $(this).parent().toggleClass('checked');
        });

        $('#exportBtn').click(function () {
            $('.logDiv').text('Exporting...');
            $('.logDiv').show();
            $('#downloadExcel').remove();
            var groupingOptions = [];
            $('#excel-grouping-options input.checkbox').each(function () {
                if (this.checked) {
                    var arrClass = $(this).parent().attr("class").split(" ");
                    var order = arrClass[2];
                    groupingOptions[order] = $(this).val();
                }
            });
            var exportOptions = [];
            $('#Export-options input.checkbox').each(function () {
                if (this.checked) {
                    exportOptions.push(this.value);
                }
            });
            var title = $('#excel-title').val();
            console.log(groupingOptions["first"]);
            $.ajax({
                url: "php/events.php",
                type: "GET",
                data: {
                    req: "excel",
                    exportConfigData: { "groupingOptions": { "first": groupingOptions["first"], "second": groupingOptions["second"] }, "exportOptions": exportOptions, "title": title }
                },
                success: function (response) {
                    console.log(response);
                    $('.excelExport #exportBtn').before('<a class="btn center excel" href="../lib/Excel/' + title + '.xlsx" id="downloadExcel" download><span class="icon"></span><input type="button" value="Download" class="btn"></a>');
                    $('.logDiv').slideUp();
                }
            });
        });

        $('#resetBtn').click(function () {
            $('#exportToExcel').click();
        });
    }

    function inviteBtnEvents() {
        $('.record-row .not-invited').off();
        $('.record-row .invited').off();

        $('.not-invited').click(function (e) {
            e.stopPropagation();
            $('.logDiv').text('Sending...');
            $('.logDiv').show();
            var id = this.parentNode.parentNode.childNodes[3].innerText.trim();
            var node = this;
            $.ajax({
                url: "php/events.php",
                type: "post",
                data: {
                    req: "invite",
                    id: id
                },
                success: function (response) {
                    $('.logDiv').html(response);
                    $(node).attr('class', 'invited');
                    $(node).text('Invited');
                    inviteBtnEvents();
                    setTimeout(slideUp, 2000);
                }
            });
        });

        $('.invited').click(function (e) {
            e.stopPropagation();
            $('.logDiv').text('Undoing...');
            $('.logDiv').show();
            var id = this.parentNode.parentNode.childNodes[3].innerText.trim();
            var node = this;
            $.ajax({
                url: "php/events.php",
                type: "post",
                data: {
                    req: "undo-invite",
                    id: id
                },
                success: function (response) {
                    $('.logDiv').html(response);
                    $(node).attr('class', 'not-invited');
                    $(node).text('Not Invited');
                    inviteBtnEvents();
                    setTimeout(slideUp, 2000);
                }
            });
        });

        $('.record-row .not-invited').hover(function () {
            $(this).text('Invite');
        }, function () {
            $(this).text('Not Invited');
        });

        $('.record-row .invited').hover(function () {
            $(this).text('Undo');
        }, function () {
            $(this).text('Invited');
        });

    }



    $('#invite').click(function () {
        $('.logDiv').text('Sending...');
        $('.logDiv').show();
        $.ajax({
            url: "php/events.php",
            type: "POST",
            data: {
                req: "invite",
                id: "all"
            },
            success: function (response) {
                $('.logDiv').text(response);
                setTimeout(slideUp, 2000);
            }
        });
    });

    $('input.checkbox').change(function () {
        console.log(this.checked);
        $(this).parent().toggleClass('checked');
    });

    function slideUp() {
        $('.logDiv').slideUp();
    }

});
function redirectToProfile(studentID) {
            window.location.href = 'studentProfile.php?studentID=' + studentID;
        }

  
  // updating the student info
    
    $('.saveIcon').click(function saveInputs() {
        open-profile
        // getting the values
        var information = { tableName: "student_info" };
        var data = { Student_ID:$('td[name=acad-id]').val() , Name:$('td[name=name]').val() ,Major:$('td[name=major]').val() ,GPA:$('td[name=gpa]').val() ,Nationality: $('td[name=nationality]').val(),Graduation_year:$('td[name=grad-year]').val() ,email: $('td[name=email]').val(),Current_Company:$('td[name=current-comp]').val() ,Coop_Company: $('td[name=co-op-comp]').val(),Company_size: $('td[name=comp-size]').val(),Job_title:$('td[name=title]').val()  };
        var informationJSON = JSON.stringify(information);
        var dataJSON = JSON.stringify(data);
        $.ajax({
            type: "GET",
            contentType: "application/json",
            data:
            {
                req: "store",
                information: informationJSON,
                data: dataJSON
            },
            url: "php/events.php",

            success: function (data)//we got the response
            {
                alert(data);
            },
            error: function (exception) { alert('Exeption:' + exception); }
        })

    });