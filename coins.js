chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};


function makeChart(name, initial){
    var config = {
        type: 'line',
        data: {
            labels: [""],
            datasets: [{
                backgroundColor: chartColors.red,
                borderColor: chartColors.red,
                data: [
                    initial
                ],
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: name
            },
            legend: {
                display: false,
            },
            tooltips: {
                enabled: false,
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value (USD)'
                    }
                }]
            }
        }
    };

    var ctx = document.getElementById('canvas').getContext('2d');
    window[name] = new Chart(ctx, config);
}

getNextValue = (prev) => prev * (1.0 + (Math.random() - 0.5) * 0.01);

function updateChart(name){
    let d = new Date();
    window[name].data.labels.push(d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
    
    window[name].data.datasets.forEach(function(dataset) {
        let next = getNextValue(dataset.data[dataset.data.length - 1]);
        dataset.data.push(next);

        window[name].update();

        if(dataset.data.length >= 60){
            window[name].data.labels.splice(0, 1); // remove the label first
            dataset.data.shift();

            window[name].update();
        }
    });
}

function populateList(coins){
    var list = document.getElementById("coin-list");
    // insert rows based upon coins
}

function updateList(coins){
    for (const coin in coins){
        var row = document.getElementById(name);
        var curr = parseFloat(row.childNodes.item(3).textContent);
        var next = getNextValue(curr);
        row.childNodes.item(3).textContent = next;

        var diff = coins[coin] - next;
        row.childNodes.item(2).textContent = Math.abs(diff);
        if (diff > 0){
            row.childNodes.item(2).textContent = "▲ " + diff;
            row.style = "color: green";
        } else {
            row.childNodes.item(2).textContent = "▼ " + Math.abs(diff);
            row.style = "color: green";
        }
        // color row accordingly
    }
}