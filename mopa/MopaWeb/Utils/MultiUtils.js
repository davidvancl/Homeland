function addData(chart, time, value, dataSetIndex) {
    chart.data.datasets[dataSetIndex].data.push({
        t: moment(time, 'YYYY-MM-DD HH:mm:ss'),
        y: value
    });
    chart.update();
}

function downloadImage(graph) {
    let a = document.createElement('a');
    a.href = graph.toBase64Image();
    a.download = 'chart.png';
    a.click();
}