$(document).ready(function () {

    // Green: #75B62A, 117,182,42
    // Red: #E84747, 232,71,71
    // Yellow: #FAB900, 250,185,0
    //light Blue: #26B6C9, 38,182,201
    //Blue: #45829F, 69,130,159
    //Dark Blue: #005781 , 0,87,129

    var companies = $('#companies');
    var companySizes = $('#companySizes');
    var numAlumnisByMajor = $('#numAlumnisByMajor');
    var nationalities = $('#nationalities');
    var companiesChartObject = {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"], // Companies Names
            datasets: [{
                label: '# of Votes',
                label: '# of Votes',
                label: '# of Votes',
                label: '# of Votes',
                label: '# of Votes',
                label: '# of Votes',
                data: [12, 19, 3, 5, 30, 3], // Values
                backgroundColor: [
                      'rgba(117,182,42, 0.4)',
                      'rgba(232,71,71, 0.4)',
                      'rgba(250,185,0, 0.4)',
                      'rgba(38,182,201, 0.4)',
                      'rgba(69,130,159, 0.4)',
                      'rgba(0,87,129, 0.4)'
                  ],
                borderColor: [
                      'rgba(117,182,42,1)',
                      'rgba(232,71,71, 1)',
                      'rgba(250,185,0, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(69,130,159, 1)',
                      'rgba(0,87,129, 1)'
                  ],
                borderWidth: 1
            }]
        },
        options: { responsive: true
        }
    };
    console.log(companiesChartObject.data.datasets[0].data[0]);

    var companiesChart = new Chart(companies, companiesChartObject);

    var companySizesObject = {
        type: 'pie',
        data: {
            labels: [
                "Red",
                "Blue",
                "Yellow"
            ],
            datasets: [
                {
                    data: [300, 50, 100],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ],
                    hoverBackgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ]
                }]
        },
        options: { responsive: true
        }
    };

    var companySizesChart = new Chart(companySizes, companySizesObject);

    var numAlumnisByMajorCharObject = {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"], // Companies Names
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3], // Values
                backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                borderWidth: 1
            }]
        },
        options: { responsive: true
        }
    };

    var numAlumnisByMajorChar = new Chart(numAlumnisByMajor, numAlumnisByMajorCharObject);

    var nationalitiesChartObject = {
        type: 'pie',
        data: {
            labels: [
                "Red",
                "Blue",
                "Yellow"
            ],
            datasets: [
                {
                    data: [300, 50, 100],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ],
                    hoverBackgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ]
                }]
        },
        options: { responsive: true
        }
    };

    var nationalitiesChart = new Chart(nationalities, nationalitiesChartObject);
});