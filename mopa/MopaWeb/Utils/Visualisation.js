let temperatureChart, humidityChart, co2Chart;

function createStatChart(canvas, title_min, xTitle, yTitle){
    return new Chart(document.getElementById(canvas).getContext('2d'), {
        data: {
            datasets: [{
                label: 'Vnitřní ' + title_min,
                backgroundColor: 'rgba(255, 99, 132, 1)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: [],
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }, {
                label: 'Vnitřní ' + title_min,
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                data: [],
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }]
        },
        options: {
            animation: {
                duration: 0
            },
            scales: {
                xAxes: [{
                    type: 'time',
                    distribution: 'series',
                    offset: true,
                    ticks: {
                        major: {
                            enabled: true,
                            fontStyle: 'bold'
                        },
                        source: 'data',
                        autoSkip: true,
                        autoSkipPadding: 75,
                        maxRotation: 0,
                        sampleSize: 100
                    },
                    scaleLabel: {
                        display: true,
                        labelString: xTitle
                    }
                }],
                yAxes: [{
                    gridLines: {
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: yTitle
                    }
                }]
            }
        }
    });
}

createStatChart("temperatureChart", "teplota", "Časová osa", "Stupně Celsia (°C)");