<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Joshua Devine and Abdullah Chaudry">
    <meta name="description" content="Let Coiner handle all your Cryptocurrency needs">

    <title>Coiner</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script><param name="" value="">
    <script src="search.js"></script>
    <script src="coins.js"></script>

</head>

<body>
    <?php include("header.php") ?>
    
    <div class="jumbotron">
        <div class="container">
          <h1>Start Investing in Crypto Today!</h1>
          <p class="text-center">Featured Coin: <b><i>Bitcoin</i></b> - Daily Change: <span id="featured-dc"></span></p>
          <div>
                <canvas id="canvas" height="400"></canvas>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h4>Coins We Offer</h4>
            <br>
            <br>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col" style="width: 4%"></th>
                    <th scope="col" style="width: 32%">Crypto</th>
                    <th scope="col" style="width: 32%">Current Price (USD)</th>
                    <th scope="col" style="width: 32%">Price Change</th>
                  </tr>
                </thead>
                <tbody id="coin-list"></tbody>
            </table>
        </div>
    </div>

    <script>
      var coins = ["Bitcoin", "Etherium", "Dogecoin", "Litecoin", "Cardano", "Polkadot", "Bitcoin Cash", "Stellar", "Chainlink"];
      var featured = "Bitcoin";

      makeChart(featured);
      makeList(coins);

      window.setInterval(function(){ 
          updateCoinValues(coins);
          updateFeaturedCoin(featured);
          updateChart(featured);
          updateList(coins);
        }, 1000);
    </script>

    <?php include("footer.php") ?>

</body>

</html>