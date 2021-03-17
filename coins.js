var initial_value = {
    "My Portfolio": 2500,
    "Bitcoin": 50000,
    "Etherium": 1500,
    "Dogecoin": 0.005,
    "Litecoin": 20,
    "Cardano": 0.15,
    "Polkadot": 38,
    "Bitcoin Cash": 550,
    "Stellar": 0.42,
    "Chainlink": 30
};

var current_value = {
    "My Portfolio": 2500,
    "Bitcoin": 50000,
    "Etherium": 1500,
    "Dogecoin": 0.005,
    "Litecoin": 20,
    "Cardano": 0.15,
    "Polkadot": 38,
    "Bitcoin Cash": 550,
    "Stellar": 0.42,
    "Chainlink": 30
}

getNextValue = (prev) => prev * (1.0 + (Math.random() - 0.5) * 0.01);

function updateCoinValues(coins){
    coins.forEach(function(coin){
        current_value[coin] = getNextValue(current_value[coin]);
        console.log(current_value[coin]);
    });
}

let fixDecimals = function(value){
    let abs_val = Math.abs(value);
    if(abs_val > 1000){
        value = value.toFixed(0);
    }else if(abs_val > 100){
        value = value.toFixed(2);
    }else if(abs_val > 1){
        value = value.toFixed(3)
    } else {
        value = value.toFixed(6);
    }
    return value;
}

function makeChart(coin){
    var config = {
        type: 'line',
        data: {
            labels: [""],
            datasets: [{
                backgroundColor: "green",
                borderColor: "green",
                data: [
                    initial_value[coin]
                ],
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
    window[coin] = new Chart(ctx, config);
}

function updateChart(coin){
    let d = new Date();
    window[coin].data.labels.push(d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
    
    window[coin].data.datasets.forEach(function(dataset) {
        var curr = current_value[coin];
        dataset.data.push(curr);
        window[coin].update();

        if(dataset.data.length >= 60){
            window[coin].data.labels.splice(0, 1);
            dataset.data.shift();

            window[coin].update();
        }

        if(dataset.data[0] > curr){
            dataset.borderColor = "red";
            dataset.backgroundColor = "red";
        }else{
            dataset.borderColor = "green";
            dataset.backgroundColor = "green";
        }

        window[coin].update();
    });
}

function updateFeaturedCoin(coin){
    var featured_coin = document.getElementById("featured-dc");

    window[coin].data.datasets.forEach(function(dataset) {
        var init = initial_value[coin];
        var curr = current_value[coin];
        var diff = fixDecimals(curr - init);
        var pct = ((Math.abs(diff) / init) * 100).toFixed(1);

        if (diff > 0){
            featured_coin.textContent = "▲ " + diff + " (" + pct + "%)";
            featured_coin.style = "color: green";
        } else {
            featured_coin.textContent = "▼ " + Math.abs(diff) + " (" + pct + "%)";
            featured_coin.style = "color: red";
        }
    });
}

function makeList(coins){
    var list = document.getElementById("coin-list");
    
    coins.forEach(function(coin){
        list.insertAdjacentHTML('beforeend', 
        "<tr id='" + coin + "' class='focus-row'>" +
            "<th scope='row'></th>" +
            "<td>" + coin + "</td>" +
            "<td id='value'>" + initial_value[coin] + "</td>" +
            "<td id='change'></td>" +
        "</tr>");
    });
}

function updateList(coins){
    coins.forEach(function(coin){
        var row = document.getElementById(coin);

        var init = initial_value[coin];
        var curr = current_value[coin];
        var diff = fixDecimals(curr - init);
        
        row.childNodes.item(2).textContent = fixDecimals(curr);

        if (diff > 0){
            row.childNodes.item(3).textContent = "▲ " + diff;
            row.style = "color: green";
        } else {
            row.childNodes.item(3).textContent = "▼ " + Math.abs(diff);
            row.style = "color: red";
        }
    });
}